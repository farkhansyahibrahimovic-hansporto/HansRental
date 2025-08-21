<?php
session_start();
include 'koneksi/koneksi.php'; // Pastikan ini sesuai dengan kebutuhan Anda

// Ambil data kendaraan dari database
$sql = "SELECT * FROM tbkendaraan"; // Ambil semua kendaraan
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hans Rental - Daftar Kendaraan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0; /* Latar belakang abu-abu terang untuk body */
            color: #333;
        }

        header {
            background: url('img/BackgroundSatu.png') no-repeat center center; /* Ganti dengan path gambar latar belakang Anda */
            background-size: cover; /* Pastikan gambar menutupi seluruh area header */
            text-align: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 20px 0; /* Mengatur padding atas dan bawah */
        }

        header img {
            max-width: 120px; /* Ubah ukuran logo sesuai keinginan */
            margin-bottom: 10px;
            border-radius: 50%; /* Membuat gambar logo bulat */
            border: 3px solid white; /* Opsional: menambahkan border putih di sekitar logo */
        }

        header h1, header p {
            animation: glow 1.5s infinite alternate; /* Animasi bersinar */
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.8), 0 0 10px rgba(255, 255, 255, 0.6);
            }
            100% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 1), 0 0 30px rgba(255, 255, 255, 0.8);
            }
        }

        nav {
            display: flex;
            justify-content: center; /* Pusatkan konten navbar */
            align-items: center;
            background-color: #000; /* Warna hitam untuk navbar */
            padding: 10px 0; /* Padding atas dan bawah untuk navbar */
            position: relative;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 0; /* Menghapus margin */
        }

        .nav-links a {
            color: white; /* Teks putih untuk navbar */
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #808080;
        }

        .hamburger {
            display: none; /* Sembunyikan hamburger secara default */
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 4px 0;
            transition: 0.4s;
        }

        .container {
            display: flex;
            flex-direction: column; /* Ubah menjadi kolom */
            height: calc(100vh - 70px); /* Mengurangi tinggi header */
            overflow: hidden;
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan konten secara horizontal */
        }

        .album {
            display: flex;
            flex-wrap: nowrap; /* Ubah menjadi nowrap untuk scroll horizontal */
            justify-content: center; /* Pusatkan album */
            gap: 20px; /* Jarak antar gambar */
            padding: 20px; /* Padding untuk album */
            max-width: 120 0px; /* Maksimal lebar album */
            width: 100%; /* Lebar penuh untuk album */
            overflow-x: auto; /* Tambahkan scroll horizontal */
            overflow-y: hidden; /* Sembunyikan scroll vertikal */
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.1)); /* Corak latar belakang */
            border-radius: 10px; /* Sudut membulat untuk album */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Bayangan untuk efek kedalaman */
        }

        .album-item {
            background-color: #2a2a2a;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            flex: 0 0 200px; /* Membuat item responsif dengan lebar tetap */
            max-width: 300px; /* Maksimal lebar item album */
            transition: transform 0.3s; /* Transisi untuk efek hover */
        }

        .album-item:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .album-item img {
            width: 100%; /* Gambar memenuhi lebar item */
            height: auto; /* Tinggi otomatis untuk menjaga rasio */
        }

        .album-item h3 {
            color: #fff; /* Teks putih untuk judul kendaraan */
            margin: 10px 0; /* Margin untuk judul */
        }

        .detail-button {
            background-color: #808080; /* Warna tombol abu-abu */
            color: white; /* Teks putih untuk tombol */
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; /* Menghapus garis bawah */
        }

        .detail-button:hover {
            background-color: #666; /* Warna tombol saat hover */
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #000; /* Warna hitam untuk footer */
            color: white; /* Teks putih untuk footer */
            position: relative;
            bottom: 0;
        }

        /* Media query untuk responsif */
        @media (max-width: 768px) {
            .nav-links {
                display: none; /* Sembunyikan menu navigasi pada layar kecil */
                flex-direction: column; /* Ubah menjadi kolom */
                width: 100%; /* Lebar penuh */
                background-color: #000; /* Latar belakang hitam untuk dropdown */
                position: absolute; /* Posisi absolut untuk dropdown */
                top: 60px; /* Jarak dari atas */
                left: 0;
            }

            .nav-links.active {
                display: flex; /* Tampilkan menu saat aktif */
            }

            .hamburger {
                display: flex; /* Tampilkan hamburger pada layar kecil */
            }

            .album-item {
                flex: 0 0 90%; /* Lebar item album pada layar kecil */
                max-width: none; /* Menghapus batasan maksimal lebar item album */
            }
        }
    </style>
</head>
<body>

<header>
    <img src="img/Logo Web.png" alt="Logo Web">
    <h1>Data Kendaraan</h1>
    <p>Selamat datang di layanan rental kendaraan Hans!</p>
    <p>Silahkan pilih beberapa kendaraan yang ingin anda sewa dibawah.</p>
</header>

<nav>
    <div class="hamburger" id="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="nav-links" id="nav-links">
        <a href="index.php"><i class="fas fa-home"></i> Beranda</a>
        <a href="daftarkendaraan.php"><i class="fas fa-bus"></i> Daftar Kendaraan</a>
        <a href="pemesanan.php"><i class="fas fa-calendar-check"></i> Pemesanan</a>
        <a href="kontak.php"><i class="fas fa-envelope"></i> Kontak</a>
        <a href="info.php"><i class="fas fa-info-circle"></i> Info Kami</a>
        <a href="<?php echo isset($_SESSION['user_id']) ? 'admin/admin_dashboard.php' : 'koneksi/login.php'; ?>">Area Admin</a>
    </div>
</nav>

<div class="container">
    <div class="album">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="album-item">
                    <img src="admin/uploads/<?php echo $row['foto']; ?>" alt="<?php echo $row['jenis']; ?>"> <!-- Gambar diambil dari folder uploads -->
                    <h3><?php echo $row['jenis']; ?></h3> <!-- Jenis kendaraan -->
                    <a href="detailkendaraan.php?id=<?php echo $row['id']; ?>" class="detail-button">Detail</a> <!-- Tombol detail -->
                    <p></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada kendaraan yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; Hans Rental, hak cipta paten.</p>
</footer>

<script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active'); // Toggle class active untuk menampilkan menu
    });
</script>

</body>
</html>