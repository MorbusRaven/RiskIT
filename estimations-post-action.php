<?php

include ("config.php");

if (isset($_POST['user'])) {

$post_msg = $_POST['post_msg'];

$username = $_POST['username'];

$post = $conn->query("INSERT INTO estimationposts (username, post_msg) VALUES ('$username', '$post_msg')");

if ($post) {

header("Location: mitigationStrategy.php?post_action=posted");

} else {

echo $conn->error;

}

}

?>