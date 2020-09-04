<?php 
	require_once('config.php');
	

?>
<?php 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] == true) {
    header("location: login.php");
    exit;
}
    
?>

<?php
$connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
$query = "SELECT * FROM roundtable ORDER BY riskName ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>


	<title>Round Table</title>
<head> 
	<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
	<body>
	<?php include( ROOT_PATH . '/includes/navbar.php') ?>

	<div class="container-fluid">
	<div class="logged_in_info">
		<span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
		|
		<span><a href="logout.php">logout</a></span>
	</div>
	 
	 <h2 class="text-center mt-5">Round Table</h2>
	 <h3 class="text-center mb-3">Add an Estimation</h3>
	 
	 <form method="post"  class="form-size" id="add_details">
				<div class="input-group mb-3">
						<div class="input-group-prepend">
								<label class="input-group-text p-1 font-weight-bold" for="riskName">Risk Name:</label>
					</div>
						<select  class="custom-select" name="riskName" >
								<option value="">Select a risk</option>
										<?php
                                        $connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
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
            
        </div>
		<div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Your Estimation</label>
            </div>
			<textarea name="Estimation" class="form-control"  required></textarea><br>
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
		
	
		
		</div>

	<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>
<!-- // footer -->
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#add_details').on('submit', function(event){
	event.preventDefault();
	$.ajax({
	 url:"insertRoundTable.php",
	 method:"POST",
	 data:$(this).serialize(),
	 dataType:"json",
	 beforeSend:function(){
		$('#add').attr('disabled', 'disabled');
		console.log('before');
	 },
	 success:function(data){
		$('#add').attr('disabled', false);
		console.log('in success');
		if(data.riskName)
		{
		 var html = '<tr>';
		 html += '<td>'+data.riskName+'</td>';
		 html += '<td>'+data.impact+'</td>';
		 html += '<td>'+data.probability+'</td>';
		 html += '<td>'+data.exposure+'</td></tr>';
		 $('#table_data').prepend(html);
		 $('#add_details')[0].reset();
		}
	 }
	})
 });
 
});



document.getElementById("add_details").onsubmit = function() {divide()};

	function divide(){
		var field1=document.getElementById("probability").value;
		const a=100;
		var probability=parseInt(field1)/a;
		multiply(probability);
		
 
}
 
function multiply(probability){
 
	var field1=document.getElementById("impact").value;
	var field2=probability;
 
	var exposure=parseFloat(field1)*parseFloat(field2);
 
	if(!isNaN(exposure)){

		console.log(exposure)
		document.getElementsByName("exposure").innerHTML=exposure;

 
	}
}
</script>
