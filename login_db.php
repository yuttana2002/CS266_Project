<?php 

    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['login_user'])) {
        $Email = mysqli_real_escape_string($conn, $_POST['Email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    }

    if(count($errors)==0){
        $password = md5($password);
        $query = "SELECT * FROM User_Account WHERE Email = '$Email' AND password = '$password' ";
        $result = mysqli_query($conn,$query);
   
         if (mysqli_num_rows($result)==1){
          //  $q = "SELECT ID FROM User_Account WHERE Email = '$Email' AND password = '$password' ";
           // $qq = mysqli_query($conn,$q);
            $row = $result->fetch_row();
            $ID = $row[0] ?? false;

            $e_query = "SELECT * FROM Employee WHERE 	eID  = '$ID' ";
            $e_result = mysqli_query($conn,$e_query);
            if (mysqli_num_rows($e_result)==1){
                $_SESSION['Email'] = $Email;
                $_SESSION['ID'] = $ID;
                $_SESSION['EMP'] = $ID;
                $_SESSION['success'] = 'login success';
                header('location: addshow.php');

            }else{
                $_SESSION['Email'] = $Email;
                $_SESSION['ID'] = $ID;
                $_SESSION['success'] = 'login success';
                header('location: Home.php');
            }
                }
         else{
            array_push($errors, "Wrong username/password combination");
            $_SESSION['error'] = "Wrong username/password try again!!";
            header('location: login.php');
        }
    }
?>