<?php
require "lib/pageHeader.php";
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
body {background-image: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,1)), url("https://upload.wikimedia.org/wikipedia/commons/1/1d/Alumni_Arena_%28UB%29.jpg");}
header {color: white;}
body {color: white;}
form {color: white;}
div {color: white;}
h1 {color: white;}
</style>
<header>
    <?php page_header_emit(); ?>
</header>
<br> </br>
<br> </br>
<body>

<h1>Select a date range</h1>

<form action="Calculate.php" method = "POST">
  <label for="start_date">Start Date:</label>
  <input type="date" id="start_date" name="start_date"> -
  <label for="end_date">End Date:</label>
  <input type="date" id="end_date" name="end_date">
  <input type="submit">
</form>

</body>
</html>