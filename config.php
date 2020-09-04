<?php 

	if (isset($_GET['PHPSESSID'])) {
 		session_id($_GET['PHPSESSID']);
	}

	session_start();

	$conn = mysqli_connect("localhost", "root", "", "riskit");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
	
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/riskit/');

	

?>

