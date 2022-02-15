<?php

require_once 'user_profile_constants.inc.php';
require_once 'user_profile_functions.inc.php';

if (isset($_POST["submit"])) {
	$email 		   = $_POST["email"];
	$firstname 	   = $_POST["firstname"];
	$lastname 	   = $_POST["lastname"];
	$phonenumber   = $_POST["phonenumber"];
	$password 	   = $_POST["password"];

	if (empty($email) && empty($firstname) && empty($lastname) && empty($password) && empty($phonenumber)) {
		header("location: ../user_profile.php?ID=" . $_GET["ID"]);
		exit();
	}

	if (userProfileUsedEmail($conn, $email) !== false) {
		header("location: ../user_profile.php?" . ERR_NAME . "=" . ERR_UPD_USEDEMAIL . "&ID=" . $_GET["ID"]);
		exit();
	}

	$sql_user_update_cols = "";
	$comma_needed = false;

	if (!empty($email)) {
		$sql_user_update_cols .= " email = '" . $email . "'";
		$comma_needed = true;
	}
	if (!empty($password)) {
		if ($comma_needed == true) {
			$sql_user_update_cols .= ",";
		}

		$sql_user_update_cols .= " password = '" . $password . "'";
		$comma_needed = true;
	}
	if (!empty($firstname)) {
		if ($comma_needed == true) {
			$sql_user_update_cols .= ",";
		}

		$sql_user_update_cols .= " name = '" . $firstname . "'";
		$comma_needed = true;
	}
	if (!empty($lastname)) {
		if ($comma_needed == true) {
			$sql_user_update_cols .= ",";
		}

		$sql_user_update_cols .= " surname = '" . $lastname . "'";
		$comma_needed = true;
	}
	if (!empty($phonenumber)) {
		if ($comma_needed == true) {
			$sql_user_update_cols .= ",";
		}

		$sql_user_update_cols .= " phonenumber = '" . $phonenumber . "' ";
		$comma_needed = true;
	}

	$sql_user_update = "UPDATE users SET" . $sql_user_update_cols . "WHERE user_id = " . $_GET["ID"];
	mysqli_query($conn, $sql_user_update);

	header("location: ../user_profile.php?" . ERR_NAME . "=" . ERR_UPD_NONE . "&ID=" . $_GET["ID"]);
} else {
	header("location: ../user_profile.php?ID=" . $_GET["ID"]);
}
