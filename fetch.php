<?php
include('server.php');
     session_start();

if(isset($_POST['search'])){
    $response = "<ul class='list-group'><ul class='list-group-item'>No movies found</ul></ul>";

    $q = mysqli_real_escape_string($conn,$_POST["q"]);
    $query = "SELECT * FROM film WHERE FilmName LIKE '$q%'"; 
    $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)>0){
        $response = "<ul class='list-group'>";
        while($row = mysqli_fetch_assoc($res)){
            $response .= "<div><li style='height: 155px;' class='movieChoice list-group-item'>"."<img src='img/movie_poster/".$row["FilmName"].".jpg' "."style='height: 135px; width:90px; margin-right: 10px'".">".$row['FilmName']."</div></li>";
        }
        $response .= "</ul>";

    }
    exit($response);


}

?>