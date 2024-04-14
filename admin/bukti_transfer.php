<?php
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id_reservasi = $_GET['id'];

$queryFoto = "SELECT foto FROM tb_bukti WHERE id_reservasi = ?";
$stmtFoto = $conn->prepare($queryFoto);
$stmtFoto->bind_param("i", $id_reservasi);
$stmtFoto->execute();
$stmtFoto->store_result();

if ($stmtFoto->num_rows > 0) {
    $stmtFoto->bind_result($foto);
    $stmtFoto->fetch();
    // Tampilkan foto bukti transfer
    echo '<img src="./uploads/bukti/' . $foto . '" alt="Bukti Transfer">';
} else {
    echo "Foto bukti transfer tidak ditemukan.";
}

$stmtFoto->close();
$conn->close();
?>
