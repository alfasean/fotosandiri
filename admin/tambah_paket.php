<?php
session_start();
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_destination = './uploads/paket/' . $foto_name;

    move_uploaded_file($foto_tmp, $foto_destination);

    $querypaket = "INSERT INTO tb_paket (nama_paket, harga, foto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($querypaket);
    $stmt->bind_param("sss", $nama_paket, $harga, $foto_name);

    if ($stmt->execute()) {
        echo '<script>window.location.href = "admin.php?page=paket";</script>';
        exit();
    } else {
        echo "Error: " . $querypaket . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container mt-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_paket">Nama Paket</label>
                    <input type="text" class="form-control" name="nama_paket" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" name="foto" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
