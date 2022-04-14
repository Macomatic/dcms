<!DOCTYPE html>
<html>
<body>
 
<?php
 
    echo "Logged out successfully";
 
    session_start();
    session_destroy();
 
?>
    <h2 style='text-align: center'><a href="login.php"><button>Log In</button></a></h2>
    <div class="container">
</body>
</html>