<?php

require_once 'connect_database.inc.php';

if(isset($_POST["submit"]))
{
	$ramp_staff_id = $_POST["rid"];
	$ramp_staff_name = $_POST["rname"];
	$vehicle_id = $_POST["vid"];
	$vehicle_plate_number = $_POST["vplate"];

	$sql = "INSERT INTO security_notifications (notification_id, ramp_staff_id, ramp_staff_name, vehicle_id, vehicle_plate_number) VALUES (NULL, '" . $ramp_staff_id . "', '" . $ramp_staff_name . "', '" . $vehicle_id . "', '" . $vehicle_plate_number . "');";
	$res = mysqli_query($conn, $sql);
}

header("location: ../ramp_staff_notify_security_list.php?" . $sql);
exit();