<?php
  // Include config file
  require_once "config.php";
  //error_reporting(E_ALL ^ E_DEPRECATED);

  $bManagerID = $_GET['id'];
  $branchID = $_GET['branchId'];
  $branchInfo = [];

  $query = 'select * from dcms.Branch order by branch_id';
    $rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
    while ($row = pg_fetch_row($rs)) {
        if ($branchID == $row[0]) {
        $branchInfo[] = $row[0]; //branch id
        $branchInfo[] = $row[1]; // address
        $branchInfo[] = $row[2]; // professionalism score
        $branchInfo[] = $row[3]; // cleanliness score
        $branchInfo[] = $row[4]; // communication score
        $branchInfo[] = $row[5]; // total reviews
      }
    }

    if ($branchInfo[5] == 0) {
        $branchInfo[2] = "No score";
        $branchInfo[3] = "No score";
        $branchInfo[4] = "No score";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Branch Manager </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    <h2>Branch ID: <?php echo $branchInfo[0] ?></h2>
    <a href="branchManager.php?id=<?php echo $bManagerID ?>">
        <button>Go back</button>
    </a>
    <h3>Address: <?php echo $branchInfo[1]?></h3>
    <h4>Average Professionalism Score: <?php echo $branchInfo[2] ?></h4>
    <h4>Average Cleanliness Score: <?php echo $branchInfo[3]?></h4>
    <h4>Average Communication Score: <?php echo $branchInfo[4]?></h4>
    <h5>Total Reviews: <?php echo $branchInfo[5]?></h5>
</div>

</body>
</html>