<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan SMKN 5 Tangerang' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fbf9f4] text-[#1b1c19]" x-data="{ mobileMenu: false }">

    {{-- Member Navigation --}}
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-white p-1" style="box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo SMKN 5 Tangerang" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-headline text-lg font-bold text-[#1a4d2e] leading-none">Perpustakaan</span>
                        <span class="block text-[10px] font-body font-medium text-[#414942] tracking-widest uppercase">SMKN 5 Tangerang</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-[#414942] hover:text-[#1a4d2e] transition-colors">Beranda</a>
                    <a href="{{ route('catalog.index') }}" class="text-sm font-medium {{ request()->routeIs('catalog.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Katalog</a>
                    <a href="{{ route('member.loans.index') }}" class="text-sm font-medium {{ request()->routeIs('member.loans.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Pinjaman Saya</a>
                    <a href="{{ route('member.profile.edit') }}" class="text-sm font-medium {{ request()->routeIs('member.profile.*') ? 'text-[#1a4d2e]' : 'text-[#414942] hover:text-[#1a4d2e]' }} transition-colors">Profil</a>
                </div>

                {{-- User info --}}
                <div class="hidden md:flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        @if(auth()->user()->foto)
                            <img src="{{ Storage::url(auth()->user()->foto) }}" class="w-8 h-8 rounded-full object-cover" alt="">
                        @else
                            <div class="w-8 h-8 rounded-full bg-[#1a4d2e] flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-sm font-medium text-[#1b1c19]">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[#414942] hover:text-[#c8401a] transition-colors text-sm">Keluar</button>
                    </form>
                </div>

                {{-- Mobile --}}
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-[#1a4d2e]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <div class="h-[2px] bg-[#eae8e3]"></div>
    </nav>

    {{-- Toast --}}
    @if(session('success') || session('error') || session('warning'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition class="fixed top-20 right-6 z-[60]">
        @if(session('success'))
            <div class="toast-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="toast-error">{{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="toast-warning">{{ session('warning') }}</div>
        @endif
    </div>
    @endif

    <main class="pt-20 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert2 Delete Confirmation
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "swal-btn-confirm",
                    cancelButton: "swal-btn-cancel"
                },
                buttonsStyling: false
            });

            document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
                form.removeAttribute('onsubmit');
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const thisForm = this;
                    swalWithBootstrapButtons.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal",
                        reverseButtons: true,
                        background: '#fbf9f4',
                        color: '#1b1c19',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown animate__faster'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp animate__faster'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                title: "Terhapus!",
                                text: "Data telah berhasil dihapus.",
                                icon: "success",
                                background: '#fbf9f4',
                                color: '#1b1c19',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown animate__faster'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                                }
                            }).then(() => {
                                thisForm.submit();
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Dibatalkan",
                                text: "Data Anda tetap aman :)",
                                icon: "error",
                                background: '#fbf9f4',
                                color: '#1b1c19',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown animate__faster'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                                }
                            });
                        }
                    });
                });
            });

            // Password Toggle Visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    if (!passwordInput) return;
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    const eyeIcon = this.querySelector('svg');
                    if (type === 'text') {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
                    } else {
                        eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                    }
                });
            });
        });
    </script>
</body>
</html>
