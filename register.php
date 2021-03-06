<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>

<?php include('includes/head_section.php'); ?>

<title>Risk Assistant | Sign up </title>
</head>
<body>
<!-- Navbar -->
<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
  <!-- // Navbar -->
<div class="container-fluid">
  

  <div style="width: 40%; margin: 20px auto;">
    <form method="post" action="register.php" >
      <h2>Register</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <input  type="text" name="fullname" value="<?php echo $fullname; ?>"  placeholder="Full Name">
      <input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
      <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
      <input type="password" name="password_1" placeholder="Password">
      <input type="password" name="password_2" placeholder="Password confirmation">
      <button type="submit" class="btn" name="reg_user">Register</button>
      <p>
        Already a member? <a href="login.php">Sign in</a>
      </p>
    </form>
  </div>
</div>
<!-- // container -->
<!-- Footer -->
  <?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->