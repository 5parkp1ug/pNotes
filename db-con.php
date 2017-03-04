<?php
$connection = mysqli_connect("localhost", "root", "toor", "pnotes");
if (!$connection) {
	include 'db-init.php';
}