<?php
    include('server.php');
    $sql = "SELECT DISTINCT amphurs FROM p_district 
         WHERE province='{$_GET['province']}'";
    $query = mysqli_query($conn, $sql); 
    $json = array();
    while($result = mysqli_fetch_assoc($query)) { 
         array_push($json, $result);
         }
    echo json_encode($json);

?>  