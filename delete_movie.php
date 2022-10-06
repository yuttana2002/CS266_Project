<?php
include('server.php');

$sql = "DELETE FROM `film` WHERE FilmID={$_GET['filmID']};";
$query = mysqli_query($conn, $sql);


?>