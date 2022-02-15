<?php

require_once 'connect_database.inc.php';
require_once 'add_ramp_functions.inc.php';
require_once 'add_ramp_constants.inc.php';

// Check if the user entered the submission page legally. If not send the user to register page.

if (isset($_POST["submit"])) {
	// Post from the register form.

	$ramp_name 	= $_POST["ramp_name"];

	// Check if there is an empty input.

	if (addRampEmptyInput($ramp_name) !== false) {
		header("location: ../add_ramp.php?" . ERR_NAME . "=" . ERR_REG_EMPTYINPUT);
		exit();
	}

	// Check if there is an account with the same email address.

	if (addRampUsedName($conn, $ramp_name) !== false) {
		header("location: ../add_ramp.php?" . ERR_NAME . "=" . ERR_REG_USEDRAMPNAME);
		exit();
	}

	// Create the account

	createRamp($conn, $ramp_name);

	header("location: ../add_ramp.php?" . ERR_NAME . "=" . ERR_REG_NONE);
} else {
	header("location: ../add_ramp.php");
}
