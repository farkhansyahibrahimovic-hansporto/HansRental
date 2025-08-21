<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - Hans Rental</title>
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

        header img {
            max-width: 120px; 
            margin-bottom: 10px;
            border-radius: 50%; 
            border: 3px solid white; 
        }

        header h1 {
            margin: 0;
            font-size: 2.5em; /* Ukuran font untuk judul */
        }

        header p {
            margin: 10px 0;
            font-size: 1.2em; /* Ukuran font untuk deskripsi */
        }

        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000;
            padding: 10px 20px;
            position: relative;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            margin: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #808080;
        }

        .hamburger {
            display: none;
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
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            flex: 1;
        }

        .card {
            background-color: #434343;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            max-width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card i {
            font-size: 2em;
            color: white;
            margin-bottom: 10px;
        }

        .btn-logout {
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }

        footer {
            background: linear-gradient(to top, #000000, #434343);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 - 2px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8em; /* Ukuran font untuk judul pada layar kecil */
            }

            header p {
                font-size: 1em; /* Ukuran font untuk deskripsi pada layar kecil */
                margin: 5px 0; /* Jarak antara judul dan deskripsi pada layar kecil */
            }

            header {
                padding: 15px 10px; /* Padding untuk header pada layar kecil */
            }

            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #000;
                position: absolute;
                top: 60px;
                left: 0;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 90%;
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.5em; /* Ukuran font untuk judul pada layar sangat kecil */
            }

            header p {
                font-size: 0.9em; /* Ukuran font untuk deskripsi pada layar sangat kecil */
            }
        }
    </style>
</head>
<body>

<header>
    <img src="../img/Logo Web.png" alt="Logo Web" class="logo">
    <h1>Beranda Admin</h1>
    <p>Selamat datang di sistem manajemen admin. Kelola semua data Anda dengan mudah.</p>
    <p>Gunakanlah fitur admin dengan bijak tanpa merugikan pihak manapun!</p>
</header>

<nav>
    <div class="hamburger" id="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="nav-links" id="nav-links">
        <a href="admin_dashboard.php">Beranda</a>
        <a href="kendaraan.php">Kendaraan</a>
        <a href="adminpemesanan.php">Pemesanan</a>
        <a href="admininfo.php">Info</a>
        <a href="laporan.php">Laporan</a>
        <a href="../koneksi/logout.php">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="card" onclick="location.href='kendaraan.php';">
        <i class="fas fa-car"></i>
        <h3>Kendaraan</h3>
        <p>Kelola data kendaraan Anda.</p>
    </div>
    <div class="card" onclick="location.href='adminpemesanan.php';">
        <i class="fas fa-calendar-check"></i>
        <h3>Pemesanan</h3>
        <p>Kelola pemesanan yang masuk.</p>
    </div>
    <div class="card" onclick="location.href='admininfo.php';">
        <i class="fas fa-info-circle"></i>
        <h3>Info</h3>
        <p>Dapatkan informasi tertentu disini.</p>
    </div>
    <div class="card" onclick="location.href='laporan.php';">
        <i class="fas fa-file-alt"></i>
        <h3>Laporan</h3>
        <p>Lihat laporan aktivitas yang ada.</p>
    </div>
    <div class="card" onclick="location.href='../koneksi/logout.php';">
        <i class="fas fa-sign-out-alt"></i>
        <h3>Logout</h3>
        <p>Keluar dari akun Anda.</p>
    </div>
</div>
<footer>
    <p>&copy;HansRental, hak cipta paten.</p>
</footer>

<script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
 });
</script>

</body>
</html>