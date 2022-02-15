<?php

require_once 'connect_database.inc.php';

if (isset($_POST["submit"])) {
	$arrival_time 		   = $_POST["arrival_time"];
	$departure_time 	   = $_POST["departure_time"];
	$department    = $_POST["department"];
	$vehicle_id= $_GET["ID"];
	
	if (empty($arrival_time) && empty($departure_time)) {
		$sql_user_update = "UPDATE vehicles SET   vehicle_status='$department' where vehicle_id='$vehicle_id'";
		mysqli_query($conn, $sql_user_update);
	}
	if (empty($arrival_time)) {
		$sql_user_update = "UPDATE vehicles SET  departure_time='$departure_time' , vehicle_status='$department' where vehicle_id='$vehicle_id'";
		mysqli_query($conn, $sql_user_update);
	}
	if (empty($departure_time)) {
		$sql_user_update = "UPDATE vehicles SET arrival_time='$arrival_time'  , vehicle_status='$department' where vehicle_id='$vehicle_id'";
		mysqli_query($conn, $sql_user_update);
	}
	
	

	header("location: ../vehicle_list.php");
} else {
	header("location: ../vehicle_list.php");
}
