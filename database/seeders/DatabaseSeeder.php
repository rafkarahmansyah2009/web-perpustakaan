<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Announcement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            ['name' => 'Ahmad Rizki Pratama', 'nis' => '20240001', 'kelas' => 'XII RPL 1', 'email' => 'ahmad.rizki@siswa.smkn5tng.sch.id'],
            ['name' => 'Dewi Anggraini', 'nis' => '20240002', 'kelas' => 'XII RPL 2', 'email' => 'dewi.anggraini@siswa.smkn5tng.sch.id'],
            ['name' => 'Farhan Maulana', 'nis' => '20240003', 'kelas' => 'XI TKJ 1', 'email' => 'farhan.maulana@siswa.smkn5tng.sch.id'],
            ['name' => 'Nadia Putri', 'nis' => '20240004', 'kelas' => 'XI MM 1', 'email' => 'nadia.putri@siswa.smkn5tng.sch.id'],
            ['name' => 'Reza Firmansyah', 'nis' => '20240005', 'kelas' => 'X RPL 1', 'email' => 'reza.firmansyah@siswa.smkn5tng.sch.id'],
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
    }
}
