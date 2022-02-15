<?php 
require_once 'connect_database.inc.php';
$ramp_id=$_GET["ramp_id"];
$status=$_GET["status"];

if($status==1)
{
	$ramp_state=2;
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
}

else if($status==2)
{
	$ramp_state=1;
	$sql_ramp_next_state_update = "UPDATE ramp  SET  ramp_states='$ramp_state' WHERE ramp_id ='$ramp_id' ";
	mysqli_query($conn, $sql_ramp_next_state_update);
}

else
{
    header("location: ../dispatcher_ramps.php?success=2");
	exit();
}

header("location: ../dispatcher_ramps.php?success=1");

?>