<?php
  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $nameArray = [];
  $dobArray = [];
  $emailArray = [];
  $query = 'SELECT * FROM dcms.patient';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    $nameArray[] = $row[1];
    $emailArray[] = $row[5];
    $dobArray[] = $row[6];
  }

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

<div class="container">
  <h1>Dental Staff</h1>
  <div>
  <?php

for ($i = 0; $i < count($nameArray); $i++)  {
  echo "<h3>".$nameArray[$i]."</h3>"."\t";
  echo "<h5>"."Date Of Birth: ".$dobArray[$i]."</h4>"."\t";
  echo "<h5>"."Email: ".$emailArray[$i]."</h5>";
  echo "<a href='patientMedicalHistory.php'> <button>View Patient</button> </a>" ."<br/>";
}
  ?>

</div>
</div>




</body>
</html>
 