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

	echo json_encode($response)
?>