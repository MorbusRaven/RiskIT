<?php  
include('config.php'); 
include('includes/registration_login.php'); 
include('includes/head_section.php'); ?>
<title>Risk Assistant| Sign in </title>
</head>
<body>
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div class="container-fluid">
		
				<form method="post" class="form-size" action="login.php" >
						
						<h2 class="text-center mb-10">Login</h2>
						<?php include(ROOT_PATH . '/includes/errors.php') ?>
					<div class="form-group">
						<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<select  class="custom-select" name="projectname" >
								<option value="">Select a Project</option>
										<?php
										$query = "SELECT projectname FROM project";
										$data = $connect->prepare($query);    
										$data->execute();
										while($row=$data->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="'.$row['id'].'">'.$row['projectname'].'</option>'; 
										}
										?>
						</select>
						<button type="submit" class="btn" name="login_btn">Login</button>
						<p>Not yet a member? <a href="register.php">Sign up</a></p>
					</div>
				</form>

	</div>
<!-- // container -->

<!-- Footer -->
  <?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->