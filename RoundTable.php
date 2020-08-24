<?php
include 'config.php';

?>
<?php 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Estimations</title>
  <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
 </head>
 <body>
  <?php include( ROOT_PATH . '/includes/navbar.php') ?>
  <div class="logged_in_info">
    <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
    |
    <span><a href="logout.php">logout</a></span>
  </div>

    <div class="body">

<form method="post" action="estimations-post-action.php">
<div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Add An Estimation</label>
            </div>
            <div class="input-group mb-3">
						<div class="input-group-prepend">
								<label class="input-group-text p-1 font-weight-bold" for="riskName">Risk Name:</label>
					</div>
						<select  class="custom-select" name="riskName" >
								<option value="">Select a risk</option>
										<?php
										$query = "SELECT riskName FROM risktable";
										$data = $connect->prepare($query);    
										$data->execute();
										while($row=$data->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="'.$row['id'].'">'.$row['riskName'].'</option>'; 
										}
										?>
						</select>
				</div>
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Impact</label>
            </div> 
            <input type="text" name="impact" class="form-control" required />
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Probability</label>
            </div>
            <input type="text" name="probability" class="form-control" required />
       <div class="input-group mb-3">
       	
      		<textarea name="Estimation" class="form-control"  required></textarea><br>
  	  </div>
<input type="submit" name="post" value="Post" />
</form>
<?php
if (isset($_GET['post_action'])) {
if ($_GET['post_action'] == "posted") {
echo 'Successfully Posted!';
}
}
?>
</div>
</form>
 </body>
</html>

