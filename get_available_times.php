<?php
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$tanggal = $_GET['tanggal'];

$queryWaktu = "SELECT * FROM tb_waktu_reservasi WHERE available = 1 AND id_waktu_reservasi NOT IN (SELECT id_waktu_reservasi FROM tb_reservasi WHERE tanggal = '$tanggal')";
$resultWaktu = mysqli_query($conn, $queryWaktu);

$availableTimes = array();

if (mysqli_num_rows($resultWaktu) > 0) {
    while ($rowWaktu = mysqli_fetch_assoc($resultWaktu)) {
        $availableTimes[] = array(
            'id_waktu_reservasi' => $rowWaktu['id_waktu_reservasi'],
            'start_time' => $rowWaktu['start_time'],
            'end_time' => $rowWaktu['end_time']
        );
    }
}

header('Content-Type: application/json');
echo json_encode($availableTimes);

$conn->close();
?>
