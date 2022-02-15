<?php

require_once 'add_ramp_constants.inc.php';

// DESC: Checks if the given inputs are empty or not. Returns true if there is an empty input and returns false if the inputs are not empty.

function addRampEmptyInput($ramp_name)
{
	$result = true;

	if (empty($ramp_name)) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

// DESC: Checks if the given ramp name is already used or not. Returns true if it's used or false if it's not.

function addRampUsedName($conn, $ramp_name)
{
	$result = false;

	$sql = "SELECT ramp_name FROM ramp WHERE ramp_name = '" . $ramp_name . "';";

	$query = mysqli_query($conn, $sql);

	if (mysqli_fetch_assoc($query)) {
		$result = true;
	}

	return $result;
}

// DESC: Creates a new account with the given information in the database.

function createRamp($conn, $ramp_name)
{
	$sql_table_users  	   = "ramp";

	$sql = "INSERT INTO " . $sql_table_users . " (ramp_name, ramp_states) VALUES (?, '2');";
	
	// Secure way of doing SQL queries. But the statement cannot be prepared for some reason.

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../add_ramp.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "s", $ramp_name);

	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}


// DESC: Returns the error code.

function addRampErrorGetErrorCode()
{
	if (isset($_GET[ERR_NAME])) {
		return $_GET[ERR_NAME];
	}

	return NULL;
}

// DESC: Gets the string corresponding to the given error code. Returns the string of the error or NULL if the error code doesn't exist.

function addRampErrorGetString($error_code)
{
	if (!is_null($error_code)) {
		if ($error_code == ERR_REG_NONE) {
			return ERR_REG_STR_NONE;
		} else if ($error_code == ERR_REG_EMPTYINPUT) {
			return ERR_REG_STR_EMPTYINPUT;
		} else if ($error_code == ERR_REG_USEDRAMPNAME) {
			return ERR_REG_STR_USEDRAMPNAME;
		}
	}

	return NULL;
}
