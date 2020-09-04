<?php

include 'config.php';

if (isset($_POST['post_comment'])) {

$post_id = $_GET['post_id'];

$comment = $_POST['comment'];

$fullname = $_SESSION['user']['fullname'];

$comment = $conn->query("INSERT INTO estimationcomments (post_id, fullname, user_comment) VALUES ($post_id, '$fullname', '$comment')");

if ($comment) {

header("Location: view-user.php?post_id=$post_id");

} else {

echo $conn->error;

}

}

?>