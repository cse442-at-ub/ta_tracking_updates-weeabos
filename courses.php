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
$servername = "oceanus.cse.buffalo.edu";
$username = "anikaleg";
$password = "50430407";
$dbname = "cse442_2021_summer_team_c_db";

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
       <a href="tas.php">Teaching Assistants</a> -
       <a href="dates.php">Dates</a> -
       <a href="locations.php">Locations</a>
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
