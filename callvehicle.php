<?php session_start();
include 'includes/connect_database.inc.php';
$id = $_SESSION["ID"]; ?>
<?php
$rampid = $_GET["ramp_id"];
$sql = mysqli_query($conn, "SELECT * FROM parking_spots");

$datas = array();


$sql2 = "SELECT * FROM parking_spots WHERE park_status = 'FULL'";
$sorgu = mysqli_query($conn, $sql2);
if ($dizi = mysqli_fetch_array($sorgu)) {
  $first = $dizi['vehicle_id'];
  $sql5 = "UPDATE parking_spots SET park_status='NULL', vehicle_id=NULL     WHERE vehicle_id='$first'";
  if ($conn->query($sql5) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }

  $sql2 = "UPDATE vehicles SET vehicle_status='PROCESS' WHERE vehicle_id='$first'";
  if ($conn->query($sql2) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }

  $sql4 = "UPDATE ramp SET vehicleID='$first'  WHERE ramp_id='$rampid'";
  if ($conn->query($sql4) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }

  $sql5 = "UPDATE parking_spots SET vehicle_id=NULL WHERE park_id='$first'";
  if ($conn->query($sql5) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
  header("location:ramp_list.php");
} else {
}

?>
