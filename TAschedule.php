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
$sql = $conn->prepare( "SELECT  * FROM office_hours WHERE email = ? AND course= ?");
$sql->bind_param("ss", $q, $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);
$csvTAnameArr = array();
$counter = 0;

echo "<table>
<tr>
<th> Location </th>
<th> Start Time</th>
<th> End Time</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['location'] . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($row['start_time'])) . "</td>";
  echo "<td>" . date('h:i a m/d/Y', strtotime($row['actual_end'])) . "</td>";
  $tableentry = array($row['email'], $row['course'], $row['location'], $row['start_time'], $row['actual_end']);
  $csvTAnameArr[$counter] = $tableentry;
  echo "</tr>";
  $counter++;
}
echo "</table>";
$_SESSION['csvTAnameArr'] = $csvTAnameArr;
mysqli_close($conn);
?>
<a href="TAinfo.php?TAname=true" >Download</a>
</body>
</html>
