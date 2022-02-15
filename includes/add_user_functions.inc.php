<?php

require_once 'add_user_constants.inc.php';

// DESC: Checks if the given inputs are empty or not. Returns true if there is an empty input and returns false if the inputs are not empty.

function addUserEmptyInput($email, $firstname, $lastname, $password, $phonenumber, $department)
{
	$result=true;

	if (empty($email) || empty($firstname) || empty($lastname) || empty($password) || empty($phonenumber) || $department == DROPDOWN_NOT_CHOSEN) {
		$result = true;
	} else {
		$result = false;
	}

	return $result;
}

// DESC: Checks if the given email is already used or not. Returns true if it's used or false if it's not.

function addUserUsedEmail($conn, $email)
{
	$result = false;

	$sql_table_users = "users";
	$sql_col_email = "email";

	$sql = "SELECT email FROM users WHERE email = '" . $email . "';";

	$query = mysqli_query($conn, $sql);

	if (mysqli_fetch_assoc($query)) {
		$result = true;
	}

	return $result;
}

// DESC: Checks if the given email doesn't exist. Returns true if it doesn't exist or false otherwise.

function addUserInvalidEmail($email)
{
	$result = false;

	return $result;
}

// DESC: Creates a string that contains a randomly generated password with the given password size. Returns the password string.

function addUserPasswordGen($password_size)
{
	$password = "";

	for ($i = 0; $i < $password_size; $i++) {
		$rand_num = rand(1, 3);

		if ($rand_num == 1) $password .= chr(rand(65, 90));  //A-Z
		elseif ($rand_num == 2) $password .= chr(rand(97, 122)); //a-z
		elseif ($rand_num == 3) $password .= chr(rand(48, 57));  //0-9
	}

	return $password;
}

// DESC: Creates a new account with the given information in the database.

function addUserCreateAccount($conn, $email, $password, $firstname, $lastname, $phonenumber, $department_id)
{
	$sql_table_users  	   = "users";
	$sql_col_email 	  	   = "email";
	$sql_col_password 	   = "password";
	$sql_col_name 		   = "name";
	$sql_col_surname 	   = "surname";
	$sql_col_phonenumber   = "phonenumber";
	$sql_col_department_id = "department_id";

	$sql = "INSERT INTO " . $sql_table_users . " (" . $sql_col_email . ", " . $sql_col_password . ", " . $sql_col_name . ", " . $sql_col_surname . ", " . $sql_col_phonenumber . ", " . $sql_col_department_id . ") VALUES (?, ?, ?, ?, ?, ?);";

	// Secure way of doing SQL queries. But the statement cannot be prepared for some reason.

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../add_user.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "sssssi", $email, $password, $firstname, $lastname, $phonenumber, $department_id);

	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

// DESC: Returns the error code.

function addUserErrorGetErrorCode()
{
	if (isset($_GET[ERR_NAME])) {
		return $_GET[ERR_NAME];
	}

	return NULL;
}

// DESC: Gets the string corresponding to the given error code. Returns the string of the error or NULL if the error code doesn't exist.

function addUserErrorGetString($error_code)
{
	if (!is_null($error_code)) {
		if ($error_code == ERR_REG_NONE) {
			return ERR_REG_STR_NONE;
		} else if ($error_code == ERR_REG_EMPTYINPUT) {
			return ERR_REG_STR_EMPTYINPUT;
		} else if ($error_code == ERR_REG_USEDEMAIL) {
			return ERR_REG_STR_USEDEMAIL;
		} else if ($error_code == ERR_REG_INVALIDEMAIL) {
			return ERR_REG_STR_INVALIDEMAIL;
		}
	}

	return NULL;
}
