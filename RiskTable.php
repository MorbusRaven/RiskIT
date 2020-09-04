<?php require_once('config.php') ?>
<?php 
 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) and $_SESSION["loggedin"] == true) {
    header("location: login.php");
    exit;
}
?>
<?php
    $connect = new PDO("mysql:host=localhost;dbname=riskit", "root", "");
    $query = "SELECT * FROM risktable ORDER BY riskName";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
?>



<!DOCTYPE html>
<html>
    <head> 
        <title>Risk Table</title>
        <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include( ROOT_PATH . '/includes/navbar.php') ?>
        <div class="container-fluid" id="risk_table">
            
               <div class="container-fluid">
    <div class="logged_in_info">
        <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>

        <span><a href="logout.php">logout</a></span>
    </div>
                    

                        <h2 class="text-center mt-5">Risk Table</h2> 
                        <h3 class="text-center mb-3">Add Risks</h3>
                        <form method="post" class="form-size" id="add_details">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend flex-row">
                                <label class="input-group-text p-2 font-weight-bold" for="fullname">Your Name</label>
                            </div>
                            <input type="text" name="fullname" class="form-control" placeholder="e.x. John Doe" required />
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend flex-row">
                                <label class="input-group-text p-2 font-weight-bold" for="riskName">Risk Name</label>
                            </div>
                            <input type="text" name="riskName" id="riskName" class="form-control" placeholder="Risk Name" required />
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend flex-row">
                                <label class="input-group-text p-2 font-weight-bold" for="description">Description</label>
                            </div>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Description" required />
                        </div>
                        <div class="form-group flex-row">
                            <legend class="col-form-label font-weight-bold">Control Enviroment</legend>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="controlEnv" id="controlEnv1" class="custom-control-input" required <?php if (isset($controlEnv) && $controlEnv=="internal") echo "checked";?> value="internal" />
                                    <label class="custom-control-label" for="controlEnv1"> Internal</label>
                                </div>
                                
                                <div class="custom-control custom-radio custom-control-inline">    
                                    <input type="radio" name="controlEnv" id="controlEnv2" class="custom-control-input"  required <?php if (isset($controlEnv) && $controlEnv=="external") echo "checked";?> value="external" />
                                    <label class="custom-control-label" for="controlEnv2"> External </label>
                                </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend flex-row">
                                <label class="input-group-text p-2 font-weight-bold" for="riskCat">Risk Category:</label>
                            </div>
                            <input type="text" name="riskCat" class="form-control" placeholder="Risk Category" required />
                            
                        </div>
                        <fieldset class="form-group flex-row">
                            <legend class="col-form-label font-weight-bold">Risk Type</legend>
                            
                            <div class="custom-control custom-radio custom-control-inline">    
                                <input type="radio" name="rtype" id="rtype1" class="custom-control-input" required <?php if (isset($rtype) && $rtype=="threat") echo "checked";?> value="threat" />
                                <label class="custom-control-label" for="rtype1"> Threat</label>
                            </div>
                            
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="rtype" id="rtype2" class="custom-control-input" required <?php if (isset($rtype) && $rtype=="opportunity") echo "checked";?> value="opportunity" />
                                <label class="custom-control-label" for="rtype2">Opportunity</label>
                            </div>
                        </fieldset>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text p-2 font-weight-bold">Phase</label>
                            </div>
                            <input type="text" name="phase" class="form-control" placeholder="Phase" required />
                            
                        </div>     
                        <div>
                            <input type="submit" name="add" id="add" class="btn btn-success" value="Add" />
                        </div>
                    </form>
                   
               
                    <h3 class="text-center my-5">View Details</h3>
                    
                    <table class="table table-striped table-bordered mb-5">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Risk Name</th>
                                <th scope="col"> Description</th>
                                <th scope="col">Contol Enviroment</th>
                                <th scope="col">Risk Category</th>
                                <th scope="col">Risk Type</th>
                                <th scope="col">Phase</th>
                                <th scope="col">Creator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(is_array($result)){
                                foreach($result as $row)
                                {
                                    echo '<tr>
                                    <td>'.$row["riskName"].'</td>
                                    <td>'.$row["description"].'</td>
                                    <td>'.$row["controlEnv"].'</td>
                                    <td>'.$row["riskCat"].'</td>
                                    <td>'.$row["rtype"].'</td>
                                    <td>'.$row["phase"].'</td>
                                    <td>'.$row["fullname"].'</td>
                                    </tr>';  
                                }
                            }    
                            ?>
                        </tbody>
                    </table>
               <!-- <div class="clearfix"></div> -->
        </div>

<!-- footer -->
<?php include( ROOT_PATH . '/includes/footer.php') ?>
        <!-- // footer -->


        <script>
$(document).ready(function(){
 
 $('#add_details').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"insertRiskTable.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function(){
    $('#add').attr('disabled', 'disabled');
   },
   success:function(data){
    $('#add').attr('disabled', false);
    if(data.riskName)
    {
     var html = '<tr>';
     html += '<td>'+data.riskName+'</td>';
     html += '<td>'+data.description+'</td>';
     html += '<td>'+data.controlEnv+'</td>';
     html += '<td>'+data.riskCat+'</td>';
     html += '<td>'+data.rtype+'</td>';
     html += '<td>'+data.phase+'</td>';
     html += '<td>'+data.fullname+'</td></tr>';
     $('#table_data').prepend(html);
     $('#add_details')[0].reset();
    }
   }
  })
 });
 
});
</script>
