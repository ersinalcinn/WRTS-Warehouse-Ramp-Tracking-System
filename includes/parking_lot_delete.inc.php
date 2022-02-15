<?php

require_once 'connect_database.inc.php';

$parkid=$_GET["parkid"];

$sql = "select * from parking_spots ";
$res = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM parking_spots WHERE parking_lot_id = '$parkid'";
$res2 = mysqli_query($conn, $sql2);
while($row2 = mysqli_fetch_assoc($res2)){
	$vehicle_id=$row2['vehicle_id'];

	if($vehicle_id != NULL){
		$sql_vehicle_status_update = "UPDATE vehicles SET vehicle_status = 2 WHERE vehicle_id = '$vehicle_id' ";
		mysqli_query($conn, $sql_vehicle_status_update);
	}
}

while ($row = mysqli_fetch_assoc($res)) {
	$sql_remove = "DELETE FROM parking_spots WHERE parking_lot_id = '$parkid'";
	$query = mysqli_query($conn, $sql_remove);
}

$sql1 = "DELETE FROM parking_lot WHERE parking_lot_id = '$parkid'";
$query1 = mysqli_query($conn, $sql1);
if ($query1) {

	header("location: ../admin_parking_lot.php?success=1");
	exit();
}

header("location: ../admin_parking_lot.php?success=2");