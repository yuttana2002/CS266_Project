<?php 
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['review_user'])) {
        $Score = mysqli_real_escape_string($conn, $_POST['ratingNum']);
        $Comment = mysqli_real_escape_string($conn, $_POST['Comments']);
		$FilmID = mysqli_real_escape_string($conn, $_POST['filmID']);
		$mID = $_SESSION['ID'];
		
        $review_checker = "SELECT * FROM `review` WHERE  FilmID = '$FilmID ' ";
        $query = mysqli_query($conn, $review_checker);
        $result = mysqli_fetch_assoc($query);
	//count review
	$sql4 = "SELECT COUNT(mID) AS count FROM review WHERE FilmID='$FilmID'";
	$sql5 = "SELECT * FROM `film` WHERE  FilmID = '$FilmID' "; //to get movie namme
	$countreview=mysqli_query($conn,$sql4);
	$countreview=mysqli_fetch_array($countreview);
	$namaiwa=mysqli_query($conn,$sql5);
	$namaiwa=mysqli_fetch_array($namaiwa);
	$reviewNum = $countreview['count'];
	$Title = $namaiwa['FilmName'];
	//variable count how many user reviewee
	//end count review
	
	//check if review = 0 or not
	if($reviewNum == 0){
		
	}
	//

		//check error
        if($result){ //will not submit review
            if ($result['mID'] === $mID){
                array_push($errors, "You already review this movie!");
				header('location: MovieDetail.php?movies='.$Title.'');
            }else if($reviewNum < 0){
				array_push($errors, "reviewNum is corrupted!");
				header('location: MovieDetail.php?movies='.$Title.'');
			}

        }
		

        if (count($errors)==0){
			if($reviewNum == 0){ //new film no one review yet
				$UpdateFilmRating = "UPDATE `film` SET `FilmRating` = '$Score' WHERE `film`.`FilmID` = '$FilmID';";
				$InsertReview =  "INSERT INTO `review` (mID, FilmID, rating, comment) VALUES ('$mID', '$FilmID', '$Score', '$Comment')" ;
				mysqli_multi_query($conn,$UpdateFilmRating);
				mysqli_multi_query($conn,$InsertReview);
				header('location: MovieDetail.php?movies='.$Title.'');
			}else if($reviewNum > 0){
				//get rating
				$Rating = floatval($namaiwa['FilmRating']);
				$Rate = floatval($Score);
				$Score_Submit = ($Rating + $Rate)/2.0;
				$UpdateFilmRating = "UPDATE `film` SET `FilmRating` = '$Score_Submit' WHERE `film`.`FilmID` = '$FilmID';"; //update rating
				$InsertReview =  "INSERT INTO `review` (mID, FilmID, rating, comment) VALUES ('$mID', '$FilmID', '$Score', '$Comment')" ;//add new Review
				mysqli_multi_query($conn,$UpdateFilmRating);
				mysqli_multi_query($conn,$InsertReview);
				header('location: MovieDetail.php?movies='.$Title.'');
			}
            
        } else {
            $_SESSION['error'] = $errors[0];
			//echo "<script language='javascript'>alert('You already Submitted Review!')</script>";
            echo $errors[0];
        }

    }

?>