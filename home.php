<?php
	session_start();
	if (!isset($_SESSION['email'])) 
		header('location:index.php');
	else
		include 'home/index.php';
?>
