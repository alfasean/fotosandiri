<?php
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id_reservasi = $_GET['id'];

$queryFotoBukti = "SELECT foto FROM tb_bukti WHERE id_reservasi = ?";
$stmtFotoBukti = $conn->prepare($queryFotoBukti);
$stmtFotoBukti->bind_param("i", $id_reservasi);
$stmtFotoBukti->execute();
$stmtFotoBukti->store_result();

if ($stmtFotoBukti->num_rows > 0) {
    $stmtFotoBukti->bind_result($fotoBukti);
    $stmtFotoBukti->fetch();
    echo '<div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Pembayaran Awal</h3>
                    <img style="width: 50%;" src="./uploads/bukti/' . $fotoBukti . '" alt="Bukti Transfer Pembayaran Awal" class="img-fluid">
                </div>';
} else {
    echo "Foto bukti transfer tidak ditemukan.";
}

$stmtFotoBukti->close();

$queryFotoReservasi = "SELECT payment FROM tb_reservasi WHERE id_reservasi = ?";
$stmtFotoReservasi = $conn->prepare($queryFotoReservasi);
$stmtFotoReservasi->bind_param("i", $id_reservasi);
$stmtFotoReservasi->execute();
$stmtFotoReservasi->store_result();

if ($stmtFotoReservasi->num_rows > 0) {
    $stmtFotoReservasi->bind_result($fotoReservasi);
    $stmtFotoReservasi->fetch();
    echo '<div class="col-md-6">
            <h3>Pembayaran Akhir</h3>
            <img style="width: 50%;" src="./uploads/payment/' . $fotoReservasi . '" alt="Bukti Transfer Pembayaran Akhir" class="img-fluid">
        </div>
    </div>
</div>';
} else {
    echo "Foto bukti transfer dari kolom payment tidak ditemukan.";
}

$stmtFotoReservasi->close();
$conn->close();
?>
