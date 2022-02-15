<?php
session_start();
include 'includes/connect_database.inc.php';
$id = $_SESSION["ID"];
$sql = "SELECT * from users where user_id='$id'";
$sorgu = mysqli_query($conn, $sql);
$dizi = mysqli_fetch_array($sorgu);
$departman_id = $dizi["departman_id"];

$sql = "select * from department WHERE department_id = '$department_id'";
$sorgu = mysqli_query($conn, $sql);
$dizi = mysqli_fetch_array($sorgu);
$department = $dizi["department_name"];
