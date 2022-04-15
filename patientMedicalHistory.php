<?php
// Include config file
require_once "config.php";

$patientid = [];
$nameArray = [];
$apptdate = [];
$dentistName = [];
$dentist_ID = [];
$treatment_ID = [];
$medication = [];
$treatmentType = [];
$patientCondition = [];
$isCompleted = [];
$date = [];
$pName;


$patient_ID = $_GET['id'];

$query = 'select * from dcms.appointment';
$rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs)) {
    if($row[8] == "Complete" and $patient_ID == $row[2]){

        $treatment_ID[] = $row[1];
        $dentist_ID[] = $row[3];
        $date[] = $row[4];

    }
}

$query = 'SELECT * FROM dcms.patient';
$rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
$id = $patient_ID;
    
while ($row = pg_fetch_row($rs)) {
  
if ($id == $row[0]){

      
    $pName = $row[1]; 
    break;
}
}

for($i = 0; $i < sizeof($treatment_ID); $i++){  
    $query = 'SELECT * FROM dcms.employee';
    $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
    $id = $dentist_ID[$i];
    
    while ($row = pg_fetch_row($rs)) {
  
    if ($id == $row[0]){

      
      $dentistName[] = $row[1]; 
      break;
    }
}
}

for($i = 0; $i < sizeof($treatment_ID); $i++){  
    $query = 'SELECT * FROM dcms.treatment';
    $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
    $id = $treatment_ID[$i];
    
    while ($row = pg_fetch_row($rs)) {
  
    if ($id == $row[0]){

      $patientCondition [] = $row[1];
      $treatmentType [] = $row[2];
      $medication [] = $row [3];
       
      break;
    }
}
}

$role = $_GET['role'];

if($role == "patient"){
    echo "<a href='patient.php?id=$patient_ID'> <button>Go Back</button> </a>" ."<br/>";
}

else if ($role == "staff"){

    $d_ID = $_GET['dentistID'];
    echo "<a href='dentalstaff.php?id=$d_ID'> <button>Go Back</button> </a>" ."<br/>";
}





?>

<html lang="en">
<head>
  <title>DCMS: Patient </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<div class="container" style='text-align: center'>
    <title>Patient Medical History</title>
    <h1 >Patient Medical History</h1>

    <div>
        <?php
            
            $length = sizeof($treatment_ID);
            for ($i = 0; $i < $length; $i++){
                $test = ucwords($patientCondition[$i]);
                echo "<h3>Patient Name: $pName <br> Dentist Name: $dentistName[$i]<br></h3>";
                echo "<h4>Patient Condition: $test <br> Treatment Type: $treatmentType[$i]<br></h4>";
                echo "<h4>Medication: $medication[$i] <br></h4>";
                echo "<h5>Date: $date[$i] <br></h5>";
            }
        ?>
    </div>
    </div>
</html>