<style>
        .gallery-item {
            margin-bottom: 30px;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>

<div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>Galeri Foto</h2>
                    <p>Foto-foto menarik dari Paket Sebox</p>
                </div>
            </div>
        </div>
    <div class="row">
        <?php
        require_once "connections/connections.php";
        $query = "SELECT * FROM tb_sebox";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-3">
                        <div class="gallery-item">
                            <img src="admin/uploads/sebox/' . $row['foto'] . '" alt="Sebox">
                        </div>
                      </div>';
            }
        } else {
            echo '<div class="col-md-12 text-center">Tidak ada foto Sebox yang ditampilkan.</div>';
        }

        mysqli_close($conn);
        ?>
    </div>
</div>