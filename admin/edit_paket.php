<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paket = $_GET['menu_upd'];
    $nama_paket = $_POST["nama_paket"];
    $harga = $_POST["harga"];

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp_name = $_FILES['foto']['tmp_name'];
        $foto_error = $_FILES['foto']['error'];

        $upload_dir = "./uploads/paket/";
        $target_file = $upload_dir . basename($foto_name);

        if(move_uploaded_file($foto_tmp_name, $target_file)) {
            $sql = "UPDATE tb_paket SET nama_paket='$nama_paket', harga='$harga', foto='$foto_name' WHERE id_paket=$id_paket";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href = "admin.php?page=paket";</script>';
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        $sql = "UPDATE tb_paket SET nama_paket='$nama_paket', harga='$harga' WHERE id_paket=$id_paket";

        if ($conn->query($sql) === TRUE) {
            echo '<script>window.location.href = "admin.php?page=paket";</script>';
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_GET['menu_upd'])) {
    $id_paket = $_GET['menu_upd'];

    $query = "SELECT * FROM tb_paket WHERE id_paket=$id_paket";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data paket tidak ditemukan.";
        exit();
    }
} else {
    echo "ID paket tidak disertakan dalam URL.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container mt-5">
            <h2>Edit Paket</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_paket">Nama Paket:</label>
                    <input type="text" class="form-control" name="nama_paket" value="<?php echo $row['nama_paket']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="text" class="form-control" name="harga" value="<?php echo $row['harga']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Paket:</label>
                    <input type="file" class="form-control-file" name="foto" accept="image/*">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
