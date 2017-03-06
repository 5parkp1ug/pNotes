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
			$notebook_id = $response['notebook_id'] = $_REQUEST['notebook_id'];
			//get notes
			$notes = array();
			$query = "select note_table_name from notebooks_info where notebook_id = '$notebook_id'";
			$query_result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			$note_table_name = mysqli_fetch_assoc($query_result)['note_table_name'];
			$query = "select note_name, note_text from $note_table_name;";
			$query_result = mysqli_query($connection, $query) or die(mysqli_error($connection));
			


			while($note = mysqli_fetch_assoc($query_result))
				$notes[] = $note;
			$response['notes'] = $notes;
			echo json_encode($response);
		}
	}