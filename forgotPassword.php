<?php
// Include config file
require_once "config.php";


if(isset($_POST['submit'])&&!empty($_POST['submit'])) {

    echo "An Email has been sent to reset your password";


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
  <h2>Forgot Password </h2>
  <form method="post">
  
     
    <div class="form-group">
      <label for="email">Please Enter Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
    </div>


     
    <input type="submit" name="submit" class="btn btn-primary" value="Send Email">
  </form>
  <br>
  <a href="login.php">
      <button class="btn btn-primary">Go Back</button>
    </a>
</div>
</body>


</html>