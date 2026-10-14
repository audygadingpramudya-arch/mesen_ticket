# DB_PEMESANAN_TIKET

## Tahapan Pertama: Persiapan Projek

1. Membuat folder projek dengan nama `db_pemesanan_ticket`.
2. Membuat dan menyesuaikan struktur MVC (*Model, View, Controller*) pada Laravel.
3. Membuat database untuk aplikasi pemesanan tiket.
4. Membuat model, view, dan controller sesuai kebutuhan aplikasi.
5. Menyiapkan konfigurasi awal projek Laravel.

## Tahapan Kedua: Konfigurasi Database

1. Mengonfigurasi koneksi database pada file `.env`.
2. Menyesuaikan nama database dengan database yang telah dibuat.
3. Mengubah konfigurasi database menjadi MySQL.
4. Memastikan username dan password database sudah benar.
5. Menjalankan perintah `php artisan migrate` untuk membuat tabel bawaan Laravel.
6. Memastikan koneksi database berhasil dan tabel berhasil dibuat.

## Tahapan Ketiga: Pembuatan Struktur Database

1. Membuat dan mengisi file migration untuk tabel `orders`.
2. Membuat dan mengisi file migration untuk tabel `events`.
3. Membuat dan mengisi file migration untuk tabel `order_details`.
4. Menentukan kolom, tipe data, primary key, dan foreign key pada setiap tabel.
5. Menjalankan migration untuk membuat ketiga tabel di database.
6. Memeriksa struktur tabel melalui phpMyAdmin atau MySQL.
7. Membuat relasi antartabel sesuai kebutuhan sistem pemesanan tiket.

## Tahapan Keempat: Pembuatan Model dan Relasi

1. Membuat model `Order`, `Event`, dan `OrderDetail`.
2. Mengatur properti `$fillable` pada setiap model.
3. Membuat relasi antarmodel menggunakan `Hasy()`, `belongsTo()`, atau relasi lain yang sesuai.
4. Menguji relasi model dengan database.

## Tahapan Kelima: Pembuatan Controller dan Halaman

1. Membuat `OrderController`, `EventsController`, dan `OrderDetailController`.
2. Membuat fungsi menampilkan data, menambah data, mengubah data, dan menghapus data (CRUD).
3. Membuat halaman Blade untuk menampilkan data pemesanan tiket.
4. Membuat formulir untuk menambahkan dan mengubah data.
5. Mengatur route pada file `routes/web.php`.
6. Menghubungkan halaman View dengan Controller dan Model.

## Tahapan Keenam: Pengujian Aplikasi

1. Menjalankan aplikasi menggunakan `php artisan serve`.
2. Menguji proses tambah, tampil, ubah, dan hapus data.
3. Memastikan data berhasil disimpan ke database MySQL.
4. Menguji relasi antara pesanan, acara, dan detail pesanan.
5. Memperbaiki error yang ditemukan selama pengujian.

## Tahapan Ketujuh: Upload Projek ke GitHub

1. Memeriksa perubahan file menggunakan `git status`.
2. Menambahkan file yang akan diunggah menggunakan `git add .`.
3. Membuat commit menggunakan `git commit -m "Menyelesaikan database pemesanan tiket"`.
4. Mengambil perubahan terbaru dari GitHub menggunakan `git pull origin main`.
5. Mengirim perubahan ke GitHub menggunakan `git push -u origin main`.
6. Memastikan seluruh perubahan projek sudah tersimpan di repositori GitHub.