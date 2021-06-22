<?php
session_start();
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


$q = strval($_GET['q']);

$servername = "oceanus.cse.buffalo.edu";
$username = "shreyaup";
$password = "50260751";
$dbname = "cse442_2021_summer_team_c_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM office_hours WHERE location = '".$q."' AND course='{$_SESSION['courseSelected']}'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$csvDownloadArr = array();
$counter = 0;


echo "<table>
<tr>
<th>email</th>
<th>start time</th>
<th>end time</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['start_time'] . "</td>";
  echo "<td>" . $row['expected_end'] . "</td>";
  $tableentry = array($row['email'], $row['course'], $row['location'], $row['start_time'], $row['expected_end']);
  $csvDownloadArr[$counter] = $tableentry;
  echo "</tr>";
  $counter++;
}
echo "</table>";

$_SESSION['csvDownloadArr'] = $csvDownloadArr;
mysqli_close($conn);
?>
<br></br>
<a href="locations.php?hello=true" >Download</a>
</body>
</html>
