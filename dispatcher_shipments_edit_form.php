<?php
include_once 'header.php';
require_once 'includes/dispatcher_shipments_functions.inc.php';
require_once 'includes/dispatcher_shipments_constants.inc.php';
?>

<!-- Start of Page Content -->

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Edit Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Update the Shipment Information </h5>
                <hr>

                <!-- Form Items -->

                <?php

                $sql_shipment = "SELECT * FROM vehicles WHERE waybill = " . $_GET["wid"];
                $query_shipment = mysqli_query($conn, $sql_shipment);
                $row_shipment = mysqli_fetch_assoc($query_shipment);

                ?>

                <form action="includes/dispatcher_shipments_edit_submit_form.inc.php?wid=<?php echo $_GET["wid"]; ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="waybill" placeholder="Waybill: <?php echo $row_shipment["waybill"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="company_name" placeholder="Company Name: <?php echo $row_shipment["company_name"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="plate_number" placeholder="Vehicle Plate Number: <?php echo $row_shipment["plate_number"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="trailer_number" placeholder="Vehicle Trailer Number: <?php echo $row_shipment["trailer_number"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="citizenship_no" placeholder="Driver Citizenship No: <?php echo $row_shipment["citizenship_no"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="driver_name" placeholder="Driver Name: <?php echo $row_shipment["driver_name"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="driver_surname" placeholder="Driver Surname: <?php echo $row_shipment["driver_surname"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="driver_language" placeholder="Driver Language: <?php echo $row_shipment["driver_language"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="phone_number" placeholder="Driver Phone number: <?php echo $row_shipment["phone_number"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="description" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <div class="dropdown no-arrow mb-3">
                            <?php
                            $sql_vehicle_types = "SELECT * FROM vehicle_types";
                            $query_vehicle_types = mysqli_query($conn, $sql_vehicle_types);
                            ?>

                            <select class="btn btn-secondary dropdown-toggle" type="button" name="vehicle_type_name" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <?php
                                    echo "<option class=\"dropdown-item\" value=\"" . DROPDOWN_NOT_CHOSEN . "\"> Choose a Vehicle Type </option>";
                                    while ($row_vehicle_types = mysqli_fetch_assoc($query_vehicle_types)) {
                                        $vehicle_type_name = $row_vehicle_types["vehicle_type_name"];
                                        echo "<option class=\"dropdown-item\" value=\"" . $vehicle_type_name . "\">" . $vehicle_type_name . "</option>";
                                    }
                                    ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="submit">
                        <span class="text"> Confirm </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Error Message Card -->

        <?php
        // Get the error string and show its message in a new card under the registeration form.

        $error_code = dispatcherErrorGetErrorCode();

        if (!is_null($error_code)) {
            $error_str = dispatcherErrorGetString($error_code);
            $error_str_color = "text-danger";

            if ($error_code == ERR_SHI_NONE) {
                $error_str_color = "text-success";
            }
        ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col text-center">
                            <?php
                            echo
                            "<div class=\"text-x font-weight-bold " . $error_str_color . " mb-1\">" .
                                $error_str .
                                "</div>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>