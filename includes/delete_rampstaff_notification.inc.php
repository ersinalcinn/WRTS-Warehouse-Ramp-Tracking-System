<?php

require_once 'connect_database.inc.php';

$id = $_GET['ID'];
$sql = "DELETE FROM ramp_staff_notifications WHERE notification_id = " . $id;

$query = mysqli_query($conn, $sql);

if ($query) {
	header("location: ../ramp_staff_notification.php?delete_success=1");
	exit();
}

header("location: ../ramp_staff_notification.php?delete_success=2");
