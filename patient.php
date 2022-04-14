<?php
    require_once "config.php";
    $patientID = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Patient </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <h2 style='text-align: center'><a href="logout.php"><button>Log Out</button></a></h2>
    <div class="container">
        <h2 >My Medical History</h2>
        <a href='patientMedicalHistory.php?id=<?php echo $patientID ?>'>
            <button>Get Medical History</button>
        </a>
        <h2 >My Appointments </h2>
        <a href='patientAppointments.php?id=<?php echo $patientID ?>'>
            <button>Get Appointments</button>
        </a>
        <h2 >Reviews </h2>
        <a href='reviews.php?id=<?php echo $patientID ?>'>
            <button>Make a Review</button>
        </a>
        <h2 >Insurance Claims</h2>
        <a href='patientInsuranceClaim.php?id=<?php echo $patientID ?>'>
            <button>Make A Claim</button>
        </a>    
    </div>
</body>
</html>