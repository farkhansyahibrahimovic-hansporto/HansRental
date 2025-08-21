<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

// Meng-include koneksi database
include '../koneksi/koneksi.php';

// Memproses pencarian
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM tbkendaraan WHERE jenis LIKE '%$search%' OR seri LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM tbkendaraan";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan Admin - Hans Rental</title>
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

        footer {
            background: linear-gradient(to top, #000000, #434343);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            width: 100%;
            margin: 0 auto;
        }

        .search-table-container {
            width: 100%;
            margin-top: 20px;
        }

        .table-container {
            overflow-x: auto;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 600px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            min-width: 120px;
        }

        th {
            background-color: #434343;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        img {
            max-width: 100px;
            height: auto;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 5px 10px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            background-color: #5a6268;
        }

        .search-container {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        .search-container form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }

        .search-container input[type="text"],
        .search-container input[type="submit"],
        .add-button {
            width: 100%;
            margin: 5px 0;
            min-width: 0;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-container input[type="submit"],
        .add-button {
            padding: 10px 15px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            flex: 1;
            margin-left: 10px;
            min-width: 120px;
        }

        .search-container input[type="submit"]:hover,
        .add-button:hover {
            background-color: #5a6268;
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
                background-color: #000;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            table {
                font-size: 0.9em;
                width: auto;
            }

            th, td {
                padding: 8px;
                min-width: 80px;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container input[type="text"],
            .search-container input[type="submit"],
            .add-button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

<header>
    <img src="../img/Logo Web.png" alt="Logo Web" class="logo">
    <h1>Daftar Kendaraan</h1>
    <p>Sistem manajemen kendaraan, kelola semua data kendaraan Anda dengan mudah.</p>
</header>

<nav>
    <div class="hamburger" id="hamburger" onclick="toggleNavbar()">
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
    <div class="search-table-container">
        <div class="search-container">
            <form method="POST" action="">
                <input type="text" name="search" placeholder="Cari kendaraan..." value="<?php echo htmlspecialchars ($search); ?>">
                <input type="submit" value="Cari">
                <a href="tambahkendaraan.php" class="add-button">Tambah Kendaraan</a>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Seri</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Tarif</th>
                        <th>Durasi (hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['jenis'] . "</td>
                                    <td>" . $row['seri'] . "</td>
                                    <td>" . $row['keterangan'] . "</td>
                                    <td><img src='uploads/" . $row['foto'] . "' alt='Foto Kendaraan'></td>
                                    <td>" . $row['tarif'] . "</td>
                                    <td>" . $row['durasi'] . "</td>
                                    <td class='action-buttons'>
                                        <a href='editkendaraan.php?id=" . $row['id'] . "'>Edit</a>
                                        <a href='hapuskendaraan.php?id=" . $row['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?');\">Hapus</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data kendaraan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <p>&copy; Hans Rental, hak cipta paten.</p>
</footer>

<script>
    function toggleNavbar() {
        const navLinks = document.getElementById('nav-links');
        navLinks.classList.toggle('active');
    }
</script>

</body>
</html>