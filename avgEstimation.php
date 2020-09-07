<?php
require_once('config.php');

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) OR $_SESSION["loggedin"] == !true) {
    header("location: login.php");
    exit;
}
if (!isset($_SESSION["projectid"]) OR $_SESSION["projectid"] ==0) {
    header("location:projectCreation.php");
    exit;

}
?>

<?php
$connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
$query = "SELECT rsk.riskName, rsk.description, avg(est.`impact`) as AvgImpact, avg(est.`probability`) as AvgProbability, avg(est.`exposure`) as AvgExposure FROM `estimations` as est inner join risktable as rsk on est.riskid = rsk.id WHERE rsk.projectid= :SESSION($projectid) group by rsk.riskName, rsk.description";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>



<html>
<title>Average Estimations</title>
 <head> 
  <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
 <body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<div class="container-fluid">
      <div class="logged_in_info">
          <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
          <span><a href="logout.php">logout</a></span><br>
          <span>Project: <?php if ($_SESSION['projectid'] ==0 ){ echo 'Not Set'; } else{ echo $_SESSION['projectname'] ;}?></span>
          <span><a href="ProjectCreation.php"><?php if ($_SESSION['projectid'] ==0 ){ echo 'Set' ;} else{ echo 'Change';} ?></a></span>
      </div>
    <input type="hidden" name = "userid" id="userid" value = "<?php echo $_SESSION['userid'] ?>">
    <input type="hidden" name = "userid" id="userid" value = "<?php echo $_SESSION['projectid'] ?>">
   <br />
   <br />
   <h2 align="center">Average Estimations</h2>
   <br />
    <table class="table table-striped table-bordered">
    <thead>
     <tr>
      <th>Risk Name</th>
      <th>Description</th>
      <th>Average Impact</th>
      <th>Average Probability</th>
      <th>Average Exposure</th>
     </tr>
    </thead>
    <tbody id="table_data">
    <?php
    if(is_array($result)){
        foreach($result as $row)
        {
            echo '<tr>
								<td>'.$row['riskName'] .'</td>
								<td>'.$row['description'].'</td>
								<td>'.$row['impact'].'</td>
								<td>'.$row['probability'].'</td>
								<td>'.$row['exposure'].'</td>
								
								
								</tr>';
        }
    }
    ?>
    </tbody>
   </table>
  </div>
 </body>
</html>