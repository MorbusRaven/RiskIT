<?php

//insert.php

$connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");

$data = array(
    ':riskName'  => $_POST["riskName"],
    ':description'  => $_POST["description"],
    ':controlEnv'  => $_POST["controlEnv"],
    ':riskCat'  => $_POST["riskCat"],
    ':rtype'  => $_POST["rtype"],
    ':phase'  => $_POST["phase"],
    ':fullname'  => $_POST["fullname"]
);

$query = "
 INSERT INTO risktable 
(riskName, description, controlEnv, riskCat, rtype, phase, fullname) 
VALUES (:riskName, :description, :controlEnv, :riskCat, :rtype, :phase, :fullname)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
    $output = array(
        'riskName' => $_POST['riskName'],
        'description'  => $_POST['description'],
        'controlEnv'  => $_POST['controlEnv'],
        'riskCat'  => $_POST['riskCat'],
        'rtype'  => $_POST['rtype'],
        'phase'  => $_POST['phase'],
        'fullname'  => $_POST['fullname']
    );

    echo json_encode($output);
}

?>