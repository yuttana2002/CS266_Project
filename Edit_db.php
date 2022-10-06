<?php
    include("server.php");
    session_start();

    $error=array();
    if (isset($_POST['edit_user']))
    {
        $firstname=$_POST['FirstName'];
        $lastname=$_POST['LastName'];
        $email=$_POST['Email'];
        $password1=$_POST['pswd'];
        $password2=$_POST['pswd_confirm'];
        $gender=$_POST['Gender'];
        $birth_date=$_POST['birthDay'];
        $houseno=$_POST['HouseNo'];
        $moo=$_POST['Moo'];
        $district=$_POST['district'];
        $tel=$_POST['PhoneNum'];
        list($year, $m, $d) = explode("-", $birth_date);
        $cyear = date("Y");
        if($cyear - $year >= 60 ){
            $MemberType = 'O';
        }else if ($cyear - $year >= 23){
            $MemberType = 'N';
        }
        else if ($cyear - $year >= 5){
            $MemberType = 'S';
        }else{
            $MemberType = 'K';
        }

      
        if(empty($firstname))
        {
            array_push($error,"You need to fill First Name");

        }
        if(empty($lastname))
        {
            array_push($error,"You need to fill Last Name");

        }
        if(empty($email))
        {
            array_push($error,"You need to fill Email");

        }
        if(empty($password1))
        {
            array_push($error,"You need to fill new password");

        }
        if(empty($password2))
        {
            array_push($error,"You need to confirm password");

        }
        if(empty($district))
        {
            array_push($error,"You need to choose Address");

        }
        if(empty($tel))
        {
            array_push($error,"You need to enter phone number");

        }

        if ($password1!=$password2)
        {
            array_push($error,"Password not match");
        }

        if (count($error)==0)
        {
            $password1=md5($password1);
            $query="UPDATE user_account SET FirstName='$firstname',LastName='$lastname',Email='$email',Password='$password1',Gender='$gender',BirthDay='$birth_date',
            HouseNo='$houseno',MO='$moo',District='$district' WHERE ID='$_SESSION[ID]'";
            mysqli_query($conn,$query);
            $query="UPDATE member SET MemberType='$MemberType' WHERE mID='$_SESSION[ID]' ";
            mysqli_query($conn,$query);
            $query="UPDATE p_tel SET Tel='$tel' WHERE ID='$_SESSION[ID]' ";
            mysqli_query($conn,$query);
            $_SESSION['Email']=$email;
            header("location:Profile.php");
        }
        else
        {
            $_SESSION['error']=$error[0];
            header("location:Edit.php");
        }

    }
  



?>