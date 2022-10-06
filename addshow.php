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


    if (!isset($_SESSION['EMP'])) {
      $_SESSION['error'] = "Permission Error";
      header('Location: '.$_SERVER['PHP_SELF']);
      die;
  }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['Email']);
        unset($_SESSION['ID']);
        header('location: login.php');
    }


    $sql = "SELECT * FROM Film";
$query = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM Theatre";
    $query1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en" style="background: rgba(184,227,255,0);">

<head>
    <!-- Required meta tags -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <title>Add Movie</title>



<script>
      
  window.addEventListener('load', loadmovielist);

  function  loadmovielist() {
  var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint1").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","get_movie.php?",true);
      xmlhttp.send();

  }


  function delete_movie(str){
      const array = str.split("/");
    if (str.length == 0) { 
      alert("error");
        return;
      } else {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
        loadmovielist();
        }
      xmlhttp.open("GET","delete_movie.php?filmID="+array[0], true);
      xmlhttp.send();
      }
  
  }

    </script>

</head>


<body style="background-color: #f5f5f5;">

<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark"  style="background-color: #004aad;">
        <div class="container-fluid">
            
                <a class="navbar-brand" href="addshow.php">
                    <img class="rounded" src="img/TUTheareLogo.png" alt="" width="70" height="70">
                    TU Theatre
                  </a>
            
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <a class="nav-link" href="Home.php?logout='1'">Logout</a>
              </li>
            </ul>
         
          </div>
        </div>
      </nav>

      <!-- Body -->
    <div style="padding: 115px;">
    <center><h1>เพิ่ม-ลบ ภาพยนตร์และรอบฉาย</h1></center>
    <br><br>
    <!-- notification message-->
    <?php if (isset($_SESSION['addshow_success'])) : ?>
                    <div class="success">
                        <h3>
                            <?php 
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            ?>
                        </h3>
                    </div>
    <?php endif ?>


<form action="addshow_db.php" method="post" >

<?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <h3>
                            <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>
                        </h3>
                    </div>
        <?php endif ?>


<div class="row">
  <div class="col">

    <label for="FilmName">Movies</label>
    <select name="FilmName" id="FilmName" class="form-select" onchange="show_showtime1()">
    <option value="">Movies Select</option>
    <?php while($result = mysqli_fetch_assoc($query)): ?>
    <option value="<?=$result['FilmID']?>"><?=$result['FilmName']?></option>
    <?php endwhile; ?>
    </select>

  </div>

  <div class="col">
    <label for="TheatreName">Theatres</label>
    <select name="TheatreName" id="TheatreName" class="form-select" onchange="show_showtime1()">
    <option value="">Theatre Select</option>
    <?php while($result = mysqli_fetch_assoc($query1)): ?>
    <option value="<?=$result['TheatreID']?>"><?=$result['TheatreName']?></option>
    <?php endwhile; ?>
    </select>   
  </div> 
</div> 
  


<div class="container-fluid">
<br>
        <div class="card" id="TableSorterCard">

            <h6 class="card-header">ข้อมูลรอบฉาย</h6>

                    <div class="card-body" >

                    <div id="txtHint"><small class="text-muted">โปรดเลือด movies และ theatres ก่อน</small></div>
                    </div>

        </div>

</div>



<br><div class="d-grid gap-2 d-md-flex justify-content-md-end"><button type="button" class="btn btn-outline-primary" onclick="show_addshow()">Add Show Time</button></div>

<div class="row" id="form_addshow">
      <div class="col">
        <label class="form-label">ShowTime</label>
        <input class="form-control" type="datetime-local" name="ShowTime" required="" >
      </div>
      <div class="col">
        <label class="form-label" >Price</label>
        <input class="form-control" type="number" name="Price" placeholder="ราคา" required="">
      </div>

   
      <div class="form-group text-center"> <br><input type="submit" class="btn btn-secondary btn-sm" name="add_show" type="submit" data-toggle="submit" value='ยืนยัน (Confirm)'></div>
      </div>
</form>



<br>
<div class="card">
  <div class="card-header">
    ข้อมูลภาพยนตร์ทั้งหมด
  </div>
  <div class="card-body">
  <div id="txtHint1"><small class="text-muted">ERROR GET MOVIE LIST</small></div>
 

  </div>
</div>

<br><div class="d-grid gap-2 d-md-flex justify-content-md-end"><button type="button" class="btn btn-outline-primary" onclick="show_addmovie()">Add Movies</button></div>
<form  class="text-dark bounce animated" action="addmovie_db.php" method="post" id="form_addmovie">
  <div class="row g-2" id="form_addshow">
        <div class="col-md-6">
            <div class="form-group"><label>Name</label><input class="form-control" type="text" name="FilmName" placeholder="ชื่อภาพยนตร์" required="" ></div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group"><label>Time</label><input class="form-control" type="time" name="FilmDuration"  required="" ></div>
        </div>
            <div class="form-group"><label>Description</label><textarea class="form-control" type="text" name="FilmDescription" placeholder="รายละเอียดของภาพยนตร์" required="" ></textarea></div>
            <div class="form-group"><label>Genre</label>
        <div class="row g-2">
           <div class="col-md-4">
           <select name='genre1' id='genre1' class="form-select" aria-label="Default select example">
              <option value="" selected>เลือกประเภทหนัง</option>
              <option value="Action">Action</option>
              <option value="Comedy">Comedy</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Horror">Horror</option>
              <option value="Mystery">Mystery</option>
              <option value="Romance">Romance</option>
              <option value="Thriller">Thriller</option>
            </select>
           </div>
           <div class="col-md-4">
           <select name='genre2' id='genre2' class="form-select" aria-label="Default select example">
           <option value="" selected>เลือกประเภทหนัง</option>
              <option value="Action">Action</option>
              <option value="Comedy">Comedy</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Horror">Horror</option>
              <option value="Mystery">Mystery</option>
              <option value="Romance">Romance</option>
              <option value="Thriller">Thriller</option>
            </select>
            </div>
           <div class="col-md-4">
           <select name='genre3' id='genre3' class="form-select" aria-label="Default select example">
              <option value="" selected>เลือกประเภทหนัง</option>
              <option value="Action">Action</option>
              <option value="Comedy">Comedy</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Horror">Horror</option>
              <option value="Mystery">Mystery</option>
              <option value="Romance">Romance</option>
              <option value="Thriller">Thriller</option>
            </select>
           </div>
        </div>
        </div>
    </div> <br>
            <div class="form-group text-center"><input type="submit" class="btn btn-secondary btn-sm" name="addmov" type="submit" data-toggle="submit" value='ยืนยัน (Confirm)'></div>
        </form>

    </div>
       <!-- end body -->

      <!-- bootstrap src -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
       <script src="backend/script-addshow.js"></script> 
</body>

</html>