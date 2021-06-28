<?php
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
<style>
table {
  width: 60%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>

<body>

<?php

$q = strval($_POST['start_date']);
$s = strval($_POST['end_date']);

$course = $_SESSION['courseSelected'];
$sql = $conn->prepare("SELECT * FROM office_hours WHERE JustDate BETWEEN ? AND ? AND course= ?");

$sql->bind_param("sss", $q, $s, $course);

$sql->execute();

$result = $sql->get_result();

$count = mysqli_num_rows($result);


while($row = mysqli_fetch_array($result)){
    $rowS[] = $row['start_time'];
    $rowE[] = $row['actual_end'];
    $roemail[] = $row['email'];
  }
  $sum = 0;
  echo "<table>
  <tr>
  <th> TA Email</th>
  <th>start time</th>
  <th>end time</th>
  <th>OH time in Hour(s)</th>
  
  </tr>";
  
  
  for ($i = 0; $i < count($rowS); $i++) {
  //echo $rowS[$i];
  //echo $rowE[$i];

    $date1 = strtotime($rowE[$i]);
    $date2 = strtotime($rowS[$i]);
    $hours = abs($date2 - $date1)/3600;
    $sum+=$hours;
  echo "<tr>";
  echo "<td>" . $roemail[$i]  . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($rowS[$i])) . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($rowE[$i])) . "</td>";
  echo "<td>" . $hours  . "</td>";
  echo "</tr>";
  
}
echo "<tfoot>
<tr> <th>Total OH:</th>";
echo "<td>" . $sum . " ". "Hour(s)". "</td>";
echo "</tr>
</tfoot>";
echo "</table>";
echo "The total number of TA Office hours that occurred from"." " . $q ." " .  "and" ." " .  $s ." " .  "is" ." " .  $sum." ". "hour(s)";
mysqli_close($conn);
?>
</body>
</html>