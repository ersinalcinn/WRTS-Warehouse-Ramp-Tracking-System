<?php

require_once 'connect_database.inc.php';
require_once 'dispatcher_shipments_functions.inc.php';

if (isset($_POST["submit"])) {
	$waybill 		   = $_POST["waybill"];
	$company_name 	   = $_POST["company_name"];
	$plate_number 	   = $_POST["plate_number"];
	$trailer_number    = $_POST["trailer_number"];
	$citizenship_no    = $_POST["citizenship_no"];
	$driver_name       = $_POST["driver_name"];
	$driver_surname    = $_POST["driver_surname"];
	$driver_language   = $_POST["driver_language"];
	$phone_number      = $_POST["phone_number"];
	$description       = $_POST["description"];
	$vehicle_type_name = $_POST["vehicle_type_name"];

	if (empty($waybill) && empty($company_name) && empty($plate_number) && empty($trailer_number) && 
		empty($citizenship_no) && empty($driver_name) && empty($driver_surname) && empty($driver_language) && 
		empty($phone_number) && empty($description) && $vehicle_type_name == DROPDOWN_NOT_CHOSEN) {
		header("location: ../dispatcher_shipments_details.php?wid=" . $_GET["wid"]);
		exit();
	}

	if (dispatcherWaybillTaken($conn, $waybill) != false) {
		header("location: ../dispatcher_shipments_details.php?success=2&wid=" . $_GET["wid"]);
		exit();
	}

	$sql_shipment_update_cols = "";
	$comma_needed = false;
	$new_waybill = false;

	if (!empty($waybill)) {
		$sql_shipment_update_cols .= " waybill = '" . $waybill . "'";
		$comma_needed = true;
		$new_waybill = true;
	}
	if (!empty($company_name)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " company_name = '" . $company_name . "'";
		$comma_needed = true;
	}
	if (!empty($plate_number)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " plate_number = '" . $plate_number . "'";
		$comma_needed = true;
	}
	if (!empty($trailer_number)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " trailer_number = '" . $trailer_number . "'";
		$comma_needed = true;
	}
	if (!empty($citizenship_no)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " citizenship_no = '" . $citizenship_no . "' ";
		$comma_needed = true;
	}
	if (!empty($driver_name)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " driver_name = '" . $driver_name . "' ";
		$comma_needed = true;
	}
	if (!empty($driver_surname)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " driver_surname = '" . $driver_surname . "' ";
		$comma_needed = true;
	}
	if (!empty($driver_language)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " driver_language = '" . $driver_language . "' ";
		$comma_needed = true;
	}
	if (!empty($phone_number)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " phone_number = '" . $phone_number . "' ";
		$comma_needed = true;
	}
	if (!empty($description)) {
		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " description = '" . $description . "' ";
		$comma_needed = true;
	}
	if (!($vehicle_type_name == DROPDOWN_NOT_CHOSEN)) {
		// Query the vehicle type id

		$sql_type_id = "SELECT * FROM vehicle_types WHERE vehicle_type_name = '" . $vehicle_type_name . "'";
		$query_type = mysqli_query($conn, $sql_type_id);
		$row_type = mysqli_fetch_assoc($query_type);

		$vehicle_type_id = $row_type["vehicle_type_id"];

		if ($comma_needed == true) {
			$sql_shipment_update_cols .= ",";
		}

		$sql_shipment_update_cols .= " vehicle_type_id = '" . $vehicle_type_id . "' ";
		$comma_needed = true;
	}

	$sql_shipment_update = "UPDATE vehicles SET" . $sql_shipment_update_cols . "WHERE waybill = '" . $_GET["wid"] . "'";
	mysqli_query($conn, $sql_shipment_update);

	if($new_waybill == true)
	{
		header("location: ../dispatcher_shipments_details.php?success=1&wid=" . $waybill);
		exit();
	}

	header("location: ../dispatcher_shipments_details.php?success=1&wid=" . $_GET["wid"]);
} else {
	header("location: ../dispatcher_shipments_details.php?success=2&wid=" . $_GET["wid"]);
}
