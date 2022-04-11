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

// echo $street;
// echo $city;
// echo $prov;


  
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
      <select name="gender" id="gender" class="form-control" value='<?php echo $patientInfo[2] ?>'>
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


    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>