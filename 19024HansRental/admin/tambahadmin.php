<?php
session_start();
include '../koneksi/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = md5($_POST['password']); // Hash password dengan MD5

    // Menambahkan admin baru ke database
    $sql = "INSERT INTO tbadmin (nama, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Admin berhasil ditambahkan!'); window.location.href='admininfo.php';</script>";
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
    <title>Tambah Admin - Hans Rental</title>
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
            max-width: 400px;
            display: flex;
            flex-direction: column;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #f0f0f0;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #555;
            border-radius: 4px;
            background: #3a3a3a;
            color: #f0f0f0;
            font-size: 16px;
            margin-left: auto;
            margin-right: auto;
        }

        button {
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #696969;
        }

        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h1>Tambah Admin</h1>
    <div class="container">
        <form action="" method="POST">
            <label for="nama">Nama Admin:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Masukkan password baru">

            <button type="submit"><i class="fas fa-plus"></i> Tambah Admin</button>
            <button type="button" onclick="window.location.href='admininfo.php'"><i class="fas fa-arrow-left"></i> Kembali</button>
        </form>
    </div>
</body>
</html>