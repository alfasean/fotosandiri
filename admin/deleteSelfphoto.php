<?php
require_once "./../connections/connections.php";

error_reporting(0);

session_start();

mysqli_query($conn, "DELETE FROM tb_selfphoto WHERE id_selfphoto = '" . $_GET['menu_del'] . "'");

header("location:admin.php?page=selfphoto");
?>
