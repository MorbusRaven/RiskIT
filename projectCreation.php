<?php require_once('config.php') ?>
<?php

// Check if the user is logged in, if not then redirect him to login page

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
        <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
        |
        <span><a href="logout.php">logout</a></span>
    </div>
    <h2 class="text-center mt-5">Project Create</h2>
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