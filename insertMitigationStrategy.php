<?php

$connect = new PDO ("mysql:host=localhost;dbname=riskit","root","");

$data = array(
    ':riskid'  => $_POST["riskid"],
    ':description' => $_POST["description"],
    ':userid' => $_POST["userid"]

);

$query = "INSERT INTO mitigation_strategies
(`description`, `riskId`, `userId`) 
VALUES (:description, :riskid, :userid)";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
    header("Location: MitigationStrategies.php?mitigationstrat-post_action=posted");

}
else {

    print_r($connect->errorInfo());

}
