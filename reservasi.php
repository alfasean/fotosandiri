<?php
session_start();
require_once "connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$queryWaktu = "SELECT * FROM tb_waktu_reservasi WHERE available = 1";
$resultWaktu = mysqli_query($conn, $queryWaktu);

$waktuOptions = "";

if (mysqli_num_rows($resultWaktu) > 0) {
    while ($rowWaktu = mysqli_fetch_assoc($resultWaktu)) {
        $waktuOptions .= '<option value="' . $rowWaktu['id_waktu_reservasi'] . '">' . $rowWaktu['start_time'] . ' - ' . $rowWaktu['end_time'] . '</option>';
    }
} else {
    $waktuOptions = '<option value="">Tidak ada waktu reservasi yang tersedia</option>';
}

$queryPaket = "SELECT * FROM tb_paket";
$resultPaket = mysqli_query($conn, $queryPaket);

$paketOptions = "";
$keterangan = "";

if (mysqli_num_rows($resultPaket) > 0) {
    while ($rowPaket = mysqli_fetch_assoc($resultPaket)) {
        $paketOptions .= '<option value="' . $rowPaket['id_paket'] . '" data-harga="' . $rowPaket['harga'] . '">' . $rowPaket['nama_paket'] . '</option>';
    }
} else {
    $paketOptions = '<option value="">Tidak ada paket yang tersedia</option>';
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $id_waktu_reservasi = $_POST['waktu'];
    $id_paket = $_POST['paket'];
    $extra_waktu = isset($_POST['extra_waktu']) ? intval($_POST['extra_waktu']) : 0;
    $extra_orang = isset($_POST['extra_orang']) ? intval($_POST['extra_orang']) : 0;

    switch ($extra_waktu) {
        case 5:
            $harga_extra_waktu = 15000;
            break;
        case 10:
            $harga_extra_waktu = 20000;
            break;
        case 15:
            $harga_extra_waktu = 25000;
            break;
        default:
            $harga_extra_waktu = 0;
            break;
    }

    $queryHargaPaket = "SELECT harga FROM tb_paket WHERE id_paket = ?";
    $stmtHargaPaket = $conn->prepare($queryHargaPaket);
    $stmtHargaPaket->bind_param("i", $id_paket);
    $stmtHargaPaket->execute();
    $resultHargaPaket = $stmtHargaPaket->get_result();
    $rowHargaPaket = $resultHargaPaket->fetch_assoc();
    $harga_paket = $rowHargaPaket['harga'];

    $harga_extra_orang = $extra_orang * 25000;

    $queryInsert = "INSERT INTO tb_reservasi (nama, email, tanggal, id_waktu_reservasi, id_paket, extra_waktu, extra_orang, total, konfirmasi, ex_cetak) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'belum_konfirmasi', '0')";
    $stmt = $conn->prepare($queryInsert);
    $stmt->bind_param("sssiiiii", $nama, $email, $tanggal, $id_waktu_reservasi, $id_paket, $extra_waktu, $extra_orang, $total_harga);

    $total_harga = $harga_paket + $harga_extra_waktu + $harga_extra_orang;

    if ($stmt->execute()) {
        $_SESSION['id_reservasi'] = $stmt->insert_id;
        echo '<script>window.location.href = "index.php?page=konfirmasi";</script>';
        exit();
    } else {
        echo "Error: " . $queryInsert . "<br>" . $conn->error;
    }
}


$conn->close();
?>

<div class="container">
    <div class="form-container" style="margin-top: 100px;">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="paket">Paket</label>
                <select class="form-control" name="paket" id="paket" required>
                    <?php echo $paketOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga Paket</label>
                <input type="text" class="form-control" id="harga" readonly>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Reservasi</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>

            <div class="form-group">
                <label for="waktu">Waktu Reservasi</label>
                <select class="form-control" name="waktu" required>
                    <?php echo $waktuOptions; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Extra Waktu:</label><br>
                <select class="form-control" name="extra_waktu">
                    <option value="0">Extra Waktu(+Rp 0)</option>
                    <option value="5">Extra Waktu 5 Menit (+Rp 15.000)</option>
                    <option value="10">Extra Waktu 10 Menit (+Rp 20.000)</option>
                    <option value="15">Extra Waktu 15 Menit (+Rp 25.000)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="extra_orang">Extra Orang (Max: 10)</label>
                <select class="form-control" id="extra_orang" name="extra_orang">
                    <?php 
                    for ($i = 0; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
                <span>(+Rp <span id="extra_orang_harga">0</span>)</span>
            </div>

            <p style="margin-bottom: 8px; color: red; font-size: 13px;"><?php echo $keterangan; ?></p>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("extra_orang").addEventListener("change", function () {
    var extraOrangHarga = document.getElementById("extra_orang_harga");
    var hargaPerOrang = 25000;
    var extraOrangValue = parseInt(this.value);
    extraOrangHarga.textContent = extraOrangValue * hargaPerOrang; 
});


    document.getElementById("paket").addEventListener("change", function () {
        var selectedOption = this.options[this.selectedIndex];
        var hargaPaket = selectedOption.getAttribute("data-harga");
        document.getElementById("harga").value = hargaPaket;
    });
</script>
