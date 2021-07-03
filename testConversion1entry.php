<?php

$servername = "oceanus.cse.buffalo.edu";
$username = "anikaleg";
$password = "50430407";
$dbname = "cse442_2021_summer_team_c_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$add = "CREATE TABLE `Dummy_Data` (
    `Dummy_course` varchar(20) NOT NULL,
    `Dummy_name` text NOT NULL,
    `Dummy_age` int NOT NULL  
  )";

if ($conn->query($add) === TRUE) {
    echo "Table Dummy_Data created successfully ";
  } else {
    echo "Error creating table: " . $conn->error . " ";
  }

  $insert = "INSERT INTO Dummy_Data (Dummy_course, Dummy_name, Dummy_age) VALUES ('CSE 101', 'Kyle Paul', 22)";

  if($conn->query($insert)===TRUE){
      echo "inserted data into table ";
  }
  else{
      echo "error inserting into table" . $conn->error . " ";
  }

$pull = "SELECT * FROM 'Dummy_Data'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$Arr = array();
  while($row = mysqli_fetch_array($result)){
    $tableentry = array($row['email'], $row['course'], $row['location'], $row['start_time'], $row['expected_end']);
    $Arr[] = $tableentry;
    
  }
  foreach($Arr as $display){
    foreach($display as $show){
        echo $show;
    }
}
  $delete= $conn->query("DROP TABLE Dummy_Data");

if($delete !== FALSE)
{
   echo("This table has been deleted. ");
}else{
   echo"This table has not been deleted due to" . $conn->error . " ";
}
  
  $conn->close();

?>