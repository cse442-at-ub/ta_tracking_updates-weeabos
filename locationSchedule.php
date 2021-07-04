<?php

if (
  (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  color: white;
  width: 60%;
  border-collapse: collapse;
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


$q = strval($_GET['q']);

$servername = "oceanus.cse.buffalo.edu";
$username = "shreyaup";
$password = "50260751";
$dbname = "cse442_2021_summer_team_c_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$course = $_SESSION['courseSelected'];
$sql = $conn->prepare("SELECT * FROM office_hours WHERE location = ? AND course= ?");
$sql->bind_param("ss", $q, $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);
$csvLocationArr = array();
$counter = 0;


echo "<table>
<tr>
<th>Email</th>
<th>Start Time</th>
<th>End Time</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($row['start_time'])) . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($row['actual_end'])) . "</td>";
  $tableentry = array($row['email'], $row['course'], $row['location'], $row['start_time'], $row['expected_end']);
  $csvLocationArr[$counter] = $tableentry;
  echo "</tr>";
  $counter++;
}
echo "</table>";

$_SESSION['csvLocationArr'] = $csvLocationArr;
mysqli_close($conn);
?>
<br></br>
<a href="locations.php?location=true" >Download</a>
</body>
</html>
