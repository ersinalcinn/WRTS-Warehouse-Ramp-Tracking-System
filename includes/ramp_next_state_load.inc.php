<?php 
require_once 'connect_database.inc.php';
$ramp_id=$_GET["ramp_id"];
$vehicle_id=$_GET["vehicle_id"];
$status=4;
$sql_vehicle_next_state_update = "UPDATE vehicles  SET  vehicle_status='$status' WHERE vehicle_id ='$vehicle_id' ";
mysqli_query($conn, $sql_vehicle_next_state_update);
header("location: ../ramp_list.php");


?>