<?php
// Include config file
require_once "config.php";
 
$randomNum = strval(random_int(1,99999999));

if(isset($_POST['submit'])&&!empty($_POST['submit'])){

  $firstName = str_replace("'", "''", $_POST['firstName']);
  $lastName = str_replace("'", "''", $_POST['lastName']);
  $insurance = str_replace("'", "''", $_POST['insurance']);
  $address = str_replace("'", "''", $_POST['address']);
    
  $sql = "insert into dcms.\"User\"(user_ID,username,password,role)values(".$randomNum.",'".$_POST['username']."','".md5($_POST['pwd']). "','patient')";
  $ret = pg_query($dbconnect, $sql);
  if($ret){
        $sql = "insert into dcms.patient(patient_ID,name,gender,insurance,ssn,email,dateOfBirth,address,phoneNumber) values (".$randomNum.",'".$firstName." ".$lastName."','".$_POST['gender']."','".$insurance."',".$_POST['ssn'].",'".$_POST['email']."','".$_POST['dateOfBirth']."','".$address."','".$_POST['phoneNumber']."')";

        $ret = pg_query($dbconnect, $sql);
        if ($ret) {
          session_start();
          $_SESSION['sid']=session_id();
          echo "User registered Successfully";
          header("Location: patient.php?id=$randomNum");
        }

        else {
          $sql = "delete from dcms.\"User\" where username = '".$_POST['username']."'";
          $ret = pg_query($dbconnect, $sql);
          echo "Something Went Wrong";
        }
          
  }else{
      
          echo "Something Went Wrong";
  }
}
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
  <h2>Patient Register</h2>
  <form method="post">

    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
    </div>
    
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>

    <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="text" class="form-control" id="firstName" placeholder="Enter first name" name="firstName">
    </div>

    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="text" class="form-control" id="lastName" placeholder="Enter last name" name="lastName">
    </div>

    <div class="form-group">
      <label for="gender">Gender:</label>
      <select class="form-control" name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>

    <div class="form-group">
      <label for="insurance">Insurance:</label>
      <input type="text" class="form-control" id="insurance" placeholder="Enter insurance" name="insurance">
    </div>

    <div class="form-group">
      <label for="ssn">Social Security Number:</label>
      <input type="number" class="form-control" id="ssn" placeholder="Enter SSN" name="ssn">
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>

    <div class="form-group">
      <label for="dateOfBirth">Date of Birth:</label>
      <input type="date" class="form-control" id="dateOfBirth" placeholder="YYYY-MM-DD" name="dateOfBirth">
    </div>

    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
    </div>

    <div class="form-group">
      <label for="phoneNumber">Phone Number:</label>
      <input type="text" class="form-control" id="phoneNumber" placeholder="0000000000" name="phoneNumber" maxlength="10">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <br>
    <a href="login.php">Already have an account? Log in!</a>
  </form>
</div>


</body>
</html>
 