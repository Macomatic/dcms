<?php
  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $employeeInfo = [];
  $patientInfo = [];
  $managerID = $_GET['managerID'];

  $query = 'select * from dcms.Employee';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    if ($row[0] == $_GET['id']) {
        //echo $_GET['name'];
        $employeeInfo[] = $row[0]; // employee id 
        $employeeInfo[] = $row[1]; // name
        $employeeInfo[] = $row[2]; // address
        $employeeInfo[] = $row[3]; // role
        $employeeInfo[] = $row[4]; // employment type
        $employeeInfo[] = $row[5]; // ssn
        $employeeInfo[] = $row[6]; // salary
        $employeeInfo[] = $row[7]; // branch id
        break;
    }
    
  }

  $query = 'select * from dcms.Patient';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    if ($row[0] == $_GET['id']) {
        //echo $_GET['name'];
        $patientInfo[] = $row[2]; // gender 0
        $patientInfo[] = $row[3]; // insurance 1
        $patientInfo[] = $row[5]; // email 2
        $patientInfo[] = $row[6]; // dob 3 
        $patientInfo[] = $row[8]; // phoneNum 4
        break;
    }
    
  }

  if ($employeeInfo[4] == "Ft") {
    $employmentTypeName = "Full-time";
  }
  else {
    $employmentTypeName = "Part-time";
  }
  

  $names = explode(" ",$employeeInfo[1]);

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

    $addresses = explode(", ",$employeeInfo[2]);
    $street = $addresses[0];
    $city = $addresses[1];
    $prov = $addresses[2];


  if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    if ($_POST['fName'] != NULL && $_POST['lName'] != NULL && $_POST['st'] != NULL && $_POST['city'] != NULL && $_POST['prov'] != NULL && $_POST['dob'] != NULL && $_POST['email'] != NULL && $_POST['phoneNum'] != NULL && $_POST['lName'] != NULL && $_POST['gender'] != NULL && $_POST['insurance'] != NULL && $_POST['ssn'] != NULL) {
      $fullName = $_POST['fName'].' '.$_POST['mName'].' '.$_POST['lName'];
      $fullAddress = $_POST['st'].', '.$_POST['city'].', '.$_POST['prov']; 
      $gender = $_POST['gender'];
      $insurance = $_POST['insurance'];
      $ssn = $_POST['ssn'];
      $email = $_POST['email'];
      $dateOfBirth = $_POST['dob'];
      $phoneNumber = $_POST['phoneNum'];
      $jobRole = $_POST['role'];
      $empType = $_POST['empType'];
      $salary = $_POST['salary'];
      if ($_POST['newBranch'] == NULL || trim($_POST['newBranch'] == "") || $_POST['newBranch'] == $employeeInfo) {
          $branch_ID = $employeeInfo[7];
      }
      else  {
          $branch_ID = (int)$_POST['newBranch'];
      }

        $sql = "update dcms.patient set (name,gender,insurance,ssn,email,dateOfBirth,address,phoneNumber) =('$fullName','$gender','$insurance','$ssn','$email','$dateOfBirth','$fullAddress','$phoneNumber')where patient_id = '$employeeInfo[0]'";
        $ret = pg_query($dbconnect, $sql);
        
        if($ret) {
            $sql = "update dcms.employee set (name,address,role,employmentType,ssn,salary,branch_ID) =('$fullName','$fullAddress','$jobRole','$empType','$ssn','$salary','$branch_ID')where employee_ID = '$employeeInfo[0]'";
            $ret = pg_query($dbconnect, $sql);
            if ($ret) {
                $sql = "update dcms.\"User\" set role = '$jobRole' where user_id = '$employeeInfo[0]'";
                $ret = pg_query($dbconnect, $sql);
                if ($ret) {
                    echo "<p style='color:#39C16E;font-weight: bold;'>".$_POST['fName']."'s information was updated and saved to the database succesfully!\nRefresh the page or go back to view the updated information."."</p>";
                }
                else {
                    echo "Something went wrong";
                }
            }

            else { 
                echo "Something Went Wrong";
              }

        }
        else { 
          echo "Something Went Wrong";
        }
  

    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Edit Employee </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Edit employee</h2>
  <a href="branchManager.php?id=<?php echo $managerID ?>">
      <button>Go back</button>
    </a>
  <form method="post">
  
    <h3>Employee Name</h3>
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
      <input type="text" class="form-control" id="st" placeholder="Enter street number and name" name="st" value='<?php echo $street ?>'>
    </div>

    <div class="form-group">
      <label for="city">City*:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city"  value='<?php echo $city ?>'>
    </div>

    <div class="form-group">
      <label for="prov">Province*:</label>
      <input type="text" class="form-control" id="prov" placeholder="Enter province" name="prov" value='<?php echo $prov ?>'>
    </div>
     
    
    <br>
    <h3>Personal Info</h3>
    <div class="form-group">
      <label for="dob">Date of Birth*:</label>
      <input type="date" class="form-control" id="dob" placeholder="mm / dd / yyyy" name="dob" value='<?php echo $patientInfo[3] ?>'>
    </div>

    <div class="form-group">
      <label for="email">Email Address*:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value='<?php echo $patientInfo[2] ?>'>
    </div>

    <div class="form-group">
      <label for="phoneNum">Phone Number*:</label>
      <input type="number" class="form-control" id="phoneNum" placeholder="Enter phone number" name="phoneNum" value='<?php echo $patientInfo[4] ?>'>
    </div>

    <div class="form-group">
      <label for="gender">Gender*:</label>
      <select name="gender" id="gender" class="form-control">
        <option selected='<?php echo $patientInfo[0]?>'><?php echo ucwords($patientInfo[0]) ?></option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
    </div>

    <div class="form-group">
      <label for="insurance">Insurance*:</label>
      <input type="text" class="form-control" id="insurance" placeholder="Enter insurance" name="insurance" value='<?php echo $patientInfo[1] ?>'>
    </div>

    <div class="form-group">
      <label for="ssn">SSN*:</label>
      <input type="number" class="form-control" id="ssn" placeholder="Enter SSN" name="ssn" value='<?php echo $employeeInfo[5] ?>'>
    </div>

    <br>
    <h3>Job Info</h3>
    <div class="form-group">
      <label for="role">Job role*:</label>
      <select name="role" id="role" class="form-control">
        <option selected='<?php echo strtolower($employeeInfo[3])?>'><?php echo ucwords($employeeInfo[3]) ?></option>
        <option value="dentistHygienist">Dentist/Hygienist</option>
        <option value="receptionist">Receptionist</option>
    </select>
    </div>

    <div class="form-group">
      <label for="empType">Employment Type*:</label>
      <select name="empType" id="empType" class="form-control">
        <option selected='<?php echo $employeeInfo[4]?>'><?php echo $employmentTypeName ?></option>
        <option value="ft">Full-time</option>
        <option value="pt">Part-time</option>
    </select>
    </div>

    <div class="form-group">
      <label for="salary">Salary ($)*:</label>
      <input type="number" class="form-control" id="salary" placeholder="Enter salary ($)" name="salary" value='<?php echo $employeeInfo[6] ?>'>
    </div>

    <div class="form-group">
      <label for="newBranch">New Branch ID (if employee is moving branches):</label>
      <input type="number" class="form-control" id="newBranch" placeholder="New Branch ID (leave empty if employee is not moving branches)" name="newBranch" value='<?php echo $employeeInfo[7] ?>'>
    </div>

    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>