<?php
require_once 'header.php';
require_once 'includes/add_user_functions.inc.php';
require_once 'includes/add_user_constants.inc.php';
?>

<!-- Start of Page Content -->

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Manage Parking Lot </h5>
                <hr>

                <!-- Form Items -->

                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="number_of_lots" placeholder="Number of Lots">
                    </div>
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="button">
                        <span class="text"> Create </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["button"])) {
    $result = false;

    if ($_POST["number_of_lots"] > 0) {
        //counting rows in table parking_spots
        $sql = "SELECT * FROM parking_spots";
        if ($result = mysqli_query($conn, $sql)) {
            $rowcount = mysqli_num_rows($result);
        }
        //if the user has entered more than the number of parking lots from the database
        if ($rowcount < $_POST["number_of_lots"]) {
            $needed_data = $_POST["number_of_lots"] - $rowcount;

            for ($x = 0; $x < $needed_data; $x += 1) {
                $sql = "insert into parking_spots(park_status)values('" . $_POST[""] . "')";
                $result = mysqli_query($conn, $sql);
            }
        }
        //if the user has entered less than the number of parking lots from the database
        else {
            $needed_data = $rowcount - $_POST["number_of_lots"];
            $sql = "DELETE FROM parking_spots ORDER BY park_id LIMIT $needed_data";
            $result = mysqli_query($conn, $sql);
        }
    }
    //if above operations succesful
    if ($result) {
?>
        <div class="col mb-3 text-success font-weight-bold text-center">
            Parking lots generated successfully
        </div>
    <?php
    } else {
    ?>
        <div class="col mb-3 text-danger font-weight-bold text-center">
            Please enter valid number
        </div>
<?php
    }
}
?>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>