<?php

require_once 'connect_database.inc.php';
require_once 'dispatcher_shipments_functions.inc.php';
require_once 'dispatcher_shipments_constants.inc.php';

// Check if the user entered the submission page legally. If not send the user to shipment registration page.

if (isset($_POST["submit"])) {

	// Post from the register form.

	$waybill           = $_POST["waybill"];
	$company_name      = $_POST["company_name"];
	$plate_number      = $_POST["plate_number"];
	$trailer_number    = $_POST["trailer_number"];
	$citizenship_no    = $_POST["citizenship_no"];
	$driver_name       = $_POST["driver_name"];
	$driver_surname    = $_POST["driver_surname"]; 
	$driver_language   = $_POST["driver_language"]; 
	$phone_number      = $_POST["phone_number"];
	$vehicle_type_name = $_POST["vehicle_type_name"];

	// Check if there is an empty input.

	if (($err = dispatcherRequiredInputEmpty($waybill, $vehicle_type_name)) !== ERR_SHI_NONE) {
		header("location: ../dispatcher_shipments_create_shipment.php?" . ERR_SHI_NAME . "=" . $err);
		exit();
	}

	// Check if the waybill is taken

	if(dispatcherWaybillTaken($conn, $waybill) == true)
	{
		header("location: ../dispatcher_shipments_create_shipment.php?" . ERR_SHI_NAME . "=" . ERR_SHI_WAYBILLTAKEN);
		exit();
	}

	// Get the vehicle type id

	$sql_vehicle_type_id = "SELECT * FROM vehicle_types WHERE vehicle_type_name = '" . $vehicle_type_name . "'";
	$query_vehicle_types = mysqli_query($conn, $sql_vehicle_type_id);
	$row_vehicle_types   = mysqli_fetch_assoc($query_vehicle_types);

	$vehicle_type_id = $row_vehicle_types["vehicle_type_id"];

	// Create the shipment

	dispatcherCreateShipment($conn, $waybill, $company_name, $plate_number, $trailer_number, $citizenship_no, $driver_name, $driver_surname, $driver_language, $phone_number, $vehicle_type_id);

	header("location: ../dispatcher_shipments_create_shipment.php?" . ERR_SHI_NAME . "=" . ERR_SHI_NONE);
} else {
	header("location: ../dispatcher_shipments.php");
}
