<?php 

header('Content-Type: text/csv; charset=utf-8');
  // tell the browser we want to save it instead of displaying it
  header('Content-Disposition: attachment; filename=test.csv');
  $f = fopen('php://output', 'w');  
  fputcsv($f,array('Email', 'Course', 'Location', 'start_time','expected_end'));

  fclose($f);
  exit();
?>
