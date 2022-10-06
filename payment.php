<?php
  include('server.php');
    session_start();
    if (!isset($_SESSION['Email'])) {
       $_SESSION['error'] = "You must log in first";
       header('location: login.php');
   }
 
   if (!isset($_SESSION['ID'])) {
       $_SESSION['error'] = "You must log in first";
       header('location: login.php');
   }
 
   if (isset($_GET['logout'])) {
       session_destroy();
       unset($_SESSION['Email']);
       unset($_SESSION['ID']);
       header('location: login.php');
   }
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport">
    <title>Payment</title>
    <link rel="stylesheet" href="bootstrap/css/payment_bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/payment_Simple-Slider.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: #f5f5f5;">
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark"  style="background-color: #004aad;">
        <div class="container-fluid">
            
                <a class="navbar-brand" href="Home.php">
                    <img class="rounded" src="img/TUTheareLogo.png" alt="" width="70" height="70">
                    TU Theatre
                  </a>
            
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <a class="nav-link" href="Home.php">หน้าหลัก</a>
              </li>
              <li class="nav-item dropdown">
              
           <li>
          
            </ul>
          
          </div>
        </div>
      </nav>
      
    <div class="container py-4 py-xl-5" style="background: transparent;text-align: center;">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 style="font-family: Kanit, sans-serif; font-size: 50px;"><strong>PAYMENT</strong></h2>
            </div>
        </div>

                <div><img width="600px" height="600px" src="img/SimpleQR.jpg"style="width: 450px;height: 450px;"></div>
                               
                            </div> 
                            <div class="container py-4 py-xl-5" style="background: transparent;text-align: center;">
                            <div class="text-center">
                            <form method="POST" action="Home.php">
                                        <button class="btn btn-primary shadow " style="margin-left: 10px;font-family: Kanit, sans-serif;width: 140px;" ;>ต่อไป(Next)</button>
                                        </form></div>
</div></div>
                            
                           
    </div>

    <script src="bootstrap/js/payment_bootstrap.min.js"></script>
    <script src="js/payment_bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="js/payment_Lightbox-Gallery.js"></script>
    <script src="js/payment_Simple-Slider.js"></script>
</body>

</html>

