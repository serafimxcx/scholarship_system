<?php 
  include_once("conn.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KLL Scholarship Online System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


  <!-- Main CSS File -->
  <link href="./assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: May 04 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a class='logo d-flex align-items-center me-auto' href='#'>
        <h1 class="sitename">iApply</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a class href='#hero'>Home</a></li>
          <li><a href='#announcements'>Announcements</a></li>
          <li><a href='#about'>About</a></li>
          
          <!-- <li><a href="index.html#services">Services</a></li>
          <li><a href="index.html#pricing">Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> -->
          <li><a href='#contact'>Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" target="_blank" href="/scholarship_system/user/register_login/user_login.php">Apply Scholarship</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="/scholarship_system/kll_bg2.png" alt="">
      </div>
      <div class="container text-center" style="margin-top: -50px;">

        <div class="row gy-4 justify-content-center mb-4">
          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/home-1.jpg" class="img-fluid" alt="" style="width: 90px;">
          </div>
          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/home-2.jpg" class="img-fluid" alt="" style="width: 90px;">
          </div>
          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/home-3.jpg" class="img-fluid" alt="" style="width: 90px;">
          </div>
          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="/scholarship_system/unifast_logo.png" class="img-fluid" alt="" style="width: 90px;">
          </div>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up" class="mb-3">Kolehiyo ng Lungsod ng Lipa</h1>
          
          <!-- <img src="./assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300"> -->
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- Announcements Section -->
    <section id="announcements" class="testimonials section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Announcements</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100" style="margin-top: -50px;">

        <div class="swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">
              <?php
                  $result = $conn->query("select * from tb_announcement order by id DESC");

                  if(mysqli_num_rows($result) == 0){
                      echo "<p style='width: 100%; text-align: center;'>No announcements has been made at this moment.</p>";
                  }else{
                    while($row = $result->fetch_assoc()){
                    $body = openssl_decrypt($row["body"], $method, $key);
                    $title = openssl_decrypt($row["title"], $method, $key);
                    $picture = openssl_decrypt($row["picture"], $method, $key);
                    $created_at = openssl_decrypt($row["created_at"], $method, $key);
                    $created_at_create = date_create($created_at);
                    $format_created_at = date_format($created_at_create,"F j, Y");

                      echo '<div class="swiper-slide n_announcement" announcement_id="'.$row["id"].'">
                                <div class="testimonial-item " style="background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(70, 70, 70, 0.5)),
                                url(./img_announcement/';
                                if($picture == ""){
                                  echo "default.jpg";
                                }else{
                                  echo $picture;
                                }
                                echo '); background-size: cover; border-radius: 15px;" >
                    
                                  <h4 style="color: white; text-align: left;">'.$format_created_at.'</h4>

                                  <h2 style="font-weight: bold; color: white; text-align: left;">'.$title.'</h2>
                                </div>
                                
                            </div>';
                    }
                  }
                  
              
              ?>
            

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">About</p>
            <h3>VISION</h3>
            <p class="fst-italic">
              A center of human development committed to the pursuit of wisdom, truth, justice, pride, dignity, and local/global competitive- ness via affordable but quality education for all.
            </p> 
            
            <h3>MISSION</h3>
            <p class="fst-italic">
              Establish and maintain an academic environment promoting the pursuit of excellence and the total development of its student as human beings, with fear of God and love of country and fellowmen.
            </p> 

            <h3>GOALS</h3>
            <p class="fst-italic">
              Kolehiyo ng Lungsod ng Lipa aims to:
            </p> 
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>foster the spiritual, intellectual, social, moral, and creative life of its client via affordable quality tertiary education;</span></li>
              <li><i class="bi bi-check-circle"></i> <span>provide the clients with rich and substantial, relevant and wide range of academic disciplines, expose them to varied curricular and co-curricular experiences which nurture and enhance their personal dedications and commitments to social, moral, cultural, and eco- nomic transformations;              </span></li>
              <li><i class="bi bi-check-circle"></i> <span>work with the government and the community in the pursuit of achieving national developmental goals; and</span></li>
              <li><i class="bi bi-check-circle"></i> <span>develop deserving and qualified clients with different skills and prepare them for local and global competitiveness.</span></li>
            </ul>
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="./assets/img/about-1.jpg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="./assets/img/about-2.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="./assets/img/about-3.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- /About Section -->

    <!-- COLLEGES Section -->
    <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/kll college/1.png" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/kll college/2.png" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/kll college/3.png" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/kll college/4.png" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="./assets/img/kll college/5.png" class="img-fluid" alt="">
          </div><!-- End Client Item -->

        </div>

      </div>

    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>Marawoy, Lipa City, Batangas</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p> <a href='tel:(043) 774 2420'>(043) 774 2420</a></p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p><a href='mailto:kll_lipa@yahoo.com'>kll_lipa@yahoo.com</a></p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1 justify-content-center">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <iframe style="width: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.928783577929!2d121.17171857573388!3d13.962844592371102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6b7f73fd9e49%3A0x1d27358b4b6562c!2sKolehiyo%20ng%20Lungsod%20ng%20Lipa!5e0!3m2!1sen!2sph!4v1714845686535!5m2!1sen!2sph" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div><!-- End Google Maps -->
        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top d-flex justify-content-center">
      <div class="row gy-4">
        <div class="col-lg-12 footer-about">
          <a class='logo d-flex align-items-center' href='/'>
            <span class="sitename">Follow Us</span>
          </a>
          <div class="social-links d-flex mt-4 justify-content-center">
            <a href="https://www.facebook.com/KLLOfficial"><i class="bi bi-facebook"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">KLL Scholarship Online System</strong><br><span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/vendor/php-email-form/validate.js"></script>
  <script src="./assets/vendor/aos/aos.js"></script>
  <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="./assets/js/main.js"></script>
  
  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- CUSTOM JS File -->
  <script src="./assets/js/script.js"></script>



</body>

<?php
  $result = $conn->query("select * from tb_announcement order by id DESC");

  if(mysqli_num_rows($result) == 0){
      echo "<p style='width: 100%; text-align: center;'>No announcements has been made at this moment.</p>";
  }else{
    while($row = $result->fetch_assoc()){
    $body = openssl_decrypt($row["body"], $method, $key);
    $title = openssl_decrypt($row["title"], $method, $key);
    $picture = openssl_decrypt($row["picture"], $method, $key);
    $created_at = openssl_decrypt($row["created_at"], $method, $key);
    $created_at_create = date_create($created_at);
    $format_created_at = date_format($created_at_create,"F j, Y");

      echo '
            
            <div class="modal announcement_modal" id="announcement_modal'.$row["id"].'">
                <div class="announcement_div">
                  <h2 style="font-weight: bold; color: black;">'.$title.'</h2>
                  <h4 style="color: black;">'.$format_created_at.'</h4>
                  <br>
                  
                    <div><center><img src="./img_announcement/';
                    if($picture == ""){
                      echo "default.jpg";
                    }else{
                      echo $picture;
                    }
                    echo '" class="img_announcement"></center></div>
                  <br><br>
                 <p>'.$body.'</p>
                  
                </div>
            </div>';
    }
  }
  

?>
<script>
  $(function(){
    $(".announcement_modal").click(function(event){
   
      if ($(event.target).hasClass("announcement_modal")) {
        $(".announcement_modal").css("display", "none");
      }
    });

    $(".n_announcement").click(function(){
      var announcement_id = $(this).attr("announcement_id");

      $("#announcement_modal"+announcement_id).css("display", "flex");
   
    });
  });
</script>
</html>