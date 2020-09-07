<?php /** @noinspection ALL */
include('config.php');

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

<!DOCTYPE html>
<html>
<head>
    <title>Invite Stakeholders</title>
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
<h2>Select User:</h2>
<div>
    <form method="POST" action="projectStakeholders.php">
        <table border="1">
            <thead>
            <th></th>
            <th>Full Name</th>
            <th>Email</th>
            </thead>
            <tbody>



            <?php
            $query=mysqli_query($conn,"select fullname,email from users");
            while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $row['userid']; ?>" name="id[]"  ></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email'];?></td>
                </tr>
                <?php
            }
            ?>

            </tbody>
        </table>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<div>
    <h2>You Selected:</h2>
    <?php
    if (isset($_POST['submit'])){
        foreach ($_POST['id'] as $id):

            $sql="select fullname,email from users where userid='$id'";
            $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
            echo $row['fullname']."<br>";
            echo $row['email']."<br>";
        endforeach;
    }
    ?>
</div>
<?php include( ROOT_PATH . '/includes/footer.php') ?>
</body>
</html>