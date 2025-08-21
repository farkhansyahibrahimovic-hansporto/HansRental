<?php
session_start();
// Meng-include koneksi database
include 'koneksi/koneksi.php';

// Memeriksa apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $durasi = $_POST['durasi'];
    $jenis = $_POST['jenis'];

    // Mengambil tarif dari tabel kendaraan berdasarkan jenis yang dipilih
    $tarif_sql = "SELECT tarif FROM tbkendaraan WHERE jenis = '$jenis'";
    $tarif_result = $conn->query($tarif_sql);

    if ($tarif_result->num_rows > 0) {
        $row = $tarif_result->fetch_assoc();
        $tarif = $row['tarif'];

        // Menghitung total pembayaran
        $total_pembayaran = $tarif * $durasi;

        // Menyimpan data pelanggan ke tbpelanggan
        $sql = "INSERT INTO tbpelanggan (nama, nik, alamat, notelp, totalpembayaran) VALUES ('$nama', '$nik', '$alamat', '$notelp', '$total_pembayaran')";
        if ($conn->query($sql) === TRUE) {
            // Mengalihkan ke pemesananberhasil.php setelah berhasil
            echo "<script>
                    alert('Pemesanan berhasil!');
                    window.location.href='pemesananberhasil.php'; // Ubah URL di sini
                  </script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Jenis kendaraan tidak ditemukan.');</script>";
    }
}

// Mengambil data syarat sewa
$syarat_sql = "SELECT * FROM tbsyaratsewa";
$syarat_result = $conn->query($syarat_sql);

// Mengambil data kendaraan
$kendaraan_sql = "SELECT * FROM tbkendaraan";
$kendaraan_result = $conn->query($kendaraan_sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Hans Rental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f0f0;
            color: #333;
        }

        header {
            background: url('img/BackgroundSatu.png') no-repeat center center; 
            background-size: cover; 
            text-align: center;
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 20px 0; 
        }

        header img {
            max-width: 120px; 
            margin-bottom: 10px;
            border-radius: 50%; 
            border: 3px solid white; 
        }

        header h1, header p {
            animation: glow 1.5s infinite alternate; 
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
            justify-content: center; /* Menengahkan navbar */
            align-items: center;
            background-color: #000; 
            padding: 10px 20px;
            position: relative;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin : 0; 
            justify-content: center; /* Menengahkan item dalam navbar */
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

        .form-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 600px;
            text-align: left;
            margin-bottom: 20px;
        }

        .form-card h2 {
            margin: 0 0 20px;
            font-size: 1.5em;
        }

        .form-card input, .form-card select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-card button {
            padding: 10px 15px;
            background-color: #808080; /* Warna abu-abu */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .form-card button:hover {
            background-color: #606060; /* Warna abu-abu gelap saat hover */
        }

        .persyaratan {
            margin-top: 20px;
        }

        .persyaratan h3 {
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #000; 
            color: white; 
            position: relative;
            bottom: 0;
        }

        /* Media query untuk perangkat kecil */
        @media (max-width: 768px) {
            .nav-links {
                display: none; /* Sembunyikan menu navigasi secara default */
                flex-direction: column; /* Ubah menjadi kolom */
                width: 100%; /* Lebar penuh */
                background-color: #000; /* Warna latar belakang */
                position: absolute; /* Posisi absolut */
                top: 60px; /* Jarak dari atas */
                left: 0; /* Jarak dari kiri */
                z-index: 999; /* Pastikan di atas elemen lain */
            }

            .nav-links.active {
                display: flex; /* Tampilkan menu saat aktif */
            }

            .hamburger {
                display: flex; /* Tampilkan hamburger menu */
            }
        }
    </style>
</head>
<body>

<header>
    <img src="img/Logo Web.png" alt="Logo Web"> 
    <h1>Bagan Pemesanan</h1>
    <p>Selamat datang di layanan rental kendaraan Hans!</p>
    <p>Silahkan baca persyaratan apa saja yang diperlukan untuk menyewa.</p>
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
    <div class="form-card">
        <h2>Form Pemesanan</h2>
        <form method="POST" action="">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="notelp">No Telepon:</label>
            <input type="text" id="notelp" name="notelp" required>

            <label for="durasi">Durasi Sewa : (hari)</label>
            <input type="number" id="durasi" name="durasi" required min="1">

            <label for="jenis">Jenis Kendaraan:</label>
            <select id="jenis" name="jenis" required onchange="updateTarif()">
                <option value="">Pilih Jenis Kendaraan</option>
                <?php while ($kendaraan = $kendaraan_result->fetch_assoc()) { ?>
                    <option value="<?php echo $kendaraan['jenis']; ?>" data-tarif="<?php echo $kendaraan['tarif']; ?>">
                        <?php echo $kendaraan['jenis'] . ' - Rp ' . number_format($kendaraan['tarif'], 0, ',', '.'); ?>
                    </option>
                <?php } ?>
            </select>

            <div id="tarif-container" style="margin-top: 10px;">
                <strong>Tarif per hari: <span id="tarif">0</span></strong>
            </div>

            <div class="persyaratan">
                <h3>Persyaratan Sewa</h3>
                <ul>
                    <?php while ($row = $syarat_result->fetch_assoc()) { ?>
                        <li><?php echo $row['persyaratan']; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <button type="submit">Buat Pesanan</button>
        </form>
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

    function updateTarif() {
        const select = document.getElementById('jenis');
        const tarifDisplay = document.getElementById('tarif');
        const selectedOption = select.options[select.selectedIndex];
        const tarif = selectedOption.getAttribute('data-tarif');
        tarifDisplay.textContent = tarif ? tarif : '0';
    }
</script>

</body>
</html>