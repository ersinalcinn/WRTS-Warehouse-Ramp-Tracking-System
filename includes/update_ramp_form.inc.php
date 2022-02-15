<?php

require_once 'connect_database.inc.php';
require_once 'add_ramp_functions.inc.php';

if (isset($_POST["submit"])) {
	$ramp_name = $_POST["ramp_name"];

	if (empty($ramp_name)) {
		header("location: ../admin_ramps.php");
		exit();
	}

	if (addRampUsedName($conn, $ramp_name) != false) {
		header("location: ../admin_ramps.php?success=2");
		exit();
	}

	$sql_user_update_cols = "";
	$comma_needed = false;

	if (!empty($ramp_name)) {
		$sql_user_update_cols .= " ramp_name = '" . $ramp_name . "'";
		$comma_needed = true;
	}

	$sql_user_update = "UPDATE ramp SET" . $sql_user_update_cols . "WHERE ramp_id = " . $_GET["ID"];
	mysqli_query($conn, $sql_user_update);

	header("location: ../admin_ramps.php?success=1");
} else {
	header("location: ../admin_ramps.php?success=2");
}
