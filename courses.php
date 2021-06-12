<!DOCTYPE html>
<html>
<h1>
<?php
echo "Welcome " . $professor . "!";
?>
</h1>
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
       <a href="tas.php">Teaching Assistants</a> - 
       <a href="dates.php">Dates</a> - 
       <a href="locations.php">Locations</a>
       <?php
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>