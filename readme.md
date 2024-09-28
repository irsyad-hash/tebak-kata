# Permainan Tebak Kata

Permainan Tebak Kata adalah aplikasi web sederhana yang memungkinkan pengguna untuk menebak kata berdasarkan deskripsi yang diberikan. Aplikasi ini dibuat menggunakan PHP dan MySQL.

## Fitur

- Kata dan deskripsi diambil secara acak dari database
- Penilaian per huruf (+10 untuk benar, -2 untuk salah)
- Clue otomatis untuk huruf ke-3 dan ke-7
- Tampilan hasil yang detail setelah menebak
- Sistem penyimpanan skor dengan nama pengguna
- Desain responsif dan user-friendly

## Persyaratan Sistem

- PHP 7.0 atau lebih tinggi
- MySQL 5.6 atau lebih tinggi
- Web server (misalnya Apache, Nginx)

## Instalasi

1. Clone repositori ini ke direktori web server Anda:

   ```
   git clone https://github.com/irsyad-hash/tebak-kata.gitt
   ```

2. Import struktur database dari file `database.sql` ke MySQL server Anda.

3. Edit file `db_config.php` dan sesuaikan dengan pengaturan database Anda:

   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "your_database_name";
   ```

4. Pastikan direktori `assets` dan file di dalamnya memiliki izin yang benar untuk diakses oleh web server.

## Penggunaan

1. Buka aplikasi melalui web browser (misalnya http://localhost/permainan-tebak-kata).

2. Baca deskripsi kata yang ditampilkan.

3. Masukkan huruf-huruf tebakan Anda ke dalam kotak input. Perhatikan bahwa huruf ke-3 dan ke-7 sudah terisi sebagai clue.

4. Klik tombol "Jawab" untuk melihat hasil tebakan Anda.

5. Pada halaman hasil, Anda dapat melihat skor Anda dan menyimpannya dengan memasukkan nama.

6. Klik "ULANGI" untuk memulai permainan baru.

## Struktur Proyek

- `index.php`: Halaman utama permainan
- `result.php`: Halaman hasil tebakan
- `db_config.php`: Konfigurasi koneksi database
- `assets/style.css`: File CSS untuk styling
- `database.sql`: Struktur database MySQL

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repositori, buat branch fitur, dan ajukan pull request.

## Lisensi

Proyek ini dilisensikan di bawah MIT License. Lihat file `LICENSE` untuk detail lebih lanjut.

## Kontak

Jika Anda memiliki pertanyaan atau saran, silakan hubungi kami di irsyadfauzi@gmail.com.
