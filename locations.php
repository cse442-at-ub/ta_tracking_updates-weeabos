<!DOCTYPE html>
<html>
<h1>
Locations
</h1>

<body>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT DISTINCT location FROM sessions";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) ?> {
         <a href="locationSchedule.php">$row["location"]</a>;
    }
<?php
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>
