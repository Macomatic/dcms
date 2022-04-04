<?php
// Include config file
require_once "config.php";
 
if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
    $sql = "insert into dcms.user(username,password)values('".$_POST['username']."','".md5($_POST['pwd'])."')";
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
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    
     
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
  </form>
</div>


</body>
</html>
 