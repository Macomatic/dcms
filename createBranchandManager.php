<?php
// Include config file
require_once "config.php";

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
  if ($_POST['fName'] != NULL && $_POST['lName'] != NULL && $_POST['st'] != NULL && $_POST['city'] != NULL && $_POST['prov'] != NULL && $_POST['lName'] != NULL) {
    $fullName = $_POST['fName'].' '.$_POST['mName'].' '.$_POST['lName'];
    $fullAddress = $_POST['st'].', '.$_POST['city'].', '.$_POST['prov'];
    $randomNum = random_int(1,99999999);
    $branchNum = $_POST['branchID'];
    $userName = $fullName;
    $password = "password";
    $role = "branchManager";
    $sql = "insert into dcms.\"User\"(user_ID,username,password,role) values('".$randomNum."','".$userName."','".md5($password)."','".$role."')";
    $ret = pg_query($dbconnect, $sql);
    if($ret) {
        
      $sql = "insert into dcms.Branch(branch_ID,address) values('".$branchNum."','".$fullAddress."')";
      $ret = pg_query($dbconnect, $sql);
      if($ret) {
          $sql = "insert into dcms.BranchManager(bManager_ID,branch_ID,name) values('".$randomNum. "','".$branchNum."','".$fullName."')";
          $ret = pg_query($dbconnect, $sql);
          if ($ret) {
            echo "<p style='color:#39C16E;font-weight: bold;'>".$_POST['fName']." was added to the patient database succesfully!"."</p>";
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

  else {
    echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
  }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Create Branch and Manager </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <a href="login.php">
      <button>Go to login</button>
    </a>
  <form method="post">
  
    <h3>Branch Manager</h3>
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
     
    <h3>Branch</h3>

    <div class="form-group">
      <label for="branchID">Branch ID*:</label>
      <input type="text" class="form-control" id="branchID" placeholder="Branch ID" name="branchID">
    </div>


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

    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>