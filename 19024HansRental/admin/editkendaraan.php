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
    if ($fotoError === 0) {
        // Jika ada gambar baru yang di-upload
        if (in_array($fotoExt, $allowed) && $fotoSize < 2000000) {
            // Hapus gambar lama dari folder uploads
            $oldFotoPath = 'uploads/' . $kendaraan['foto'];
            if (file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }

            // Membuat nama file unik
            $fotoNewName = uniqid('', true) . "." . $fotoExt;
            $fotoDestination = 'uploads/' . $fotoNewName;

            // Memindahkan file ke folder uploads
            move_uploaded_file($fotoTmpName, $fotoDestination);

            // Update data kendaraan
            $sql = "UPDATE tbkendaraan SET jenis='$jenis', seri='$seri', keterangan='$keterangan', foto='$fotoNewName', tarif='$tarif', durasi='$durasi' WHERE id='$id'";
        } else {
            echo "<script>alert('Format file tidak diizinkan atau ukuran file terlalu besar!');</script>";
        }
    } else {
        // Jika tidak ada gambar baru, tetap menggunakan gambar lama
        $sql = "UPDATE tbkendaraan SET jenis='$jenis', seri='$seri', keterangan='$keterangan', tarif='$tarif', durasi='$durasi' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kendaraan berhasil diperbarui!'); window.location.href='kendaraan.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan - Hans Rental</title>
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

        .container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            background: #2a2a2a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
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

        img {
            width: 100%;
            max-width: 200px;
            margin: 10px 0;
        }

        @media (max-width: 600px) {
            form {
                width: 90%; /* Lebar form di perangkat kecil */
            }
        }
    </style>
</head>
<body>
    <h1>Edit Kendaraan</h1>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="jenis">Jenis Kendaraan:</label>
            <input type="text" id="jenis" name="jenis" value="<?php echo $kendaraan['jenis']; ?>" required>

            <label for="seri">Seri Kendaraan:</label>
            <input type="text" id="seri" name="seri" value="<?php echo $kendaraan['seri']; ?>" required>

            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" required><?php echo $kendaraan['keterangan']; ?></textarea>

            <label for="tarif">Tarif:</label>
            <input type="text" id="tarif" name="tarif" value="<?php echo $kendaraan['tarif']; ?>" required>

            <label for="durasi">Durasi:</label>
            <input type="text" id="durasi" name="durasi" value="<?php echo $kendaraan['durasi']; ?>" required>

            <label for="foto">Foto Kendaraan: (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <p>Gambar saat ini:</p>
            <img src="uploads/<?php echo $kendaraan['foto']; ?>" alt="Foto Kendaraan">

            <button type="submit"><i class="fas fa-edit"></i> Update Kendaraan</button>
            <button type="button" onclick="window.location.href='kendaraan.php'"><i class="fas fa-arrow-left"></i> Kembali</button>
        </form>
    </div>
</body>
</html> 