<?php
session_start();
require_once "connections/connections.php";
if (isset($_SESSION['id_reservasi'])) {
    $id_reservasi = $_SESSION['id_reservasi'];

    $query = "SELECT * FROM tb_reservasi WHERE id_reservasi = $id_reservasi";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $invoice_link = '<li class="nav-item"><a class="nav-link" href="index.php?page=invoice">Invoice</a></li>';
    } else {
        $invoice_link = ''; 
    }
} else {
    $invoice_link = ''; 
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <title>Fotosandiri.studio</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css?v=2">
      <link rel="stylesheet" href="css/responsive.css">
      <script src="https://kit.fontawesome.com/8353bdf612.js" crossorigin="anonymous"></script>
      <link rel="icon" href="images/logo.png" type="image/gif" />
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
   </head>

   <style>
      .icon-link {
    margin-right: 15px;
}

.icon-link i {
    font-size: 3em;
}

   </style>

   <body class="main-layout">
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <div class="header" style="top: 0;">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class=" col-md-2 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="index.html"><img src="images/logo.png" width="100" height="100" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-10 col-sm-12">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="index.php?page=home">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#paket">Paket</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#frame">Frame</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="#galeri">Galeri</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="index.php?page=reservasi">Reservasi</a>
                           </li>
                           <li class="nav-item">
                                 <?php echo $invoice_link; ?>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>

      <?php
    error_reporting(0);
    switch($_GET['page'])
    {
    default:
    include 'home.php';
    break;
    		case "reservasi";
    		include 'reservasi.php';
    		break;
    		case "home";
    		include 'home.php';
    		break;
    		case "konfirmasi";
    		include 'konfirmasi.php';
    		break;
         case "invoice";
    		include 'invoice.php';
    		break;
         case "sebox";
    		include 'sebox.php';
    		break;
         case "selfphoto";
    		include 'selfphoto.php';
    		break;
         case "cancel_confirmation";
    		include 'cancel_confirmation.php';
    		break;
    	}
    	?>


<footer style="margin-top: 150px !important;">
  <div class="row" style="background-color: #FFC0CB;">
    <div class="col-lg text-white">
      <div class="p-5">
        <h2 class="h1 text-uppercase font-weight-bold mb-4">Fotosandiri.studio</h2>
        <p class="lead mb-4">Self Photo Studio & Photobox Pertama di Manado</p>
        <address>
         <p class="mb-3">Contact Us:</p>
          <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center mb-3">
              <i class="fas fa-map-marker-alt fa-lg mr-2 text-white"></i>
              <span><span class="text-white">Jl. Tikala Ares No.108, Tikala Ares, Kec. Tikala, Kota Manado</span></span>
            </li>
            <li class="d-flex align-items-center mb-3">
            <i class="fa-brands fa-whatsapp fa-lg  mr-2 text-white"></i>
              <span><span class="text-white">+6285399581627</span></span>
            </li>
            <li class="d-flex align-items-center mb-3">
            <i class="fa-brands fa-instagram fa-lg  mr-2 text-white"></i>
              <span><a class="text-white" href="https://www.instagram.com/fotosandiri.studio/">fotosandiri.studio</a></span>
            </li>
            <li class="d-flex align-items-center">
               <i class="fa-brands fa-tiktok fa-lg  mr-2 text-white"></i>
               <span><a class="text-white" href="https://www.tiktok.com/@fotosandiri.studio">fotosandiri.studio</a></span>
            </li>
          </ul>
        </address>
      </div>
    </div>

    <div class="col-lg" style="min-height: 400px;">
      <div class="h-100 d-flex justify-content-center align-items-center">
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.8070625350574!2d124.84409507363596!3d1.483784661133488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x328775e899005551%3A0xb955666574c0bd16!2sSoondays%20coffee!5e1!3m2!1sid!2sid!4v1712486606084!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</footer>



      <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
      <script>
         document.addEventListener('DOMContentLoaded', function () {
            new Splide('.splide', {
                  type: 'slide',
                  perPage: 3, 
                  perMove: 1,
                  gap: 20,
                  pagination: false,
                  breakpoints: {
                     768: {
                        perPage: 1, 
                     }
                  }
            }).mount();
         });
      </script>


      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>