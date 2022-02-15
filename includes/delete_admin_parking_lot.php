<?php


require_once 'connect_database.inc.php';

$parkid=$_GET["parkid"];
$sql = "select * from parking_spots where park_id='$parkid' ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$parking_lot_id=$row['parking_lot_id'];

$sql_remove = "DELETE FROM parking_spots WHERE park_id = '$parkid'";
$query = mysqli_query($conn, $sql_remove);
    
if ($query) {

	header("location: ../admin_parking_lot_park.php?parkid=$parking_lot_id");
	exit();
}

header("location: ../admin_parking_lot_park.php?parkid=$parking_lot_id");
?>