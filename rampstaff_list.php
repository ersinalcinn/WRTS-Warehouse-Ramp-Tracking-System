<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ramp Staff List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>e-Mail</th>
                        <th>Phone Number</th>
                        <th>Assign</th>
                    </tr>
                </thead>
                <?php

                $ramp_id=$_GET['ramp_id'];
                $sql = "select * from users where department_id='4'";
                $res = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($res)){
                    $state_id  = $row["vehicle_status"];
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["surname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    echo "<td>"; ?> <a href="dispatcher_ramps.php?ramp_success=1&ramp_id=<?php echo $ramp_id; ?>&user_id=<?php echo $row['user_id']; ?>" class="btn btn-success btn-circle"> <i class="fas fa-check"></i></a><?php
                    mysqli_close($conn);
                }
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

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>