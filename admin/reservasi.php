<div class="wrapper">
    <div class="content-wrapper">
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper mt-5">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <h2><b>Data Reservasi</b></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once "./../connections/connections.php";

                    if (!$conn) {
                        die("Koneksi database gagal: " . mysqli_connect_error());
                    }

                    $query = "SELECT r.*, w.start_time, w.end_time, p.nama_paket, p.harga 
                              FROM tb_reservasi r
                              INNER JOIN tb_waktu_reservasi w ON r.id_waktu_reservasi = w.id_waktu_reservasi
                              INNER JOIN tb_paket p ON r.id_paket = p.id_paket";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                        <th>Extra Cetak</th>
                                        <th>Extra Orang</th>
                                        <th>Extra Waktu</th>
                                        <th>Total Harga</th>
                                        <th>Lunas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                
                        $no = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $no++;
                            echo '<tr>
                                    <td>' . $no . '</td>
                                    <td>' . $row['nama'] . '</td>
                                    <td>' . $row['tanggal'] . '</td>
                                    <td>' . $row['start_time'] . ' - ' . $row['end_time'] . '</td>
                                    <td>' . $row['nama_paket'] . '</td>
                                    <td>' . $row['harga'] . '</td>
                                    <td>' . $row['metode_pembayaran'] . '</td>
                                    <td>' . $row['konfirmasi'] . '
                                        ';
                                    if($row['konfirmasi'] == 'cancel') {
                                        echo '<br><a href="admin.php?page=return&menu_upd=' . $row['id_reservasi'] . '">Lihat rekening</a>';
                                    }
                                    echo '
                                    </td>
                                    <td>' . $row['ex_cetak'] . '</td>
                                    <td>' . $row['extra_orang'] . '</td>
                                    <td>' . $row['extra_waktu'] . '</td>
                                    <td>' . $row['total'] . '</td>
                                    <td>' . $row['lunas'] . '</td>
                                    <td>
                                        <a style="color: #F2BE22;" href="admin.php?page=edit_reservasi&menu_upd=' . $row['id_reservasi'] . '"" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                        <a style="color: #CD1818;" href="deleteReservasi.php?menu_del='. $row['id_reservasi'] . '" class="delete"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
                                        <a style="color: #4CAF50;" href="bukti_transfer.php?id=' . $row['id_reservasi'] . '" class="edit" target="_blank"><i class="material-icons" data-toggle="tooltip" title="Lihat Pembayaran">&#xE8F4;</i></a>
                                    </td>
                                </tr>';
                        }
                        echo '</tbody>
                              </table>';
                    } else {
                        echo '<p>Tidak ada data reservasi.</p>';
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
