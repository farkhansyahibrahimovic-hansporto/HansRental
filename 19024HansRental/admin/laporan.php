<?php
session_start();
include '../koneksi/koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

$adminName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

// Query untuk menghitung jumlah pelanggan
$queryPelanggan = "SELECT COUNT(*) as total FROM tbpelanggan"; 
$resultPelanggan = mysqli_query($conn, $queryPelanggan);
$dataPelanggan = mysqli_fetch_assoc($resultPelanggan);
$totalPelanggan = $dataPelanggan['total'];

// Query untuk menghitung jumlah admin
$queryAdmin = "SELECT COUNT(*) as total FROM tbadmin"; 
$resultAdmin = mysqli_query($conn, $queryAdmin);
$dataAdmin = mysqli_fetch_assoc($resultAdmin);
$totalAdmin = $dataAdmin['total'];

// Query untuk menghitung jumlah kendaraan
$queryKendaraan = "SELECT COUNT(*) as total FROM tbkendaraan"; 
$resultKendaraan = mysqli_query($conn, $queryKendaraan);
$dataKendaraan = mysqli_fetch_assoc($resultKendaraan);
$totalKendaraan = $dataKendaraan['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin - Hans Rental</title>
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
            font-size: 2.5em;
        }

        header p {
            margin: 10px 0;
            font-size: 1.2em;
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
            margin-bottom : 10px;
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

        footer p {
            margin: 0;
            font-size: 0.9em;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8em;
            }

            header p {
                font-size: 1em;
                margin: 5px 0;
            }

            header {
                padding: 15px 10px;
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
                font-size: 1.5em;
            }

            header p {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>

<header>
    <img src="../img/Logo Web.png" alt="Logo Web" class="logo">
    <h1>Laporan</h1>
    <p>Selamat datang, <?php echo $adminName; ?>, berikut adalah beberapa catatan tentang Hans Rental</p>
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
    <div class="card">
        <i class="fas fa-users"></i>
        <h2><?php echo $totalPelanggan; ?></h2>
        <p>Pelanggan</p>
    </div>
    <div class="card">
        <i class="fas fa-user-shield"></i>
        <h2><?php echo $totalAdmin; ?></h2>
        <p>Admin</p>
    </div>
    <div class="card">
        <i class="fas fa-car"></i>
        <h2><?php echo $totalKendaraan; ?></h2>
        <p>Kendaraan</p>
    </div>
</div>

<footer>
    <p>&copy; Hans Rental. hak cipta paten.</p>
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