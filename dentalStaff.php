<?php
  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $appointmentArray = [];
  $dateArray = [];
  $startArray = [];
  $endArray = [];
  $atypeArray = [];
  $patientArray = [];
  $pName = [];

  $dentist_ID = $_GET['id'];

  $query = 'SELECT * FROM dcms.appointment';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    
    if ($dentist_ID == $row[3] && $row[8] != "Complete"]){

      $appointmentArray[] = $row[0]; 
      $dateArray[] = $row[4];
      $startArray[] = $row[5];
      $endArray[] = $row[6];
      $atypeArray[] = $row[7];
      $patientArray[] = $row[2];

    }

  }



  for($i = 0; $i < sizeof($patientArray); $i++){  
    $query = 'SELECT * FROM dcms.patient';
    $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
    $id = $patientArray[$i];
    
    while ($row = pg_fetch_row($rs)) {
  
    if ($id == $row[0]){

      
      $pName[] = $row[1]; 
      break;
    }

  }}


  // $_GET['id'] --> Gets the ID of the currently logged in dentalHygienist
  
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<a href="logout.php"><button>Log Out</button></a>
<div class="container">
  <h1>Dental Staff</h1>
  <div>

  <?php

for ($i = 0; $i < sizeof($startArray); $i++)  {
  echo "<h3>".$pName[$i]."</h3>"."\t";
  echo "<h5>".$atypeArray[$i]."</h5>"."\t";
  echo "<h5>"."Date: ".$dateArray[$i]."</h4>"."\t";
  echo "<h5>"."Start Time: ".$startArray[$i]."</h5>";
  echo "<h5>"."End Time: ".$endArray[$i]."</h5>";
  echo "<h5>"."Appointment ID: ".$appointmentArray[$i]."</h5>";
  echo "<a href='patientMedicalHistory.php?id=$patientArray[$i]'> <button>View Patient</button> </a>" ."<br/>";
}
  ?>

</div>
</div>




</body>
</html>
 