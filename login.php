<?php
	include 'db-con.php';
	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $_REQUEST['email'];
		$pass = $_REQUEST['password'];
		$salt="@g26jQsG&nh*&#8v";
		$password=  sha1($pass.$salt);
		$query = "SELECT name,email,password,id FROM users WHERE email='$email' AND password='$password'";
		$result = mysqli_query($connection, $query);
		$response = array("status" => "FAILED", "email" => $email, "password" => $password);
		if (mysqli_num_rows($result)) {
			$response['status'] = "OK";
			$response['result'] = "Logged In Successfully";
			$user = mysqli_fetch_assoc($result);
			session_start();
			$_SESSION['email'] = $user["email"];
			setcookie('email', $user["email"]);
			$_SESSION['name'] = $user["name"];
			setcookie('name', $user["name"]);
			echo json_encode($response);
		} else {
			$response['result'] = "Invalid ID";
			echo json_encode($response);
		}
	}