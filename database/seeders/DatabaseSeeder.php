<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Announcement;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ADMIN =====
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@smkn5tng.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_aktif' => true,
        ]);

        // ===== GURU =====
        User::create([
            'name' => 'Budi Santoso, S.Pd.',
            'email' => 'budi.santoso@smkn5tng.sch.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'nip' => '198501152010011001',
            'no_telp' => '081234567890',
            'status_aktif' => true,
        ]);

        User::create([
            'name' => 'Siti Rahayu, M.Pd.',
            'email' => 'siti.rahayu@smkn5tng.sch.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'nip' => '199003222015042001',
            'no_telp' => '081234567891',
            'status_aktif' => true,
        ]);

        // ===== SISWA =====
        $siswaData = [
            ['name' => 'Kasandra Aulea', 'nis' => '12425231', 'kelas' => 'XI RPL 1', 'email' => 'kasandra.aulea@siswa.smkn5tng.sch.id'],
            ['name' => 'Kayla Sanari Rubina', 'nis' => '12425232', 'kelas' => 'XI RPL 1', 'email' => 'kayla.sanari@siswa.smkn5tng.sch.id'],
            ['name' => 'Khalid Rahman Al-Fachrezy', 'nis' => '12425233', 'kelas' => 'XI RPL 1', 'email' => 'khalid.rahman@siswa.smkn5tng.sch.id'],
            ['name' => 'Khasanah Amelia', 'nis' => '12425234', 'kelas' => 'XI RPL 1', 'email' => 'khasanah.amelia@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhamad Agam Firdaus', 'nis' => '12425236', 'kelas' => 'XI RPL 1', 'email' => 'muhamad.agam@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhamad Choiril Azhar', 'nis' => '12425237', 'kelas' => 'XI RPL 1', 'email' => 'muhamad.choiril@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhamad Tazul Arifin', 'nis' => '12425238', 'kelas' => 'XI RPL 1', 'email' => 'muhamad.tazul@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhammad Fadhlan Algifahri', 'nis' => '12425239', 'kelas' => 'XI RPL 1', 'email' => 'muhammad.fadhlan@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhammad Fahri Ferdinan', 'nis' => '12425240', 'kelas' => 'XI RPL 1', 'email' => 'muhammad.fahri@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhammad Havid Muzacky', 'nis' => '12425241', 'kelas' => 'XI RPL 1', 'email' => 'muhammad.havid@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhammad Rito Xama Zimmy', 'nis' => '12425242', 'kelas' => 'XI RPL 1', 'email' => 'muhammad.rito@siswa.smkn5tng.sch.id'],
            ['name' => 'Muhammad Rizqi Abian', 'nis' => '12425243', 'kelas' => 'XI RPL 1', 'email' => 'muhammad.rizqi@siswa.smkn5tng.sch.id'],
            ['name' => 'Rafka Rahmansyah', 'nis' => '12425245', 'kelas' => 'XI RPL 1', 'email' => 'rafka.rahmansyah@siswa.smkn5tng.sch.id'],
            ['name' => 'Sopyan Firdaus', 'nis' => '12425250', 'kelas' => 'XI RPL 1', 'email' => 'sopyan.firdaus@siswa.smkn5tng.sch.id'],
            ['name' => 'Tobias Ibrahim', 'nis' => '12425252', 'kelas' => 'XI RPL 1', 'email' => 'tobias.ibrahim@siswa.smkn5tng.sch.id'],
        ];

        foreach ($siswaData as $siswa) {
            User::create(array_merge($siswa, [
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'status_aktif' => true,
            ]));
        }

        // ===== CATEGORIES =====
        $categories = [
            ['nama' => 'Fiksi', 'slug' => 'fiksi', 'deskripsi' => 'Novel, cerpen, dan karya fiksi lainnya'],
            ['nama' => 'Pelajaran', 'slug' => 'pelajaran', 'deskripsi' => 'Buku teks pelajaran sekolah'],
            ['nama' => 'Referensi', 'slug' => 'referensi', 'deskripsi' => 'Ensiklopedia, kamus, dan buku referensi'],
            ['nama' => 'Sains', 'slug' => 'sains', 'deskripsi' => 'Buku-buku ilmu pengetahuan alam dan teknologi'],
            ['nama' => 'Sejarah', 'slug' => 'sejarah', 'deskripsi' => 'Buku tentang sejarah Indonesia dan dunia'],
            ['nama' => 'Komik', 'slug' => 'komik', 'deskripsi' => 'Buku cerita bergambar dan manga'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // ===== BOOKS =====
        $books = [
            [
                'isbn' => '978-602-06-5070-1',
                'judul' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori_id' => 1,
                'deskripsi' => 'Novel inspiratif tentang perjuangan anak-anak Belitung untuk mendapatkan pendidikan. Kisah yang penuh semangat dan harapan.',
                'stok' => 5,
                'lokasi_rak' => 'A-01',
            ],
            [
                'isbn' => '978-602-03-2876-5',
                'judul' => 'Bumi Manusia',
                'pengarang' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => 1980,
                'kategori_id' => 1,
                'deskripsi' => 'Novel sejarah yang mengisahkan kehidupan Minke, seorang priyayi Jawa di era kolonial Belanda.',
                'stok' => 3,
                'lokasi_rak' => 'A-02',
            ],
            [
                'isbn' => '978-602-244-505-3',
                'judul' => 'Matematika SMA Kelas XII',
                'pengarang' => 'Kemendikbud',
                'penerbit' => 'Pusat Kurikulum',
                'tahun_terbit' => 2023,
                'kategori_id' => 2,
                'deskripsi' => 'Buku teks pelajaran matematika untuk SMA/SMK kelas XII sesuai kurikulum merdeka.',
                'stok' => 15,
                'lokasi_rak' => 'B-01',
            ],
            [
                'isbn' => '978-602-244-510-7',
                'judul' => 'Bahasa Indonesia SMA Kelas XI',
                'pengarang' => 'Kemendikbud',
                'penerbit' => 'Pusat Kurikulum',
                'tahun_terbit' => 2023,
                'kategori_id' => 2,
                'deskripsi' => 'Buku teks pelajaran Bahasa Indonesia kelas XI dengan pendekatan berbasis teks.',
                'stok' => 12,
                'lokasi_rak' => 'B-02',
            ],
            [
                'isbn' => '978-979-22-1234-5',
                'judul' => 'Kamus Besar Bahasa Indonesia',
                'pengarang' => 'Tim Penyusun KBBI',
                'penerbit' => 'Balai Pustaka',
                'tahun_terbit' => 2020,
                'kategori_id' => 3,
                'deskripsi' => 'Kamus resmi Bahasa Indonesia edisi kelima dengan entri terbaru.',
                'stok' => 4,
                'lokasi_rak' => 'C-01',
            ],
            [
                'isbn' => '978-0-13-468599-1',
                'judul' => 'Ensiklopedia Ilmu Pengetahuan',
                'pengarang' => 'DK Publishing',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2019,
                'kategori_id' => 3,
                'deskripsi' => 'Ensiklopedia visual yang mencakup berbagai bidang ilmu pengetahuan.',
                'stok' => 2,
                'lokasi_rak' => 'C-02',
            ],
            [
                'isbn' => '978-602-03-5566-2',
                'judul' => 'Fisika Dasar untuk SMA',
                'pengarang' => 'Halliday & Resnick',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2021,
                'kategori_id' => 4,
                'deskripsi' => 'Buku fisika dasar yang membahas mekanika, termodinamika, dan gelombang.',
                'stok' => 8,
                'lokasi_rak' => 'D-01',
            ],
            [
                'isbn' => '978-602-03-5577-8',
                'judul' => 'Biologi Molekuler',
                'pengarang' => 'Bruce Alberts',
                'penerbit' => 'EGC',
                'tahun_terbit' => 2022,
                'kategori_id' => 4,
                'deskripsi' => 'Buku referensi biologi molekuler dan sel untuk tingkat lanjut.',
                'stok' => 3,
                'lokasi_rak' => 'D-02',
            ],
            [
                'isbn' => '978-979-9023-45-6',
                'judul' => 'Sejarah Indonesia Modern',
                'pengarang' => 'M.C. Ricklefs',
                'penerbit' => 'Gadjah Mada University Press',
                'tahun_terbit' => 2018,
                'kategori_id' => 5,
                'deskripsi' => 'Buku komprehensif tentang sejarah Indonesia dari masa kolonial hingga reformasi.',
                'stok' => 6,
                'lokasi_rak' => 'E-01',
            ],
            [
                'isbn' => '978-979-9023-50-0',
                'judul' => 'Sejarah Peradaban Dunia',
                'pengarang' => 'Sartono Kartodirdjo',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2017,
                'kategori_id' => 5,
                'deskripsi' => 'Perjalanan peradaban manusia dari zaman kuno hingga era modern.',
                'stok' => 4,
                'lokasi_rak' => 'E-02',
            ],
            [
                'isbn' => '978-602-04-9836-9',
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'pengarang' => 'Yuval Noah Harari',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => 2018,
                'kategori_id' => 5,
                'deskripsi' => 'Buku yang mengeksplorasi sejarah umat manusia dari zaman batu hingga abad ke-21.',
                'stok' => 8,
                'lokasi_rak' => 'E-03',
            ],
            [
                'isbn' => '978-623-242-124-1',
                'judul' => 'Atomic Habits',
                'pengarang' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2019,
                'kategori_id' => 3,
                'deskripsi' => 'Perubahan kecil yang memberikan hasil luar biasa dalam membangun kebiasaan baik.',
                'stok' => 12,
                'lokasi_rak' => 'C-03',
            ],
            [
                'isbn' => '978-602-06-3317-6',
                'judul' => 'Filosofi Teras',
                'pengarang' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2019,
                'kategori_id' => 3,
                'deskripsi' => 'Filsafat Yunani-Romawi kuno untuk mental tangguh masa kini.',
                'stok' => 10,
                'lokasi_rak' => 'C-04',
            ],
            [
                'isbn' => '978-979-22-8133-8',
                'judul' => 'Hujan',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2016,
                'kategori_id' => 1,
                'deskripsi' => 'Novel tentang persahabatan, cinta, dan melupakan di tengah bencana alam.',
                'stok' => 7,
                'lokasi_rak' => 'A-03',
            ],
            [
                'isbn' => '978-602-8519-93-9',
                'judul' => 'Cantik Itu Luka',
                'pengarang' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2002,
                'kategori_id' => 1,
                'deskripsi' => 'Kisah epik keluarga yang memadukan sejarah kelam Indonesia dengan realisme magis.',
                'stok' => 5,
                'lokasi_rak' => 'A-04',
            ],
            [
                'isbn' => '978-602-244-525-1',
                'judul' => 'Informatika SMA Kelas X',
                'pengarang' => 'Kemendikbud',
                'penerbit' => 'Pusat Kurikulum',
                'tahun_terbit' => 2021,
                'kategori_id' => 2,
                'deskripsi' => 'Buku teks pelajaran informatika dasar untuk siswa kelas X.',
                'stok' => 20,
                'lokasi_rak' => 'B-03',
            ],
            [
                'isbn' => '978-602-04-0123-4',
                'judul' => 'Naruto Vol. 1',
                'pengarang' => 'Masashi Kishimoto',
                'penerbit' => 'Elex Media Komputindo',
                'tahun_terbit' => 2003,
                'kategori_id' => 6,
                'deskripsi' => 'Perjalanan awal Uzumaki Naruto untuk menjadi seorang Hokage.',
                'stok' => 10,
                'lokasi_rak' => 'F-01',
            ],
            [
                'isbn' => '978-602-04-5678-9',
                'judul' => 'Boruto: Naruto Next Generations Vol. 1',
                'pengarang' => 'Ukyo Kodachi & Mikio Ikemoto',
                'penerbit' => 'Elex Media Komputindo',
                'tahun_terbit' => 2017,
                'kategori_id' => 6,
                'deskripsi' => 'Kisah generasi baru ninja setelah era Naruto, berpusat pada Boruto Uzumaki.',
                'stok' => 8,
                'lokasi_rak' => 'F-02',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // ===== ANNOUNCEMENTS =====
        Announcement::create([
            'judul' => 'Selamat Datang di Perpustakaan Digital SMKN 5 Tangerang',
            'slug' => 'selamat-datang-perpustakaan-digital',
            'konten' => '<p>Perpustakaan SMKN 5 Tangerang kini hadir dalam bentuk digital! Siswa dan guru dapat mengakses katalog buku, mengajukan peminjaman, dan melihat riwayat pinjaman secara online.</p><p>Fitur-fitur utama:</p><ul><li>Pencarian buku berdasarkan judul, pengarang, atau kategori</li><li>Pengajuan peminjaman online</li><li>Notifikasi jatuh tempo</li><li>Kartu anggota digital</li></ul>',
            'status' => 'publish',
            'tgl_publish' => now(),
        ]);

        Announcement::create([
            'judul' => 'Koleksi Buku Baru Semester Genap 2025/2026',
            'slug' => 'koleksi-buku-baru-semester-genap',
            'konten' => '<p>Perpustakaan telah menambahkan 50 judul buku baru untuk semester genap tahun ajaran 2025/2026. Koleksi baru mencakup buku-buku pelajaran terbaru, novel populer, dan referensi ilmiah.</p><p>Kunjungi katalog kami untuk melihat daftar lengkap buku baru!</p>',
            'status' => 'publish',
            'tgl_publish' => now()->subDays(3),
        ]);

        Announcement::create([
            'judul' => 'Jadwal Operasional Perpustakaan',
            'slug' => 'jadwal-operasional-perpustakaan',
            'konten' => '<p>Perpustakaan SMKN 5 Tangerang buka setiap hari kerja:</p><ul><li>Senin - Kamis: 07.00 - 15.00 WIB</li><li>Jumat: 07.00 - 11.30 WIB</li></ul><p>Peminjaman dan pengembalian buku hanya dilayani pada jam operasional.</p>',
            'status' => 'publish',
            'tgl_publish' => now()->subDays(7),
        ]);

        // ===== LOANS & FINES (SAMPLE DATA) =====
        $siswaList = User::where('role', 'siswa')->take(5)->get();
        $bookList = Book::take(5)->get();

        if ($siswaList->count() >= 3 && $bookList->count() >= 3) {
            // 1. Peminjaman Berstatus 'Pending'
            Loan::create([
                'user_id' => $siswaList[0]->id,
                'book_id' => $bookList[0]->id,
                'tgl_pinjam' => Carbon::now()->toDateString(),
                'tgl_kembali_rencana' => Carbon::now()->addDays(7)->toDateString(),
                'status' => 'pending',
            ]);

            // 2. Peminjaman Berstatus 'Dipinjam' (Aktif)
            Loan::create([
                'user_id' => $siswaList[1]->id,
                'book_id' => $bookList[1]->id,
                'tgl_pinjam' => Carbon::now()->subDays(2)->toDateString(),
                'tgl_kembali_rencana' => Carbon::now()->addDays(5)->toDateString(),
                'status' => 'dipinjam',
            ]);

            // 3. Peminjaman Berstatus 'Terlambat' & Punya Denda
            $lateLoan = Loan::create([
                'user_id' => $siswaList[2]->id,
                'book_id' => $bookList[2]->id,
                'tgl_pinjam' => Carbon::now()->subDays(10)->toDateString(),
                'tgl_kembali_rencana' => Carbon::now()->subDays(3)->toDateString(),
                'status' => 'terlambat',
            ]);

            Fine::create([
                'loan_id' => $lateLoan->id,
                'jumlah_hari' => 3,
                'nominal_denda' => 3000, // 1000 per hari misal
                'status_bayar' => 'belum',
            ]);

            // 4. Peminjaman Berstatus 'Dikembalikan' & Denda Lunas
            $returnedLoan = Loan::create([
                'user_id' => $siswaList[3]->id,
                'book_id' => $bookList[3]->id,
                'tgl_pinjam' => Carbon::now()->subDays(15)->toDateString(),
                'tgl_kembali_rencana' => Carbon::now()->subDays(8)->toDateString(),
                'tgl_kembali_aktual' => Carbon::now()->subDays(5)->toDateString(),
                'status' => 'dikembalikan',
            ]);

            Fine::create([
                'loan_id' => $returnedLoan->id,
                'jumlah_hari' => 3,
                'nominal_denda' => 3000,
                'status_bayar' => 'lunas',
                'tgl_bayar' => Carbon::now()->subDays(5)->toDateString(),
            ]);
        }
    }
}
