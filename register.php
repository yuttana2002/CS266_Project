<?php
    session_start();
    include('server.php');
?>
<!DOCTYPE html>
<html style="background: #f5f5f5;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<!---- Registeration page --->
    <title>Registeration</title>
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
	
</head>

<body style="background: #b8e3ff;">
    <div class="d-flex align-items-center align-content-center contact-clean" style="color: var(--gray-dark);">
        <form class="text-dark bounce animated" action="register_db.php" method="post">
            <h2 class="text-center bounce animated" style="font-family: Kanit, sans-serif;">Registration</h2>

                    <!-- notification message-->
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
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend"></div><input class="form-control" type="text" data-toggle="tooltip" data-bss-tooltip="" data-placement="bottom" placeholder="Pomponette" name="FirstName" required="" style="font-size: 16px;font-family: Kanit, sans-serif;width: 130px;" maxlength="50" minlength="1" title="กรอกชื่อต้นเป็นภาษาอังกฤษ เช่น Pomponette, Samuel, Songsakdi"><input class="form-control" type="text" data-toggle="tooltip" data-bss-tooltip="" data-placement="right" placeholder="Davidovich" name="LastName" required="" style="font-size: 16px;font-family: Kanit, sans-serif;width: 130px;" maxlength="50" minlength="1" title="กรอกนามสกุลเป็นภาษาอังกฤษ เช่น Davidovich, ChanoCha, Naruebeth เป็นต้น">
                    <div class="input-group-append" style="font-size: 16px;font-family: Kanit, sans-serif;"></div>
                </div>
            </div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>รหัสบัตรประชาชน (ID)</label><input class="form-control" type="text" name="ID" placeholder="1139600108000" required="" maxlength="13" minlength="13"></div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>อีเมลล์ (Email)</label><input class="form-control" type="text" name="Email" placeholder="example@provider.com" required="" maxlength="100" minlength="7"></div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>รหัสผ่าน (Password)</label><input class="form-control" type="password" data-toggle="tooltip" data-bss-tooltip="" data-placement="right" placeholder="กรอกรหัสผ่านที่ต้องการ" name="password_1" required="" minlength="8" maxlength="50" title="ควรตั้งรหัสผ่านให้รัดกุมเพื่อความปลอดภัยโดยมีอักษรพิมพ์ใหญ่ ตัวเลข และสัญลักษณ์เช่น #_$@"></div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>ยืนยันรหัสผ่าน (Password)</label><input class="form-control" type="password" data-toggle="tooltip" data-bss-tooltip="" data-placement="right" placeholder="กรอกรหัสผ่านที่ต้องการ" name="password_2" required="" minlength="8" maxlength="50" title="ควรตั้งรหัสผ่านให้รัดกุมเพื่อความปลอดภัยโดยมีอักษรพิมพ์ใหญ่ ตัวเลข และสัญลักษณ์เช่น #_$@"></div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label for="BirthDay">วัน/เดือน/ปีเกิด (Date of Birth)</label><input class="form-control" type="date" style="color: var(--gray-dark);" name="BirthDay" required=""></div>

      

          
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>ที่อยู่ (Address)</label>
              <div></div><input class="form-control float-left flex-fill" type="text" placeholder="เลขที่บ้าน เช่น 66/666"  required="" style="height: 42px;width: 198px;margin: 0px;margin-bottom: 0px;margin-right: 2px;" name="HouseNo" maxlength="6"><input class="form-control" type="number" placeholder="หมู่ที เช่น 3"  style="height: 42px;width: 198px;margin: 0px;margin-bottom: 0px;margin-right: 2px;" name="Mo" maxlength="3">

            
            <br><div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="province">จังหวัด</label>
                        <select name="province" id="province" class="form-control">
                        <option value="">เลือกจังหวัด</option>
                                        <?php
                                        $sql = "SELECT DISTINCT province FROM p_district";
                                        $query = mysqli_query($conn, $sql);
                                        while($result = mysqli_fetch_assoc($query)):
                                        ?>
                                            <option value="<?=$result['province']?>"><?=$result['province']?></option>
                                        <?php endwhile; ?>
                                    </select>
                        </div>
                            <div class="form-group col-md-4">
                        <label for="amphurs">อำเภอ</label>
                        <select name="amphurs" id="amphurs" class="form-control">
                            <option value="">เลือกอำเภอ</option>

                        </select>
                            </div>
                            <div class="form-group col-md-4">
                        <label for="district">ตำบล</label>
                        <select name="district" id="district" class="form-control">
                                <option value="">เลือกตำบล</option>
                                        
                        </select>
                                    </div>

            </div></div>
            <div class="input-group input-group-sm">
                <div class="input-group-prepend"></div>
                <div class="input-group-append"></div>
            </div>
            <div class="form-group"><label style="margin-top: 5px;font-family: Kanit, sans-serif;">เบอร์โทรศัพท์สำหรับติดต่อ (Phone Number)</label><input class="form-control" type="text" placeholder="เบอร์โทรศัพท์ เช่น 0987654321" name="Tel" required="" maxlength="10" minlength="10" style="font-family: Kanit, sans-serif;" pattern="[0]{1}[0-9]{1}[0-9]{8}"></div>
            <div class="form-group" style="font-family: Kanit, sans-serif;"><label>เพศ (Gender)</label><select class="custom-select" name="Gender" required="" value="0">
                    <optgroup label="กรุณาระบุเพศของคุณ">
                        <option value="M">ชาย (Male)</option>
                        <option value="F">หญิง (Female)</option>
                        <option value="L">LGBTQ</option>
                        <option value="N">ไม่ระบุ</option>
                    </optgroup>
                </select></div>
            <div class="form-group text-center"><button class="btn btn-primary shadow" data-bss-hover-animate="pulse" name="reg_user" type="submit" data-toggle="submit" style="font-family: Kanit, sans-serif;">ยืนยัน (Confirm)</button></div>
        </form>
    </div>
	<script src="backend/script-register.js"></script>
</body>

</html>