<?php
require_once "./../connections/connections.php";

error_reporting(0);

session_start();

mysqli_query($conn, "DELETE FROM tb_waktu_reservasi WHERE id_waktu_reservasi = '" . $_GET['menu_del'] . "'");

header("location:admin.php?page=waktu");
?>
