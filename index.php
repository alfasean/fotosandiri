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
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/responsive.css">
      <link rel="icon" href="images/logo.png" type="image/gif" />
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
   </head>
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
    
    <footer>
      <div class="footer">
         <div class="copyright">
               <div class="container">
                  <div class="row align-items-center"> 
                     <div class="col-md-6">
                           <iframe width="500" height="250" class="mt-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.8070625350574!2d124.84409507363596!3d1.483784661133488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x328775e899005551%3A0xb955666574c0bd16!2sSoondays%20coffee!5e1!3m2!1sid!2sid!4v1712486606084!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                     <div class="col-md-6">
                           <p class="py-5 text-center">© 2024 All Rights Reserved. Design by Fotosandiri.studio</p>
                     </div>
                  </div>
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