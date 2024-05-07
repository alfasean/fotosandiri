<?php 
session_start();
require_once "./../connections/connections.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <link href="../img/logo.png" rel="icon">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css?v=2">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>

        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="admin.php?p=dashboard" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin.php?page=reservasi" class="nav-link">
                    <i class="nav-icon fas fa-calendar-check"></i>
                    <p>
                        Reservasi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin.php?page=paket" class="nav-link">
                    <i class="nav-icon far fa-sticky-note"></i>
                    <p>
                        Paket
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin.php?page=frame" class="nav-link">
                    <i class="nav-icon fas fa-portrait"></i>
                    <p>
                        Frame
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin.php?page=waktu" class="nav-link">
                    <i class="nav-icon fas fa-clock"></i>
                    <p>
                        Waktu
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-images"></i>
                    <p>
                        Galeri
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="admin.php?page=selfphoto" class="nav-link">
                            <i class="nav-icon fas fa-portrait"></i>
                            <p>
                                Selfphoto
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php?page=sebox" class="nav-link">
                            <i class="nav-icon fas fa-portrait"></i>
                            <p>
                                Sebox
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="logout.php" id="logout" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
      </div>
    </aside>

    <?php
    error_reporting(0);
    switch($_GET['page'])
    {
    default:
    include 'dashboard.php';
    break;
    		case "paket";
    		include 'paket.php';
    		break;
    		case "reservasi";
    		include 'reservasi.php';
    		break;
    		case "frame";
    		include 'frame.php';
    		break;
    		case "waktu";
    		include 'waktu.php';
    		break;
    		case "selfphoto";
    		include 'selfphoto.php';
    		break;
    		case "sebox";
    		include 'sebox.php';
    		break;
    		case "tambah_paket";
    			include 'tambah_paket.php';
    		break;
    		case "tambah_frame";
    			include 'tambah_frame.php';
    		break;
    		case "tambah_waktu";
    			include 'tambah_waktu.php';
    		break;
    		case "tambah_selfphoto";
    			include 'tambah_selfphoto.php';
    		break;
    		case "tambah_sebox";
    			include 'tambah_sebox.php';
    		break;
    		case "edit_reservasi";
    			include 'edit_reservasi.php';
    		break;
    		case "edit_waktu";
    			include 'edit_waktu.php';
    		break;
    		case "edit_paket";
    			include 'edit_paket.php';
    		break;
    		case "return";
    			include 'return.php';
    		break;
    	}
    	?>
        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/chart.js/Chart.min.js"></script>
    <script src="plugins/sparklines/sparkline.js"></script>
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>