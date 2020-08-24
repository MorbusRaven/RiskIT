<?php
//fetch.php
if(isset($_POST["action"])){
    $connect = mysqli_connect("localhost", "root", "", "dileris");
    $output = '';

    if($_POST["action"] == "riskName"){
        $query = "SELECT riskName FROM risktable WHERE riskName = '".$_POST["query"]."' GROUP BY riskName";
        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)) {
              $output .= '<h1>'.$row["riskName"].'</h1>';
        }
    }
    
    echo $output;
  }
?>