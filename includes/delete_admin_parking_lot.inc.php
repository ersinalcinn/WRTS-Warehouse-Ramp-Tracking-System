<?php


require_once 'connect_database.inc.php';

$parkid=$_GET["parkid"];
$sql = "SELECT * FROM parking_spots where park_id='$parkid' ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$parking_lot_id=$row['parking_lot_id'];
$vehicle_id=$row['vehicle_id'];

if($vehicle_id != NULL){
	$sql_vehicle_status_update = "UPDATE vehicles SET vehicle_status = 2 WHERE vehicle_id = '$vehicle_id' ";
	mysqli_query($conn, $sql_vehicle_status_update);
}

$sql_remove = "DELETE FROM parking_spots WHERE park_id = '$parkid'";
$query = mysqli_query($conn, $sql_remove);
    
if ($query) {

	header("location: ../admin_parking_lot_park.php?parkid=$parking_lot_id&delete_success=1");
	exit();
}

header("location: ../admin_parking_lot_park.php?parkid=$parking_lot_id&delete_success=2");
?>