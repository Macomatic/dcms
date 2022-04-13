<?php
// Include config file
require_once "config.php";

if(isset($_POST['submit'])&&!empty($_POST['submit'])) {
    $hashpassword = md5($_POST['pwd']);
    $sql = "select * from dcms.\"User\" where username ='" . pg_escape_string($dbconnect,$_POST['username']) . "' and password='" . $hashpassword . "'";
    $data = pg_query($dbconnect, $sql);
    $login_check = pg_num_rows($data);

    if($login_check > 0) {
        echo "Login Successfully";
    } else {
        echo "Invalid Details";
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
  <h2>Login </h2>
  <form method="post">
  
     
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
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