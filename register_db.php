<?php 
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['reg_user'])) {
        $ID = mysqli_real_escape_string($conn, $_POST['ID']);
        $FirstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
        $LastName = mysqli_real_escape_string($conn, $_POST['LastName']);
        $Tel = mysqli_real_escape_string($conn, $_POST['Tel']);
        $Email = mysqli_real_escape_string($conn, $_POST['Email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
        $BirthDay = mysqli_real_escape_string($conn, $_POST['BirthDay']);
        $Gender = mysqli_real_escape_string($conn, $_POST['Gender']);
        $HouseNo = mysqli_real_escape_string($conn, $_POST['HouseNo']);
        $Mo = mysqli_real_escape_string($conn, $_POST['Mo']);
        $District = mysqli_real_escape_string($conn, $_POST['district']);

        list($year, $m, $d) = explode("-", $BirthDay);
        $cyear = date("Y");
        if($cyear - $year >= 60 ){
            $MemberType = O;
        }else if ($cyear - $year >= 23){
            $MemberType = N;
        }
        else if ($cyear - $year >= 5){
            $MemberType = S;
        }else{
            $MemberType = K;
        }

        if ($password_1 != $password_2){
            array_push($errors, "The two passwords do not match");
        }

        $user_check_query = "SELECT * FROM User_Account WHERE  Email = '$Email' ";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){ // if user exists
            if ($result['email'] === $email){
                array_push($errors, "Email already exists");
            }

        }

        if (count($errors)==0){
            $password = md5($password_1);

            $sql =  "INSERT INTO User_Account (ID, Password, FirstName, LastName, BirthDay, Gender, Email, HouseNo, Mo, District) VALUES ('$ID', '$password', '$FirstName', '$LastName', '$BirthDay', '$Gender', '$Email', '$HouseNo', '$Mo','$District');
            INSERT INTO Member (mID, MemberType) VALUES ('$ID', '$MemberType');
            INSERT INTO P_Tel (`Tel`, `ID`) VALUES ('$Tel', '$ID');" ;
            // mysqli_query($conn,$sql);
            mysqli_multi_query($conn,$sql);
         

            $_SESSION['Email'] = $Email;
            $_SESSION['ID'] = $ID;
            $_SESSION['success'] = "You are now logged in";
            header('location: Home.php');
        } else {
            $_SESSION['error'] = $errors[0];
            header("location: register.php");
        }

    }

?>