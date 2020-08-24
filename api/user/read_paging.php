<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/project.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and project object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$project = new project($db);
  
// query project
$stmt = $project->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // project array
    $projects_arr=array();
    $projects_arr["records"]=array();
    $projects_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['username'] to
        // just $username only
        extract($row);
  
        $project_item=array(
            "id" => $id,
            "username" => $username,
            "password" => $password,
            "fullname" => $fullname,
            "project_id" => $project_id,
            "project_username" => $project_username
        );
  
        array_push($project_arr["records"], $project_item);
    }
  
  
    // include paging
    $total_rows=$project->count();
    $page_url="{$home_url}project/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $project_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($project_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user project does not exist
    echo json_encode(
        array("message" => "No project found.")
    );
}
?>