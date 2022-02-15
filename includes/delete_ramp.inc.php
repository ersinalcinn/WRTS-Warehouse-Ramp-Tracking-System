<?php

require_once 'connect_database.inc.php';

$id = $_GET['ID'];
$sql = "DELETE FROM ramp WHERE ramp_id = " . $id;

$query = mysqli_query($conn, $sql);

if ($query) {
	header("location: ../admin_ramps.php?delete_success=1");
	exit();
}

header("location: ../admin_ramps.php?delete_success=2");
