<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

// Meng-include koneksi database
include '../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST['jenis'];
    $seri = $_POST['seri'];
    $keterangan = $_POST['keterangan'];
    $tarif = $_POST['tarif'];
    $durasi = $_POST['durasi'];

    // Mengambil informasi file
    $foto = $_FILES['foto'];
    $fotoName = $_FILES['foto']['name'];
    $fotoTmpName = $_FILES['foto']['tmp_name'];
    $fotoSize = $_FILES['foto']['size'];
    $fotoError = $_FILES['foto']['error'];
    $fotoType = $_FILES['foto']['type'];

    // Mengatur ekstensi yang diizinkan
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $fotoExt = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));

    // Validasi file
    if (in_array($fotoExt, $allowed) && $fotoError === 0) {
        if ($fotoSize < 2000000) { // Maksimum ukuran file 2MB
            // Membuat nama file unik
            $fotoNewName = uniqid('', true) . "." . $fotoExt;
            $fotoDestination = 'uploads/' . $fotoNewName;

            // Memindahkan file ke folder uploads
            if (move_uploaded_file($fotoTmpName, $fotoDestination)) {
                // Menyimpan informasi kendaraan ke database
                $sql = "INSERT INTO tbkendaraan (jenis, seri, keterangan, foto, tarif, durasi) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $jenis, $seri, $keterangan, $fotoNewName, $tarif, $durasi);

                if ($stmt->execute()) {
                    echo "<script>alert('Kendaraan berhasil ditambahkan!'); window.location.href='kendaraan.php';</script>";
                } else {
                    echo "<script>alert('Terjadi kesalahan saat menambahkan kendaraan.');</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Gagal mengunggah foto.');</script>";
            }
        } else {
            echo "<script>alert('Ukuran file terlalu besar!');</script>";
        }
    } else {
        echo "<script>alert('Format file tidak diizinkan atau terjadi kesalahan saat upload!');</script>";
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan - Hans Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1e1e1e;
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #b0b0b0;
            margin-bottom: 20px;
        }

        form {
            background: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            max-width: 600px; /* Lebar maksimum form */
            margin: auto;
            display: flex;
            flex-direction: column; /* Mengatur elemen dalam kolom */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #f0f0f0;
        }

        input[type="text"], textarea, input[type="file"] {
            width: 90%; /* Mengurangi lebar input dan textarea */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #555;
            border-radius: 4px;
            background: #3a3a3a;
            color: #f0f0f0;
            font-size: 16px;
            margin-left: auto; /* Menjajarkan input ke tengah */
            margin-right: auto; /* Menjajarkan input ke tengah */
        }

        button {
            background-color: #808080; /* Warna tombol abu-abu */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-bottom: 10px; /* Jarak antara tombol */
        }

        button:hover {
            background-color: #696969; /* Warna tombol saat hover */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #808080; /* Warna tautan abu-abu */
            font-weight: bold;
        }

        a:hover {
            color: #696969; /* Warna tautan saat hover */
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            form {
                width: 90%; /* Lebar form di perangkat kecil */
            }
        }
    </style>
</head>
<body>

<h1>Tambah Kendaraan</h1>
<form method="POST" action="" enctype="multipart/form-data">
    <label for="jenis">Jenis Kendaraan:</label>
    <input type="text" id="jenis" name="jenis" required>

    <label for="seri">Seri Kendaraan:</label>
    <input type="text" id="seri" name="seri" required>

    <label for="keterangan">Keterangan:</label>
    <textarea id="keterangan" name="keterangan" required></textarea>

    <label for="tarif">Tarif:</label>
    <input type="text" id="tarif" name="tarif" required>

    <label for="durasi">Durasi:</label>
    <input type="text" id="durasi" name="durasi" required>

    <label for="foto">Foto Kendaraan:</label>
    <input type="file" id="foto" name="foto" accept="image/*" required>

    <button type="submit"><i class="fas fa-plus"></i> Tambah Kendaraan</button>
    <a href="kendaraan.php"><i class="fas fa-arrow-left"></i> Kembali</a>
</form>

</body>
</html>