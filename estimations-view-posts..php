<?php


include ("config.php");

if (isset($_GET['post_id'])) {

$id = $_GET['post_id'];

$estpost = $conn->query("SELECT * FROM estimationposts WHERE post_id = $id");

$post_data = $estpost->fetch_assoc();

} else {

header("Location: index.php");

}

?>

<!doctype html>

<html>

<head>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>


<title><?php echo $post_data['fullname'] ?>Status Update</title>

<link rel="stylesheet" type="text/css" href="public_styling.css">

</head>

 

<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<div class="body">

<a href="RoundTable.php">Estimations</a> | <b><?php echo $post_data['username'] ?></b>

</div>

<div class="body">

<div class="post-panel">

<div class="post-body" style="border: none;">

<?php echo $post_data['post_msg'] ?>

</div>

<div class="post-footer">

<?php

$estcomments = $conn->query("SELECT * FROM estcomments WHERE post_id = $id");

?>

<b><?php echo $estcomments->num_rows ?></b> Total comments<br><br>

<?php

while ($comment_data = $estcomments->fetch_assoc()) { ?>

<div class="post-panel">

<div class="post-header">

<b><?php echo $comment_data['username'] ?></b>

</div>

<div class="post-body">

<?php echo $comment_data['user_comment'] ?>

</div>

</div>

<?php }

?>

<form method="post" action="comment-action.php?post_id=<?php echo $id ?>">

<label>Quick Comment:</label><br>

<textarea name="comment" required></textarea><br>
<?php echo  $_SESSION['username']; ?>
<input type="submit" name="post_comment" />

</form>

</div>

</div>

</div>

</body>

</html>