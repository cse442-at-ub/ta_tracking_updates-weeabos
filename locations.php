<?php
session_start();
?>

<!DOCTYPE html>
<html>
<h1>
Locations:
</h1>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oceanus";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT DISTINCT location FROM sessions WHERE course='{$_SESSION['course']}'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while($row = mysqli_fetch_assoc($result)) {  ?>
         <a href="locationSchedule.php" <?php $_SESSION["location"] = $row["location"];?>> <?php echo $row["location"]; ?> </a>
<br> </br>
  <?php }

} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>
