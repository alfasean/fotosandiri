<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit UMKM</title>
    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once "./../connections/connections.php";

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $no_hp = $_POST["no_hp"];
        $deskripsi = $_POST["deskripsi"];
        $kategori = $_POST["kategori"];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];

        if (!empty($_FILES['foto']['name'])) {
            $foto = uploadFoto();
            if ($foto) {
                $sql = "UPDATE tb_umkm SET nama='$nama', alamat='$alamat', no_hp='$no_hp', deskripsi='$deskripsi', kategori='$kategori', latitude='$latitude', longitude='$longitude', foto='$foto' WHERE id_umkm='$_GET[menu_upd]'";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>window.location.href = "umkm.php";</script>';
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            $sql = "UPDATE tb_umkm SET nama='$nama', alamat='$alamat', no_hp='$no_hp', deskripsi='$deskripsi', kategori='$kategori', latitude='$latitude', longitude='$longitude' WHERE id_umkm='$_GET[menu_upd]'";

            if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href = "umkm.php";</script>';
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    if (isset($_GET['menu_upd'])) {
        $id_umkm = $_GET['menu_upd'];

        $sql = "SELECT * FROM tb_umkm WHERE id_umkm='$id_umkm'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Invalid request.";
        exit();
    }
    ?>

    <div class="form-container mt-2">
        <h2>Edit UMKM</h2>
        <form id="editForm" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" value="<?php echo $row['nama']; ?>" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" value="<?php echo $row['alamat']; ?>" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor Handphone:</label>
                <input type="number" id="no_hp" value="<?php echo $row['no_hp']; ?>" name="no_hp" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required style="width: 100% !important;"><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori" required>
                    <option value="Fashion" <?php if ($row['kategori'] == 'Fashion') echo 'selected'; ?>>Fashion</option>
                    <option value="Kuliner" <?php if ($row['kategori'] == 'Kuliner') echo 'selected'; ?>>Kuliner</option>
                    <option value="Kriya" <?php if ($row['kategori'] == 'Kriya') echo 'selected'; ?>>Kriya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" value="<?php echo $row['latitude']; ?>" name="latitude" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" value="<?php echo $row['longitude']; ?>" name="longitude" required>
            </div>
            <div class="form-group submit-button">
                <button class="btn btn-success" type="button" id="submitButton">Submit</button>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submitButton").addEventListener("click", function() {
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Kamu akan mengedit data?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('editForm').submit(); 
                    }
                });
            });
        });
    </script>
</body>

</html>
