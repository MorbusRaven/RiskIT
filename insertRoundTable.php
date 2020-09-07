<?php

$connect = new PDO ("mysql:host=localhost;dbname=riskit","root","");

$data = array(
    ':riskid'  => $_POST["riskid"],
    ':impact'  => $_POST["impact"],
    ':probability'  => $_POST["probability"],
    ':description' => $_POST["description"],
    ':userid' => $_POST["userid"]

);

$query = "INSERT INTO estimations
(`description`, `impact`, `probability`, `exposure`, `riskId`, `userId`) 
VALUES (:description, :impact, :probability, ((:probability/100)*:impact), :riskid, :userid)";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
    header("Location: RoundTable.php?estimations-post_action=posted");

}
else {

    print_r($connect->errorInfo());

}
