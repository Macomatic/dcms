<?php
// Include config file
require_once "config.php";

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
  if ($_POST['fName'] != NULL && $_POST['lName'] != NULL && $_POST['st'] != NULL && $_POST['city'] != NULL && $_POST['prov'] != NULL && $_POST['dob'] != NULL && $_POST['email'] != NULL && $_POST['phoneNum'] != NULL && $_POST['lName'] != NULL && $_POST['gender'] != NULL && $_POST['insurance'] != NULL && $_POST['ssn'] != NULL) {
    $fullName = $_POST['fName'].' '.$_POST['mName'].' '.$_POST['lName'];
    $fullAddress = $_POST['st'].', '.$_POST['city'].', '.$_POST['prov'];
    $randomNum = random_int(1,99999999);
    $randomPassNum = random_int(0,9999999);
    $userName = trim($fullName.$randomNum);
    $password = "password".$randomPassNum;
    echo $password;
    $role = "patient";
    $sql = "insert into dcms.\"User\"(user_ID,username,password,role) values('".$randomNum."','".$userName."','".md5($password)."','".$role."')";
    $ret = pg_query($dbconnect, $sql);
    if($ret) {
        
      $sql = "insert into dcms.Patient(patient_ID,name,gender,insurance,ssn,email,dateOfBirth,address,phoneNumber) values('".$randomNum."','".$fullName."','".$_POST['gender']."','".$_POST['insurance']."','".$_POST['ssn']."','".$_POST['email']."','".$_POST['dob']."','".$fullAddress."','".$_POST['phoneNum']."')";
      $ret = pg_query($dbconnect, $sql);
      if($ret) {
        echo "<p style='color:#39C16E;font-weight: bold;'>".$_POST['fName']." was added to the patient database succesfully!"."</p>";
        // /header('Location: receptionist.php');
        $password = "password".$randomPassNum;
      }
      else { 
        echo "Something Went Wrong";
      }

    }
    else { 
        echo "Something Went Wrong";
    }
  
  }

  else {
    echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
  }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Add Patient </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Add a new patient</h2>
  <a href="receptionist.php">
      <button>Go back</button>
    </a>
  <form method="post">
  
    <h3>Patient Name</h3>
    <div class="form-group">
      <label for="fName">First Name*:</label>
      <input type="text" class="form-control" id="fName" placeholder="Enter first name" name="fName">
    </div>

    <div class="form-group">
      <label for="mName">Middle Name (if applicable):</label>
      <input type="text" class="form-control" id="mName" placeholder="Enter midle name if applicable" name="mName" value="">
    </div>

    <div class="form-group">
      <label for="lName">Last Name*:</label>
      <input type="text" class="form-control" id="lName" placeholder="Enter last name" name="lName">
    </div>
    
     <br>
    <h3>Address</h3>
    <div class="form-group">
      <label for="st">Street # and name*:</label>
      <input type="text" class="form-control" id="st" placeholder="Enter street number and name" name="st">
    </div>

    <div class="form-group">
      <label for="city">City*:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city">
    </div>

    <div class="form-group">
      <label for="prov">Province*:</label>
      <input type="text" class="form-control" id="prov" placeholder="Enter province" name="prov">
    </div>
     
    
    <br>
    <h3>Personal Info</h3>
    <div class="form-group">
      <label for="dob">Date of Birth*:</label>
      <input type="date" class="form-control" id="dob" placeholder="mm / dd / yyyy" name="dob">
    </div>

    <div class="form-group">
      <label for="email">Email Address*:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>

    <div class="form-group">
      <label for="phoneNum">Phone Number*:</label>
      <input type="number" class="form-control" id="phoneNum" placeholder="Enter phone number" name="phoneNum">
    </div>

    <div class="form-group">
      <label for="gender">Gender*:</label>
      <select name="gender" id="gender" class="form-control">
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
    </div>

    <div class="form-group">
      <label for="insurance">Insurance*:</label>
      <input type="text" class="form-control" id="insurance" placeholder="Enter insurance" name="insurance">
    </div>

    <div class="form-group">
      <label for="ssn">SSN*:</label>
      <input type="number" class="form-control" id="ssn" placeholder="Enter SSN" name="ssn">
    </div>


    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>