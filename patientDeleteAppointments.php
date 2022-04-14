<?php

require_once "config.php";

$t = $_GET['treatmentID'];
$d = $_GET['id'];
$p = $_GET['pID'];

if(isset($_POST['submit'])&&!empty($_POST['submit'])){ 
    echo $d;
    $sql = "delete from dcms.appointment where appointment_id = $d";
    $rs = pg_query($dbconnect, $sql) or die ("Error: ".pg_last_error());
    $sql = "delete from dcms.treatment where treatment_id = $t";
    $rs = pg_query($dbconnect, $sql) or die ("Error: ".pg_last_error());
    if ($rs){
        echo "Deleted Successully";
        header("Location:patient.php?id=$p");
    }
    else{
        echo "Unsuccessful";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Delete Employee </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Would you like to cancel your appointment?</h2>
  <h4>A small cancellation fee will be charged on the account's associated card</h3>
  <form method="post">
    <a href="">
        <input type="submit" name="submit" value="Yes, delete">
    </a>
    <a href="patient.php?id=<?php echo $p ?>">
        <input type="button" value="No, go back">
    </a>
    </form>
</div>