<?php
function connect_to_database() {
  // Create database connection
  $DATABASE_HOST = "oceanus.cse.buffalo.edu"; // if using online server, need to change the name
  $DATABASE_USER = "FILL_ME_IN"; // you can change to your ubit and person number below
  $DATABASE_PASS = "CHANGE_ME";
  $DATABASE_NAME = "UPDATE_ME";
  // Try and connect using the info above.
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  try {
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
         // If there is an error with the connection, stop the script and display the error.
         die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    return $con;
  } catch (Exception $e) {
    die ('Failed to connect to MySQL: ' . $e->getMessage());
  }
}
?>
