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


$sql1 = "SELECT DISTINCT FilmGenre FROM FilmGenre";
#sql2 = for display movie
$sql2 = "SELECT DISTINCT T1.filmID, T1.FilmName, T1.FilmDescription, T1.FilmRating, T2.Genre
		FROM (SELECT DISTINCT film.filmID, film.FilmName, film.FilmDescription, film.FilmRating
				FROM film
				INNER JOIN FilmGenre
					ON film.filmID=FilmGenre.FilmID) AS T1
		INNER JOIN (SELECT FilmID,GROUP_CONCAT(FilmGenre) AS Genre
					FROM `filmgenre`
					GROUP BY FilmID) AS T2
		ON T1.filmID=T2.FilmID";
$sql3 = "SELECT DISTINCT T3.filmID, T3.FilmName, showtime.ShowTime
	FROM (SELECT DISTINCT T1.filmID, T1.FilmName, T1.FilmDescription, T1.FilmRating, T2.Genre
			FROM (SELECT DISTINCT film.filmID, film.FilmName, film.FilmDescription, film.FilmRating
					FROM film
					INNER JOIN FilmGenre
						ON film.filmID=FilmGenre.FilmID) AS T1
			INNER JOIN (SELECT FilmID,GROUP_CONCAT(FilmGenre) AS Genre
						FROM `filmgenre`
						GROUP BY FilmID) AS T2
			ON T1.filmID=T2.FilmID) AS T3
	INNER JOIN `showtime`
	ON T3.filmID = showtime.FilmID
	ORDER BY showtime.ShowTime;";
$query3 = mysqli_query($conn, $sql3);
$movie1 = "";
$promote = array();
$counter = 0;
$amountReallyAdded = 0; //check how many distinct title are showing for promote array
$maxSlide = 3; //set how many slide max
while($slider = mysqli_fetch_assoc($query3) AND $counter < $maxSlide){
	if(!in_array($slider['FilmName'], $promote) == true){
		$movie1 = $slider['FilmName'];
		array_push($promote, $movie1);
		$counter++;
		$amountReallyAdded++;
		//echo $movie1;
	}
}
$query1 = mysqli_query($conn, $sql1);
$query2 = mysqli_query($conn, $sql2);

?>
<!DOCTYPE html>
<html lang="en" style="background: rgba(184,227,255,0);">

<head>
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
    <link rel="stylesheet" href="css/style.css">

<!-- SEARCH BOX MODULE  (1/2)-->
<script src="js/searchbox.js"></script> 
<link rel="stylesheet" href="css/searchbox.css">
<!-- SEARCH BOX MODULE  (1/2) 50%complete -->
    <title>หน้าหลัก</title>



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
                  <li><a class="dropdown-item" href="Home.php?logout='1'">Logout</a></li>
                </ul>
              </li>
            </ul>
			
            <form class="d-flex" action="search.php" method="POST">
              <input class="form-control me-2" id="searchBox" name="searchBox" autocomplete="off" type="search" placeholder="ค้นหาภาพยตร์" aria-label="Search" required>
			  
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
			
          </div>
        </div>
      </nav>
<!-- SearchBox Module2/2 attach this below nav bar </nav> -->
	<div id="result">
				  
	</div>
<!-- SearchBox Module2/2 --100%complete!-->
<!-- Body -->

      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
		<div class="carousel-item active">
            <img src="img/slide1.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide2.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide3.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide4.jpeg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide5.jpeg" class="d-block w-100" alt="...">
          </div>
		  
		  
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div id = "myPadding" >
          
          <center><p class="fs-1">RECOMMEND MOVIES</p></center>


          <div class="container" style="margin-top: 15px;">
            <div class="row">
                <div class="col-md-6" style="width: 230px;">
                    <div class="user-grid" style="height: 300 px;width: 205px;background: #1945aa;border-radius: 10px;border: 1px solid #343a40;">
                 
                      
                      
<select name="FilmGenre" id="FilmGenre" class="form-control" style="width: 185px;height: 45px;margin-top: 10px;margin-bottom: 10px;margin-right: 0px;margin-left: 10px;color: #495057;font-family: Kanit, sans-serif;" onchange="showGenre()">
<option value="movies">เลือกประเภทหนัง</option>
<?php while($result = mysqli_fetch_assoc($query1)): ?>
<option value="<?=$result['FilmGenre']?>"><?=$result['FilmGenre']?></option>
<?php endwhile; ?> 
</select>
                      </div>
                </div>
                <div class="col-md-6" style="width: 910px;"> <!-- start--->
                    <div class="row row-cols-1 row-cols-md-3 g-4">
					
	<?php
			$currentMovie = 0;
            while ($row = mysqli_fetch_array($query2)) 
			{
				$sql4 = "SELECT COUNT(mID) AS count FROM review WHERE FilmID='".$row['filmID']."'";
				$countreview=mysqli_query($conn,$sql4);
				$countreview=mysqli_fetch_array($countreview);
					$row_class = preg_replace('/[,]+/', ' ', trim($row['Genre']));
					$Genre = preg_replace('/[,]+/', ', ', trim($row['Genre']));
					echo "<div class='col ".$row_class." movies' href='". $row['FilmName']."'>
                          <div class='card h-100'>";
					echo "<img src='img/movie_poster/".$row['FilmName'].".jpg' class='card-img-top' alt='...'>";
					echo "<div class='card-body'>";
					echo "<div>";
					echo "<h5 class='card-title'>".$row['FilmName']."</h5>";
					echo "<p class='card-text' style='font-size:14px; text-align:justify'>".$row['FilmDescription']."</p>";
					echo "<br></div>";
					echo "<ul class='list-group list-group-flush'>";
					echo "<li class='list-group-item' style='font-size:14px '><div>Genre : ".$Genre."</div></li>";
					echo "<li class='list-group-item' style='font-size:14px'>Rating     : ".$row['FilmRating']." (".$countreview['count']." reviews) </li>";
					echo "</ul>";
					echo "</div>";
					 
					echo "<div class='card-footer'>";
					echo "<small class='text-muted'>Copyright © All Right Reserved</small>
							  <a href='MovieDetail.php?movies=".$row['FilmName']."' class='stretched-link'></a>
                            </div>
                          </div>";
					echo "</div>";
					$currentMovie = $row['filmID'];
			}
    ?>
			
					
					
						
                      </div>



      </div>
	  <!--- JavaScript --->
		<script>
		function showGenre(){
			var x = document.getElementById('FilmGenre').value; //get value from selector
			var y = "." + x;
			var VisibleCardList = document.querySelectorAll(y);
			var InvisibleCardList = document.querySelectorAll('.movies');
			for(let n = 0; n < InvisibleCardList.length; n++){
				InvisibleCardList[n].style.display = "none";
			}
			for(let m = 0; m < VisibleCardList.length; m++){
				VisibleCardList[m].style.display = "block";
			}
		}
		
		</script>
      <!-- bootstrap src -->
	  	<script>
       
    </script>
	<!--- JavaScript for search --->
</div>			  
	  
	  
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>