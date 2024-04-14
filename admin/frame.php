<div class="content-wrapper">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper mt-5">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <h2><b>Data Frame</b></h2>
                            <a href="admin.php?page=tambah_frame" class="btn btn-success" tabindex="-1"
                                role="button" aria-disabled="true"> <i class="fa fa-plus mr-1"></i>Tambah
                                Data</a>
                        </div>
                    </div>
                </div>

                <?php
                $no = 0;
                $query = "SELECT * FROM tb_frame";

                if ($resultProduk = mysqli_query($conn, $query)) {
                    if (mysqli_num_rows($resultProduk) > 0) {
                        echo '<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Frame</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>';
                        echo '<tbody>';
                        while ($rowProduk = mysqli_fetch_assoc($resultProduk)) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td><img src='uploads/frame/" . $rowProduk['foto'] . "' alt='Foto Frame' style='max-width: 100px;'></td>";
                            echo "<td>
                                    <a style='color: #CD1818;' href='deleteFrame.php?menu_del=" . $rowProduk['id_frame'] . "' class='delete'><i class='material-icons' data-toggle='tooltip' title='Hapus'>&#xE872;</i></a>
                                  </td>";
                            echo "</tr>";
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>Tidak ada data yang ditampilkan.</p>';
                    }
                    mysqli_free_result($resultProduk);
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>
