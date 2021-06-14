<!DOCTYPE html>
<?php
session_start();
?>
<html>
<h2>
Courses:
</h2>
<body>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT DISTINCT course FROM professors";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       $row["course"]; ?> - 
       <a href="tas.php" <?php $_SESSION ["course"] = $row["course"];?>>Teaching Assistants</a> - 
       <a href="dates.php" <?php $_SESSION ["course"] = $row["course"];?>>Dates</a> - 
       <a href="locations.php"<?php $_SESSION ["course"] = $row["course"];?>>Locations</a>
       <?php
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>