<?php

require_once 'connect_database.inc.php';
require_once 'dispatcher_shipments_constants.inc.php';

// DESC: Checks the required inputs

function dispatcherRequiredInputEmpty($waybill, $vehicle_type_name)
{
	if(empty($waybill))
	{
		return ERR_SHI_EMPTYWAYBILL;
	}
	if($vehicle_type_name == DROPDOWN_NOT_CHOSEN)
	{
		return ERR_SHI_EMPTYVEHTYPE;
	}

	return ERR_SHI_NONE;
}

// DESC: Checks if the waybill has already been taken

function dispatcherWaybillTaken($conn, $waybill)
{
	$result = false;

	$sql_table_vehicles = "vehicles";
	$sql_col_waybill = "waybill";

	$sql = "SELECT " . $sql_col_waybill . " FROM " . $sql_table_vehicles . " WHERE " . $sql_col_waybill . " = ?;";

    $query = mysqli_query($conn, $sql);
    
    $res = mysqli_fetch_assoc($query);
    
	if (mysqli_fetch_assoc($res)) {
		$result = true;
	}

	return $result;
}

// DESC: Creates a new shipment with the given information in the database.

function dispatcherCreateShipment($conn, $waybill, $company_name, $plate_number, $trailer_number, $citizenship_no, $driver_name, $driver_surname, $driver_language, $phone_number, $vehicle_type_id)
{
	$vehicle_status = "1";

	// Sql columns string

	$sql_shipment_insert_cols = "";
	$comma_needed = false;

	if (!empty($vehicle_type_id)) {
		$sql_shipment_insert_cols .= "vehicle_type_id";
		$comma_needed = true;
	}
	if (!empty($company_name)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "company_name";
		$comma_needed = true;
	}
	if (!empty($waybill)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "waybill";
		$comma_needed = true;
	}
	if (!empty($plate_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "plate_number";
		$comma_needed = true;
	}
	if (!empty($trailer_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "trailer_number";
		$comma_needed = true;
	}
	if (!empty($driver_name)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "driver_name";
		$comma_needed = true;
	}
	if (!empty($driver_surname)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "driver_surname";
		$comma_needed = true;
	}
	if (!empty($driver_language)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "driver_language";
		$comma_needed = true;
	}
	if (!empty($phone_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "phone_number";
		$comma_needed = true;
	}
	if (!empty($citizenship_no)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_cols .= ",";
		}

		$sql_shipment_insert_cols .= "citizenship_no";
		$comma_needed = true;
	}

	if ($comma_needed == true) {
		$sql_shipment_insert_cols .= ",";
	}

	$sql_shipment_insert_cols .= "vehicle_status";
	$comma_needed = true;

	// Sql values string

	$sql_shipment_insert_values = "";
	$comma_needed = false;

	if (!empty($vehicle_type_id)) {
		$sql_shipment_insert_values .= "'" . $vehicle_type_id . "'";
		$comma_needed = true;
	}
	if (!empty($company_name)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $company_name . "'";
		$comma_needed = true;
	}
	if (!empty($waybill)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $waybill . "'";
		$comma_needed = true;
	}
	if (!empty($plate_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $plate_number . "'";
		$comma_needed = true;
	}
	if (!empty($trailer_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $trailer_number . "'";
		$comma_needed = true;
	}
	if (!empty($driver_name)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $driver_name . "'";
		$comma_needed = true;
	}
	if (!empty($driver_surname)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $driver_surname . "'";
		$comma_needed = true;
	}
	if (!empty($driver_language)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $driver_language . "'";
		$comma_needed = true;
	}
	if (!empty($phone_number)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $phone_number . "'";
		$comma_needed = true;
	}
	if (!empty($citizenship_no)) {
		if ($comma_needed == true) {
			$sql_shipment_insert_values .= ",";
		}

		$sql_shipment_insert_values .= "'" . $citizenship_no . "'";
		$comma_needed = true;
	}

	if ($comma_needed == true) {
		$sql_shipment_insert_values .= ",";
	}

	$sql_shipment_insert_values .= "'" . $vehicle_status . "'";
	$comma_needed = true;


	$sql = "INSERT INTO vehicles (" . $sql_shipment_insert_cols . ") VALUES (" . $sql_shipment_insert_values . ")";

	$query = mysqli_query($conn, $sql);
}

// DESC: Returns the error code.

function dispatcherErrorGetErrorCode()
{
	if (isset($_GET[ERR_SHI_NAME])) {
		return $_GET[ERR_SHI_NAME];
	}

	return NULL;
}

// DESC: Gets the string corresponding to the given error code. Returns the string of the error or NULL if the error code doesn't exist.

function dispatcherErrorGetString($error_code)
{
	if (!is_null($error_code)) {
		if ($error_code == ERR_SHI_NONE) {
			return ERR_SHI_STR_NONE;
		} 
		else if ($error_code == ERR_SHI_EMPTYVEHTYPE) {
			return ERR_SHI_STR_EMPTYVEHTYPE;
		}
		else if ($error_code == ERR_SHI_EMPTYWAYBILL) {
			return ERR_SHI_STR_EMPTYWAYBILL;
		}
		else if ($error_code == ERR_SHI_WAYBILLTAKEN) {
			return ERR_SHI_STR_WAYBILLTAKEN;
		}
	}

	return NULL;
}
