<?php
$connection = mysqli_connect("localhost", "root", "toor");
echo "DB not found, creating database!"."<br/>";
mysqli_connect("localhost", "root", "toor") or die(mysqli_connect_error());
$query = "CREATE DATABASE pnotes;";
mysqli_query($connection, $query) or die(mysqli_error($connection));
$query = "use pnotes;";
mysqli_query($connection, $query) or die(mysqli_error($connection));
$query = "CREATE TABLE users(id int auto_increment primary key, name VARCHAR(30), email VARCHAR(30) UNIQUE, password VARCHAR(30))";
mysqli_query($connection, $query) or die(mysqli_error($connection));
echo "Database initialized";