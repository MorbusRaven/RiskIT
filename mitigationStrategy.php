<?php
include 'config.php';

?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Mitigation Strategies</title>
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
</head>
<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<div class="logged_in_info">
    <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>

    <span><a href="logout.php">logout</a></span>
</div>

<div class="body">

    <form method="post" action="mitigationstrat-post-action.php">

        <select  class="custom-select" name="riskName" >
            <option value="">Select a risk</option>
            <?php
            $connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
            $query = "SELECT riskName FROM risktable";
            $data = $connect->prepare($query);
            $data->execute();
            while($row=$data->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['id'].'">'.$row['riskName'].'</option>';
            }
            ?>
        </select>

        <label>Add A Mitigation Strategy:</label><br>

        <textarea name="post_msg"  class="form-control" required></textarea><br>

        <input type="submit" name="post" class="form-control" value="Post" />

    </form>

    <?php

    if (isset($_GET['mitigationstrat-post-action'])) {

        if ($_GET['mitigationstrat-post-action'] == "posted") {

            echo 'Successfully Posted!';

        }

    }

    ?>

</div>



    </form>
</body>
</html>

