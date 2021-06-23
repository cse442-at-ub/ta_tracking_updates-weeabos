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
  width: 60%;
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
$course = $_SESSION['courseSelected'];
$sql = $conn->prepare( "SELECT  * FROM office_hours WHERE email = ? AND course= ?");
$sql->bind_param("ss", $q, $course);
$result = $sql->get_result();
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