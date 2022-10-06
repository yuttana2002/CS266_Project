<?php
    include('server.php');
    $sql = "SELECT * FROM p_district WHERE Amphurs='{$_GET['amphurs']}'";
    $query = mysqli_query($conn, $sql);
                                        
    $json = array();
    while($result = mysqli_fetch_assoc($query)) {    
        array_push($json, $result);
    }
    echo json_encode($json);
    ?>