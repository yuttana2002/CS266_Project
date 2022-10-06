<?php 

    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['add_show'])) {
        $FilmID = mysqli_real_escape_string($conn, $_POST['FilmName']);
        $TheatreID = mysqli_real_escape_string($conn, $_POST['TheatreName']);
        $ShowTime = mysqli_real_escape_string($conn, $_POST['ShowTime']);
        $Price = mysqli_real_escape_string($conn, $_POST['Price']);

      
    }

    if(count($errors)==0){
          
            $query3 = "SELECT * FROM show_in WHERE TheatreID = '$TheatreID' AND FilmID = '$FilmID' ";
            $result3 = mysqli_query($conn,$query3);
         
            $query4 ="SELECT TotalSeat FROM Theatre WHERE TheatreID = '$TheatreID'";
            $result4 = mysqli_query($conn,$query4);
            $seat = $result4->fetch_row();
            $seatresult = $seat[0] ?? false;

            echo $seatresult12;
 
            if (mysqli_num_rows($result3)==1){
                $sql1 =  "INSERT INTO ShowTime(TheatreID, FilmID, ShowTime, Price, RemainingSeat)
                VALUES ('$TheatreID', '$FilmID', '$ShowTime', '$Price', '$seatresult');" ;
                mysqli_query($conn,$sql1);

            }else{
                $sql0 =  "INSERT INTO show_in (TheatreID, FilmID) VALUES ('$TheatreID', '$FilmID');
                INSERT INTO ShowTime(TheatreID, FilmID, ShowTime, Price, RemainingSeat) VALUES ('$TheatreID', '$FilmID', '$ShowTime', '$Price', '$seatresult');"; 
               mysqli_multi_query($conn,$sql0);

            }
            header('location: addshow.php');

    }
         else{
            array_push($errors, "addshow error");
            $_SESSION['error'] = "addshow error!!";
            header('location: addshow.php');
        }
    
?>
