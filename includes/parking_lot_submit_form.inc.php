<?php

require_once 'connect_database.inc.php';
require_once 'parking_lot_functions.inc.php';
require_once 'parking_lot_constants.inc.php';

if (isset($_POST["submit"])) {
	// Post from the register form.

	$parking_lot_name  = $_POST["parkinglotname"];
	$vehicle_type_name = $_POST["vehicletype"];

	if($vehicle_type_name == DROPDOWN_NOT_CHOSEN)
	{
		header("location: ../admin_parking_lot_create_park.php?" . ERR_VEH_NAME . "=" . ERR_VEH_EMPTYVEHTYPE);
		exit();
	}

	if(empty($parking_lot_name))
	{
		$parking_lot_name = NULL;
	}
	else
	{
		$sql_parking_lot = "SELECT * FROM parking_lot WHERE parking_lot_name = '" . $parking_lot_name . "'";
		$query_parking_lot = mysqli_query($conn, $sql_parking_lot);

		if (mysqli_fetch_assoc($query_parking_lot)) 
		{
			header("location: ../admin_parking_lot_create_park.php?" . ERR_VEH_NAME . "=" . ERR_VEH_USEDNAME);
			exit();
		}
	}

	$sql_vehicle_type_id = "SELECT * FROM vehicle_types WHERE vehicle_type_name = '" . $vehicle_type_name . "'";
	$query_vehicle_types = mysqli_query($conn, $sql_vehicle_type_id);
	$row_vehicle_types   = mysqli_fetch_assoc($query_vehicle_types);

	$vehicle_type_id = $row_vehicle_types["vehicle_type_id"];

	// Create the account

	parkingLotCreateParkingLot($conn, $parking_lot_name, $vehicle_type_id);

	header("location: ../admin_parking_lot_create_park.php?" . ERR_VEH_NAME . "=" . ERR_VEH_NONE);
} else {
	header("location: ../admin_parking_lot_create_park.php");
}
