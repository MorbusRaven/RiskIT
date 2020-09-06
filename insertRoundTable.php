<?php

$connect = new PDO ("mysql:host=localhost;dbname=riskit","root","");

$data = array(
    ':riskName'  => $_POST["riskName"],
    ':impact'  => $_POST["impact"],
    ':probability'  => $_POST["probability"],
    ':post_msg' => $_POST["post_msg"]
);

$query = "
INSERT INTO roundtable
(riskName, impact, probability,post_msg) 
VALUES (:riskName, :impact, :probability,:post_msg)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
    $output = array(
        'riskName' => $_POST['riskName'],
        'impact' => $_POST['impact'],
        'probability' => $_POST['probability'],
        'post_msg' => $_POST['post_msg']
    );

    echo json_encode($output);
}

?>