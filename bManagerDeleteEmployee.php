<?php

  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);
  $employeeInfo = [];
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

  if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    $sql = 'delete from dcms.employee where '

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
  <h2>Delete</h2>
    <a href="bManagerAddEmployee.php?branchId=<?php echo $branch_id?>&id=<?php echo $bManagerID?>">
      <button>Add New Employee</button>

    </a>
</div>