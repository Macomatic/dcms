<?php
// Include config file
require_once "config.php";

$patientID = $_GET['id'];
$patientid = [];
$nameArray = [];
$apptdate = [];
$dentistName = [];
$treatmentType = [];
$isCompleted = [];

$query = 'select * from dcms.Patient';
$rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs)) {
    $patientid[] = $row[0];
    $nameArray[] = $row[1];
}

$queryAppointment = 'select * from dcms.Appointment';
$rs2 = pg_query($dbconnect, $queryAppointment) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs2)) {
    $apptPatientID[] = $row[2];
    $status[] = $row[8];
    $appointmentID[] = $row[0];
    $treatmentID[] = $row[1];
}


?>
<html>
    <title>Patient Upcoming Appointments</title>
    <h1 style="text-align: center">Patient Upcoming Appointments</h1>
    <div>
        <?php
            $length = sizeof($nameArray);
            $lengthStatus = sizeof($status);
            for ($i = 0; $i < $length; $i++){
                echo "<a style='text-align: center'><h3>Patient ID: $patientid[$i] <br> Patient Name: $nameArray[$i]<br></h3>";
                for ($j = 0; $j < $lengthStatus; $j++){
                    if ($status[$j] == "Not Complete" && $apptPatientID[$j] == $patientid[$i]){
                        echo "<a style='text-align: center'><h4>Treatment ID: $treatmentID[$j], Appointment ID: $appointmentID[$j], Appointment Status: $status[$j]<br></h4>";
                    }
                    if ($status[$j] == "In Progress" && $apptPatientID[$j] == $patientid[$i]){
                        echo "<a style='text-align: center'><h4>Treatment ID: $treatmentID[$j], Appointment ID: $appointmentID[$j], Appointment Status: $status[$j]<br></h4>";
                    }
                    if ($status[$j] == "Complete" && $apptPatientID[$j] == $patientid[$i]){
                        echo "<a style='text-align: center'><h4>Treatment ID: $treatmentID[$j], Appointment ID: $appointmentID[$j], Appointment Status: $status[$j]<br></h4>";
                    }
                }
            }
               
        ?>
    </div>
</html>