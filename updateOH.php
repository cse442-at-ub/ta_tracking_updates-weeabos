<?php
require "lib/pageHeader.php";
if (
   (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();
require "lib/database.php";
$conn = connect_to_database();
?>

<!DOCTYPE html>
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
<html>
<header>
    <?php page_header_emit(); ?>
</header>
<br> </br>
<br> </br>
</html>
<head>
<style>
table {
  width: 60%;
  border-collapse: collapse;
  color: white;
}

table, td, th {
  border: 3px solid white;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>

<body>

<?php
$course = $_SESSION['courseSelected'];
$sql = $conn->prepare("SELECT * FROM office_hours WHERE course = ?");
$sql->bind_param("s", $course);
$sql->execute();
$result = $sql->get_result();
$count = mysqli_num_rows($result);


while($row = mysqli_fetch_array($result)){
    $rowS[] = $row['start_time'];
    $rowE[] = $row['expected_end'];
    $roemail[] = $row['email'];
  }
  //$sum = 0;
  for ($i = 0; $i < count($rowS); $i++) {
    //echo $rowS[$i];
    //echo $rowE[$i];
      $dtend = explode(" ", $rowE[$i]);
      $dtendtime = $dtend[1];
      $dtstart = explode(" ", $rowS[$i]);
      $dtold = $rowS[$i];
      $dtstartdate = $dtstart[0];
      $dtstarttime = $dtstart[1];
      //$hours = abs($date2 - $date1)/3600;
      //$sum+=$hours;<tr>
    ?>
    <table>
  <tr>
  <th> TA Email</th> 
  <th>date</th>
  <th>start time</th>
  <th>end time</th>
  </tr>

  <tr>
  <td><form id="<?php echo $i?>" action="viewOH.php" method = "POST"><?php echo $roemail[$i]?></td>
  <input form = "<?php echo $i?>" type="hidden" id="TAemail" name="TAemail"value = "<?php echo $roemail[$i]?>">

  <td> <input form="<?php echo $i?>" type="date" id="date" name="date" value ="<?php echo htmlspecialchars($dtstartdate) ?>"></td>
  <input form = "<?php echo $i?>" type="hidden" id="old_date" name="old_date"value = "<?php echo $dtold?>">
  <td><input form="<?php echo $i?>" type="time" id="start_time" name="start_time"value ="<?php echo htmlspecialchars($dtstarttime) ?>"></td>
  <td><input form="<?php echo $i?>" type="time" id="end_time" name="end_time"value ="<?php echo htmlspecialchars($dtendtime) ?>"> </td>
  <td><input form="<?php echo $i?>" type="submit"></td>
  </tr>
  </form>
    </table>

      <?php
    
  }
?>

</body>
</html>