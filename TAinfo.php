<?php
session_start();
$_SESSION['course'] = 'CSE 101';
?>
<html>
<head>
<script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","TAschedule.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
</head>
<body>
<?php
$servername = "oceanus.cse.buffalo.edu";
$username = "shreyaup";
$password = "50260751";
$dbname = "cse442_2021_summer_team_c_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT DISTINCT registered_users.first_name, registered_users.last_name, registered_users.email, registered_users.faculty, office_hours.email, office_hours.course FROM registered_users INNER JOIN office_hours  ON office_hours.email = registered_users.email WHERE office_hours.course='{$_SESSION['course']}' AND registered_users.faculty = 0";
//$sql = "SELECT DISTINCT * FROM registered_users, office_hours where office_hours.email = registered_users.email AND office_hours.course = '{$_SESSION['course']}' AND registered_users.faculty = 0";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
?>
<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a Name:</option>
<?php while($row = mysqli_fetch_array($result)){?>

  <option value= "<?php echo $row['email']; ?>" > <?php echo $row['first_name']. ' '. $row['last_name']; ?></option>
  <?php  }?>
  </select>
  
</form>

<br>
<div id="txtHint"><b>Teaching Assistant information for <?php echo $_SESSION['course'] ?> will be shown</b></div>

</body>
</html>