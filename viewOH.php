<?php
require "lib/pageHeader.php";
if (
   (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();
require "lib/database.php";
$conn = connect_to_database();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
body {background-image: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,1)), url("https://upload.wikimedia.org/wikipedia/commons/1/1d/Alumni_Arena_%28UB%29.jpg");}
header {color: white;}
form {color: white;}
div {color: white;}
</style>
<html>
<header>
    <?php page_header_emit(); ?>
</header>
<br> </br>
<br> </br>
</html>
<head>
<style>
table {
  width: 60%;
  border-collapse: collapse;
  color: white;
}

table, td, th {
  border: 3px solid white;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>

<body>


<?php 

$a = strval($_POST['date']);
$b = strval($_POST['start_time']);
$c = strval($_POST['end_time']);
$d = strval($_POST['TAemail']);
$old = strval($_POST['old_date']);
$startdt = date('Y/m/d H:i:s',strtotime($a . " " . $b));
$enddt = date('Y/m/d H:i:s', strtotime($a . " " . $c));
$course = $_SESSION['courseSelected'];
$update = $conn->prepare("UPDATE office_hours SET start_time = ?, expected_end = ?, JustDate = ? WHERE email = ? AND start_time = ?");
$update->bind_param("sssss", $startdt, $enddt, $a, $d, $old);
$update->execute();
echo $update->error;
//$result = $sql->get_result();

$sql = $conn->prepare("SELECT * FROM office_hours WHERE course = ?");
$sql->bind_param("s", $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)){
    $rowS[] = $row['start_time'];
    $rowE[] = $row['expected_end'];
    $roemail[] = $row['email'];
  }
  echo "<table>
  <tr>
  <th> TA Email</th>
  <th>start time</th>
  <th>end time</th>
  <th> course </th>
  </tr>";
  
  
  for ($i = 0; $i < count($rowS); $i++) {
  //echo $rowS[$i];
  //echo $rowE[$i];

    $date1 = strtotime($rowE[$i]);
    $date2 = strtotime($rowS[$i]);
  echo "<tr>";
  echo "<td>" . $roemail[$i]  . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($rowS[$i])) . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($rowE[$i])) . "</td>";
  echo "<td>" . $course  . "</td>";
  echo "</tr>";
  
}
echo "</table>";

?>