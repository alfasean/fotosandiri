<style>
    .gallery {
        background-color: #ffffff;
        padding: 50px 0;
    }

    .gallery-item {
        margin-bottom: 30px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center; 
        flex-direction: column;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
        max-width: 350px; 
        height: auto; 
        border-radius: 10px 10px 0px 0px;
    }

    .gallery-item img:hover {
        transform: scale(1.1);
    }

    .gallery-item-text {
        text-align: center;
        margin-top: 10px;
    }

    .gallery-item-text p{
        font-size: 20px;
        font-weight: bold;
    }

    .btn-lihat-lebih-banyak {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #FFC0CB;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-lihat-lebih-banyak:hover {
        margin-top : 10px;
        transition :transform 0.8s ease;
    }

    .color-box {
    width: 100%;
    height: 100px;
    margin-bottom: 20px;
}

.sebox-item {
        margin-bottom: 30px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center; 
        flex-direction: column;
    }

    .sebox-item img {
        max-width: 250px; 
        height: auto; 
        border-radius: 20px;
    }

</style>


<div class="full_bg">
         <div class="slider_main">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div id="carouselExampleIndicators" class="carousel slide">
                        <ol class="carousel-indicators">
                           <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                           <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                           <div class="carousel-item active">
                              <div class="carousel-caption relative">
                                 <div class="row d_flex">
                                    <div  class="col-md-5">
                                       <div class="board">
                                          <i><img src="images/top_icon.png" alt="#"/></i>
                                          <h3>
                                             Fotosandiri.<br> Studio
                                          </h3>
                                          <div class="link_btn">
                                             <a class="read_more" href="#tentang">Tentang<span></span></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="banner_img">
                                          <figure><img class="img_responsive" src="images/cek.png" style="width: 70%; height: auto;"></figure>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="carousel-item">
                              <div class="carousel-caption relative">
                                 <div class="row d_flex">
                                    <div  class="col-md-5">
                                       <div class="board">
                                          <i><img src="images/top_icon.png" alt="#"/></i>
                                          <h3>
                                             Manjooo<br> Bafoto
                                          </h3>
                                          <div class="link_btn">
                                             <a class="read_more" href="#tentang">Tentang<span></span></a>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-7">
                                       <div class="banner_img">
                                          <figure><img class="img_responsive" src="images/cek.png" style="width: 70%; height: auto;"></figure>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="class">
         <div class="container" id="paket">
            <div class="row">
                  <div class="col-md-12">
                     <div class="titlepage text_align_center">
                        <h2>Daftar Harga</h2>
                        <p>Paket yang ada di Fotosandiri.Studio</p>
                     </div>
                  </div>
            </div>
            <div class="row">
               <div class="col-md-3 margi_bottom">
                  <div class="class_paket text_align_center">
                        <i><img src="admin/uploads/paket/price1.png" alt="Nama Paket 1"/></i>
                  </div>
               </div>
               <div class="col-md-3 margi_bottom">
                  <div class="class_paket text_align_center">
                        <i><img src="admin/uploads/paket/price2.png" alt="Nama Paket 2"/></i>
                  </div>
               </div>
               <div class="col-md-3 margi_bottom">
                  <div class="class_paket text_align_center">
                        <i><img src="admin/uploads/paket/price3.png" alt="Nama Paket 3"/></i>
                  </div>
               </div>
               <div class="col-md-3 margi_bottom">
                  <div class="class_paket text_align_center">
                        <i><img src="admin/uploads/paket/price4.png" alt="Nama Paket 4"/></i>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="about" id="tentang" style="background-color: #FFC0CB !important;">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-md-6">
                  <div class="titlepage text_align_left">
                     <h2>Tentang Foto Sandiri</h2>
                     <p>Fotosandiri.studio merupakan salah satu perusahaan yang usahanya bergerak dibidang jasa foto.Fotosandiri.studio masih tergolong salah satu UMKM baru yang terbentuk pada 16 Juni 2022 yang terletak di Fotosandiri.studio, Jl. Tikala Ares No.108, Tikala Ares, Kec. Tikala, Kota Manado, Sulawesi Utara. Fotosandiri.studio juga terus
                     mencoba mengembangkan usahanya karena dengan adanya beberapa pesaing dibidang usaha ini dan juga membuat nama perusahaan ini lebih dikenal oleh kalangan masyarakat Kota Manado.
                     </p>
                     <a class="read_more" href="index.php?page=reservasi">Reservasi</a>
                  </div>
               </div>
               <div class="col-md-6">
                  <img class="about_img" src="images/about.jpg" alt="foto">
               </div>
            </div>
         </div>
      </div>

      <div class="frame_foto" id="frame">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>Frame</h2>
                    <p>Frame untuk jadi pilihan foto kamu</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            require_once "connections/connections.php";

                            $query = "SELECT * FROM tb_frame";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li class="splide__slide">
                                            <div class="frame_foto-paket">
                                                <figure><img src="admin/uploads/frame/' . $row['foto'] . '" alt="Frame"></figure>
                                            </div>
                                          </li>';
                                }
                            } else {
                                echo '<p>Tidak ada data yang ditampilkan.</p>';
                            }
                            mysqli_close($conn);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gallery" id="galeri">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>Galeri Foto</h2>
                    <p>Foto-foto menarik dari Fotosandiri.Studio</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="gallery-item" style="margin-right: 10px;">
                <img src="images/gambar1.jpg" alt="Photo 1">
                <div class="gallery-item-text">
                  <p>SELFPHOTO</p>
                  <button onclick="location.href='index.php?page=selfphoto'" class="btn-lihat-lebih-banyak">Lihat Lebih Banyak</button>
                </div>
            </div>
            <div class="gallery-item">
                <img src="images/gambar4.jpg" alt="Photo 4">
                <div class="gallery-item-text">
                  <p>SEBOX</p>
                  <button onclick="location.href='index.php?page=sepaket'" class="btn-lihat-lebih-banyak">Lihat Lebih Banyak</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg_color py-5" style="background-color: #FFC0CB;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2 class="text-white">Background Color</h2>
                    <p class="text-white">Pilihan warna dari Fotosandiri.Studio</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="color-box" style="background-color: #FFFFFF;"></div>
                <p class="text-white text-center">Putih</p>
            </div>
            <div class="col-md-4">
                <div class="color-box" style="background-color: #808080;"></div>
                <p class="text-white text-center">Abu-Abu</p>
            </div>
            <div class="col-md-4">
                <div class="color-box" style="background-color: #DEB887;"></div>
                <p class="text-white text-center">Coklat</p>
            </div>
        </div>
    </div>

    <div class="bg_sebox py-2 mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2 class="text-white">Background Sebox</h2>
                    <p class="text-white">Pilihan background dari paket Sebox</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="sebox-item mr-3">
                <img src="images/sebox light.jpg" alt="backrgound-sebox">
                <p class="text-white text-center mt-3" style="font-size: 24px; font-weight: bold;">S E B O X <br> L I G H T</p>
            </div>
            <div class="sebox-item">
                <img src="images/sebox poster.jpg" alt="backrgound-sebox">
                <p class="text-white text-center mt-3" style="font-size: 24px; font-weight: bold;">S E B O X <br> P O S T E R</p>
            </div>
        </div>
    </div>
</div>
</div>




