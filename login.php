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
     $ubit_id_nr = mysqli_real_escape_string($conn,$_POST['ubit_id']);
     $ubit_id = htmlspecialchars($ubit_id_nr);
     $email = $ubit_id."@buffalo.edu";
     $sql = $conn->prepare("SELECT email FROM registered_users WHERE email = ?");
     $sql->bind_param("s", $email);
     $sql->execute();
     $result = $sql->get_result();
     $count = mysqli_num_rows($result);

     if($count > 0) {
        $_SESSION["uid"] = $ubit_id;
        header("Location: start.php");
      } else { ?>
         <html>
            <head>
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <style>
                  .alert {
                     padding: 20px;
                     background-color: #f44336;
                     color: white;
                  }
               </style>
            </head>
            <body>
               <div class="alert">
                  Your UBIT ID is invalid. Please try again.
               </div>
            </body>
         </html>
         <?php
      }
   }
?>

<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
body {background-image: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,1)), url("https://upload.wikimedia.org/wikipedia/commons/1/1d/Alumni_Arena_%28UB%29.jpg");}
h1   {color: white;}
h2   {color: white;}
form {color: white;}
</style>

<br> </br>
<h1 class="text-center"> University at Buffalo </h1>
<h2 class="text-center"> Teaching Assistant Availability System </h2>
<br> </br>
<body>
<form action = "" method = "post" class="text-center">
<label>UBIT ID: </label><input type = "text" name = "ubit_id" class = "box"/><br /><br />
<input type = "submit" value = " Submit "/><br />
</form>
</body>

</html>
