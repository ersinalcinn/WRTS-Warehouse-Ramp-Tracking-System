<?php 
require_once 'connect_database.inc.php';
$ramp_id=$_GET["ramp_id"];
$vehicle_id=$_GET["vehicle_id"];
$status=$_GET["status"];
if($status==0)
{
	$state=7;
	$ramp_state=2;
	$sql_vehicle_next_state_update = "UPDATE vehicles  SET  vehicle_status='$state' WHERE vehicle_id ='$vehicle_id' ";
	mysqli_query($conn, $sql_vehicle_next_state_update);
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state', vehicle_id=NULL WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
	
}
else if($status==1)
{
	$ramp_state=2;
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
}
else if($status==2)
{
	$state=6;
	$ramp_state=4;
	$sql_vehicle_next_state_update = "UPDATE vehicles  SET  vehicle_status='$state' WHERE vehicle_id ='$vehicle_id' ";
	mysqli_query($conn, $sql_vehicle_next_state_update);
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state', vehicle_id='$vehicle_id' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
}
else if($status==3)
{
	$state=4;
	$ramp_state=3;
	$sql_vehicle_next_state_update = "UPDATE vehicles  SET  vehicle_status='$state' WHERE vehicle_id ='$vehicle_id' ";
	mysqli_query($conn, $sql_vehicle_next_state_update);
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state', vehicle_id='$vehicle_id' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
	$sql_parking_spots_clear = "UPDATE parking_spots  SET  park_status='NULL', vehicle_id=NULL WHERE vehicle_id ='$vehicle_id' ";
	mysqli_query($conn, $sql_parking_spots_clear);
}
else if($status==4)
{
	$faulty_ramp_id=$_GET["faulty_ramp_id"];
	$sql1 = "SELECT * from ramp where ramp_id='$faulty_ramp_id' ";
	$sorgu1 = mysqli_query($conn, $sql1);
	$dizi1 = mysqli_fetch_array($sorgu1);
	$ramp_faulty_id=$dizi1['vehicle_id'];
	$ramp_faulty_states=$dizi1['ramp_states'];
	
	
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_faulty_states', vehicle_id='$ramp_faulty_id' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
	$sql_ramp_faulty_report = "UPDATE ramp  SET  ramp_states=1, vehicle_id=NULL WHERE ramp_id ='$faulty_ramp_id' ";
	mysqli_query($conn, $sql_ramp_faulty_report);
	
}
header("location: ../ramp_list.php");
?>