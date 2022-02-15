<?php
require_once 'header.php';
?>

<!-- Start of Page Content -->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ramp Operations</h6>
        </div>
        <div class="card-body">

        <?php
            if ($_GET["success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Ramp state changed succesfully
                </div>
            <?php
            }
            ?>
            <?php
            if ($_GET["success"] == 2){
            ?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    Ramp is currently in use
                </div>
            <?php
            }
            ?>

            <?php
            if ($_GET["update_success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Ramp updated succesfully
                </div>
            <?php
            }
            ?>
            <?php
            if ($_GET["update_success"] == 2){
            ?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    Ramp name already taken
                </div>
            <?php
            }
            ?>

            <?php
            if ($_GET["ramp_success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Ramp Staff Appointed Succesfully
                </div>
            <?php
            }
            ?>
            
            <?php
                $ramp_id=$_GET["ramp_id"];
                $user_id=$_GET["user_id"];
                $sql_user_id_update = "UPDATE ramp SET  user_id='$user_id' WHERE ramp_id ='$ramp_id' ";
	            mysqli_query($conn, $sql_user_id_update);
            ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ramp Number</th>
                            <th>Ramp Name</th>
                            <th>Ramp Staff Name</th>
                            <th>Ramp State</th>
                            <th>Edit</th>
                            <th>Change Ramp State</th>
                            <th>Add Ramp Staff</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "select * from ramp";
                    $res = mysqli_query($conn, $sql);
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $user_id = $row['user_id'];
                        $index += 1;
                        echo "<tr>";
                        echo "<td>" . $index . "</td>";
                        echo "<td>" . $row["ramp_name"] . "</td>";

                        $sql2 = "SELECT * from users where user_id='$user_id' ";
						$res2 = mysqli_query($conn, $sql2);
						$row2 = mysqli_fetch_array($res2);
                        echo "<td>" . $row2['name'], ' ', $row2['surname']. "</td>";
                        
                        $ramp_state_id = $row['ramp_states'];
                        $sql1 = "SELECT * from ramp_states where ramp_state_id='$ramp_state_id' ";
						$res1 = mysqli_query($conn, $sql1);
						$row1 = mysqli_fetch_array($res1);
						echo '<td>' . $row1['ramp_state_name'] . '</td>';

                        echo "<td>"; ?> <a href="update_ramp_form_dispatcher.php?ID=<?php echo $row["ramp_id"]; ?>" class="btn btn-success btn-circle">
                            <i class="fas fa-fw fa-wrench"></i>
                        </a><?php
                        echo "<td>"; ?> <a href="./includes/dispatcher_change_ramp_state.inc.php?ramp_id=<?php echo $row['ramp_id']; ?>&status=<?php echo $row['ramp_states']; ?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50"> <i class="fas fa-exclamation-triangle"></i></span>
                            <span class="text">Change Ramp State</span></a>
                        <?php
                        echo "<td>"; ?> <a href="rampstaff_list.php?ramp_id=<?php echo $row['ramp_id']; ?>" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                        <span class="text">Add Ramp Staff</span></a>
                        <?php
                        }
                        mysqli_close($conn);
                            ?>
                    </tbody>
                </table>
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