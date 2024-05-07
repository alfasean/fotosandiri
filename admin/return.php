<div class="wrapper">
    <div class="content-wrapper">
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper mt-5">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <h2><b>Data Return</b></h2>
                            </div>
<?php
require_once "./../connections/connections.php";

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_GET['menu_upd'])) {
    $id_reservasi = $_GET['menu_upd'];

    $query = "SELECT * FROM tb_return WHERE id_reservasi=$id_reservasi";
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

$query = "SELECT * FROM tb_return";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bank</th>
                    <th>No Rekening</th>
                </tr>
            </thead>
            <tbody>';
                
    $no = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $no++;
        echo '<tr>
                <td>' . $no . '</td>

                <td>' . $row['bank'] . '</td>
                <td>' . $row['no_rekening'] . '</td>
              </tr>';
    }
    echo '</tbody>
          </table>';
} else {
    echo '<p>Tidak ada data tb_return.</p>';
}

mysqli_close($conn);
?>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
