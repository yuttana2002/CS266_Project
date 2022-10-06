<?php 
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['addmov'])) {
        $FilmName = mysqli_real_escape_string($conn, $_POST['FilmName']);
        $FilmDescription = mysqli_real_escape_string($conn, $_POST['FilmDescription']);
        $FilmDuration = mysqli_real_escape_string($conn, $_POST['FilmDuration']);
        $FilmGenre1 = mysqli_real_escape_string($conn, $_POST['genre1']);
        $FilmGenre2 = mysqli_real_escape_string($conn, $_POST['genre2']);
        $FilmGenre3 = mysqli_real_escape_string($conn, $_POST['genre3']);

        $user_check_query = "SELECT * FROM Film WHERE  FilmName = '$FilmName'";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){ // if user exists
            if ($result['FilmName'] === $FilmName){
                array_push($errors, "Film already exists");
            }

        }

        if (count($errors)==0){
            $sql =  "INSERT INTO Film(FilmName,FilmDescription,FilmDuration,FilmRating) VALUES ('$FilmName','$FilmDescription','$FilmDuration','0.0');";

            if($FilmGenre1 != "" AND $FilmGenre2 != "" AND $FilmGenre3 != ""){
                $sql = $sql . "INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre1');
                INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre2');
                INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre3');
                ";
            }else if($FilmGenre1 != "" AND $FilmGenre2 != ""){
                $sql = $sql . "INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre1');
                INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre2');
                ";
            }else{ $FilmGenre1 = mysqli_real_escape_string($conn, $_POST['genre1']);
                $sql = $sql . "INSERT INTO FilmGenre(FilmID, FilmGenre) VALUES ((SELECT FilmID FROM Film WHERE FilmID = LAST_INSERT_ID() ), '$FilmGenre1');";
                }
            

            mysqli_multi_query($conn,$sql);

            $_SESSION['m_add_success'] = "addedmovie";
            header('location: addshow.php');
        } else {
            $_SESSION['error'] = $errors[0];
            header("location: addshow.php");
        }

    }

?>