<?php

require_once 'connect_database.inc.php';
require_once 'add_user_functions.inc.php';

if (isset($_POST["submit"])) {
	$email 		   = $_POST["email"];
	$firstname 	   = $_POST["firstname"];
	$lastname 	   = $_POST["lastname"];
	$phonenumber   = $_POST["phonenumber"];
	$password 	   = $_POST["password"];
	$department    = $_POST["department"];

	if (empty($email) && empty($firstname) && empty($lastname) && empty($password) && empty($phonenumber) && $department == DROPDOWN_NOT_CHOSEN) {
		header("location: ../admin_users.php?success=0");
		exit();
	}

	if (addUserUsedEmail($conn, $email) != false) {
		header("location: ../admin_users.php?success=2");
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
	if (!($department == DROPDOWN_NOT_CHOSEN)) {
		// Query the department id

		$sql_dep_id = "SELECT * FROM department WHERE department_name = '" . $department . "'";
		$query_department = mysqli_query($conn, $sql_dep_id);
		$row_department = mysqli_fetch_assoc($query_department);

		$department_id = $row_department["department_id"];

		if ($comma_needed == true) {
			$sql_user_update_cols .= ",";
		}

		$sql_user_update_cols .= " department_id = '" . $department_id . "' ";
		$comma_needed = true;
	}


	$sql_user_update = "UPDATE users SET" . $sql_user_update_cols . "WHERE user_id = " . $_GET["ID"];
	mysqli_query($conn, $sql_user_update);

	header("location: ../admin_users.php?success=1");
} else {
	header("location: ../admin_users.php?success=2");
}
