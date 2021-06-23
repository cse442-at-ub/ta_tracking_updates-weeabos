<?php

if (
  (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();
$course = $_SESSION['courseSelected'];
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
    xmlhttp.open("GET","dateSchedule.php?q="+str,true);
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
$sql = $conn->prepare("SELECT DISTINCT JustDate FROM office_hours WHERE course=?");
$sql->bind_param("s", $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);


?>
<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a Date:</option>
<?php while($row = mysqli_fetch_array($result)){  ?>
  <option value= "<?php echo $row['JustDate']; ?>" > <?php echo $row['JustDate']; ?></option>
  <?php } ?>
</select>

</form>

<br>
<div id="txtHint"><b>Date information for <?php echo $_SESSION['course'] ?> will be shown</b></div>

</body>
</html>
