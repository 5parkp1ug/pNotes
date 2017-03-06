<?php 
	include 'db-con.php';
	header('Content-Type: application/json');
	$response = array('status' => 'FAILED');
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    	$response['message'] = "This method is not allowed";
		echo json_encode($response);
		exit();
	}
	if (!isset($_REQUEST['name']) || $_REQUEST['name'] === '') {
		$response['message'] = "params not received";
		echo json_encode($response);
		exit();
	}
	$name = ($_REQUEST['name']);
	$email = ($_REQUEST['email']);
	$pass = ($_REQUEST['password']);

	//salting of password
	$salt="@g26jQsG&nh*&#8v";
	$password=  sha1($pass.$salt);
	$login_url = "<a href='/index.php?email=$email'>here</a>";
	$query = "insert into users (name,email,password) values('$name', '$email', '$password');";

	if (mysqli_query($connection, $query)) {
	    	$response['status'] = 'OK';
	    	$response['message'] = "Registration Successful. Click $login_url to continue to login.";
	    	$response['name'] = $name;
	    	$response['email'] = $email;

	} else {
		$response['error'] = mysqli_error($connection);
		$response['number'] = mysqli_errno($connection);

		if (mysqli_errno($connection) == '1062'){
			//duplicate entry
			$response['error'] = "Email Exists";
		}
	}

	//Find the last max id value which is the last user who registered
	$query = "select max(id) from users;";
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	$max_id = mysqli_fetch_assoc($result);
	$max_user_id = $max_id['max(id)'];
	$response['created-user-id'] = $max_user_id;
	
	//create a table for default notebook for the user to store notes
	$default_notebook_name = md5("$max_user_id"."Default");
	$query = "CREATE TABLE $default_notebook_name(note_id int auto_increment primary key, note_text VARCHAR(100))";
	if (mysqli_query($connection, $query)) {
	    	$response['notebook-table-create-flag'] = 'OK';

	}
	else {
		$response['notebook-table-create-flag'] = 'FAILED';		
	}

	// update the notebooks-info table
	
	$query = "insert into notebooks_info (user_id, notebook_name, notebook_table_name) values($max_user_id, 'Default', '$default_notebook_name');";
	if (mysqli_query($connection, $query)) {
	    $response['notebooks-add-entry'] = 'OK';

	}
	else {
		$response['notebooks-add-entry'] = 'FAILED';		
	}


	//create a default note for the user
	$query = "insert into $default_notebook_name (note_text) values ('This is a test Post');";
	if (mysqli_query($connection, $query)) {
	    	$response['create-first-note'] = 'OK';

	}
	else {
		$response['create-first-note'] = 'FAILED';		
	}
	
	echo json_encode($response)
?>
