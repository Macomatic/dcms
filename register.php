<?php
// Include config file
require_once "config.php";
 
$randomNum = random_int(1,99999999);

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
  $sql = "insert into dcms.\"User\"(user_ID,username,password,role)values('".$randomNum."','".$_POST['username']."','".md5($_POST['pwd']). "','". $_POST['role']."')";
  $ret = pg_query($dbconnect, $sql);
  if($ret){
      
          echo "Data saved Successfully";
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
  <h2>Register</h2>
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
      <label for="role">Role:</label>
      <select class="form-control" name="role">
        <option value="receptionist">Receptionist</option>
        <option value="dentistHygienist">Dentist/Hygienist</option>
        <option value="patient">Patient</option>
      </select>
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>
 