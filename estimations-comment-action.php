<?php

include 'config.php';

if (isset($_POST['post_comment'])) {

$post_id = $_GET['post_id'];

$comment = $_POST['comment'];

$user_name = $_POST['user_name'];

$comment = $conn->query("INSERT INTO estimations_comments (post_id, user_name, user_comment) VALUES ($post_id, '$user_name', '$comment')");

if ($comment) {

header("Location: estimations-view-post.php?post_id=$post_id");

} else {

echo $conn->error;

}

}

?>