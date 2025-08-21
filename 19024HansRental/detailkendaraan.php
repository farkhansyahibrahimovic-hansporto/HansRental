<?php
// Meng-include koneksi database
include 'koneksi/koneksi.php';

// Memeriksa apakah ID kendaraan ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data kendaraan berdasarkan ID
    $sql = "SELECT * FROM tbkendaraan WHERE id='$id'";
    $result = $conn->query($sql);

    // Memastikan data ditemukan
    if ($result->num_rows > 0) {
        $kendaraan = $result->fetch_assoc();
    } else {
        echo "<script>alert('Kendaraan tidak ditemukan!'); window.location.href='bus-list.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID kendaraan tidak valid!'); window.location.href='bus-list.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hans Rental - Detail Kendaraan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(to bottom, #000000, #434343);
            color: white;
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1; /* Memastikan kontainer mengambil sisa ruang */
        }

        .detail-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            text-align: left; /* Mengubah teks menjadi rata kiri */
            transition: transform 0.3s; /* Efek transisi saat hover */
            margin-bottom: 20px; /* Ruang bawah untuk detail card */
        }

        .detail-card:hover {
            transform: scale(1.02); /* Efek zoom saat hover */
        }

        .detail-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px; /* Ruang bawah untuk gambar */
        }

        .detail-card h2 {
            margin: 10px 0;
            font-size: 2em;
        }

        .detail-card p {
            margin: 10px 0; /* Menambahkan margin untuk jarak antar paragraf */
            font-size: 1.2em;
        }

        footer {
            background: linear-gradient(to top, #000000, #434343);
            color: white;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: flex;
            align-items: center; /* Vertikal center */
            justify-content: center; /* Horizontal center */
            margin-top: 30px; /* Menambah jarak antara tombol dan teks di atasnya */
            flex-wrap: wrap; /* Memungkinkan tombol untuk berpindah ke baris berikutnya pada ukuran layar kecil */
        }

        .back-button,
        .order-button {
            padding: 10px 15px;
            background-color: #6c757d; /* Warna abu-abu */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin: 0 10px; /* Jarak antar tombol */
            transition: background-color 0.3 s; /* Transisi untuk efek hover */
            flex: 1; /* Membuat tombol mengambil ruang yang sama */
            max-width: 200px; /* Membatasi lebar maksimum tombol */
            text-align: center; /* Memastikan teks tombol berada di tengah */
        }

        .back-button:hover,
        .order-button:hover {
            background-color: #5a6268; /* Warna abu-abu gelap saat hover */
        }

        .logo {
            width: 50px; /* Ukuran logo */
            height: 50px; /* Ukuran logo */
            border-radius: 50%; /* Membuat logo berbentuk lingkaran */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
            margin: 0 15px; /* Jarak antara logo dan tombol */
        }

        /* Media Queries untuk responsivitas */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2em; /* Ukuran font lebih kecil pada layar kecil */
            }

            .detail-card h2 {
                font-size: 1.5em; /* Ukuran font lebih kecil pada layar kecil */
            }

            .detail-card p {
                font-size: 1em; /* Ukuran font lebih kecil pada layar kecil */
                margin: 8px 0; /* Mengurangi margin untuk jarak yang lebih baik */
            }

            .back-button,
            .order-button {
                padding: 8px 12px; /* Ukuran tombol lebih kecil pada layar kecil */
                flex: 1; /* Membuat tombol mengambil ruang yang sama */
                max-width: 100%; /* Memastikan tombol tidak melebihi lebar kontainer */
            }

            .logo {
                width: 40px; /* Ukuran logo lebih kecil pada layar kecil */
                height: 40px; /* Ukuran logo lebih kecil pada layar kecil */
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Detail Kendaraan</h1>
</header>

<div class="container">
    <div class="detail-card">
        <img src="admin/uploads/<?php echo $kendaraan['foto']; ?>" alt="Foto Kendaraan">
        <h2><?php echo htmlspecialchars($kendaraan['jenis']); ?></h2>
        <p><strong>Seri:</strong> <?php echo htmlspecialchars($kendaraan['seri']); ?></p>
        <p><strong>Harga:</strong> Rp <?php echo number_format($kendaraan['tarif'], 0, ',', '.'); ?> per hari</p>
        <p><strong>Durasi:</strong> <?php echo htmlspecialchars($kendaraan['durasi']); ?> hari</p>
        <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($kendaraan['keterangan']); ?></p>
        <div class="button-container">
            <a href="daftarkendaraan.php" class="back-button">Kembali ke Daftar Kendaraan</a>
            <img src="img/Logo Web.png" alt="Logo" class="logo"> <!-- Ganti dengan path logo Anda -->
            <a href="pemesanan.php" class="order-button">Pesan Sekarang</a>
        </div>
    </div>
</div>

<footer>
    <p>&copy; HansRental, hak cipta paten.</p>
</footer>

</body>
</html>