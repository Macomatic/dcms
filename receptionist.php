<?php
  // Include config file
  require_once "config.php";
  error_reporting(E_ALL ^ E_DEPRECATED);

  if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    $query = 'select * from dcms."User"';
    $rs = pg_query($query) or die ("Error: ".pg_last_error());
    while ($row = pg_fetch_row($rs)) {
      echo "$row[0] $row[1] $row[2] $row[3]\n";
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Receptionist </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Receptionist Page</h2>
    <a href="receptionistAddPatient.php">
      <button>Add Patient</button>

    </a>
    <label for="search">Search for a patient: </label>
    <input type="text" id="search" name="search" placeholder="Search for a name">
</div>

<div>
  <form method="post">
    <input type="submit" name="submit" class="btn btn-primary" value="Get patients">
  </form>
</div>


</body>
</html>