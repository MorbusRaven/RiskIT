<?php

$connect = new PDO ("mysql:host=localhost;dbname=riskit","root","");

$data = array(
 ':riskName'  => $_POST["riskName"],
 ':description'  => $_POST["description"],
 ':impact'  => $_POST["impact"],
 ':probability'  => $_POST["probability"],
 ':exposure'  => $_POST["exposure"]
); 

$query = "
 INSERT INTO risktable 
(riskName, impact, probability, exposure) 
VALUES (:riskName, :description, :impact, :probability, :exposure)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 $output = array(
  'riskName' => $_POST['riskName'],
  'description' => $_POST['description'],
  'impact' => $_POST['impact'],
  'probability' => $_POST['probability'],
  'exposure' => $_POST['exposure']
 );

 echo json_encode($output);
}



?>