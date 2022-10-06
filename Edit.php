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

  $uid = $_SESSION['ID'];
  $sql = "SELECT * FROM user_account WHERE ID = '$uid' ";
  $query = mysqli_query($conn, $sql);
  $row = $query -> fetch_array(MYSQLI_ASSOC);
 
  $sql1 = "SELECT Tel FROM p_tel WHERE ID = '$uid' ";
  $query1 = mysqli_query($conn, $sql1);
  $row1 = $query1 -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" >
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link rel="icon" href="img/ico.ico" type="image/ico">
	<!---- style sheet --->
  <link rel="stylesheet" href="bootstrap/css/reg_bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit&amp;display=swap">
  <link rel="stylesheet" href="css/reg_Contact-Form-Clean.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
 
<!-------ajax and jquery-------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="bootstrap/js/reg_bootstrap.min.js"></script>
  <script src="js/reg_bs-init.js"></script>
  <script src="js/reg_PassRequirements.js"></script>
<!------------------------------>
    <link rel="stylesheet" href="css/style.css">

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
              <li><a class="dropdown-item" href="Profile.php?logout='1'">Logout</a></li>
            </ul>
          </li>
        </ul>
     
      </div>
    </div>
  </nav>

<div>

      <div>
            <div class="d-flex align-items-center align-content-center contact-clean" style="color: var(--gray-dark);background: #f5f5f5;">
            <form class="text-dark bounce animated" data-bss-recipient="12223ac6677c1d072c3a5614f27bf1e1" action="Edit_db.php" method="post">
                  <h2 class="text-center bounce animated" style="font-family: Kanit, sans-serif;">แก้ไขข้อมูลส่วนตัว</h2>
            
          <!--PHP: notification message-->
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

            <div class="form-group"><label style="font-family: Kanit, sans-serif;">ชื่อจริง นามสกุลจริง&nbsp; (First Name/ Last Name)</label>
               
              <!----- 
              input group 
              input : name + surname textbox
             ------>
             <div class="input-group input-group-sm">
               <input class="form-control" type="text" data-toggle="tooltip" data-bss-tooltip="" data-placement="left" placeholder="Pomponette" id="e_fname" name="FirstName" required="" style="font-size: 16px;font-family: Kanit, sans-serif;width: 130px;" maxlength="50" minlength="1" title="กรอกชื่อต้นเป็นภาษาอังกฤษ เช่น Pomponette, Samuel, Songsakdi">
               <input class="form-control" type="text" data-toggle="tooltip" data-bss-tooltip="" data-placement="right" placeholder="Davidovich" id="e_lname" name="LastName" required="" style="font-size: 16px;font-family: Kanit, sans-serif;width: 130px;" maxlength="50" minlength="1" title="กรอกนามสกุลเป็นภาษาอังกฤษ เช่น Davidovich, ChanoCha, Naruebeth เป็นต้น">
                     </div>
             
                 </div>
           
                 <div class="form-group" style="font-family: Kanit, sans-serif;">
           <label>อีเมลล์ (Email)</label>
           <input class="form-control" type="email" id="e_email" name="Email" placeholder="example@provider.com" required="" maxlength="100" minlength="7">
           </div>
           <!--Password-->
                 <div class="form-group" style="font-family: Kanit, sans-serif;">
           <label>รหัสผ่าน (Password)</label>
                 
           <input class="form-control" type="password" style="font-family: Kanit, sans-serif;" data-bss-tooltip="" data-placement="right" placeholder="กรอกรหัสผ่านที่ต้องการ" name="pswd" required="" minlength="8" maxlength="50" title="ควรตั้งรหัสผ่านให้รัดกุมเพื่อความปลอดภัยโดยมีอักษรพิมพ์ใหญ่ ตัวเลข และสัญลักษณ์เช่น #_$@">
                 <div class="form-group" style="font-family: Kanit, sans-serif;"></div>
                 <label>ยืนยันรหัสผ่าน (Password Confirm)</label>
                 <input class="form-control" type="password" placeholder="ยืนยันรหัสผ่านของท่านอีกครั้ง" name="pswd_confirm" required="" minlength="8" maxlength="50" title="ควรตั้งรหัสผ่านให้รัดกุมเพื่อความปลอดภัยโดยมีอักษรพิมพ์ใหญ่ ตัวเลข และสัญลักษณ์เช่น #_$@" >
                 </div>
           <!--Gender select-->
           <div class="form-group" id="GenderGroup" style="font-family: Kanit, sans-serif;margin-bottom: 0px;margin-top: 11px;">	
           <label>เพศ (Gender)</label>
           <select class="custom-select" id="e_gender" name="Gender" required="" value="0">
                         <optgroup label="กรุณาระบุเพศของคุณ">
                             <option value="M">ชาย (Male)</option>
                             <option value="F">หญิง (Female)</option>
                             <option value="L">LGBTQ</option>
                             <option value="N">ไม่ระบุ</option>
                         </optgroup>
                     </select>
           </div>
           
           <!--Birth Date-->
                 <div class="form-group" id="BirthDateGroup" style="font-family: Kanit, sans-serif;">
           <label for="BirthDate" style="margin-top: 18px;">วัน/เดือน/ปีเกิด (Date of Birth)</label>
           <input class="form-control" type="date" id="HBD" name="birthDay" data-fate ="" style="color: var(--gray-dark);" required min="1945-12-19" max="2019-01-01" />
           </div>
           
           <!--Career (!!!)-->
                 <div class="form-group" id="career_group" style="font-family: Kanit, sans-serif;"><label>คุณกำลังประกอบอาชีพอะไร</label>
                     <select class="custom-select" name="career">
                         <optgroup label="กรุณาระบุอาชีพ">
                             <option value="N" selected="">-</option>
                             <option value="S">นักเรียน</option>
                             <option value="N">ทำงาน</option>
                             <option value="O">เกษียณ</option>
                         </optgroup>
                     </select>
           </div>
           
           <!--Address-->
                 <div class="form-group" style="font-family: Kanit, sans-serif;"><label>ที่อยู่ (Address)</label>
                     <div></div>
                     <div class="input-group">
                         <div class="input-group-prepend"></div>
                         <div class="input-group-append"></div><input class="form-control float-left flex-fill" type="text" placeholder="เลขที่บ้าน เช่น 66/666" id="ehno" name="HouseNo" maxlength="6" style="width: 108.5px;">
               <input class="form-control" type="number" placeholder="หมู่ที เช่น 3" id="emo" name="Moo" maxlength="3" style="width: 106.4625px;">
               <!--Province-->
               <select class="custom-select" name="province" id="province" style="width: 237.875px;">
                             <optgroup label="กรุณาเลือกจังหวัด"></optgroup>
                                 <option value="">เลือกจังหวัด</option>
                    <?php
                                             $sql = "SELECT DISTINCT province FROM p_district";
                                             $query = mysqli_query($conn, $sql);
                                             while($result = mysqli_fetch_assoc($query)):
                                             ?>
                                                 <option value="<?=$result['province']?>"><?=$result['province']?></option>
                                 <?php endwhile; ?> 
                         </select>
               
               <!--Amphur-->
               <select class="custom-select" name="amphurs" id="amphurs" style="width: 194.875px;">
                             <optgroup label="กรุณาเลือกอำเภอ">
                                 <option value="" selected="">เลือกอำเภอ</option>
                             </optgroup>
                         </select>
               
               <!--Tambon-->
               <select class="custom-select" name="district" id="district" style="width: 147.875px;">
                             <optgroup label="กรุณาเลือกตำบล">
                                 <option value="" selected="">เลือกตำบล</option>
                             </optgroup>
                         </select>
               
                     </div>
                 </div>
                 <div class="form-group"><label style="margin-top: 5px;font-family: Kanit, sans-serif;">เบอร์โทรศัพท์สำหรับติดต่อ (Phone Number)</label><input class="form-control" type="tel" placeholder="เบอร์โทรศัพท์ เช่น 0987654321" id="etel" name="PhoneNum" required="" maxlength="10" minlength="10" style="font-family: Kanit, sans-serif;" pattern="[0]{1}[0-9]{1}[0-9]{8}"></div>
                 <div class="form-group text-center">
                  <button class="btn btn-primary shadow" data-bss-hover-animate="pulse" type="button" onclick="history.back()" data-toggle="submit">ย้อนกลับ</button>
                   <button class="btn btn-primary shadow" data-bss-hover-animate="pulse" type="submit" data-toggle="submit" name="edit_user">ยืนยัน (Confirm)</button></div>
             </form>
         </div>

        </div>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="js/edit_script.js"></script>
        
   <script>

document.getElementById('e_email').value = '<?php echo $row['Email'];?>';
document.getElementById('e_fname').value = '<?php echo $row['FirstName'];?>';
document.getElementById('e_lname').value = '<?php echo $row['LastName'];?>';
document.getElementById('e_gender').value = '<?php echo $row['Gender'];?>';
document.getElementById('HBD').value = '<?php echo $row['BirthDay'];?>';
document.getElementById('etel').value = '<?php echo $row1['Tel'];?>';

   </script>
</body>

</html>