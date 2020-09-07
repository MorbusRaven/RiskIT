<?php
require_once('config.php');

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
$query = "SELECT rk.riskName, est.impact, est.probability, est.exposure, est.id, usr.username, est.description FROM estimations as est inner join risktable rk on est.riskid = rk.id inner join users usr on est.userid = usr.id ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>


<title>Round Table</title>
<head>
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="logged_in_info">
            <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
            <span><a href="logout.php">logout</a></span><br>
            <span>Project: <?php if ($_SESSION['projectid'] ==0 ){ echo 'Not Set'; } else{ echo $_SESSION['projectname'] ;}?></span>
            <span><a href="ProjectCreation.php"><?php if ($_SESSION['projectid'] ==0 ){ echo 'Set' ;} else{ echo 'Change';} ?></a></span>
        </div>

    <h2 class="text-center mt-5">Round Table</h2>
    <h3 class="text-center mb-3">Add an Estimation</h3>




    <form method="post" action="insertRoundTable.php"  class="form-size" id="add_details">
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
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Impact</label>
            </div>
            <input type="text" name="impact" id="impact" class="form-control" required />
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Probability</label>
            </div>
            <input type="text" name="probability" id="probability" class="form-control" required />

        </div>
        <input type="hidden" name = "userid" id="userid" value = "<?php echo $_SESSION['userid'] ?>">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text p-2 font-weight-bold">Add An Estimation/Description</label>
            </div>
            <textarea name="description" class="form-control"  required class="form-control"></textarea><br>
        </div>

        <input type="submit" name="post" value="Post" class="form-control" />
    </form>


</div>
</form>

    <h5>
        Existing Estimations </h5>

    <table class="table table-striped table-bordered mb-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Risk Name</th>
            <th scope="col">Impact</th>
            <th scope="col">Probability</th>
            <th scope="col">Exposure</th>
            <th scope="col">Description</th>
            <th scope="col">Creator</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(is_array($result)){
            if(count($result)==0) {
                echo '<tr><td colspan = 5>No data</td></tr> ';
            }
            else {
                foreach($result as $row)
                {
                    echo '<tr>
					<td>'.$row["riskName"].'</td>
					<td>'.$row["impact"].'</td>
					<td>'.$row["probability"].'</td>
					<td>'.$row["exposure"].'</td>
					<td>'.$row["description"].'</td>
					<td>'.$row["username"].'</td>
					</tr>';
                }
            }
        }
        ?>
        </tbody>
    </table>

</div>

<!-- footer -->
<?php include( ROOT_PATH . '/includes/footer.php') ?>
<!-- // footer -->
</body>
</html>
