<?php require_once('config.php') ?>
<?php

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) OR $_SESSION["loggedin"] == !true) {
    header("location: login.php");
    exit;
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $projectid = $_POST['projectid'];
    if (!empty($projectid)) {
        $_SESSION['projectid'] = $_POST['projectid'];
        $connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
        $query = "SELECT `projectname` FROM `projects` where id = :projectid limit 1";
        $statement = $connect->prepare($query);
        $params = array('projectid'=>$projectid);
        $statement->execute($params);
        $result = $statement->fetch();
        $_SESSION['projectname'] = $result['projectname'];
    }
}
?>
<?php
$connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
$query = "SELECT `projectname`, `clientname`, `description`, `created_at`, `id` FROM `projects` ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Project Creation</title>
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container-fluid">
    <div class="logged_in_info">
        <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>|<span><a href="logout.php">logout</a></span><br>
        <span>Project:<?php if (!isset($_SESSION["projectid"]) OR $_SESSION['projectid'] ==0 ){ echo 'Not Set'; } else{ echo $_SESSION['projectname'] ;}?></span>
    </div>
    <h2 class="text-center mt-5">Project Selection/Creation</h2>
    <h3  class="text-center mb-3">Select an existing project </h3>
    <table class="table table-striped table-bordered mb-5">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Project Id</th>
            <th scope="col">Project Name</th>
            <th scope="col">Client Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Desciption</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(is_array($result)){
            foreach($result as $row)
            {
                echo '<tr>
					<td>'.$row["id"].'</td>
					<td>'.$row["projectname"].'</td>
					<td>'.$row["clientname"].'</td>
					<td>'.$row["created_at"].'</td>
					<td>'.$row["description"].'</td>
					</tr>';
            }
        }
        ?>
        </tbody>
    </table>
    <form method ="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class = "form-size" id="select_project">
        <select  class="custom-select" name="projectid" id="projectid" >
            <?php
									if(is_array($result)){
            foreach($result as $row)
            {

            echo '<option value="'.$row['id'].'">'.$row['projectname'].'</option>';
            }
									}
								?>
        </select>
        <input type="submit" name="select" id="select" class="btn btn-success" value="Select Project" />

    </form>
    <p><p>

    <h3 class="text-center mb-3">Create a Project</h3>

    <form method="post" class="form-size" id="add_details">

        <div class="input-group mb-3">
            <div class="input-group-prepend flex-row">
                <label class="input-group-text p-2 font-weight-bold" for="projectname">Project Name</label>
            </div>
            <input type="text" name="projectname" id="projectname" class="form-control" placeholder="Project Name"
                   required />
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend flex-row">
                <label class="input-group-text p-2 font-weight-bold" for="clientname">Client's Name</label>
            </div>
            <input type="text" name="clientname" id="clientname" class="form-control" placeholder="Client's Name"
                   required />
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend flex-row">
                <label class="input-group-text p-2 font-weight-bold" for="description">Project's Description</label>
            </div>
            <input type="textarea" name="description" id="description" class="form-control"
                   placeholder="Description" required />
        </div>

        <div>
            <input type="submit" name="add" id="add" class="btn btn-success" value="Submit" />
            <p>
                <a href="projectStakeholders.php">Add stakeholders</a>
            </p>

        </div>
    </form>

    <div id="table_data" style="text-align: center; padding: 50px 0;"></div>

    <!-- footer -->
    <?php include( ROOT_PATH . '/includes/footer.php') ?>
    <!-- // footer -->
</body>

</html>

<script>
    $(document).ready(function () {

        //  $('#add_details').on('submit', function(event){
        //   event.preventDefault();
        //   $.ajax({
        //    type:"POST",
        //    data:$(this).serialize(),
        //    url:"insertProject.php",
        //    dataType:"json",
        //    beforeSend:function(){
        //     $('#add').attr('disabled', 'disabled');
        //     console.log('before');
        //    },
        //    success:function(data){
        //     $('#add').attr('disabled', false);
        //     console.log('in success');
        //     if(data.projectname)
        //     {
        //      var html = '<tr>';
        //      html += '<td>'+data.projectname+'</td>';
        //      html += '<td>'+data.description+'</td>';
        //      html += '<td>'+data.clientname+'</td></tr>';
        //      $('#table_data').prepend(html);
        //      $('#add_details')[0].reset();
        //     }
        //    },
        //   error: function(e) {
        // 	//called when there is an error
        // 	console.log(e.message);
        //   }
        //   })
        //  });

        $('#add_details').on('submit', function (event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var dataAll = $('#add_details').serializeArray();
            $.ajax({
                type: 'GET',
                url: 'insertProject.php',
                data: $('#add_details').serialize(),
                // dataType: 'json',
                success: function (response) {
                    console.log('success');
                    console.log(dataAll);
                    console.log(response);

                    if (dataAll[0]['value']) {
                        console.log('project active');
                        var html = '<h3><b>Project Created</b></h3>';
                        html += '<br><br>';
                        html += '<tr>';
                        html += '<td><b>' + dataAll[0]['name']  + ': </b></td>';
                        html += '<td>'    + dataAll[0]['value'] + '</td>';
                        html += '<br>';
                        html += '<td><b>' + dataAll[1]['name']  + ': </b></td>';
                        html += '<td>'    + dataAll[1]['value'] + '</td>';
                        html += '<br>';
                        html += '<td><b>' + dataAll[2]['name']  + ': </b></td>';
                        html += '<td>'    + dataAll[2]['value'] + '</td>';
                        html += '<br>';
                        $('#table_data').html(html);
                        $('#add_details')[0].reset();
                    }
                },

                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });

            return false;
        });
    });
</script>