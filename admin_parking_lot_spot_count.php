<?php
include_once 'header.php';
$parking_lot_id=$_GET["parkid"];
?>
<!-- Start of Page Content -->

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Change  Parking Lot Spot Count </h5>
                <hr>

                <!-- Form Items -->

                <form action="includes/parking_lot_change_count_form.inc.php?parkid=<?php echo $parking_lot_id; ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="parkinglotcount" placeholder="Enter a number of parking lot...">
                    </div>
                   
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="submit">
                        <span class="text"> Create </span>
                    </button>
                </form>
            </div>
        </div>

        
        
    </div>
</div>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>