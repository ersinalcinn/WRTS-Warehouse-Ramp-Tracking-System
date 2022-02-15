<?php

require_once 'connect_database.inc.php';

$parkid = $_GET["parkid"];

if (isset($_POST["submit"])) {
	// Post from the register form.

	$vehicle_id = $_POST["department"];
	echo $vehicle_id;
	echo $parkid;
	
	$sql_user_update = "UPDATE parking_spots SET vehicle_id='$vehicle_id' , park_status='FULL' where park_id='$parkid'";
	mysqli_query($conn, $sql_user_update);
	
	
$sql = "UPDATE vehicles SET vehicle_status=3 where vehicle_id='$vehicle_id'";
mysqli_query($conn, $sql);
	
	$sql_parking_lot = "SELECT * FROM parking_spots where park_id='$parkid'";
       	$query_parking_lot = mysqli_query($conn, $sql_parking_lot);
       	while ($row_parking_lot = mysqli_fetch_assoc($query_parking_lot)) {
       		$index += 1;
			
       		$park_id = $row_parking_lot["parking_lot_id"];
       	}
		
	header("location: ../parking_spots.php?parkid=$park_id");
}
