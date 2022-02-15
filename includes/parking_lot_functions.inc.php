<?php

require_once 'parking_lot_constants.inc.php';

// DESC: Creates a new parking lot with the given information in the database.

function parkingLotCreateParkingLot($conn, $parking_lot_name, $vehicle_type_id)
{
	$sql_table_parking_lot    = "parking_lot";
	$sql_col_parking_lot_name = "parking_lot_name";
	$sql_col_vehicle_type_id  = "vehicle_type_id";

	$sql = "";

	if($parking_lot_name == NULL)
	{
		$parking_lot_name = "NULL";
	}

	$sql = "INSERT INTO " . $sql_table_parking_lot . " (" . $sql_col_parking_lot_name . ", " . $sql_col_vehicle_type_id . ") VALUES (?, ?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../admin_parking_lot_create_park.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "si", $parking_lot_name, $vehicle_type_id);

	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

// DESC: Returns the error code.

function parkingLotErrorGetErrorCode()
{
	if (isset($_GET[ERR_VEH_NAME])) {
		return $_GET[ERR_VEH_NAME];
	}

	return NULL;
}

// DESC: Gets the string corresponding to the given error code. Returns the string of the error or NULL if the error code doesn't exist.

function parkingLotErrorGetString($error_code)
{
	if (!is_null($error_code)) {
		if ($error_code == ERR_VEH_NONE) {
			return ERR_VEH_STR_NONE;
		} 
		else if ($error_code == ERR_VEH_EMPTYVEHTYPE) {
			return ERR_VEH_STR_EMPTYVEHTYPE;
		} 
		else if ($error_code == ERR_VEH_USEDNAME) {
			return ERR_VEH_STR_USEDNAME;
		} 
	}

	return NULL;
}
