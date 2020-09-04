<?php require_once('config.php') ?>

<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Risk Assistant | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	
		<!-- navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<!-- // navbar -->
		<div class="container-fluid">
			<!-- banner -->
			<?php include( ROOT_PATH . '/includes/banner.php') ?>
			<!-- // banner -->

			<!-- Page content -->
			<?php

$estimations_posts = $conn->query("SELECT * FROM roundtable ORDER BY post_id DESC");
$mitigation_strat_posts = $conn->query("SELECT * FROM mitigation_strat_posts ORDER BY post_id DESC");
?>

<div class="body">

<b><?php echo $estimations_posts ->num_rows ?></b> Τotal Estimations
</div>
<div class="body">
	<?php

if ($estimations_posts->num_rows == null) {

echo 'Νo posts yet';

} else if ($estimations_posts->num_rows != null) {

while ($post_data = $estimations_posts->fetch_assoc()) { ?>

<div class="post-panel">

<div class="post-header">

<b><?php echo $post_data['post_name'] ?></b>

</div>

<div class="post-body">

<?php echo $post_data['post_msg'] ?>

</div>

<?php

$estimations_posts = $conn->query("SELECT * FROM roundtable WHERE post_id = ".$post_data['post_id']."");

?>

<div class="post-footer">

<a href="estimations-view-posts.php?post_id=<?php echo $post_data['post_id'] ?>">Comment (<?php echo $estimations_posts->num_rows ?>)</a>

</div>

</div>

<?php }

}

?>

</br>
<b><?php echo $mitigation_strat_posts->num_rows ?></b> Τotal Mitigation Strategies
</div>
<div class="body" style="padding-bottom: 1px;">

<?php

if ($mitigation_strat_posts->num_rows == null) {

echo 'Νo posts yet';

} else if ($mitigation_strat_posts->num_rows != null) {

while ($post_data = $mitigation_strat_posts->fetch_assoc()) { ?>

<div class="post-panel">

<div class="post-header">

<b><?php echo $post_data['post_name'] ?></b>

</div>

<div class="post-body">

<?php echo $post_data['post_msg'] ?>

</div>

<?php

$mitigation_strat_posts = $conn->query("SELECT * FROM mitigation_strat_comments WHERE post_id = ".$post_data['post_id']."");

?>

<div class="post-footer">

<a href="mitigationstrat-view-post.php?post_id=<?php echo $post_data['post_id'] ?>">Comment (<?php echo $mitigation_strat_posts->num_rows ?>)</a>

</div>

</div>

<?php }

}

?>
		<!-- // Page content -->

		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->