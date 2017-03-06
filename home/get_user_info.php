<?php
	session_start();

	if (!isset($_SESSION['email'])) 
			header('location:index.php');
	
	else {
		include '../db-con.php';
		header('Content-Type: application/json');
		
		$response = array('status' => "OK");
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$user_id = $_COOKIE["id"];
			$response['user_id'] = $user_id;
			//get notebook
			$notebooks = array();
			$query = "select notebook_id, notebook_name, note_table_name from notebooks_info where user_id='$user_id'";
			$query_result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			while($notebook = mysqli_fetch_assoc($query_result))
				$notebooks[] = $notebook;
			$response['notebooks'] = $notebooks;
			echo json_encode($response);
		}
	}