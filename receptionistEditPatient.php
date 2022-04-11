<?php
  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $patientInfo = [];



  $query = 'select * from dcms.Patient';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    if ($row[0] == $_GET['id']) {
        //echo $_GET['name'];
        $patientInfo[] = $row[0]; // patient id
        $patientInfo[] = $row[1]; // name
        $patientInfo[] = $row[2]; // gender
        $patientInfo[] = $row[3]; // insurance
        $patientInfo[] = $row[4]; // ssn
        $patientInfo[] = $row[5]; // email
        $patientInfo[] = $row[6]; // dob
        $patientInfo[] = $row[7]; // address
        $patientInfo[] = $row[8]; // phoneNum
        break;
    }
    
  }

  $names = explode(" ",$patientInfo[1]);

  if (sizeof($names) == 3) {
    $fName = $names[0];
    $mName = $names[1];
    $lName = $names[2];
  }
  else {
    $fName = $names[0];
    $lName = $names[1];
    $mName = "";
  }
  
//   echo $fName;
//   echo $mName;
//   echo $lName;

$addresses = explode(", ",$patientInfo[7]);
$street = $addresses[0];
$city = $addresses[1];
$prov = $addresses[2];

// $gender = $patientInfo[2];
// $insurance = $patientInfo[3];
// $ssn = $patientInfo[4];
// $email = $patientInfo[5];
// $dateOfBirth = $patientInfo[6];
// $phoneNum = $patientInfo[8];
// echo $street;
// echo $city;
// echo $prov;


if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    if ($_POST['fName'] != NULL && $_POST['lName'] != NULL && $_POST['st'] != NULL && $_POST['city'] != NULL && $_POST['prov'] != NULL && $_POST['dob'] != NULL && $_POST['email'] != NULL && $_POST['phoneNum'] != NULL && $_POST['lName'] != NULL && $_POST['gender'] != NULL && $_POST['insurance'] != NULL && $_POST['ssn'] != NULL) {
      $fullName = $_POST['fName'].' '.$_POST['mName'].' '.$_POST['lName'];
      $fullAddress = $_POST['st'].', '.$_POST['city'].', '.$_POST['prov']; 
      $gender = $_POST['gender'];
      $insurance = $_POST['insurance'].'';
        $sql = "update dcms.patient set name = '$fullName' where patient_ID = ".$patientInfo[0].";";
        $ret = pg_query($dbconnect, $sql);
        
        $sql = "update dcms.patient set insurance = '$insurance' where patient_ID = ".$patientInfo[0].";";

            // "update dcms.patient set (name,gender,insurance,ssn,email,dateOfBirth,address,phoneNumber) =('$fullName','$_POST['gender']','$_POST['insurance']','$_POST['ssn']','$_POST['email']','$_POST['dob']','$fullAddress','$_POST['phoneNum']')where patient.patient_id = '$patientInfo[0]'";
            // name = ".$fullName.", 
            // gender = ".$_POST['gender'].", 
            // insurance = ".$_POST['insurance'].", 
            // ssn = ".$_POST['ssn'].", 
            // email = ".$_POST['email'].", 
            // dateOfBirth = ".$_POST['dob'].", 
            // address = ".$fullAddress.", 
            // phoneNumber = ".$_POST['phoneNum']."
            // where patient_ID = ".$patientInfo[0].";";
        
        if($ret) {
          echo "<p style='color:#39C16E;font-weight: bold;'>".$_POST['fName']."'s information was updated and saved to the database succesfully!\nRefresh the page or go back to view the updated information."."</p>";
          // /header('Location: receptionist.php');
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
      <input type="text" class="form-control" id="fName" placeholder="Enter first name" name="fName" value='<?php echo $fName ?>'>
    </div>

    <div class="form-group">
      <label for="mName">Middle Name (if applicable):</label>
      <input type="text" class="form-control" id="mName" placeholder="Enter midle name if applicable" name="mName" value='<?php echo $mName ?>'>
    </div>

    <div class="form-group">
      <label for="lName">Last Name*:</label>
      <input type="text" class="form-control" id="lName" placeholder="Enter last name" name="lName" value='<?php echo $lName ?>'>
    </div>
    
     <br>
    <h3>Address</h3>
    <div class="form-group">
      <label for="st">Street # and name*:</label>
      <input type="text" class="form-control" id="st" placeholder="Enter street number and name" name="st" value='<?php echo $street ?>' >
    </div>

    <div class="form-group">
      <label for="city">City*:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" value='<?php echo $city ?>'>
    </div>

    <div class="form-group">
      <label for="prov">Province*:</label>
      <input type="text" class="form-control" id="prov" placeholder="Enter province" name="prov" value='<?php echo $prov ?>'>
    </div>
     
    
    <br>
    <h3>Personal Info</h3>
    <div class="form-group">
      <label for="dob">Date of Birth*:</label>
      <input type="date" class="form-control" id="dob" placeholder="mm / dd / yyyy" name="dob" value='<?php echo $patientInfo[6] ?>'>
    </div>

    <div class="form-group">
      <label for="email">Email Address*:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" maxlength="50" value='<?php echo $patientInfo[5] ?>'>
    </div>

    <div class="form-group">
      <label for="phoneNum">Phone Number*:</label>
      <input type="number" class="form-control" id="phoneNum" placeholder="Enter phone number" name="phoneNum" value='<?php echo $patientInfo[8] ?>'>
    </div>

    <div class="form-group">
      <label for="gender">Gender*:</label>
      <select name="gender" id="gender" class="form-control">
        <option selected='<?php echo $patientInfo[2] ?>'><?php echo ucwords($patientInfo[2]) ?></option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
    </div>

    <div class="form-group">
      <label for="insurance">Insurance*:</label>
      <input type="text" class="form-control" id="insurance" placeholder="Enter insurance" name="insurance" maxlength = "20" value='<?php echo $patientInfo[3] ?>'>
    </div>

    <div class="form-group">
      <label for="ssn">SSN*:</label>
      <input type="number" class="form-control" id="ssn" placeholder="Enter SSN" name="ssn" value='<?php echo $patientInfo[4] ?>'>
    </div>


    <input type="submit" name="submit" class="btn btn-primary" value="Update">
  </form>
</div>


</body>
</html>