<?php

require_once 'connect_database.inc.php';
require_once 'add_user_functions.inc.php';
require_once 'add_user_constants.inc.php';

// Check if the user entered the submission page legally. If not send the user to register page.

if (isset($_POST["submit"])) {
	// Post from the register form.

	$email 		     = $_POST["email"];
	$firstname 	     = $_POST["firstname"];
	$lastname 	     = $_POST["lastname"];
	$phonenumber     = $_POST["phonenumber"];
	$department_name = $_POST["department"];
	$password 	     = addUserPasswordGen(8);

	// Check if there is an empty input.

	if (addUserEmptyInput($email, $firstname, $lastname, $password, $phonenumber, $department_name) !== false) {
		header("location: ../add_user.php?" . ERR_NAME . "=" . ERR_REG_EMPTYINPUT);
		exit();
	}

	// Check if there is an account with the same email address.

	if (addUserUsedEmail($conn, $email) !== false) {
		header("location: ../add_user.php?" . ERR_NAME . "=" . ERR_REG_USEDEMAIL);
		exit();
	}

	// Check if the email address is not valid.

	if (addUserInvalidEmail($email) !== false) {
		header("location: ../add_user.php?" . ERR_NAME . "=" . ERR_REG_INVALIDEMAIL);
		exit();
	}

	// Query the department id

	$sql_dep_id = "SELECT * FROM department WHERE department_name = '" . $department_name . "'";
	$query_department = mysqli_query($conn, $sql_dep_id);
	$row_department = mysqli_fetch_assoc($query_department);

	$department_id = $row_department["department_id"];

	// Create the account

	addUserCreateAccount($conn, $email, $password, $firstname, $lastname, $phonenumber, $department_id);

	header("location: ../add_user.php?" . ERR_NAME . "=" . ERR_REG_NONE);
} else {
	header("location: ../add_user.php");
}
