<div class="wrapper">
    <div class="content-wrapper">
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper mt-5">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <h2><b>Data Paket</b></h2>
                                <a href="admin.php?page=tambah_paket" class="btn btn-success" tabindex="-1"
                                    role="button" aria-disabled="true"> <i class="fa fa-plus mr-1"></i>Tambah
                                    Data</a>
                            </div>
                            <?php
                            require_once "./../connections/connections.php";

                            if (!$conn) {
                                die("Koneksi database gagal: " . mysqli_connect_error());
                            }

                            $no = 0;

                            $query = "SELECT * FROM tb_paket";
                            $result = mysqli_query($conn, $query);


                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Paket</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>';
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $no++;
                                    echo '<tr>
                                            <td>' . $no . '</td>
                                            <td>' . $row['nama_paket'] . '</td>
                                            <td>' . $row['harga'] . '</td>
                                            <td><img src="./uploads/paket/' . $row['foto'] . '" alt="' . $row['foto'] . '" style="max-width: 100px;"></td>
                                            <td>
                                                <a style="color: #F2BE22;" href="admin.php?page=edit_paket&menu_upd=' . $row['id_paket'] . '"" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                                <a style="color: #CD1818;" href="deletePaket.php?menu_del='. $row['id_paket'] . '" class="delete"><i class="material-icons" data-toggle="tooltip" title="Hapus">&#xE872;</i></a>
                                            </td>
                                        </tr>';
                                }

                                echo '</table>';
                            } else {
                                echo 'Tidak ada data.';
                            }

                            mysqli_close($conn);
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
