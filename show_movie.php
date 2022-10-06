<?php
$FilmID = intval($_GET['FilmID']);
$TheatreID = intval($_GET['TheatreID']);

session_start();
include('server.php');



$sql="SELECT * FROM showtime WHERE FilmID = '$FilmID' AND TheatreID = '$TheatreID' AND  RemainingSeat > 2 ";
$result = mysqli_query($conn,$sql);


$sql1="SELECT FilmName FROM Film WHERE FilmID = '$FilmID' ";
$result1 = mysqli_query($conn,$sql1);

$sql2="SELECT TheatreName FROM Theatre WHERE TheatreID = '$TheatreID' ";
$result2 = mysqli_query($conn,$sql2);

$row1 = $result1->fetch_row();
$Fname = $row1[0] ?? false;

$row2 = $result2->fetch_row();
$Tname = $row2[0] ?? false;



echo "<table class='table' id='showtime'>
<thead>
<tr>
<th>FilmName</th>
<th>ShowTime</th>
<th>Price</th>
<th>RemainingSeat</th>
<th>Select</th>
</tr>
</thead>
<tbody>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $Fname . "</td>";
  echo "<td>" . $row['ShowTime'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "<td>" . $row['RemainingSeat'] . "</td>";
  echo "<td>" . "<input  type='button' class='btn btn-outline-success btn-sm' name='".$FilmID."/".$TheatreID."/".$row['ShowTime']."/".$row['Price']."/".$row['RemainingSeat']."/".$Fname."/".$Tname."' value='select' onclick='buy(this.name)' >". "</td>";
  
  echo "</tr>";
}
echo "</tbody></table>";
mysqli_close($conn);
?>
