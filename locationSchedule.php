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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oceanus";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT ta, day FROM sessions WHERE course='{$_SESSION["course"]}' and location='{$_SESSION["location"]}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Teaching Assistant</th><th>Date</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["ta"]. "</td><td>" . $row["day"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

$conn->close();
?>

</body>
</html>