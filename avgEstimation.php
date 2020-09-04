
<?php require_once('config.php') ?>
<?php 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] == true) {
    header("location: login.php");
    exit;
}
    
?>


<html>
<title>Average Estimations</title>
 <head> 
  <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
 <body>
  <div class="container">
  <?php include( ROOT_PATH . '/includes/navbar.php') ?>
  <div class="logged_in_info">
    <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
    <span><a href="logout.php">logout</a></span>
  </div>
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
      // Attempt select query execution
$sql = "SELECT * FROM riskavg";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['riskName'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['impact'] . "</td>";
                echo "<td>" . $row['probability'] . "</td>";
                echo "<td>" . $row['exposure'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } 
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
      ?>
    </tbody>
   </table>
  </div>
 </body>
</html>