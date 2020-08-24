<?php

include ("config.php");

if (isset($_POST['post'])) {

$post_msg = $_POST['post_msg'];
$post_name = $_POST['post_name'];
$impact = $_POST['impact'];
$probability = $_POST['probability'];
$riskName = $_POST['riskName'];
$description = $_POST['description'];



$post = $conn->query("INSERT INTO roundtable (post_name, post_msg, impact, probability, riskName, 'description') VALUES ('$post_name', '$post_msg', '$impact', '$probability', '$riskName', '$description')");

if ($post) {

header("Location: RoundTable.php?post_action=posted");

} else {

echo $conn->error;

}

}

?>