<?php
require_once 'header.php';
?>

<!-- Start of Page Content -->

<div class="container-fluid">

    <!-- Buttons -->

    <div class="row">

        <!-- Manage Ramp Button -->

        <div class="col-auto mb-3">
            <div class="card-body">
                

                <a href="includes/parking_lot_change_count_form.inc.php?parkid=<?php echo $_GET["parkid"]; ?>" class="btn btn-success btn-icon-split">
               
                    <span class="text">Add a Parking Spot</span>
                </a>
            </div>
        </div>

        <!-- Delete Parking Lot Button -->

        <div class="col-auto mb-3">
            <div class="card-body">
                <?php
                echo "<a href=\"includes/parking_lot_delete.inc.php?parkid=" . $_GET["parkid"] . "\" class=\"btn btn-danger btn-icon-split\">";
                ?>
                    <span class="text">Delete the Parking Lot</span>
                </a>
            </div>
        </div>

    </div>

    <?php
    if ($_GET["success"] == 1){
    ?>
        <div class="col mb-3 text-success font-weight-bold text-center">
            Parking Spot Added Succesfully
        </div>
    <?php
    }
    if ($_GET["success"] == 2){?>
        <div class="col mb-3 text-danger font-weight-bold text-center">
            Parking Spot Could not Added
        </div>
    <?php
    }
    ?>
    <?php
    if ($_GET["delete_success"] == 1){
    ?>
        <div class="col mb-3 text-success font-weight-bold text-center">
            Parking Spot Deleted Succesfully
        </div>
    <?php
    }
    if ($_GET["delete_success"] == 2){?>
        <div class="col mb-3 text-danger font-weight-bold text-center">
            Parking Spot Could not Deleted
        </div>
    <?php
    }
    ?>

    <!-- Parking Spot List -->

    <div class="col-auto mb-3">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Parking Spots</h6>

            </div>
             <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Spot Number</th>
                        <th>Spot Name</th>
                        <th>Spot Status</th>
                        <th>Plate Number</th>
                        <th>Trailer Number</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <?php
                $parking_spots_id=$_GET["parkid"];
                $sql = "select * from parking_spots where parking_lot_id='$parking_spots_id' ";
                $res = mysqli_query($conn, $sql);
                $sql2 = "select * from parking_lot where parking_lot_id = '$parking_spots_id' ";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);
                $index = 0;

                while ($row = mysqli_fetch_assoc($res)) {
                    $index += 1;
                    echo "<tr>";
                    echo "<td>" . $index . "</td>";
                    if($row2["parking_lot_name"] == "NULL")
                    {
                        echo "<td>Parking Spot " . $index . "</td>";
                    }
                    else
                    {
                        echo "<td>" . $row2["parking_lot_name"] . "</td>";
                    }

                    if($row["park_status"] == "NULL")
                    {
                        echo "<td>" . "-" . "</td>";;
                    }
                    else
                    {
                        echo "<td>" . $row["park_status"] . "</td>";
                    }
                    
                    $veh_id=$row["vehicle_id"];
                    $sql3 = "select * from vehicles where vehicle_id = '$veh_id' ";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    echo "<td>" . $row3["plate_number"] . "</td>";
                    echo "<td>" . $row3["trailer_number"] . "</td>";
                    echo "<td>"; ?> <a href="includes/delete_admin_parking_lot.inc.php?parkid=<?php echo $row["park_id"]; ?>" class="btn btn-danger btn-circle">
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
</div>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>