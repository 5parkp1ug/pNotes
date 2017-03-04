<?php
	include 'db-con.php';
	header('Content-Type: application/json');
	$email = $_REQUEST['email'];
	$pass = $_REQUEST['password'];
	$salt="@g26jQsG&nh*&#8v";
	$password=  sha1($pass.$salt);
	
	$response = array("status" => "FAILED", "email" => $email, "password" => $password);
	$query = "SELECT name,email,password,id FROM users WHERE email='$email'";
	$result = mysqli_query($connection, $query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_array($result)) {
			
			//$response['result'] = $row[0].$row[1].$row[2];
			
			if($row[2]==$password) {
				$response['status'] = "OK";
				$response['result'] = "Logged In Successfully";
				
				session_start();
				$_SESSION['login']=1;
				$_SESSION['user_id']=$row[4];	
				header('location:home.php');
			}
			
			else {
				$response['result'] =  "Login Failed";
			}
		}
	} 
	
	else {
		$response['result'] =  "Login Failed";
	}

	
	echo json_encode($response)
?>