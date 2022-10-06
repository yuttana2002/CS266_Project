

<?php
$FilmID = intval($_GET['FilmID']);
$TheatreID = intval($_GET['TheatreID']);
session_start();
include('server.php');


$sql="SELECT * FROM showtime WHERE FilmID = '$FilmID' AND TheatreID = '$TheatreID'";
$result = mysqli_query($conn,$sql);

echo "<table class='table' id='showtime'>
<thead>
<tr>
<th>ShowTime</th>
<th>Price</th>
<th>RemainingSeat</th>
<th>Delete</th>
</tr>
</thead>
<tbody>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['ShowTime'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "<td>" . $row['RemainingSeat'] . "</td>";
  echo "<td>" . "<input  type='button' class='btn btn-outline-danger btn-sm' name='".$FilmID."/".$TheatreID."/".$row['ShowTime']."' value='delete' onclick='delete_showtime(this.name)' >". "</td>";
  echo "</tr>";
}
echo "</tbody></table>";
mysqli_close($conn);
?>
