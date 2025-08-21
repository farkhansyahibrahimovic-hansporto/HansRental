<?php
session_start();
include '../koneksi/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../koneksi/login.php");
    exit();
}

// Mengambil ID persyaratan dari URL
$id = $_GET['id'];
$sql = "SELECT * FROM tbsyaratsewa WHERE id='$id'";
$result = $conn->query($sql);
$persyaratan = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $persyaratan = $_POST['persyaratan'];

    // Update data persyaratan
    $sql = "UPDATE tbsyaratsewa SET persyaratan='$persyaratan' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('persyaratan berhasil diperbarui!'); window.location.href='admininfo.php';</script>";
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
    <title>Edit persyaratan - Hans Rental</title>
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

        input[type="text"] {
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
    <h1>Edit persyaratan</h1>
    <div class="container">
        <form action="" method="POST">
            <label for="persyaratan">persyaratan:</label>
            <input type="text" id="persyaratan" name="persyaratan" value="<?php echo htmlspecialchars($persyaratan['persyaratan']); ?>" required>

            <button type="submit"><i class="fas fa-edit"></i> Update persyaratan</button>
            <button type="button" onclick="window.location.href='admininfo.php'"><i class="fas fa-arrow-left"></i> Kembali</button>
        </form>
    </div>
</body>
</html>