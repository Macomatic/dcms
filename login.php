<?php
// Include config file
require_once "config.php";

if(isset($_POST['submit'])&&!empty($_POST['submit'])) {
    $hashpassword = md5($_POST['pwd']);
    $sql = "select * from dcms.user where email ='" . pg_escape_string($_POST['email']) . "' and password='" . $hashpassword . "'";
    $data = pg_query($dbconnect, $sql);
    $login_check = pg_num_rows($data);

    if($login_check > 0) {
        echo "Login Successfully";
    } else {
        echo "Invalid Details";
    }
}
?>


<div class="container">
  <h2>Login Here </h2>
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