<?php
session_start();
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $id_reservasi = $_SESSION['id_reservasi'];

    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto_destination = 'admin/uploads/bukti/' . $foto_name;

    move_uploaded_file($foto_tmp, $foto_destination);

    $querypaket = "INSERT INTO tb_bukti (id_reservasi, foto) VALUES (?, ?)";
    $stmt = $conn->prepare($querypaket);
    $stmt->bind_param("is", $id_reservasi, $foto_name);

    if ($stmt->execute()) {
        echo '<script>window.location.href = "index.php?page=invoice";</script>';
        exit();
    } else {
        echo "Error: " . $querypaket . "<br>" . $conn->error;
    }
}

$id_reservasi = $_SESSION['id_reservasi'];
$query_info = "SELECT r.nama, r.tanggal, w.start_time, w.end_time, p.nama_paket, p.harga, p.kategori, r.total, r.extra_waktu, r.extra_orang
               FROM tb_reservasi r
               JOIN tb_waktu_reservasi w ON r.id_waktu_reservasi = w.id_waktu_reservasi
               JOIN tb_paket p ON r.id_paket = p.id_paket
               WHERE r.id_reservasi = ?";
$stmt_info = $conn->prepare($query_info);
$stmt_info->bind_param("i", $id_reservasi);
$stmt_info->execute();
$result_info = $stmt_info->get_result();
$row_info = $result_info->fetch_assoc();

$dp = ($row_info['kategori'] == 'sebox') ? 15000 : 30000;

$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top:80px;">
            <h2 class="text-center mt-5">Konfirmasi Pembayaran</h2>
            <form action="" method="post" enctype="multipart/form-data" class="mt-5">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" value="<?php echo $row_info['nama']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="text" class="form-control" id="tanggal" value="<?php echo $row_info['tanggal']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="waktu">Waktu:</label>
                    <input type="text" class="form-control" id="waktu" value="<?php echo $row_info['start_time'] . ' - ' . $row_info['end_time']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="paket">Paket:</label>
                    <input type="text" class="form-control" id="paket" value="<?php echo $row_info['nama_paket']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="dp">Harga Paket:</label>
                    <input type="text" class="form-control" id="dp" value="<?php echo $row_info['harga']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="extra_orang">Extra Orang:</label>
                    <input type="text" class="form-control" id="extra_orang" value="<?php echo $row_info['extra_orang']; ?> Orang" readonly>
                </div>

                <div class="form-group">
                    <label for="extra_waktu">Extra Waktu:</label>
                    <input type="text" class="form-control" id="extra_waktu" value="<?php echo $row_info['extra_waktu']; ?> Menit" readonly>
                </div>

                <div class="form-group">
                    <label for="dp">Total Harga:</label>
                    <input type="text" class="form-control" id="dp" value="<?php echo $row_info['total']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="dp">DP:</label>
                    <input type="text" class="form-control" id="dp" value="<?php echo $dp; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="harga">Nomor Rekening:</label>
                    <input type="text" class="form-control" id="harga" value="1241250914 SITI NADIYAH TUENO // BNI" readonly>
                    <input type="text" class="form-control mt-1" id="harga" value="082196417567 NAULA MODJO // DANA" readonly>
                </div>

                <div class="form-group">
                    <label for="foto">Upload Bukti Transfer</label>
                    <input type="file" class="form-control-file" name="foto" accept="image/*" required>
                    <p style="font-size: 13px; color: red;"><i>Uang yang dibayarkan di awal adalah Uang DP sebagai reservasi. Sisanya bisa dibayar setelah sesi foto. <br> Pastikan untuk melakukan transfer sesuai nominal!</i></p>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Kirim</button>
            </form>
        </div>
    </div>
</div>
