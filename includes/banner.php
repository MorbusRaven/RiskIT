<?php /** @noinspection ALL */
if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
        <div class="logged_in_info">
            <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
            <span><a href="logout.php">logout</a></span><br>
            <span>Project: <?php if ($_SESSION['projectid'] ==0 ){ echo 'Not Set'; } else{ echo $_SESSION['projectname'] ;}?></span>
            <span><a href="ProjectCreation.php"><?php if ($_SESSION['projectid'] ==0 ){ echo 'Set' ;} else{ echo 'Change';} ?></a></span>
        </div>
	</div>
<?php }else{ ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>Today's Inspiration</h1>
			<p> 
			   Risk management needs to lift up from risk control to risk intelligence which can identify the potential business growth opportunities. <br> 
			    
				<span>~ Pearl Zhu</span>
			</p>
			<a href="register.php" class="btn">Join us!</a>
		</div>

		<div class="login_div">
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2>Login</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input type="password" name="password"  placeholder="Password">
				
				<button class="btn" type="submit" name="login_btn">Sign in</button>
			</form>
		</div>
	</div>
<?php } ?>