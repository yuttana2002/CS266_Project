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
<html lang="en">

<head>
<link rel="icon" href="img/ico.ico" type="image/ico">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>ค้นหาภาพยนตร์</title>

    <script>
      

  
        </script>
    
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
                  <li><a class="dropdown-item" href="SearchMovie.php?logout='1'">Logout</a></li>
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
 SearchBox Module2/2 attach this below nav bar uwu</nav> -->

	<div id="result">
				  
	</div>

<!-- SearchBox Module2/2 --100%complete!-->
    <div class="container py-4 py-xl-5" style="background: transparent;text-align: center;">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2 style="font-family: Kanit, sans-serif; font-size: 50px;"><strong>เลือกรอบฉายที่ต้องการ</strong></h2>
            </div>
        </div>

        <?php
    $servername = "localhost";
    $username = "root";
    $passworddb = "";
    $dbname = "tu_theatre"; 
    
    // Create connection
    $conn = new mysqli($servername, $username, $passworddb, $dbname);
      
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM Film";
    $query = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM Theatre";
    $query1 = mysqli_query($conn, $sql1);

    $sql4 = "SELECT DISTINCT ShowTime FROM showtime";

    $query3 = mysqli_query($conn, $sql4);
    $date = explode(' ', $sql4);
    

    ?>
    <div class="row">
  <div class="col">
        <!--Theater-->
        
            <select name="TheatreName" id="TheatreName" class="form-select" onchange="show_showtime2()">
            <option value="">Theatre Select</option>
            <?php while($result = mysqli_fetch_assoc($query1)): ?>
            <option value="<?=$result['TheatreID']?>"><?=$result['TheatreName']?></option>
            <?php endwhile; ?>
            </select>   
        </div>

        <div class="col">
        <!--Flim-->
        
            <select name="FilmName" id="FilmName" class="form-select" onchange="show_showtime2()">
            <option value="">Movies Select</option>
            <?php while($result = mysqli_fetch_assoc($query)): ?>
            <option value="<?=$result['FilmID']?>"><?=$result['FilmName']?></option>
            <?php endwhile; ?>
            </select>
        </div>

    </div>


              <!-- Show Table from show_movie-->
      <div class="container-fluid">
<br>
        <div class="card" id="TableSorterCard">

            <h6 class="card-header">ผลการค้นหาภาพยนตร์</h6>

                    <div class="card-body" >

                    <div id="txtHint"><small class="text-muted">โปรดเลือก movies และ theatres ก่อน</small></div>
                    </div>

        </div>
              
</div>
<br>

                


                 <!-- bootstrap src -->
                 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
       <script src="backend/showMovies.js"></script> 
       <script src="backend/script-addshow.js"></script> 
              </body>

</html>