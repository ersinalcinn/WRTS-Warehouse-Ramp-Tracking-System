<?php

require_once 'connect_database.inc.php';
require_once 'user_profile_constants.inc.php';

// DESC: Checks if the given email is already used or not. Returns true if it's used or false if it's not.

function userProfileUsedEmail($conn, $email)
{
	$result = false;

	$sql_table_users = "users";
	$sql_col_email = "email";

	$sql = "SELECT " . $sql_col_email . " FROM " . $sql_table_users . " WHERE " . $sql_col_email . " = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		$result = true;
		return $result;
	}

	mysqli_stmt_bind_param($stmt, "s", $email);

	mysqli_stmt_execute($stmt);

	$query_result = mysqli_stmt_get_result($stmt);

	if (mysqli_fetch_assoc($query_result)) {
		$result = true;
	}

	mysqli_stmt_close($stmt);

	return $result;
}

// DESC: Returns the error code.

function userProfileErrorGetErrorCode()
{
	if (isset($_GET[ERR_NAME])) {
		return $_GET[ERR_NAME];
	}

	return NULL;
}

// DESC: Gets the string corresponding to the given error code. Returns the string of the error or NULL if the error code doesn't exist.

function userProfileErrorGetString($error_code)
{
	if (!is_null($error_code)) {
		if ($error_code == ERR_UPD_NONE) {
			return ERR_UPD_STR_NONE;
		} else if ($error_code == ERR_UPD_USEDEMAIL) {
			return ERR_UPD_STR_USEDEMAIL;
		}
	}

	return NULL;
}
