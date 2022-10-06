<!DOCTYPE html>
<html>
<head>

 <!-- Required meta tags -->
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <title>Add Movie</title>

<style>

</style>
</head>
<body>

<?php
session_start();
include('server.php');


$sql="SELECT * FROM Film";
$result = mysqli_query($conn,$sql);

echo "<table class='table' id='s_film'>
<thead>
<tr>
<th>Name</th>
<th>Running Time</th>
<th>Rating</th>
<th>Gennre</th>
<th style = 'text-align: center;'>Delete</th>
</tr>
</thead>
<tbody>";
while($row = mysqli_fetch_array($result)) {
  $dat = $row['FilmID'];
$sql2="SELECT FilmGenre FROM FilmGenre WHERE FilmID = '$dat' ";
$result2 = mysqli_query($conn, $sql2);

$rowcount = mysqli_num_rows($result2);

$Genre="";
if ($rowcount == 1){
  $row2 = $result2->fetch_row();
  $Genre = $row2[0] ?? false;
}
else if ($rowcount > 1){
  while ($row3 = mysqli_fetch_array($result2, MYSQLI_NUM)) {
    $Genre = $Genre .", " .$row3[0]?? false;
}

$Genre = substr($Genre, 1);
}

  echo "<tr>";
  echo "<td>" . $row['FilmName'] . "</td>";
  echo "<td>" . $row['FilmDuration'] . "</td>";
  echo "<td>" . $row['FilmRating'] . "</td>";
  echo "<td>" . $Genre . "</td>";
  echo "<td style = 'text-align: center;'>" . "<input  type='button' class='btn btn-outline-danger btn-sm' name='".$row['FilmID']."/".$row['FilmName']."' value='delete' onclick='delete_movie(this.name)' >". "</td>";
  echo "</tr>";
}
echo "</tbody></table>";
mysqli_close($conn);
?>
</body>
</html>