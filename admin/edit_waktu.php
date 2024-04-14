<?php
session_start();
require_once "./../connections/connections.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_waktu_reservasi = $_GET['menu_upd'];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $sql = "UPDATE tb_waktu_reservasi SET start_time='$start_time', end_time='$end_time' WHERE id_waktu_reservasi=$id_waktu_reservasi";

    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "admin.php?page=waktu";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['menu_upd'])) {
    $id_waktu_reservasi = $_GET['menu_upd'];

    $query = "SELECT * FROM tb_waktu_reservasi WHERE id_waktu_reservasi=$id_waktu_reservasi";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data waktu tidak ditemukan.";
        exit();
    }
} else {
    echo "ID waktu tidak disertakan dalam URL.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Waktu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container mt-5">
            <h2>Edit Waktu</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="start_time">Waktu Mulai:</label>
                    <input type="time" class="form-control" name="start_time" value="<?php echo $row['start_time']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="end_time">Waktu Selesai:</label>
                    <input type="time" class="form-control" name="end_time" value="<?php echo $row['end_time']; ?>"
                        required>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
