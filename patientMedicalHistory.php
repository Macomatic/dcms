<?php
// Include config file
require_once "config.php";

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



?>
<html>
    <title>Patient Medical History</title>
    <h1 style="text-align: center">Patient Medical History</h1>
    <div>
        <?php
            $length = sizeof($nameArray);
            for ($i = 0; $i < $length; $i++){
                echo "<a style='text-align: center'><h3>Patient ID: $patientid[$i] <br> Patient Name: $nameArray[$i]<br></h3>";
            }
        ?>
    </div>
</html>