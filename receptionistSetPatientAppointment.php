<?php
// Include config file
require_once "config.php";

    /*
    appointment_ID INTEGER, 
	  treatment_ID INTEGER,
    patient_ID INTEGER,
    dentist INTEGER,
    date DATE,
    startTime VARCHAR(20),
    endTime VARCHAR(20),
    appointmentType VARCHAR(20),
    status VARCHAR(20),
    room VARCHAR(20),
    */
    /*
    treatment_ID INTEGER,
    patientCondition VARCHAR(20),
    treatmentType VARCHAR(20),
    medication VARCHAR(50),
    */

$patientID = $_GET['id'];
$dentistNames = [];
$dentistID = [];
$queryEmployees = 'select * from dcms.employee';
$rs2 = pg_query($dbconnect, $queryEmployees) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs2)){
    $dentistNames[] = $row[1];
    $dentistID[] = $row[0];
    $isDentist[] = $row[3];
}

$randomNum = random_int(1,99999999);
$apptNum = $randomNum;
$randomNum2 = random_int(1,99999999);
$treatmentType = 'Root Canal';

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
  if ($_POST['treatmentType'] == 1){
    $treatmentType = 'Root Canal';
  }
  if ($_POST['treatmentType'] == 2){
    $treatmentType = 'Tooth Extraction';
  }
  if ($_POST['treatmentType'] == 3){
    $treatmentType = 'Tooth Filling';
  }
  
  if ($_POST['medication'] == 4){
    $medicationType = 'Pain Killers';
  }
  if ($_POST['medication'] == 5){
    $medicationType = 'Anesthesia';
  }
  if ($_POST['medication'] == 6){
    $medicationType = 'Antibiotics';
  }
  if ($_POST['date'] != NULL && $_POST['startTime'] != NULL && $_POST['endTime'] != NULL && $_POST['apptType'] != NULL && $_POST['status'] != NULL && $_POST['room'] != NULL) {
    $sql = "insert into dcms.Appointment(appointment_ID,treatment_ID,patient_ID,dentist_ID,date,startTime,endTime,appointmentType,status,room) values('".$apptNum."','".$randomNum2."','".$patientID."','".$_POST['dentist']."','".$_POST['date']."','".$_POST['startTime']."','".$_POST['endTime']."','".$_POST['apptType']."','".$_POST['status']."','".$_POST['room']."')";
    $ret = pg_query($dbconnect, $sql);
    if ($ret){
      echo "<p style='color:#39C16E;font-weight: bold;'> Added to the patient database succesfully!"."</p>";
    }
  
  }
  else {
    echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
  }
  if ($_POST['treatmentType'] != NULL && $_POST['patientCondition'] != NULL && $treatmentType != NULL && $medicationType != NULL) {
    $sql = "insert into dcms.Treatment(treatment_ID,patientCondition,treatmentType,medication,treatmentType_ID)values('".$randomNum2."','".$_POST['patientCondition']."','".$treatmentType."','".$medicationType."','".$_POST['treatmentType']."')";
    $ret = pg_query($dbconnect, $sql);
  }
  else {
    echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Set Patient Appointment </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Set Patient Appointment</h2>
  <a href="receptionist.php">
      <button>Go back</button>
    </a>
  <form method="post">

    <div class="form-group">
      <label for="patientID"><?php echo "<h3>Patient ID: $patientID <br></h3>" ?> </label>
    </div>

    <div class="form-group">
      <label for="apptID"><?php echo "<h3>Appointment ID: $apptNum</h3>"?></label>
    </div>
    
     <br>
    <h3>Dentist</h3>
    <div class="form-group">
        
      <label for="dentist">Select The Dentist's Name:</label>
            <select name="dentist" id="dentist">
                <?php
                    $length = sizeof($dentistNames);
                    for ($i = 0; $i < $length; $i++){
                      if ($isDentist[$i] == "dentistHygienist"){
                        echo "<option id='dentist' value='$dentistID[$i]'>$dentistNames[$i]</option>";
                      }else{
                        continue;
                      }
                    }
                ?>
            </select>
    </div>
    <h3>Treatment</h3>
    <div class="form-group">
      <label for="patientCondition">Patient Condition:</label>
      <select name="patientCondition" id="patientCondition">
        <option id="low" value="low">Low</option>
        <option id="moderate" value="moderate">Moderate</option>
        <option id="severe" value="severe">Severe</option>
        </select> 
    </div>
    <div class="form-group">
      <label for="treatmentType">Treatment Type:</label>
      <select name="treatmentType" id="treatmentType">
        <option id="rootCanal" value='1'>Root Canal</option>
        <option id="filling" value='2'>Filling</option>
        <option id="extraction" value='3'>Tooth Extraction</option>
      </select> 
    </div>
    <div class="form-group">
      <label for="medication">Medication:</label>
      <select name="medication" id="medication">
        <option id="painKillers" value='4'>Painkillers</option>
        <option id="anesthesia" value='5'>Anesthesia</option>
        <option id="antibiotics" value='6'>Antibiotics</option>
      </select> 
    </div>
    <h3>Time</h3>
    <div class="form-group">
      <label for="date">Appointment Date:</label>
      <input type="date" class="form-control" id="date" placeholder="yyyy/mm/dd" name="date">
    </div>

    <div class="form-group">
      <label for="startTime">Start Time:</label>
      <input type="time" class="form-control" id="startTime" placeholder="Enter Start Time" name="startTime">
    </div>

    <div class="form-group">
      <label for="endTime">End Time:</label>
      <input type="time" class="form-control" id="endTime" placeholder="Enter End Time" name="endTime">
    </div>
    <br>

    <h3>General Info</h3>
    <div class="form-group">
      <label for="apptType">Appointment Type:</label>
      <input type="text" class="form-control" id="apptType" placeholder="Enter Appointment Type" name="apptType">
    </div>

    <div class="form-group">
      <label for="status">Status:</label>
      <select name="status" id="status">
        <option id="status" value="Not Complete">Not Complete</option>
        <option id="status" value='In Progress'>In Progress</option>
        <option id="status" value='Complete'>Complete</option>
      </select> 
    </div>

    <div class="form-group">
      <label for="room">Room:</label>
      <input type="text" class="form-control" id="room" placeholder="Enter Room Number" name="room">
    </div>
    <br>

    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>