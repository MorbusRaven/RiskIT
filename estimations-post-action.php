<?php /** @noinspection ALL */

include ("config.php");

if (isset($_POST['user'])) {

    $post_msg = $_POST['post_msg'];
    $riskName = $_POST['riskName'];
    $impact = $_POST['impact'];
    $probability = $_POST['probability'];




    $post = $conn->query("INSERT INTO estimations (post_msg, impact, probability) VALUES ('$riskName', '$post_msg', '$impact', '$probability')");

    if ($post) {

        header("Location: RoundTable.php?post_action=posted");

    } else {

        echo $conn->error;

    }

}

