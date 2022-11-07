<?php
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ข้อมูลผู้ใช้</title>
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <link rel="stylesheet" href="bootstrap/css/profile_bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
    <link rel="stylesheet" href="css/user-img.css">
</head>

<body style="font-family: Kanit, sans-serif;background: rgb(245,245,245);">
    <?php if (isset($_SESSION['ID'])):?>
    <?php
      include("server.php");
      $ID=$_SESSION['ID'];
      $query="SELECT * FROM user_account WHERE ID='$ID'";
      $result=mysqli_query($conn,$query);
      $data=mysqli_fetch_assoc($result);
      $query="SELECT * FROM p_district WHERE District='$data[District]'";
      $result=mysqli_query($conn,$query);
      $address=mysqli_fetch_assoc($result);
      $query="SELECT * FROM p_tel WHERE ID=$data[ID]";
      $result=mysqli_query($conn,$query);
      $numphone=mysqli_fetch_assoc($result);
      $query="SELECT MemberType FROM member WHERE mID = '$data[ID]'";
      $work=mysqli_query($conn,$query);
      $work=mysqli_fetch_assoc($work);
      
    ?>  
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
                  <li><a class="dropdown-item" href="Profile.php?logout='1'">ออกจากระบบ</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container" style="margin-top: 15px;">
        <div class="row">
            <div class="col-md-6" style="width: 300px;">
                <!-- <div class="user-grid" style="height: 400px;width: 350px;background: #ffffff;border-radius: 10px;border: 1px ;"><img class="user-image" src="img/blank-profile-picture-973460_1280-1.png" style="width: 300px;margin-top: 20px;">
                    <h2 class="text-center" style="margin-top: 8px;"><?php echo($data['FirstName']);?>&nbsp;<?php echo($data['LastName']);?><br></h2>
                </div> -->
            </div>
            
            <div class="col-md-6" style="width: 765px;">
              
                <div class="user-grid" style="height: 535px;width: 740px;background: #ffffff;border-radius: 10px;border: 5px ">
                  <div class="profile-header" style="height: 40px;margin: 20px;"></div>  
                  <div class="profile-header" style="height: 40px;margin: 20px;">
                        <h3>ข้อมูลผู้ใช้</h3><button class="btn btn-primary edit-profile-button" type="button" style="margin-top: -70px;margin-left: 555px;width: 140.3906px;" onclick="window.location.href='Edit.php'"><i class="fas fa-user-edit" style="margin-right: 5px;"></i>แก้ไขข้อมูลผู้ใช้</button>
                        <hr style="height: 3px;margin-top: -30px;width: 210px;background: #495057;">
                    </div>
                    <div style="height: 340px;margin: 20px;">
                        <div style="height: 30px;">
                            <h5 style="width: 330px;"><i class="far fa-list-alt" style="margin-right: 5px;"></i>อีเมลล์</h5>
                            <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;"><?php echo($data['Email']);?></p>
                            <hr style="margin-top: 5px;background: #495057;height: 2px;">
                        </div>
                        <div style="height: 30px;margin-top: 15px;">
                            <h5 style="width: 330px;"><i class="far fa-id-card" style="margin-right: 5px;"></i>รหัสบัตรประชาชน<br></h5>
                            <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;"><?php echo($data['ID'])?><br></p>
                            <hr style="margin-top: 5px;background: #495057;height: 2px;">
                        </div>
                        <div style="height: 30px;margin-top: 15px;">
                            <h5 style="width: 330px;"><i class="fas fa-user" style="margin-right: 5px;"></i>ชื่อ นามสกุล</h5>
                            <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;"><?php echo($data['FirstName'])?>&nbsp;<?php echo($data['LastName'])?><br></p>
                            <hr style="margin-top: 5px;background: #495057;height: 2px;">
                        </div>
                        <div style="height: 30px;margin-top: 15px;">
                            <h5 style="width: 330px;"><i class="fas fa-transgender-alt" style="margin-right: 5px;"></i>เพศ</h5>
                            <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;">
                            <?php
                      if ($data['Gender']=='M') echo("ชาย");
                      else if ($data['Gender']=='F') echo("หญิง");
                      else if ($data['Gender']=='L') echo("LGBTQ");
                      else if ($data['Gender']=='N') echo("ไม่ระบุ");
                            ?></p>
                            <hr style="margin-top: 5px;background: #495057;height: 2px;">
                        </div>
                        <div style="height: 30px;margin-top: 15px;">
                            <h5 style="width: 330px;"><i class="far fa-address-book" style="margin-right: 5px;"></i>ที่อยู่</h5>
                            <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;height: 55px;">
                            <?php 
                                  if($data['HouseNo']!="")echo("เลขที่".$data['HouseNo']." ");
                                  if ($data['MO']!="")echo("หมู่ที่".$data['MO']." "); echo("ต.".$data['District']);
                            
                            ?><br>
                            <?php
                                  echo("อ.".$address['Amphurs']." จังหวัด".$address['Province']." ".$address['Zipcode']);
                            ?>
                            <br></p>
                            <br><hr style="margin-top: 5px;background: #495057;height: 2px;">
                            <div style="height: 30px;margin-top: 15px;">
                                <h5 style="width: 330px;"><i class="fas fa-phone-alt" style="margin-right: 5px;"></i>เบอร์โทรศัพท์</h5>
                                <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;"><?php echo($numphone['Tel'])?></p>
                                <hr style="margin-top: 5px;background: #495057;height: 2px;">
                            </div>
                            <div style="height: 30px;margin-top: 15px;">
                                <h5 style="width: 330px;"><i class="fas fa-business-time" style="margin-right: 5px;"></i>ประเภทสมาชิก<br></h5>
                                <p style="color: #495057;margin-bottom: 0px;width: 358px;margin-left: 340px;margin-top: -35px;font-size: 18px;">
                                <?php
                                  if ($work['MemberType']=='K')echo("เด็กเล็ก");
                                  else if ($work['MemberType']=='N')echo("ทั่วไป");
                                  else if ($work['MemberType']=='S')echo("นักเรียน");
                                  else if ($work['MemberType']=='O')echo("ผู้สูงอายุ");
                                ?></p>
                                <hr style="margin-top: 5px;background: #495057;height: 2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/profile_bootstrap.min.js"></script>
    <?php endif?>
</body>

</html>