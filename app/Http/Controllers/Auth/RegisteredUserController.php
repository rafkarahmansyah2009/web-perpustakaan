<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:siswa,guru'],
            'no_telp' => ['nullable', 'string', 'max:20'],
        ];

        // Conditional validation based on role
        if ($request->role === 'siswa') {
            $rules['nis'] = ['required', 'string', 'max:20', 'unique:users,nis'];
            $rules['kelas'] = ['required', 'string', 'max:20'];
        } elseif ($request->role === 'guru') {
            $rules['nip'] = ['required', 'string', 'max:30', 'unique:users,nip'];
        }

        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Pilih peran (Siswa/Guru).',
            'role.in' => 'Peran harus Siswa atau Guru.',
            'nis.required' => 'NIS wajib diisi untuk siswa.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'kelas.required' => 'Kelas wajib dipilih untuk siswa.',
            'nip.required' => 'NIP wajib diisi untuk guru.',
            'nip.unique' => 'NIP sudah terdaftar.',
        ];

        $request->validate($rules, $messages);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'no_telp' => $request->no_telp,
            'status_aktif' => true,
        ];

        if ($request->role === 'siswa') {
            $userData['nis'] = $request->nis;
            $userData['kelas'] = $request->kelas;
        } elseif ($request->role === 'guru') {
            $userData['nip'] = $request->nip;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
