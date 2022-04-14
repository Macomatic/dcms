<?php 
    require_once "config.php";
    $patientID = $_GET['id'];

    if(isset($_POST['submit'])&&!empty($_POST['submit'])){ 
        echo "You will automatically be reimbursed if you are viable for the claim";    
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DCMS: Patient Insurance Claim </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    <h2 >My Medical History</h2>
        </br>
    <a href='patient.php?id=<?php echo $patientID ?>'>
            <button>Go Back</button>
        </a>
    <form method="post">
            </br>
            <input type="file" id="myFile" name="filename">
            </br>
            <input type="submit" name="submit" value="Submit">
            </form>
    </div>
</body>
</html>