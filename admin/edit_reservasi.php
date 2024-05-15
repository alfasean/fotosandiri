<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reservasi = $_GET['menu_upd'];
    $nama = $_POST["nama"];
    $tanggal = $_POST["tanggal"];
    $id_waktu_reservasi = $_POST["id_waktu_reservasi"];
    $id_paket = $_POST["id_paket"];
    $konfirmasi = $_POST["konfirmasi"];
    $ex_cetak = $_POST["ex_cetak"];
    $extra_orang = isset($_POST['extra_orang']) ? intval($_POST['extra_orang']) : 0;
    $extra_waktu = isset($_POST['extra_waktu']) ? intval($_POST['extra_waktu']) : 0;
    $lunas = $_POST["lunas"];
    $metode_pembayaran = $_POST["metode_pembayaran"];

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

    $query_harga_paket = "SELECT harga FROM tb_paket WHERE id_paket=$id_paket";
    $result_harga_paket = $conn->query($query_harga_paket);
    if ($result_harga_paket->num_rows > 0) {
        $row_harga_paket = $result_harga_paket->fetch_assoc();
        $harga_paket = $row_harga_paket['harga'];
    } else {
        echo "Harga paket tidak ditemukan.";
        exit();
    }

    $harga_extra_orang = $extra_orang * 25000;
    $total = $harga_paket + $harga_extra_orang + $harga_extra_waktu;
    if ($ex_cetak > 0) {
        $harga_ex_cetak = 20000; 
        $total += $harga_ex_cetak * $ex_cetak;
    }

    $foto_name = $_FILES['payment']['name'];
    $foto_tmp = $_FILES['payment']['tmp_name'];
    $foto_destination = 'uploads/payment/' . $foto_name;

    move_uploaded_file($foto_tmp, $foto_destination);

    $sql = "UPDATE tb_reservasi SET 
                nama='$nama', 
                tanggal='$tanggal', 
                id_waktu_reservasi='$id_waktu_reservasi', 
                id_paket='$id_paket', 
                konfirmasi='$konfirmasi', 
                ex_cetak='$ex_cetak', 
                extra_waktu='$extra_waktu', 
                extra_orang='$extra_orang', 
                lunas='$lunas', 
                total='$total', 
                metode_pembayaran='$metode_pembayaran', 
                payment='$foto_name' 
            WHERE id_reservasi=$id_reservasi";

    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "admin.php?page=reservasi";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['menu_upd'])) {
    $id_reservasi = $_GET['menu_upd'];

    $query = "SELECT * FROM tb_reservasi WHERE id_reservasi=$id_reservasi";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data reservasi tidak ditemukan.";
        exit();
    }
} else {
    echo "ID reservasi tidak disertakan dalam URL.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="form-container mt-5">
            <h2>Edit Reservasi</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="id_waktu_reservasi">Waktu:</label>
                    <select class="form-control" name="id_waktu_reservasi" required>
                        <?php
                        $query_waktu = "SELECT * FROM tb_waktu_reservasi";
                        $result_waktu = $conn->query($query_waktu);
                        if ($result_waktu->num_rows > 0) {
                            while ($row_waktu = $result_waktu->fetch_assoc()) {
                                $selected = ($row_waktu['id_waktu_reservasi'] == $row['id_waktu_reservasi']) ? 'selected' : '';
                                echo '<option value="' . $row_waktu['id_waktu_reservasi'] . '" ' . $selected . '>' . $row_waktu['start_time'] . ' - ' . $row_waktu['end_time'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_paket">Paket:</label>
                    <select class="form-control" name="id_paket" required>
                        <?php
                        $query_paket = "SELECT * FROM tb_paket";
                        $result_paket = $conn->query($query_paket);
                        if ($result_paket->num_rows > 0) {
                            while ($row_paket = $result_paket->fetch_assoc()) {
                                $selected = ($row_paket['id_paket'] == $row['id_paket']) ? 'selected' : '';
                                echo '<option value="' . $row_paket['id_paket'] . '" ' . $selected . '>' . $row_paket['nama_paket'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="konfirmasi">Status:</label>
                    <select class="form-control" name="konfirmasi" required>
                        <option value="konfirmasi" <?php if($row['konfirmasi'] == 'konfirmasi') echo 'selected'; ?>>Konfirmasi</option>
                        <option value="belum_konfirmasi" <?php if($row['konfirmasi'] == 'belum_konfirmasi') echo 'selected'; ?>>Belum Konfirmasi</option>
                        <option value="cancel" <?php if($row['konfirmasi'] == 'cancel') echo 'selected'; ?>>Cancel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="extra_orang">Extra Orang:</label>
                    <select class="form-control" name="extra_orang" required>
                        <?php
                        for ($i = 0; $i <= 10; $i++) {
                            $selected = ($i == $row['extra_orang']) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="extra_waktu">Extra Waktu:</label>
                    <select class="form-control" name="extra_waktu" required>
                        <option value="0">0</option>
                        <option value="5" <?php if($row['extra_waktu'] == '5') echo 'selected'; ?>>5 Menit</option>
                        <option value="10" <?php if($row['extra_waktu'] == '10') echo 'selected'; ?>>10 Menit</option>
                        <option value="15" <?php if($row['extra_waktu'] == '15') echo 'selected'; ?>>15 Menit</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ex_cetak">Extra Cetak:</label>
                    <select class="form-control" name="ex_cetak" required>
                        <?php
                        for ($i = 0; $i <= 10; $i++) {
                            $selected = ($i == $row['ex_cetak']) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lunas">Lunas:</label>
                    <select class="form-control" name="lunas" required>
                        <option value="lunas" <?php if($row['lunas'] == 'lunas') echo 'selected'; ?>>Lunas</option>
                        <option value="belum_lunas" <?php if($row['lunas'] == 'belum_lunas') echo 'selected'; ?>>Belum Lunas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran:</label>
                    <select class="form-control" name="metode_pembayaran" required>
                        <option value="transfer" <?php if($row['metode_pembayaran'] == 'transfer') echo 'selected'; ?>>Transfer</option>
                        <option value="cash" <?php if($row['metode_pembayaran'] == 'cash') echo 'selected'; ?>>Cash</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment">Foto Payment:</label>
                    <input type="file" class="form-control-file" name="payment" accept="image/*">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
            <?php
            if ($row['konfirmasi'] == 'cancel') {
                $query_return_id = "SELECT id_return FROM tb_return WHERE id_reservasi = " . $row['id_reservasi'];
                $result_return_id = $conn->query($query_return_id);
                if ($result_return_id->num_rows > 0) {
                    $return_row = $result_return_id->fetch_assoc();
                    $return_id = $return_row['id_return'];
                    echo '<a href="admin.php?page=return&menu_upd=' . $row['id_reservasi'] . '">Lihat rekening</a>';
                } else {
                    echo '<p>Data return tidak ditemukan</p>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
