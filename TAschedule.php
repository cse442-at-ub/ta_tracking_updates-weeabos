<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 3px solid black;
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
$sql = "SELECT  * FROM office_hours WHERE email = '".$q."' AND course='{$_SESSION['courseSelected']}'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

echo "<table>
<tr>
<th> OH Location </th>
<th> OH start time</th>
<th> OH end time</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['location'] . "</td>";
  echo "<td>" . $row['start_time'] . "</td>";
  echo "<td>" . $row['expected_end'] . "</td>";

  echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
</body>
</html>
