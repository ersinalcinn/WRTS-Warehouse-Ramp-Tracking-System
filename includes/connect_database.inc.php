<?php

// Database Login Data

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName 	= "wrts";

// Database Connection

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if ($conn == false)
{
	die("DB connection failed: " . mysqli_connect_error());
}