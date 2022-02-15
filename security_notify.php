<?php
require_once 'includes/connect_database.inc.php';

if($_GET["ID"] != NULL && $_GET["resp"] != NULL){
    $sql = "SELECT * from security_notifications WHERE notification_id='".$_GET["ID"]."'";
    $res = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($res)){
        $ramp_staff_id = $row["ramp_staff_id"];
        $vehicle_id = $row["vehicle_id"];
        $vehicle_plate_number = $row["vehicle_plate_number"];
        $resp = $_GET["resp"];

        $sql = "INSERT INTO ramp_staff_notifications (ramp_staff_id, vehicle_id, vehicle_plate_number, response_type) VALUES ('$ramp_staff_id', '$vehicle_id', '$vehicle_plate_number', '$resp')";
        $res = mysqli_query($conn, $sql);

        $sql = "DELETE from security_notifications WHERE notification_id='".$_GET["ID"]."'";
        $res = mysqli_query($conn, $sql);
    }
    header('Location: ./security_notify.php');
    exit();
}

require_once 'header.php';

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-auto mb-3">
            <div class="card-body">
                </a>
            </div>
        </div>
    </div>
    <div class="col-auto mb-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Notification List</h6>

            </div>
             <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Notification </th>
                        <th>Wait</th>
                        <th>Don't Wait</th>

                         </tr>
                </thead>

                <?php
                $sql_sec_notif = "select * from security_notifications";
                $res_sec_notif = mysqli_query($conn, $sql_sec_notif);
                $index = 0;

                while ($row_sec_notif = mysqli_fetch_assoc($res_sec_notif)) {
                    $sql_spot = "select * from parking_spots where vehicle_id=". $row_sec_notif["vehicle_id"];
                    $res_spot = mysqli_query($conn, $sql_spot);
                    $row_spot = mysqli_fetch_assoc($res_spot);

                    $sql_lot = "select * from parking_lot where parking_lot_id =". $row_spot["parking_lot_id"];
                    $res_lot = mysqli_query($conn, $sql_lot);
                    $row_lot = mysqli_fetch_assoc($res_lot);

                    $index += 1;

                    echo "<tr>";
                   
                    echo 
                    "<td>" . 
                    	$row_sec_notif["ramp_staff_name"] . ": ".$row_sec_notif["vehicle_plate_number"] ." did not come to the ramp after the call. Parking Lot: ".$row_lot["parking_lot_name"] . 
                    "</td>";

                    echo 
                    "<td>
                    	<a href=\"security_notify.php?ID=".$row_sec_notif["notification_id"]."&resp=1\" class=\"btn btn-success btn-circle\">
                    		<i class=\"fas fa-check-circle\"></i>
                    	</a>
                    </td>";

                    echo 
                    "<td>
                    	<a href=\"security_notify.php?ID=".$row_sec_notif["notification_id"]."&resp=0\" class=\"btn btn-danger btn-circle\">
                    		<i class=\"fas fa-times-circle\"></i>
                    	</a>
                    </td>";

                    echo "</tr>";
                    
                    ?> 
                   
                       </i>
                    </a>

                    <?php
                 
                    }
                    mysqli_close($conn);

					?>

                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
</div>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>