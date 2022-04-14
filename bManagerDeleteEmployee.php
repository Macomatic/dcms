<?php

  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $managerID = $_GET['managerID'];
  $empID = $_GET['id'];

  $query = 'select * from dcms.Employee';
  $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
  while ($row = pg_fetch_row($rs)) {
    if ($row[0] == $_GET['id']) {
        //echo $_GET['name'];
        $name = $row[1]; // name

        break;
    }
    
  }
  

  if(isset($_POST['submit'])){
    $sql = "delete from dcms.employee where employee_id = $empID";
    $rs = pg_query($dbconnect, $sql) or die ("Error: ".pg_last_error());
    if ($rs) {
        echo "Deleted successfully";
        header("Location: branchManager.php?id=$managerID");
    }
    else {
        echo "Something went wrong";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Delete Employee </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Would you like to delete <?php echo $name ?> from the Employee database?</h2>
  <form method="post">
    <a href="">
        <input type="submit" name="submit" value="Yes, delete">
    </a>
    <a href="branchManager.php?id=<?php echo $managerID ?>">
        <input type="button" value="No, go back">
    </a>
    </form>
</div>