<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->
<div class="col-auto mb-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Operations</h6>
        </div>

        <div class="card-body">
            <a href="add_user.php" class="btn btn-info btn-icon-split">

                <span class="text">Add User</span>
            </a>
        </div>
        <div class="card-body">

            <?php
            if ($_GET["success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    User Updated Succesfully
                </div>
            <?php
            }
            if ($_GET["success"] == 2){?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    User Could not Updated
                </div>
            <?php
            }
            ?>

            <?php
            if ($_GET["delete_success"] == 1){
            ?>
                <div class="col mb-3 text-success font-weight-bold text-center">
                    User Deleted Succesfully
                </div>
            <?php
            }
            if ($_GET["delete_success"] == 2){?>
                <div class="col mb-3 text-danger font-weight-bold text-center">
                    User Could not Deleted
                </div>
            <?php
            }
            ?>
                

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone Number</th>
                            <th>Department</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "select * from users";
                    $res = mysqli_query($conn, $sql);
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                       $index += 1;
                       echo "<tr>";
                       echo "<td>" . $index . "</td>";
                       echo "<td>" . $row["email"] . "</td>";
                       echo "<td>" . $row["password"] . "</td>";
                       echo "<td>" . $row["name"] . "</td>";
                       echo "<td>" . $row["surname"] . "</td>";
                       echo "<td>" . $row["phonenumber"] . "</td>";
                       $departmentn = $row["department_id"];
                       $sql2 = "select * from department where department_id = '$departmentn' ";
                       $res2 = mysqli_query($conn, $sql2);
                       $row2 = mysqli_fetch_assoc($res2);
                       echo "<td>" . $row2["department_name"] . "</td>";
                       echo "<td>"; ?> <a href="update_user_form.php?ID=<?php echo $row["user_id"]; ?>" class="btn btn-success btn-circle">
                        <i class="fas fa-fw fa-wrench"></i>
                        </a><?php
                        echo "<td>"; ?> <a href="includes/delete_user.inc.php?ID=<?php echo $row["user_id"]; ?>" class="btn btn-danger btn-circle">
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