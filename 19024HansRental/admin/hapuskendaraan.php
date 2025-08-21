<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

// Meng-include koneksi database
include '../koneksi/koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM tbkendaraan WHERE id='$id'";
$result = $conn->query($sql);
$kendaraan = $result->fetch_assoc();

if ($kendaraan) {
    // Hapus gambar dari folder uploads
    $fotoPath = 'uploads/' . $kendaraan['foto'];
    if (file_exists($fotoPath)) {
        unlink($fotoPath);
    }

    // Hapus data kendaraan dari database
    $sql = "DELETE FROM tbkendaraan WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kendaraan berhasil dihapus!'); window.location.href='kendaraan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "<script>alert('Kendaraan tidak ditemukan!'); window.location.href='kendaraan.php';</script>";
}
?>