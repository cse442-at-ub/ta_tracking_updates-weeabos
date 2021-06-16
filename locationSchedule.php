<?php
session_start();
?>

<!DOCTYPE html>
<html>
<h1>
<?php
echo $_SESSION["location"] . " Sessions";
?>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</h1>
<body>

<?php
$servername = "oceanus.cse.buffalo.edu";
$username = "shreyaup";
$password = "50260751";
$dbname = "cse442_2021_summer_team_c_db";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT email, start_time, expected_end FROM office_hours WHERE course='{$_SESSION["course"]}' and location='{$_SESSION["location"]}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>TA email</th><th>Office hour start</th><th>Office hour end</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["email"]. "</td><td>" . $row["start_time"]. "</td><td>" . $row["expected_end"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>