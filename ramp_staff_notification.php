<?php
require_once 'header.php';
?>

<!-- Start of Page Content -->

<div class="col-auto mb-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Notifications</h6>
        </div>

        <div class="card-body">

            <?php
            if ($_GET["delete_success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Notification Deleted Succesfully
                </div>
            <?php
            }
            if ($_GET["delete_success"] == 2){?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    Notification Could not Deleted
                </div>
            <?php
            }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Response</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "select * from ramp_staff_notifications WHERE ramp_staff_id = '" . $id . "';";
                    $res = mysqli_query($conn, $sql);
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $index += 1;
                        echo "<tr>";
                        echo "<td>" . $index . "</td>";

                        if($row["response_type"] == 1){
                            echo "<td> Vehicle with plate number '" . $row["vehicle_plate_number"] . "' is coming. </td>";
                        }
                        else{
                            echo "<td> Vehicle with plate number '" . $row["vehicle_plate_number"] . "' is not coming. </td>";
                        }

                        ?> 

                        <td> 
                            <a href="includes/delete_rampstaff_notification.inc.php?ID=<?php echo $row["notification_id"]; ?>" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>

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

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>

<!-- Bootstrap core JavaScript-->

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>