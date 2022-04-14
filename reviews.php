<?php
// Include config file
require_once "config.php";

$patientID = $_GET['id'];
$patientid = [];
$nameArray = [];

$query = 'select * from dcms.Patient';
$rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs)) {
    $patientid[] = $row[0];
    $nameArray[] = $row[1];
}

$totalReviews = [];
$branchID = [];
$professionalism = [];
$communication = [];
$cleanliness = [];
$query = 'select * from dcms.Branch';
$rs = pg_query($dbconnect, $query) or die ("Error: ".pg_last_error());
while ($row = pg_fetch_row($rs)) {
    $branchID = $row[0];
    $totalReviews = $row[5];
    if ($totalReviews[0] > 0){
        $professionalism[] = $row[2];
        $cleanliness[] = $row[3];
        $communication[] = $row[4];
        break;
    }
}

$value;
$randomNum = random_int(1,99999999);
$reviewNum = $randomNum;
$randomNum2 = random_int(1,99999999);

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    $value = $_POST['professionalism'] + $_POST['communication'] + $_POST['cleanliness'];
    if ($reviewNum != NULL && $patientID != NULL && $branchID[0] != NULL && $_POST['professionalism'] != NULL && $_POST['communication'] != NULL && $_POST['cleanliness'] != NULL) {
      $sql = "insert into dcms.Reviews(review_id,patient_id,branch_id,professionalism,communication,cleanliness,value) values('".$reviewNum."','".$patientID."','".$branchID."','".$_POST['professionalism']."','".$_POST['communication']."','".$_POST['cleanliness']."','".$value."')";
      $ret = pg_query($dbconnect, $sql);
      if ($ret){
        echo "<p style='color:#39C16E;font-weight: bold;'> Added to the Reviews database succesfully!"."</p>";
      }
    }
    else {
      echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
    }
    if ($totalReviews[0] == 0){
        $temp = 1;
        $sql = "update dcms.branch set(professionalismscore,cleanlinessscore,communicationscore,totalreviews)=('".$_POST['professionalism']."','".$_POST['cleanliness']."','".$_POST['communication']."','".$temp."')where branch_id = '$branchID[0]'";
        $ret = pg_query($dbconnect, $sql);
        if ($ret){
        echo "<p style='color:#39C16E;font-weight: bold;'> Added to the Branch database succesfully!"."</p>";
        }
        else {
            echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
        }
    }   else{
            $temp = $totalReviews[0] + 1;
            $prof2 = $_POST['professionalism'];
            $clean2 = $_POST['cleanliness'];
            $comm2 = $_POST['communication'];

            $prof = floor((($professionalism[0]*($temp-1)) + $prof2) / $temp);
            $clean = floor((($professionalism[0]*($temp-1)) + $clean2) / $temp);
            $comm = floor((($professionalism[0]*($temp-1)) + $comm2) / $temp);
            $sql = "update dcms.branch set(professionalismscore,cleanlinessscore,communicationscore,totalreviews)=('".$prof."','".$clean."','".$comm."','".$temp."')where branch_id = '$branchID[0]'";
            $ret = pg_query($dbconnect, $sql);
            if ($ret){
                echo "<p style='color:#39C16E;font-weight: bold;'> Added to the Branch database succesfully!"."</p>";
            }else{
                echo "<p style='color:#EA0730;font-weight: bold;'>"."Please fill out all required fields marked with an *"."</p>";
            }   
        }
    }
}

?>
<html>
    <title>Create a Review</title>
    <h1 style="text-align: center">Create a Review</h1>
    <h2 style='text-align: center'><a href="patient.php?id=<?php echo $patientID ?>"><button>Go back</button></a></h2>
        <div>
            <?php
                $length = sizeof($nameArray);
                for ($i = 0; $i < $length; $i++){
                    if ($patientID == $patientid[$i]){
                        $name = $nameArray[$i];
                        break;
                    }
                }
                echo "<a style='text-align: center'><h3>Patient ID: $patientID <br> Patient Name: $name <br><br>PLEASE GIVE A REVIEW FROM 1-100 FOR EACH CATEGORY BELOW. </h3>";
                
            ?>
            <form method='post'>
            <h3>Professionalism Score</h3>
            <div class="form-group">
            <label for="professionalism">Professionalism:</label>
            <input type="number" class="form-control" id="professionalism"  placeholder="1-100" min="1" max="100" name="professionalism">
            </div>
            <h3>Communication Score</h3>
            <div class="form-group">
            <label for="communication">Communication:</label>
            <input type="number" class="form-control" id="communication"  placeholder="1-100" min="1" max="100" name="communication">
            </div>
            <h3>Cleanliness Score</h3>
            <div class="form-group">
            <label for="cleanliness">Cleanliness:</label>
            <input type="number" class="form-control" id="cleanliness" placeholder="1-100" min="1" max="100" name="cleanliness">
            </div>
            </div>
            <h3 style='text-align:center'><input style='text-align: center' type="submit" name="submit" class="btn btn-primary" value="Submit"></h3>
            </form>
</html>