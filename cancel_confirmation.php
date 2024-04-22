<?php
session_start();
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reservasi = $_SESSION['id_reservasi'];
    $bank = $_POST['bank'];
    $no_rekening = $_POST['no_rekening'];

    $query = "INSERT INTO tb_return (id_reservasi, bank, no_rekening) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $id_reservasi, $bank, $no_rekening);
    $stmt->execute();

    $query_update = "UPDATE tb_reservasi SET konfirmasi = 'cancel' WHERE id_reservasi = ?";
    $stmt_update = $conn->prepare($query_update);
    $stmt_update->bind_param("i", $id_reservasi);
    $stmt_update->execute();

    header("Location: index.php?page=home");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembatalan Reservasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 100px;">
            <h2 class="text-center">Konfirmasi Pembatalan Reservasi</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="bank">Nama Bank:</label>
                    <input type="text" class="form-control" id="bank" name="bank" required>
                </div>
                <div class="form-group">
                    <label for="no_rekening">Nomor Rekening:</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                </div>
                <button type="submit" class="btn btn-danger">Konfirmasi Pembatalan</button>
                <a href="index.php?page=home" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
