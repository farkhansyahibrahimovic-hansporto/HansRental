<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hans Rental - Info Kami</title>
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
            padding: 10px 20px;
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

        .main-content {
            padding: 20px;
            background-color: #000; /* Latar belakang hitam untuk konten utama */
            border-radius: 10px; /* Sudut melengkung pada konten utama */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center; /* Rata tengah untuk teks */
            max-width: 600px; /* Lebar maksimum untuk konten */
            margin: 20px; /* Margin untuk memberikan jarak */
            color: #fff; /* Teks putih untuk kontras dengan background */
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #000; /* War na hitam untuk footer */
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
        }
    </style>
</head>
<body>

<header>
    <img src="img/Logo Web.png" alt="Logo Web"> 
    <h1>Info Kami</h1>
    <p>Selamat datang di layanan rental kendaraan Hans!</p>
    <p>Berikut beberapa info kecil tentang kami.</p>
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
    <div class="main-content">
        <h2>Info Kami</h2>
        <p>Hans Rental adalah penyedia layanan rental kendaraan yang berkomitmen untuk memberikan pengalaman terbaik bagi pelanggan kami.</p>
        <p>Kami menawarkan berbagai jenis kendaraan untuk memenuhi kebutuhan perjalanan Anda, baik untuk keperluan pribadi maupun bisnis.</p>
        <p>Dengan tim profesional dan armada yang terawat, kami siap membantu Anda dalam setiap perjalanan.</p>
        <p>Terima kasih telah memilih Hans Rental!</p>
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