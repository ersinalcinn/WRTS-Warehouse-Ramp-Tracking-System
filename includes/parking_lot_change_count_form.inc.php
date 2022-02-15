<?php

require_once 'connect_database.inc.php';
$parkid=$_GET["parkid"];

$sql="select * from  parking_lot  where parking_lot_id='$parkid'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$type= $row["vehicle_type_id"];


$sqladd="insert into parking_spots(park_status,vehicle_type_id,parking_lot_id) 
VALUES ('NULL','$type','$parkid')";
$res = mysqli_query($conn, $sqladd);
if ($res==0)
     header("location: ../admin_parking_lot_park.php?parkid=$parkid&success=2");
else
     header("location: ../admin_parking_lot_park.php?parkid=$parkid&success=1");

	

 
	

