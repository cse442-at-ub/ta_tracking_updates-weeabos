<?php
if (
   (!isset($_SERVER['HTTPS'])||($_SERVER['HTTPS']!='on')))
{header('Location: '. 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);}

session_start();
require "lib/database.php";
require "lib/constants.php";
require "lib/taListBuilder.php";

$conn = connect_to_database();

if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ubit_id = mysqli_real_escape_string($conn,$_POST['ubit_id']);
     $email = $ubit_id."@buffalo.edu";
     $sql = $conn->prepare("SELECT email FROM registered_users WHERE email = ?");
     $sql->bind_param("s", $email);
     $sql->execute();
     $result = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($result);

     if($count > 0) {
        $_SESSION["uid"] = $ubit_id;
        header("Location: start.php");
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
