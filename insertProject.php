<?php 
	// variable declaration
	$projectname = "";
	$clientname = "";
	$projectname    = "";
	$errors = array(); 

	// REGISTER project
	if (isset($_POST['project_create'])) {
		// receive all input values from the form
		$projectname = esc($_POST['projectname']);
		$projectname = esc($_POST['projectname']);
		$clientname = esc($_POST['clientname']);
		

		// Ensure that no project is registered twice. 
		// the clientname and projectnames should be unique
		$project_check_query = "SELECT * FROM projects WHERE projectname='$projectname'  LIMIT 1";

		$result = mysqli_query($conn, $project_check_query);
		$project = mysqli_fetch_assoc($result);
		
		 // if project exists
			if ($project['projectname'] === $projectname) {
			  array_push($errors, "Project name already exists");
			}
	
		
		// register project if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO projects (projectname, clientname, description, created_at)
					  VALUES('projectname', 'clientname', 'description', now(), )";
			mysqli_query($conn, $query);

			// get id of created project
			$reg_project_id = mysqli_insert_id($conn); 

			// put logged in project into session array
			$_SESSION['project'] = getProjectById($reg_project_id);

			
	

	

		$_SESSION["project"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["projectname"] = $projectname;
        
		
		if (empty($errors)) {
		
			$sql = "SELECT * FROM project WHERE projectname='$projectname'  LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				// get id of created project
				$reg_project_id = mysqli_fetch_assoc($result)['id']; 

				// put logged in project into session array
				$_SESSION['project'] = getProjectById($reg_project_id); 

				
				if ( ($_SESSION['project'])) {
					$_SESSION['message'] = "You are now logged in";
					// redirect to public area
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Wrong credentials');
			}
		}
	}
	// escape value from form
	function esc(String $value)
	{	
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get project info from project id
	function getProjectById($id)
	{
		global $conn;
		$sql = "SELECT * FROM projects WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$project = mysqli_fetch_assoc($result);

		
		return $project; 
	}
?>