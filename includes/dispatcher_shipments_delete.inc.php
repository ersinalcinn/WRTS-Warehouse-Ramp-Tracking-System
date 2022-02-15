<?php

require_once 'connect_database.inc.php';

$wid = $_GET["wid"];
$sql = "DELETE FROM vehicles WHERE waybill = '" . $wid . "'";

$query = mysqli_query($conn, $sql);

if ($query) {
	header("location: ../dispatcher_shipments.php?delete=1");
	exit();
}

header("location: ../dispatcher_shipments.php?delete=2");