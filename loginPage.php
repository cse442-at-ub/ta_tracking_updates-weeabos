<?php
session_start();
require "lib/database.php";
require "lib/constants.php";
require "lib/taListBuilder.php";

$conn = connect_to_database();

if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ubit_id = mysqli_real_escape_string($conn,$_POST['ubit_id']);
     $sql = "SELECT ubit_id FROM professors WHERE ubit_id = '$ubit_id'";
     $result = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($result);

     if($count > 0) {
        $_SESSION["id"] = $ubit_id;
        header("Location: courses.php");
      } else {
        echo '<script>alert("Your UBIT ID is invalid")</script>';
      }
   }
?>

<html>

<h1> Teaching Assistant Availability System </h1>
<h2> Professor Login </h2>

<body>
<form action = "" method = "post">
<label>UBIT ID :</label><input type = "text" name = "ubit_id" class = "box"/><br /><br />
<input type = "submit" value = " Submit "/><br />
</form>
</body>

</html>