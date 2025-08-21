<?php
// Konfigurasi database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$dbname = '19024_psas'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengatur charset menjadi UTF-8 untuk mendukung karakter internasional
$conn->set_charset("utf8");

// Jika Anda ingin menampilkan pesan sukses (hanya untuk debugging, sebaiknya dihapus di lingkungan produksi)
// echo "Koneksi berhasil!";

// Anda dapat menambahkan kode lain di sini untuk melakukan query atau operasi database lainnya

?>