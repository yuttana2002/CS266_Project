<?php
include('server.php');

$sql = "DELETE FROM `showtime` WHERE TheatreID={$_GET['theatreID']} AND FilmID = {$_GET['filmID']} AND ShowTime = '{$_GET['showtime']}'";
$query = mysqli_query($conn, $sql);

?>