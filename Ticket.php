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
<!DOCTYPE html>
<html lang="en" style="height: 825px;">

<head>

    <title>ตั๋วหนังที่มีอยู่</title>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
	<!-- SEARCH BOX MODULE  (1/2)-->
	<script src="js/searchbox.js"></script> 
	<link rel="stylesheet" href="css/searchbox.css">
	<!-- SEARCH BOX MODULE  (1/2) 50%complete -->
	
	
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
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ตั๋วหนัง
                </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="SearchMovie.php">จองตั๋ว</a></li>
                <li><a class="dropdown-item" href="Ticket.php">ตั๋วที่มีอยู่</a></li>
              </ul><li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  ข้อมูลส่วนตัว
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="Profile.php">ข้อมูลผู้ใช้</a></li>
                  <li><a class="dropdown-item" href="Edit.php">แก้ไขข้อมูลส่วนตัว</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="Ticket.php?logout='1'">Logout</a></li>
                </ul>
              </li>
            </ul>
           <!--- replace old search box -->
            <form class="d-flex" action="search.php" method="POST">
              <input class="form-control me-2" id="searchBox" name="searchBox" autocomplete="off" type="search" placeholder="ค้นหาภาพยตร์" aria-label="Search" required>
			  
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
<!--- replace old search box -->
          </div>
        </div>
      </nav>
      <!-- put under </nav>
 SearchBox Module2/2 attach this below nav bar </nav> -->

	<div id="result">
				  
	</div>

<!-- SearchBox Module2/2 --100%complete!-->
    <div class="container py-4 py-xl-5" style="background: transparent;text-align: center;">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 style="font-family: Kanit, sans-serif; font-size: 50px;"><strong>TICKET</strong></h2>
            </div>
        </div>


     <?php if (isset($_SESSION['ID'])):?>
     <?php
          $query="SELECT DISTINCT mID,TheatreID,FilmID,T_Showtime FROM ticket WHERE mID ='$_SESSION[ID]'";
          $allticket=mysqli_query($conn,$query);
      ?> 

     <?php while($ticket=mysqli_fetch_assoc($allticket)):?> 
     <?php
         $query="SELECT Film.FilmName , Film.FilmDuration, filmgenre.FilmGenre, Film.FilmRating
         FROM 
         Film INNER JOIN ShowTime ON (Film.FilmID=ShowTime.FilmID)
         INNER JOIN filmgenre ON(filmgenre.FilmID=Film.FilmID)
         WHERE Film.FilmID = '$ticket[FilmID]'";
         $curfilm=mysqli_query($conn,$query);
         $curfilm=mysqli_fetch_assoc($curfilm);

         $query="SELECT COUNT(DISTINCT TicketID) AS count
         FROM ticket 
         WHERE mID ='$_SESSION[ID]' AND FilmID='$ticket[FilmID]' AND TheatreID='$ticket[TheatreID]' AND T_Showtime='$ticket[T_Showtime]'";
         $amount=mysqli_query($conn,$query);
         $amount=mysqli_fetch_array($amount);

         $query="SELECT FilmGenre FROM filmgenre WHERE FilmID='$ticket[FilmID]'";
         $allgenre=mysqli_query($conn,$query);

         $query="SELECT COUNT(mID) AS count FROM review WHERE FilmID='$ticket[FilmID]'";
         $countreview=mysqli_query($conn,$query);
         $countreview=mysqli_fetch_array($countreview);

         $query="SELECT TheatreName FROM theatre WHERE TheatreID='$ticket[TheatreID]'";
         $theatre= mysqli_query($conn,$query);
         $theatre=mysqli_fetch_assoc($theatre);
         
      
      ?> 
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex" style="width: 450px;">
                                <div><img width="600px" height="600px" src="img/movie_poster/<?php echo($curfilm['FilmName'])?>.jpg" style="width: 450px;height: 700px;"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4" id="FilmName" style="font-size: 42px;font-weight: bold;text-align: left;margin-right:-20px;"><?php echo($curfilm['FilmName'])?></h4>
                                    </div><br>
                                        <p class="lead fs-6" id="FilmDate" style="color: rgb(30,31,31);font-family: Kanit, sans-serif;text-align: justify;"><?php $newDate=date("d M Y",strtotime($ticket['T_Showtime']));echo($newDate);?><br></p>
                                        <p id="FilmDate" style="color: rgb(30,31,31);font-family: Kanit, sans-serif;text-align: justify;font-size: 20px;"><?php echo($theatre['TheatreName']) ;?><br></p>
                                        
                                        <p class="lead fs-6"></p>
                                        <?php while($genre=mysqli_fetch_assoc($allgenre)):?>
                                        <button class="btn btn-primary shadow float-start" style="margin-right: 10px;font-family: Kanit, sans-serif;width: 110px;"><?php echo ($genre['FilmGenre'])?></button>                                        
                                        <?php endwhile?><br>
                                        <p class="lead fs-6"><br><br></p>
                                        <p class="fw-bold float-start mb-0" id="RatingLabel" style="width: 97px;color: rgb(20,0,255);font-family: Kanit, sans-serif;margin-top: -26px;">Movie Rating</p>
                                        <p class="text-muted float-start mb-0" id="RatingScore" style="margin-top: -26px;margin-left: 93px;">&nbsp; <?php echo($curfilm['FilmRating']." (".$countreview['count']." reviews)")?> </p><br><br><br>
                                        <button class="btn btn-primary shadow float-start" id="FilmTime" style="margin-right: 10px;font-family: Kanit, sans-serif;width: 150px;">
                                        <?php 
                                        
                                        $start=$ticket['T_Showtime']; 
                                        $end=$curfilm['FilmDuration'];
                                        $end=strtotime($end);
                                        $hour=date('H',$end);
                                        $hour=$hour*3600;
                                        $minute=date('i',$end);
                                        $minute=$minute*60;
                                        $final=$hour+$minute;
                                        //echo($final);
                                        $endfilm=date("H:i",strtotime($start."+$final seconds"));
                                        $start=date("H:i",strtotime($start));
                                        echo($start."-".$endfilm);
                                        ?></button>
                                        <p class="lead fs-6"><br><br><br></p>
                                        <small style="color: rgb(30,31,31); font-size: 22px;font-family: Kanit, sans-serif;margin-left: -210px;">Number of Ticket :</small>
                                        <small id="FilmOwnNum" style="color: rgb(30,31,31); font-size: 22px;font-family: Kanit, sans-serif;margin-right: 10px;margin-left: 10px;"><?php echo($amount['count']);?><br><br></small>
                                        <button class="btn btn-outline-primary float-start" data-bss-hover-animate="pulse" id="ReviewButton" type="button" style="margin-left: 0px;font-family: Kanit, sans-serif;margin-top:40px;" onclick="window.location.href='MoviesReview.php?movies=<?php echo($curfilm['FilmName'])?>&moviesID=<?php echo($ticket['FilmID']);?>';">Review Page</button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile?>
     <?php endif ?>   


    <script src="bootstrap/js/ticket_bootstrap.min.js"></script>
    <script src="js/ticket_bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="js/ticket_Lightbox-Gallery.js"></script>
    <script src="js/ticket_Simple-Slider.js"></script>
</body>

</html>