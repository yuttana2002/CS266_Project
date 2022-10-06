<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "TU_Theatre";

    //create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //check cennection
    if(!$conn){
        die("connection failed".mysqli_connect_error());
    }
    mysqli_set_charset($conn, 'utf8');
    mysqli_query($conn, 'SET CHARACTER SET utf8');
?>
