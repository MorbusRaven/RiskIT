<?php /** @noinspection ALL */

include ("config.php");

if (isset($_POST['post'])) {

    $post_id = $_POST['post_id'];
    $post_msg = $_POST['post_msg'];
    $risk_name = $_GET['risk_name'];

    $post = $conn->query("INSERT INTO mitigation_strat_posts (post_id, risk_name, post_msg) VALUES ('$post_id','$risk_name', '$post_msg')");

    if ($post) {

        header("Location: mitigationStrategy.php?mitigationstrat-post-action=posted");

    } else {

        echo $conn->error;

    }
}

