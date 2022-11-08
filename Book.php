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
    $counter = 0;

  
  $FilmID = $_GET['FilmID'];
  $FilmName = $_GET['FilmName'];
  $TheatreID = $_GET['TheatreID'];
  $showtime = $_GET['showtime'];
  $Price = $_GET['Price'];
  $RemainingSeat = $_GET['RemainingSeat'];
  $TheatreName = $_GET['TheatreName'];
  $ID = $_SESSION['ID'];
  
  $temp_sql = "SELECT `MemberType` FROM `member` WHERE `mID` = '$ID';";
  $temp_result = mysqli_query($conn, $temp_sql);
  $temp_result = mysqli_fetch_assoc($temp_result);
  if($temp_result['MemberType'] == 'K'){
    $Price = $Price-($Price*0.2);
  }else if($temp_result['MemberType'] == 'S'){
    $Price = $Price-($Price*0.3);
  }else if($temp_result['MemberType'] == 'O'){
    $Price = $Price-($Price*0.4);
  }


  $_SESSION['FilmID'] =  $FilmID;
  $_SESSION['TheatreID']= $TheatreID ;
  $_SESSION['ShowTime']= $showtime;
  $_SESSION['RemainingSeat']= $RemainingSeat;


 

  
  
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <title>จองภาพยนตร์</title>
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/Simple-Slider.css">
    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/review_Simple-Slider.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      window.addEventListener('load', showprice);

 
      var newURL = location.href.split("?")[0];
      window.history.pushState('object', document.title, newURL);

      
      var price = " <?php echo  $Price  ?> ";
  
      var remaingseat = " <?php echo  $RemainingSeat  ?> ";


      function showprice(){
      document.getElementById('showprice').innerHTML='Price: ' + price + ' บาท';

      }

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
                  <li><a class="dropdown-item" href="Book.php?logout='1'">ออกจากระบบ</a></li>
                </ul>
              </li>
            </ul>
            <!--- replace old search box -->
            <form class="d-flex" action="search.php" method="POST">
              <input class="form-control me-2" id="searchBox" name="searchBox" style='width: 476px;' autocomplete="off" type="search" placeholder="ค้นหาภาพยตร์" aria-label="Search" required>
              <button class="btn btn-outline-light" type="submit">ค้นหา</button>
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
      <form action="addTicketdb.php" method="post" id="form_addticket">
          <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex" style="width: 450px;">
                            <?php
                            echo "<img class='img-rounded' src='img/movie_poster/" . $FilmName . ".jpg' alt='404 Error' width='450' height='700'>"
                          ?> 
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                    <?php
                                    echo "<h1 style='font-family: Kanit, sans-serif; '>" . $FilmName . "</h1>";
                                 
                                    ?>
                                   
                                    <br><br>
                                    <?php
                                    echo "<h4 style='font-family: Kanit, sans-serif; '>Show Time: " . $showtime . "  Complex: " . $TheatreName . "   </h4>";
                                
            
                                   ?> <br>
                                   <h5 id="showprice" ></h5>
                                        <small style="color: rgb(30,31,31); font-size: 27px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 10px;">จำนวนตั๋วภาพยนตร์ </small>
                                        <br>    
                                        <input class="form-control" type="number" id="NumOfFlim" name = "NumOfFlim" value="1" min="1" max="<?php echo  $RemainingSeat  ?>" onchange="recal()"  style="height: 42px;width: 198px;margin: 0px;margin-bottom: 0px;margin-left: 120px;" >
                                       
                                        
                                        <small style="color: rgb(30,31,31); font-size: 27px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 70px;">ป๊อปคอร์น 120 บาท ต่อถัง </small>
                                        <small style="color: rgb(30,31,31); font-size: 14px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 10px;">(200 กรัม)</small>
                                        <input class="form-control" type="number" id="NumOfPop" name = "NumOfPop" value="0" min="0" max="5" onchange="recal()" style="height: 42px;width: 198px;margin: 0px;margin-bottom: 0px;margin-left: 120px;" >
                                        <small style="color: rgb(30,31,31); font-size: 27px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 70px;">เครื่องดื่ม 89 บาท ต่อแก้ว </small>
                                        <small style="color: rgb(30,31,31); font-size: 14px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 10px;">(32 ออนซ์) </small>
                                        <br>
                                        <input class="form-control" type="number" id="NumOfDrink" name = "NumOfDrink" value="0" min="0" max="5" onchange="recal()" style="height: 42px;width: 198px;margin: 0px;margin-bottom: 0px;margin-left: 120px;" >
                                        <p class="lead fs-4">
                                        <small style="color: red; font-size: 17px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 30px;">*เลือกรสชาติของป๊อปคอร์นและเครื่องดื่มที่เคาน์เตอร์ </small>
                                        <br> 
                                        <small style="color: red; font-size: 17px;font-family: Kanit, sans-serif;margin-left: 0px;margin-left: 30px;">*ส่วนลดของสมาชิกไม่รวมอยู่ในค่าป๊อปคอร์นและเครื่องดื่ม </small>
                                        <br><br> 
                                        <button class="btn btn-primary shadow " style="margin-left: 10px;font-family: Kanit, sans-serif;width: 140px;" ;>ยืนยัน</button>
                              
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
      </div> <!-- /container -->
    

    <script src="js\PlusMinusFlim.js"></script>
    <script src="bootstrap/js/book_bootstrap.min.js"></script>
    <script src="js/book_bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="js/book_Lightbox-Gallery.js"></script>
    <script src="js/book_Simple-Slider.js"></script>

   <script>
      function rem(){
        let cnt = document.getElementById('NumOfFlim').value;
       let pop =  document.getElementById('NumOfPop').value;
	    let drink =  document.getElementById('NumOfDrink').value;
		let film = document.getElementById('NumOfFlim').value;
	      let mai = Number(price)*Number(film) + Number(pop)*Number(120) + Number(drink)*Number(89);
	      
	 if(cnt<=1 ){
          document.getElementById('NumOfFlim').value = 1;
 	  document.getElementById('showprice').innerHTML='Price: ' + mai+ ' บาท';
        
        }else{
         cnt = Number(cnt)-1;
 	document.getElementById('NumOfFlim').value = Number(cnt);
          document.getElementById('showprice').innerHTML='Price: ' + mai+ ' บาท';     
        }
        
    }

    function add(){
		let pop =  document.getElementById('NumOfPop').value;
	    let drink =  document.getElementById('NumOfDrink').value;
      let cnt = document.getElementById('NumOfFlim').value;
	  let film = document.getElementById('NumOfFlim').value;
let mai = Number(price)*Number(film) + Number(pop)*Number(120) + Number(drink)*Number(89);

        
      if(cnt >= <?php echo  $RemainingSeat  ?>){
          
          if(cnt >= 20){
             document.getElementById('NumOfFlim').value = 20;
             document.getElementById('showprice').innerHTML='Price: ' + mai+ ' บาท';
          }
          else{
             document.getElementById('NumOfFlim').value = <?php echo  $RemainingSeat  ?>;
             document.getElementById('showprice').innerHTML='Price: ' + price*<?php echo  $RemainingSeat  ?>+ ' บาท' ;
          } 
	} 
 
      else{
 	if(cnt >= 20){
             document.getElementById('NumOfFlim').value = 20;
             document.getElementById('showprice').innerHTML='Price: ' + mai+ ' บาท'  ;

          }
 		else{cnt = Number(cnt)+1;
          	document.getElementById('NumOfFlim').value = Number(cnt);
         	 document.getElementById('showprice').innerHTML='Price: ' + mai + ' บาท' ;}
	
        }
      
      }


      function recal(){
		  let pop =  document.getElementById('NumOfPop').value;
	    let drink =  document.getElementById('NumOfDrink').value;
        let cnt1 = document.getElementById('NumOfFlim').value;
		let film = document.getElementById('NumOfFlim').value;
	      let mai = Number(price)*Number(film) + Number(pop)*Number(120) + Number(drink)*Number(89);
  	if(cnt1 >= 20){
             document.getElementById('NumOfFlim').value = 20;
            document.getElementById('showprice').innerHTML='Price: ' + mai + ' บาท' ;
          }
	else{ document.getElementById('showprice').innerHTML='Price: ' + mai + ' บาท';}
       
      }

    </script>
</body>

</html>
