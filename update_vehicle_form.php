<?php
require_once 'header.php';
require_once 'includes/add_user_constants.inc.php';
?>

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Update the Vehicle Information </h5>
                <hr>

                <!-- Form Items -->

                <?php

                $sql = "SELECT * FROM vehicles where vehicle_id = " . $_GET['vehicle_id'];
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);

                ?>

                <form action="includes/update_vehicle_form.inc.php?ID=<?php echo $_GET["vehicle_id"]; ?>" method="post">
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="name" disabled placeholder="<?php echo "Name - " . $row["driver_name"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="surname" disabled placeholder="<?php echo "Surname - " . $row["driver_surname"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="language" disabled placeholder="<?php echo "Languange - " . $row["driver_language"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="citizenship_no" disabled placeholder="<?php echo "Citizenship No - " . $row["citizenship_no"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="phone_number" disabled placeholder="<?php echo "Phone Number - " . $row["phone_number"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="plate_number" disabled placeholder="<?php echo "Plate Number - " . $row["plate_number"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="trailer_number" disabled placeholder="<?php echo "Trailer Number - " . $row["trailer_number"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="company_name" disabled placeholder="<?php echo "Company Name - " . $row["company_name"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="waybill" disabled placeholder="<?php echo "Waybill - " . $row["waybill"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="arrival_time" placeholder="<?php echo "Arrival Time - " . $row["arrival_time"]; ?>">
                    </div>
					<div class="form-group">
                        <input type="text" class="form-control form-control-user" name="departure_time" placeholder="<?php echo "Departure Time - " . $row["departure_time"]; ?>">
                    </div>
                    <div class="form-group">
                        <div class="dropdown no-arrow mb-3">
                            <?php
                            $sql_department = "SELECT * FROM vehicle_states";
                            $query_department = mysqli_query($conn, $sql_department);
                            ?>

                            <select class="btn btn-secondary dropdown-toggle" type="button" name="department" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <?php
									
                                    echo "<option class=\"dropdown-item\" value=\"" . DROPDOWN_NOT_CHOSEN . "\"> Choose a State </option>";
                                    while ($row_department = mysqli_fetch_assoc($query_department)) {
                                        $department_name = $row_department["vehicle_state_name"];
										$department_id = $row_department["vehicle_state_id"];
                                        echo "<option class=\"dropdown-item\" value=\"" . $department_id . "\">" . $department_name . "</option>";
                                    }
                                    ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="submit">
                        <span class="text"> Update </span>
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