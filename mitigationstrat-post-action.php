<?php

include ("config.php");

if (isset($_POST['post'])) {

$post_msg = $_POST['post_msg'];

$post_name = $_GET['post_name'];

$post = $conn->query("INSERT INTO mitigation_strat_posts (post_name, post_msg) VALUES ('$post_name', '$post_msg')");

if ($post) {

header("Location: mitigationStrategy.php?mitigationstrat-post-action=posted");

} else {

echo $conn->error;

}

}

?>