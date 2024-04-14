<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reservasi = $_GET['menu_upd'];
    // Ambil data yang dikirimkan melalui form
    $nama = $_POST["nama"];
    $tanggal = $_POST["tanggal"];
    $id_waktu_reservasi = $_POST["id_waktu_reservasi"];
    $id_paket = $_POST["id_paket"];
    $konfirmasi = $_POST["konfirmasi"];
    $ex_cetak = $_POST["ex_cetak"];

    // Buat query untuk update data reservasi
    $sql = "UPDATE tb_reservasi SET nama='$nama', tanggal='$tanggal', id_waktu_reservasi=$id_waktu_reservasi, id_paket=$id_paket, konfirmasi='$konfirmasi', ex_cetak = '$ex_cetak' WHERE id_reservasi=$id_reservasi";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "admin.php?page=reservasi";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Periksa apakah parameter menu_upd tersedia dalam URL
if (isset($_GET['menu_upd'])) {
    $id_reservasi = $_GET['menu_upd'];

    // Buat query untuk mengambil data reservasi yang akan diedit
    $query = "SELECT * FROM tb_reservasi WHERE id_reservasi=$id_reservasi";
    $result = $conn->query($query);

    // Periksa apakah data reservasi ditemukan
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
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                </div>
                <!-- Menampilkan opsi waktu dari tabel tb_waktu_reservasi -->
                <div class="form-group">
                    <label for="id_waktu_reservasi">Waktu:</label>
                    <select class="form-control" name="id_waktu_reservasi" required>
                        <?php
                        $query_waktu = "SELECT * FROM tb_waktu_reservasi";
                        $result_waktu = $conn->query($query_waktu);
                        if ($result_waktu->num_rows > 0) {
                            while ($row_waktu = $result_waktu->fetch_assoc()) {
                                // Menandai waktu yang dipilih
                                $selected = ($row_waktu['id_waktu_reservasi'] == $row['id_waktu_reservasi']) ? 'selected' : '';
                                echo '<option value="' . $row_waktu['id_waktu_reservasi'] . '" ' . $selected . '>' . $row_waktu['start_time'] . ' - ' . $row_waktu['end_time'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <!-- Menampilkan opsi paket dari tabel tb_paket -->
                <div class="form-group">
                    <label for="id_paket">Paket:</label>
                    <select class="form-control" name="id_paket" required>
                        <?php
                        $query_paket = "SELECT * FROM tb_paket";
                        $result_paket = $conn->query($query_paket);
                        if ($result_paket->num_rows > 0) {
                            while ($row_paket = $result_paket->fetch_assoc()) {
                                // Menandai paket yang dipilih
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
                    </select>
                </div>
                <div class="form-group">
                    <label for="ex_cetak">Extra Cetak:</label>
                    <select class="form-control" name="ex_cetak" required>
                        <option value="Tidak" <?php if($row['tidak'] == 'tidak') echo 'selected'; ?>>Tidak</option>
                        <option value="Ya" <?php if($row['ya'] == 'ya') echo 'selected'; ?>>Ya</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>