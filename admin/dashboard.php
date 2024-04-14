<?php
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$queryTotalReservasi = "SELECT COUNT(*) as total_reservasi FROM tb_reservasi";
$resultTotalReservasi = $conn->query($queryTotalReservasi);

if ($resultTotalReservasi->num_rows > 0) {
    $rowTotalReservasi = $resultTotalReservasi->fetch_assoc();
    $totalReservasi = $rowTotalReservasi['total_reservasi'];
} else {
    $totalReservasi = 0;
}

$queryTotalFrame = "SELECT COUNT(*) as total_frame FROM tb_frame";
$resultTotalFrame = $conn->query($queryTotalFrame);

if ($resultTotalFrame->num_rows > 0) {
    $rowTotalFrame = $resultTotalFrame->fetch_assoc();
    $totalFrame = $rowTotalFrame['total_frame'];
} else {
    $totalFrame = 0;
}

$queryTotalPaket = "SELECT COUNT(*) as total_paket FROM tb_paket";
$resultTotalPaket = $conn->query($queryTotalPaket);

if ($resultTotalPaket->num_rows > 0) {
    $rowTotalPaket = $resultTotalPaket->fetch_assoc();
    $totalPaket = $rowTotalPaket['total_paket'];
} else {
    $totalPaket = 0;
}

$conn->close();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalReservasi; ?></h3>
                            <p>Total Reservasi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $totalFrame; ?></h3>
                            <p>Total Frame</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-image"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $totalPaket; ?></h3>
                            <p>Total Paket</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
