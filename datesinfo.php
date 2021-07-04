<?php
require "lib/pageHeader.php";

if (
  (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();
$course = $_SESSION['courseSelected'];

if(isset($_GET['dates'])){
  header('Content-Type: text/csv; charset=utf-8');
  // tell the browser we want to save it instead of displaying it
  header('Content-Disposition: attachment; filename=locations.csv');
  $f = fopen('php://output', 'w');
  fputcsv($f,array('Email', 'Course', 'Location', 'start_time','expected_end'));
  foreach($_SESSION['csvDatesArr'] as $outer){
    fputcsv($f, $outer);
  }
  fclose($f);
  exit();
}
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
body {background-image: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,1)), url("https://upload.wikimedia.org/wikipedia/commons/1/1d/Alumni_Arena_%28UB%29.jpg");}
header {color: white;}
form {color: white;}
div {color: white;}
</style>
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

<html>
<header>
    <?php page_header_emit(); ?>
</header>
<br> </br>
<br> </br>
</html>
<form class="text-center">
<select name="users" onchange="showUser(this.value)">
<option value="">Select a Date:</option>
<?php while($row = mysqli_fetch_array($result)){  ?>
  <option value= "<?php echo $row['JustDate']; ?>" > <?php echo $row['JustDate']; ?></option>
  <?php } ?>
</select>

</form>

<br>
<div class="text-center" id="txtHint"><b>Date information for <?php echo $_SESSION['course'] ?> will be shown</b></div>

</body>
</html>