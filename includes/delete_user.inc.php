<?php

require_once 'connect_database.inc.php';

$id = $_GET['ID'];

$sql1 = "select * from ramp where user_id = " . $id;
$res = mysqli_query($conn, $sql1);

while ($row = mysqli_fetch_assoc($res)){
	$sql_user_id_update = "UPDATE ramp SET  user_id = NULL WHERE user_id = " . $id;
	mysqli_query($conn, $sql_user_id_update);
}

$sql = "DELETE FROM users WHERE user_id = " . $id;
$query = mysqli_query($conn, $sql);

if ($query) {
	header("location: ../admin_users.php?delete_success=1");
	exit();
}

header("location: ../admin_users.php?delete_success=2");
