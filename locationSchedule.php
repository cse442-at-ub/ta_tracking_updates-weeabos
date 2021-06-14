<!DOCTYPE html>
<?php
session_start();
?>
<html>
<h1>
<?php
echo $location . " Sessions";
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
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ta, day FROM sessions WHERE course=$_SESSION["course"] and location=$_SESSION["location"]";
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