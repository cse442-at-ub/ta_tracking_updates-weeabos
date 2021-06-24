<?php

if (
  (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();

if(isset($_GET['hello'])){
  header('Content-Type: text/csv; charset=utf-8');
  // tell the browser we want to save it instead of displaying it
  header('Content-Disposition: attachment; filename=locations.csv');
  $f = fopen('php://output', 'w');
  fputcsv($f,array('Email', 'Course', 'Location', 'start_time','expected_end'));
  foreach($_SESSION['csvDownloadArr'] as $outer){
    fputcsv($f, $outer);
  }
  fclose($f);
  exit();
}

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
    xmlhttp.open("GET","locationSchedule.php?q="+str,true);
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
$course = $_SESSION['courseSelected'];
$sql =$conn->prepare( "SELECT DISTINCT location FROM office_hours WHERE course= ?");

$sql->bind_param("s", $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);
$rows = array();

while($row = mysqli_fetch_array($result)){
  $rows[] = $row['location'];
}
?>
<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select a Location:</option>
<?php for ($i = 0; $i < count($rows); $i++) { ?>

  <option value= "<?php echo $rows[$i]; ?>" > <?php echo $rows[$i]; ?></option>
  <?php } ?>
  </select>

</form>

<br>
<div id="txtHint"><b>Location information for <?php echo $_SESSION['courseSelected'] ?> will be shown</b></div>

</body>
</html>