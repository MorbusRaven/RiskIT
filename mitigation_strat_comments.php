<?php

include 'config.php';

if (isset($_POST['post_comment'])) {

    $post_id = $_GET['post_id'];

    $comment = $_POST['comment'];

    $uname = $_POST['uname'];

    $comment = $mysqli->query("INSERT INTO miitigationstrat_comments (post_id, user_name, user_comment) VALUES ($post_id, '$uname', '$comment')");

    if ($comment) {

        header("Location: view-post.php?post_id=$post_id");

    } else {

        echo $mysqli->error;
    }
}

