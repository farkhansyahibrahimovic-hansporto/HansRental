<?php
session_start();
include 'koneksi.php'; // Menghubungkan ke database

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = '';

// Memeriksa apakah pengguna sudah login, jika ya, arahkan ke dashboard
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("Location: ../admin/admin_dashboard.php");
    exit();
}

// Memeriksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Mencari admin berdasarkan nama dan password
    $sql = "SELECT * FROM tbadmin WHERE nama = ? AND password = MD5(?)"; // Menggunakan MD5 untuk keamanan
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah ada hasil
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['status'] = "login";
        $_SESSION['pengguna'] = "admin";
        $_SESSION['username'] = $user['nama']; // Menyimpan username ke sesi
        header("Location: ../admin/admin_dashboard.php"); // Arahkan ke dashboard admin
        exit(); // Pastikan untuk menghentikan eksekusi script setelah redirect
    } else {
        $error = "Nama atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #121212; /* Latar belakang gelap */
            color: #ffffff; /* Teks putih */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #1e1e1e; /* Latar belakang gelap untuk form */
            padding: 30px;
            border-radius: 10px; /* Sudut melengkung pada form */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center; /* Rata tengah untuk teks */
            width: 90%; /* Lebar penuh untuk form */
            max-width: 400px; /* Lebar maksimum untuk form */
            transition: transform 0.3s; /* Transisi saat hover */
        }

        .login-container:hover {
            transform: scale(1.02); /* Efek zoom saat hover */
        }

        .login-container h2 {
            margin-bottom: 20px; /* Jarak bawah untuk judul */
            color: #aaaaaa; /* Warna abu-abu untuk judul */
        }

        .login-container img {
            width: 100px; /* Lebar logo */
            height: 100px; /* Tinggi logo */
            border-radius: 50%; /* Membulatkan logo */
            margin-bottom: 20px; /* Jarak bawah untuk logo */
        }

        .input-container {
            display: flex;
            flex-direction: column; /* Mengatur input dalam kolom */
            align-items: stretch; /* Rata kiri untuk label dan input */
            width: 100%; /* Lebar penuh untuk input container */
            margin-bottom: 15px; /* Jarak bawah untuk setiap input */
        }

        .input-password-container {
            display: flex; /* Menggunakan flexbox untuk input dan ikon */
            align-items: center; /* Rata tengah untuk input dan ikon */
            width: 100%; /* Lebar penuh untuk container input password */
        }

        .login-container input {
            width: 100%; /* Lebar penuh untuk input */
            padding: 10px; /* Padding yang sama untuk semua input */
            border: 1px solid #ccc; /* Border abu-abu untuk input */
            border-radius: 5px; /* Sudut melengkung pada input */
            background-color: #333; /* Latar belakang input gelap */
            color: #ffffff; /* Teks putih untuk input */
            transition: border-color 0.3s, background-color 0.3s; /* Transisi border dan latar belakang saat fokus */
            box-sizing: border-box; /* Memastikan padding dan border dihitung dalam lebar total */
        }

        .login-container input::placeholder {
            color: #aaaaaa; /* Warna placeholder */
        }

        .login-container input:focus {
            border-color: #aaaaaa; /* Warna border saat fokus */
            outline: none; /* Menghapus outline */
            background-color: #444; /* Latar belakang saat fokus */
        }

        .toggle-password {
            cursor: pointer; /* Kursor pointer saat hover */
            color: #aaaaaa; /* Warna ikon */
            margin-left: -30px; /* Mengatur posisi ikon agar lebih dekat dengan input */
        }

        .button-container {
            display: flex; /* Menggunakan flexbox untuk tombol */
            justify-content: center; /* Menyusun tombol di tengah */
            gap: 10px; /* Jarak antara tombol */
            margin: 10px 0; /* Jarak atas dan bawah untuk tombol container */
            width: 100%; /* Lebar penuh untuk tombol container */
        }

        .login-container button {
            background-color: #aaaaaa; /* Warna abu-abu untuk tombol */
            color: white; /* Teks putih untuk tombol */
            padding: 10px; /* Padding tombol */
            border: none; /* Menghapus border */
            border-radius: 5px; /* Sudut melengkung pada tombol */
            cursor: pointer; /* Kursor pointer saat hover */
            transition: background-color 0.3s, transform 0.2s; /* Transisi saat hover */
            width: 100%; /* Lebar penuh untuk tombol */
            max-width: 150px; /* Lebar maksimum untuk tombol */
        }

        .login-container button:hover {
            background-color: #888888; /* Warna abu-abu lebih gelap saat hover */
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .error-message {
            color: red; /* Warna merah untuk pesan kesalahan */
            margin-top: 10px; /* Jarak atas untuk pesan kesalahan */
            font-size: 14px; /* Ukuran font untuk pesan kesalahan */
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px; /* Mengurangi padding pada layar kecil */
            }

            .login-container img {
                width: 80px; /* Mengurangi ukuran logo pada layar kecil */
                height: 80px; /* Mengurangi ukuran logo pada layar kecil */
            }

            .login-container h2 {
                font-size: 1.5em; /* Mengurangi ukuran font judul pada layar kecil */
            }

            .login-container button {
                width: 100%; /* Lebar penuh untuk tombol pada layar kecil */
            }
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggle = document.getElementById("password-toggle");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.classList.remove("fa-eye");
                passwordToggle.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordToggle.classList.remove("fa-eye-slash");
                passwordToggle.classList.add("fa-eye");
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <img src="../img/Logo Web.png" alt="Logo Web">
        <h2>Login Admin</h2>
        <form method="POST" action="">
            <div class="input-container">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required placeholder="Masukkan nama Anda">
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <div class="input-password-container">
                    <input type="password" id="password" name="password" required placeholder="Masukkan password Anda">
                    <i id="password-toggle" class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
            <div class="button-container">
                <button type="submit">Masuk</button>
                <button type="button" onclick="window.location.href='../index.php';">Kembali</button>
            </div>
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>