<?php
session_start();
// Meng-include koneksi database
include '../koneksi/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

// Mengambil data pelanggan dari tbpelanggan
$pemesan_sql = "SELECT * FROM tbpelanggan";
$pemesan_result = $conn->query($pemesan_sql);

// Proses hapus
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM tbpelanggan WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: adminpemesanan.php"); // Redirect setelah hapus
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pemesanan - Hans Rental</title>
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
            flex-direction: column;
            align-items: center;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 800px;
            text-align: center; /* Pusatkan teks di dalam container */
            margin-bottom: 20px;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%; /* Lebar input pencarian */
            max-width: 400px; /* Lebar maksimum input pencarian */
            margin-right: 10px; /* Jarak antara input dan tombol */
        }

        .table-scroll {
            max-height: 400px; /* Atur tinggi maksimum untuk scroll */
            overflow-y: auto; /* Tambahkan scroll vertikal */
            margin-top: 10px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8f9fa; /* Warna latar belakang tabel abu-abu */
        }

        .table-container th, .table-container td {
            padding: 10px;
            border:  1px solid #ccc;
            text-align: center; /* Pusatkan teks di header dan sel */
        }

        .table-container th {
            background-color:#000;
            color: white;
        }

        .table-container tr:nth-child(even) {
            background-color: #e9ecef; /* Warna abu-abu untuk baris genap */
        }

        .delete-button {
            background-color: #6c757d; /* Warna abu-abu untuk tombol hapus */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #5a6268; /* Warna gelap saat hover */
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #000; 
            color: white; 
            position: relative;
            bottom: 0;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none; /* Sembunyikan menu pada perangkat kecil */
                flex-direction: column;
                width: 100%;
                background-color: #000;
                position: absolute;
                top: 60px; /* Sesuaikan dengan tinggi navbar */
                left: 0;
                z-index: 1000;
            }

            .nav-links.active {
                display: flex; /* Tampilkan menu saat aktif */
            }

            .hamburger {
                display: flex; /* Tampilkan hamburger */
            }
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data ini?");
        }

        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }

        function searchPemesanan() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('pemesananTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) { // Mulai dari 1 untuk menghindari header
                const td = tr[i].getElementsByTagName('td')[0]; // Mencari di kolom nama
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    </script>
</head>
<body>

<header>
    <img src="../img/Logo Web.png" alt="Logo Web"> 
    <h1>Daftar Pemesanan</h1>
    <p>Kelola semua pemesanan dengan mudah.</p>
</header>

<nav>
    <div class="hamburger" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="nav-links">
    <a href="admin_dashboard.php">Beranda</a>
        <a href="kendaraan.php">Kendaraan</a>
        <a href="adminpemesanan.php">Pemesanan</a>
        <a href="admininfo.php">Info</a>
        <a href="laporan.php">Laporan</a>
        <a href="../koneksi/logout.php">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="table-container">
        <h2>Daftar Pemesanan</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari berdasarkan nama..." onkeyup="searchPemesanan()">
        </div>
        <div class="table-scroll">
            <table id="pemesananTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Total Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($pemesan = $pemesan_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $pemesan['nama']; ?></td>
                            <td><?php echo $pemesan['nik']; ?></td>
                            <td><?php echo $pemesan['alamat']; ?></td>
                            <td><?php echo $pemesan['notelp']; ?></td>
                            <td><?php echo 'Rp ' . number_format($pemesan['totalpembayaran'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="?delete=<?php echo $pemesan['id']; ?>" class="delete-button" onclick="return confirmDelete();">Hapus</a> 
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <p>&copy; Hans Rental, hak cipta paten.</p>
</footer>

</body>
</html>