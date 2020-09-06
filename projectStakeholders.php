<?php /** @noinspection ALL */
include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invite Stakeholders</title>
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
</head>
<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<h2>Select User:</h2>
<div>
    <form method="POST">
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