<?php 
require_once 'connect_database.inc.php';
$ramp_id=$_GET["ramp_id"];

$sql_ramp_faulty_report = "UPDATE ramp  SET  ramp_states=1 WHERE ramp_id ='$ramp_id' ";
mysqli_query($conn, $sql_ramp_faulty_report);
header("location: ../ramp_list.php");

?>