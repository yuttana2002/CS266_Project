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


$search = $_POST["searchBox"];
$sql = "SELECT * FROM film WHERE FilmName LIKE '$search%'";
$res = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM film WHERE FilmName LIKE '$search%'";
$review = "SELECT DISTINCT T1.filmID, T1.FilmName, T1.FilmDescription, T1.FilmRating, T1.mID, T1.rating, T1.comment, T2.FirstName, T2.LastName
		FROM (SELECT film.filmID, film.FilmName, film.FilmDescription, film.FilmRating, review.mID, review.rating, review.comment
				FROM film
				INNER JOIN review
				ON film.filmID=review.FilmID) AS T1
		INNER JOIN (SELECT `user_account`.`ID`,`user_account`.`FirstName`,`user_account`.`LastName` FROM `user_account`) AS T2
		ON T1.mID=T2.ID AND T1.FilmName LIKE '$search%'";
		
$sql3 = "SELECT * FROM (SELECT DISTINCT film.filmID, film.FilmName, film.FilmDescription, film.FilmRating, filmgenre.FilmGenre
				FROM film
				INNER JOIN FilmGenre
					ON film.filmID=FilmGenre.FilmID)AS T1 WHERE T1.FilmName LIKE '$search%'";
$FilmID = mysqli_query($conn, $sql2);
$FilmID = mysqli_fetch_array($FilmID);
$FilmID = $FilmID['FilmID'];
$sql4 = "SELECT COUNT(mID) AS count FROM review WHERE FilmID='$FilmID'";
$countreview=mysqli_query($conn,$sql4);
$countreview=mysqli_fetch_array($countreview);						
					
$quereview = mysqli_query($conn, $review);
$query2 = mysqli_query($conn, $sql);
$query3 = mysqli_query($conn, $sql3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>รายละเอียดภาพยนตร์</title>
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <link rel="stylesheet" href="css/style.css">
	<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    #ButtonGenre{
        cursor: context-menu;
    }
</style>
<style>
.badge {
        font-size: 25px;
        font-weight: 200
    }
    
    .badge i {
        font-size: 20px;
        font-weight: 200
    }
    
    .about-rating {
        font-size: 15px;
        font-weight: 500;
        margin-top: 5px
    }

.total-ratings {
    font-size: 12px
}

.bg-custom {
    background-color: #b7dd29 !important
}

.text-custom {
    color: #b7dd29 !important
}

.progress {
    margin-top: 2px;
    border-radius: 0px;
    padding-left: 0px
}

.star-light
{
	color:#e9ecef;
}

.rating-color {
    color: #fbc634 !important
}

.review-count {
    font-weight: 400;
    margin-bottom: 2px;
    font-size: 24px !important
}
</style>

<!-- SEARCH BOX MODULE  (1/2)-->
<script src="js/searchbox.js"></script> 
<link rel="stylesheet" href="css/searchbox.css">
<!-- SEARCH BOX MODULE  (1/2) 50%complete -->
</head>

<body style="font-family: Kanit, sans-serif;background: rgb(245,245,245);">
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
                  <li><a class="dropdown-item" href="Search.php?logout='1'">Logout</a></li>
                </ul>
              </li>
            </ul>
<!--- replace old search box XD 75%-->
            <form class="d-flex" action="search.php" method="POST">
              <input class="form-control me-2" id="searchBox" name="searchBox" autocomplete="off" type="search" placeholder="ค้นหาภาพยตร์" aria-label="Search" required>
			  
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
<!--- replace old search box XD 75%-->
          </div>
        </div>
      </nav>
<!-- put under </nav>
 SearchBox Module2/2 attach this below nav bar uwu</nav> -->

	<div id="result">
				  
	</div>

<!-- SearchBox Module2/2 --100%complete!-->
      <div id = "myPadding"><div class="container">

        <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-9 col-lg-12 col-xl-10">
                  <div class="card shadow-lg o-hidden border-0 my-5">
                      <div class="card-body p-0">
                          <div class="row">
                              <div class="col-lg-6 d-none d-lg-flex" style="width: 450px;">
                                 <?php
							  echo "<div><img width='600px' height='600px' src='img/movie_poster/".$search.".jpg' style='width: 450px;height: 700px;'></div>";
                              ?>
                              </div>
                              <div class="col-lg-6">
                                  <div class="p-5">
                                      <div class="text-center">
									  <?php
										echo "<h4 class='text-dark mb-4' id='MovieTitle' style='font-size: 30px;font-weight: bold;text-align: left;'>".$search."</h4>";
									  ?>
                                          
										
									  </div>
                                      <p class="lead fs-6"></p>
								<?php while($GenreResult = mysqli_fetch_assoc($query3)): ?>
                                          <button class="btn btn-primary shadow float-start" id="ButtonGenre" style="margin-left: 10px;font-family: Kanit, sans-serif;width: 110px;"><?=$GenreResult['FilmGenre']?><br></button>
								<?php endwhile; ?> 
                                          <br><br><br>
									<?php
									while ($row = mysqli_fetch_array($query2)) 
			{	  
										echo "<p class='lead fs-6' id='FilmDetail' style='color: rgb(30,31,31);font-family: Kanit, sans-serif;text-align: justify;'>".$row['FilmDescription']."<br><br></p>";
										 echo "<p class='fw-bold float-start mb-0' id='RatingLabel' style='width: 97px;color: rgb(20,0,255);font-family: Kanit, sans-serif;margin-top:-30px;'>Duration</p>";
										echo "<p class='text-muted float-start mb-0' id='RatingScore' style='margin-top:-30px;margin-left: 80px;'>".$row['FilmDuration']."</p><br>";
            }                           ?>  <?php
$Title = $search;
$reSql = "SELECT DISTINCT * FROM `review`";
$filmSql = "SELECT * FROM film WHERE FilmName LIKE '$Title'";
$filmData=mysqli_query($conn,$filmSql);
$filmData=mysqli_fetch_array($filmData);
$ReviewQ = mysqli_query($conn, $reSql);
$rating5sql = "SELECT COUNT(mID) AS count FROM review WHERE rating=5 AND FilmID = ".$FilmID."";
$count5=mysqli_query($conn,$rating5sql);
$count5=mysqli_fetch_array($count5);


$rating4sql = "SELECT COUNT(mID) AS count FROM review WHERE rating=4 AND FilmID = ".$FilmID." ";
$count4=mysqli_query($conn,$rating4sql);
$count4=mysqli_fetch_array($count4);

$rating3sql = "SELECT COUNT(mID) AS count FROM review WHERE rating=3 AND FilmID = ".$FilmID."";
$count3=mysqli_query($conn,$rating3sql);
$count3=mysqli_fetch_array($count3);

$rating2sql = "SELECT COUNT(mID) AS count FROM review WHERE rating=2 AND FilmID = ".$FilmID."";
$count2=mysqli_query($conn,$rating2sql);
$count2=mysqli_fetch_array($count2);

$rating1sql = "SELECT COUNT(mID) AS count FROM review WHERE rating=1 AND FilmID = ".$FilmID."";
$count1=mysqli_query($conn,$rating1sql);
$count1=mysqli_fetch_array($count1);
if($countreview['count'] > 0){
	$count5=$count5['count']/$countreview['count'] * 100;
	$count4=$count4['count']/$countreview['count'] * 100;
	$count3=$count3['count']/$countreview['count'] * 100;
	$count2=$count2['count']/$countreview['count'] * 100;
	$count1=$count1['count']/$countreview['count'] * 100;
}else{
	$count5['count'] = 0;
	$count4['count'] = 0;
	$count3['count'] = 0;
	$count2['count'] = 0;
	$count1['count'] = 0;
	$count5=$count5['count'];
	$count4=$count4['count'];
	$count3=$count3['count'];
	$count2=$count2['count'];
	$count1=$count1['count'];
}
$statusCol = 'secondary';
$statText = 'NO REVIEW';
if($filmData['FilmRating'] == 5 ){
	$statusCol = 'success';
	$statText = 'MASTERPIECE';
}else if($filmData['FilmRating'] >= 4){
	$statusCol = 'info';
	$statText = 'Excellent';
}else if($filmData['FilmRating'] >= 3){
	$statusCol = 'info';
	$statText = 'GOOD';
}else if($filmData['FilmRating'] >= 2){
	$statusCol = 'warning';
	$statText = 'NORMAL';
}else if($filmData['FilmRating'] >= 1){
	$statusCol = 'danger';
	$statText = 'DEFICIENT';
}

										echo '<div class="card">';
										echo '<div class="row no-gutters">';
										echo '<div class="col-md-4 border-right" style="margin-top: -40px; height: 60px;">';
										echo '<div class="ratings text-center p-4 py-5"> <span class="badge bg-'.$statusCol.'">'.round($filmData['FilmRating'],2).' <i class="fa fa-star-o"></i></span> <span class="d-block about-rating"><div>'.$statText.'</div></span> <span class="d-block total-ratings">'.$countreview['count'].' ratings</span> </div>';
										echo '</div>';
										echo '<div class="col-md-8" style="margin-top: -20px;">';
										echo '<div class="rating-progress-bars p-3 mt-2">';
										echo '<div class="d-flex align-items-center"> <span class="stars"> <span>5 <i class="fa fa-star text-success"></i></span> </span>';
										echo '<div class="col px-2">';
										echo '<div class="progress" style="height: 5px;">';
										echo '<div class="progress-bar bg-success" role="progressbar" style="width: '.$count5.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
										echo '</div>';
										echo '</div> <span class="percent"> <span>'.round($count5).'%</span> </span>';
										echo '</div>';
										echo '<div class="d-flex align-items-center"> <span class="stars"> <span> 4 <i class="fa fa-star text-custom"></i></span> </span>';
										echo '<div class="col px-2">';
										echo '<div class="progress" style="height: 5px;">';
										echo '<div class="progress-bar bg-custom" role="progressbar" style="width: '.$count4.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
										echo '</div>';
										echo '</div> <span class="percent"> <span>'.round($count4).'%</span> </span>';
										echo '</div>';
										echo '<div class="d-flex align-items-center"> <span class="stars"> <span>3 <i class="fa fa-star text-primary"></i></span> </span>';
										echo '<div class="col px-2">';
										echo '<div class="progress" style="height: 5px;">';
										echo '<div class="progress-bar bg-primary" role="progressbar" style="width: '.$count3.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
										echo '</div>';
										echo '</div> <span class="percent"> <span>'.round($count3).'%</span> </span>';
										echo '</div>';
										echo '<div class="d-flex align-items-center"> <span class="stars"> <span>2 <i class="fa fa-star text-warning"></i></span> </span>';
										echo '<div class="col px-2">';
										echo '<div class="progress" style="height: 5px;">';
										echo '<div class="progress-bar bg-warning" role="progressbar" style="width: '.$count2.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
										echo '</div>';
										echo '</div> <span class="percent"> <span>'.round($count2).'%</span> </span>';
										echo '</div>';
										echo '<div class="d-flex align-items-center"> <span class="stars"> <span>1 <i class="fa fa-star text-danger"></i></span> </span>';
										echo '<div class="col px-2">';
										echo '<div class="progress" style="height: 5px;">';
										echo '<div class="progress-bar bg-danger" role="progressbar" style="width: '.$count1.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
										echo '</div>';
										echo '</div> <span class="percent"> <span>'.round($count1).'%</span> </span>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div><br>';
?> 
                                  <center><button class='btn btn-primary shadow float-start' style='margin-top: 20px; font-family: Kanit, sans-serif;width: 140px;' onclick='gotoBook()'>ซื้อตั๋วหนัง (Ticket)</button></center></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  <div class="container py-4 py-xl-5">
      <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="color: #f5f5f5;">
	  <?php while($Review = mysqli_fetch_assoc($quereview)): ?>
          <div class="col">
              <div class="card">
                  <div class="card-body p-4" style="font-family: Kanit, sans-serif;box-shadow: inset 0px 0px #070707;">
                      <p class="text-primary card-text mb-0" id="ReviewUserName1" style="box-shadow: inset 0px 0px #070707;"><?=$Review['FirstName']?> <?=$Review['LastName']?></p>
                      <p class="fw-bold float-start mb-0" style="width: 50px;color: rgb(31,31,31);box-shadow: inset 0px 0px #070707;">Rating</p>
                      <p class="text-muted float-start card-text mb-0" style="box-shadow: inset 0px 0px #070707;">&nbsp; <?=$Review['rating']?></p><textarea id="ReviewTextDis1" readonly="" style="min-width: 100%;height: 154px;font-family: Kanit, sans-serif;box-shadow: inset 0px 0px #070707;" placeholder="<?=$Review['comment']?>"></textarea>
                      <div class="d-flex" style="box-shadow: inset 0px 0px #070707;">
                          <div style="box-shadow: inset 0px 0px #070707;"></div>
                      </div>
                  </div>
              </div>
          </div>
		  <?php endwhile; ?> 
		  
      </div>

    </div>

		<script>
		function gotoBook(){
			window.location.href='SearchMovie.php?';
		}
		</script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>