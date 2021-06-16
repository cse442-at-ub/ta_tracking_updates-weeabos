<?php
session_start();
$_SESSION['course'] = 'CSE331';
?>

<!DOCTYPE html>
<html>
<h1>
Locations:
</h1>

<body>

<?php
$servername = "oceanus.cse.buffalo.edu";
$username = "shreyaup";
$password = "50260751";
$dbname = "cse442_2021_summer_team_c_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT DISTINCT location FROM office_hours WHERE course='{$_SESSION['course']}'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while($row = mysqli_fetch_assoc($result)) { ?>
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
