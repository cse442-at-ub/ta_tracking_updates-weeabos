<?php
session_start();
?>

<!DOCTYPE html>
<html>
<h2>
Courses:
</h2>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oceanus";

$conn = mysqli_connect($servername, $username, $password, $dbname);

function setcourse($course_name){
$_SESSION["course"] = $course_name;
}
if (isset($_GET['set'])) {
    setcourse($row['course']);
  }

$sql = "SELECT DISTINCT course FROM professors WHERE ubit_id='{$_SESSION['id']}'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       echo $row['course']; ?> -
       <a href="tas.php" <?php $_SESSION["course"] = $row['course']; ?> >Teaching Assistants</a> -
       <a href="dates.php" <?php $_SESSION["course"] = $row['course']; ?> >Dates</a> -
       <a href="locations.php" <?php $_SESSION["course"] = $row['course']; ?> >Locations</a>
	     <br> </br>
       <?php
    }
 }else {
    echo "0 results";
}


mysqli_close($conn);
?>

</body>
</html>