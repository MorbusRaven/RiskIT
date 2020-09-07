<?php
include 'config.php';

?>
<?php

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) OR $_SESSION["loggedin"] == !true) {
    header("location: login.php");
    exit;
}
if (!isset($_SESSION["projectid"]) OR $_SESSION["projectid"] ==0) {
    header("location:projectCreation.php");
    exit;

}
?>

<?php
$connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
$query = "SELECT rk.riskName, usr.username, mts.description FROM mitigation_strategies as est inner join risktable rk on mts.riskid = rk.id inner join users usr on mts.userid = usr.id ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
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
    <span><a href="logout.php">logout</a></span><br>
    <span>Project: <?php if ($_SESSION['projectid'] ==0 ){ echo 'Not Set'; } else{ echo $_SESSION['projectname'] ;}?></span>
    <span><a href="ProjectCreation.php"><?php if ($_SESSION['projectid'] ==0 ){ echo 'Set' ;} else{ echo 'Change';} ?></a></span>
</div>

<div class="body">

    <form method="post" action="insertMitigationStrategy.php" class="form-size" >
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-1 font-weight-bold" for="riskid">Risk Name:</label>
            </div>
            <select  class="custom-select" name="riskid" id="riskid" >
                <option value="">Select a risk</option>
                <?php
                $connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
                $query = "SELECT id, riskName FROM risktable";
                $data = $connect->prepare($query);
                $data->execute();
                while($row=$data->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$row['id'].'">'.$row['riskName'].'</option>';
                }
                ?>
            </select>
        </div>
        <input type="hidden" name = "userid" id="userid" value = "<?php echo $_SESSION['userid'] ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Add A Mitigation Strategy</label>
            </div>
            <textarea name="description" class="form-control"  required class="form-control"></textarea><br>
        </div>

        <input type="submit" name="post" value="Post" class="form-control" />
    </form>
    <?php
    if (isset($_GET['mitigation-post_action'])) {
        if ($_GET['mitigation-post_action'] == "posted") {
            echo 'Successfully Posted!';
        }
    }
    ?>


</div>
</form>



</div>

<!-- footer -->
<?php include( ROOT_PATH . '/includes/footer.php') ?>
<!-- // footer -->
</body>
</html>


