<?php
require_once 'header.php';
?>

<!-- Start of Page Content -->

<div class="col-auto mb-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ramp Operations</h6>
        </div>

        <div class="card-body">
            <a href="add_ramp.php" class="btn btn-info btn-icon-split">
                <span class="text">Add Ramp</span>
            </a>
        </div>

        <div class="card-body">

        <?php
            if ($_GET["success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Ramp Updated Succesfully
                </div>
            <?php
            }
            if ($_GET["success"] == 2){?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    Ramp Name Already Taken
                </div>
            <?php
            }
            ?>

            <?php
            if ($_GET["delete_success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    Ramp Deleted Succesfully
                </div>
            <?php
            }
            if ($_GET["delete_success"] == 2){?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    Ramp Could not Deleted
                </div>
            <?php
            }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ramp Number</th>
                            <th>Ramp Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "select * from ramp";
                    $res = mysqli_query($conn, $sql);
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $index += 1;
                        echo "<tr>";
                        echo "<td>" . $index . "</td>";
                        echo "<td>" . $row["ramp_name"] . "</td>";
                        echo "<td>"; ?> <a href="update_ramp_form.php?ID=<?php echo $row["ramp_id"]; ?>" class="btn btn-success btn-circle">
                            <i class="fas fa-fw fa-wrench"></i>
                            </a><?php
                            echo "<td>"; ?> <a href="includes/delete_ramp.inc.php?ID=<?php echo $row["ramp_id"]; ?>" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                                </a><?php
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