<?php
session_start();
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$id_reservasi = $_SESSION['id_reservasi'];

$query = "SELECT r.*, w.start_time, w.end_time, p.nama_paket, p.harga
          FROM tb_reservasi r
          INNER JOIN tb_waktu_reservasi w ON r.id_waktu_reservasi = w.id_waktu_reservasi
          INNER JOIN tb_paket p ON r.id_paket = p.id_paket
          WHERE r.id_reservasi = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_reservasi);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$status_reservasi = $row['konfirmasi'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 100px;">
            <h2 class="text-center">Data Reservasi</h2>
            <table class="table table-bordered mt-5">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td><?php echo $row['nama']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Reservasi</th>
                        <td><?php echo $row['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Waktu Reservasi</th>
                        <td><?php echo $row['start_time'] . ' - ' . $row['end_time']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Paket</th>
                        <td><?php echo $row['nama_paket']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Harga Paket</th>
                        <td>Rp<?php echo $row['harga']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Extra Orang</th>
                        <td><?php echo $row['extra_orang']; ?> Orang</td>
                    </tr>
                    <tr>
                        <th scope="row">Extra Waktu</th>
                        <td><?php echo $row['extra_waktu']; ?> Menit</td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td>Rp<?php echo $row['total']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td><?php echo $row['konfirmasi']; ?></td>
                    </tr>
                </tbody>
            </table>
            <p style="font-size: 13px">Note : Tunggu status pesananmu di reservasi admin dulu yah. <br> Jika sudah di konfirmasi kamu bisa screenshoot halaman ini dan tunjukkan ke karyawan kami saat datang. <br> Untuk yang ingin mengganti jam harap memberi kabar ke admin 2 jam sebelum jam yang sudah di booking, Jika lewat dari itu maka sudah tidak bisa diubah lagi. <br> Kami memberikan waktu 5 menit untuk costumer yang terlambat . Mohon tepat waktu agar reservasinya (DP) tidak hangus.</p>
            <a href="index.php?page=home" class="btn btn-primary">Kembali ke Halaman Utama</a>
            <?php if ($status_reservasi !== "cancel"): ?>
            <a href="cancel_confirmation.php?id=<?php echo $id_reservasi; ?>" class="btn btn-danger">Cancel Reservasi</a>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
