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

                <h5 class="title text-center"> Create an Account </h5>
                <hr>

                <!-- Form Items -->

                <form action="includes/add_user_submit_form.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" placeholder="Email...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="phonenumber" placeholder="Phone number...">
                    </div>
                    <div class="form-group">
                        <div class="dropdown no-arrow mb-3">
                            <?php
                            $sql_department = "SELECT * FROM department";
                            $query_department = mysqli_query($conn, $sql_department);
                            ?>

                            <select class="btn btn-secondary dropdown-toggle" type="button" name="department" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <?php
                                    echo "<option class=\"dropdown-item\" value=\"" . DROPDOWN_NOT_CHOSEN . "\"> Choose a Department </option>";
                                    while ($row_department = mysqli_fetch_assoc($query_department)) {
                                        $department_name = $row_department["department_name"];
                                        echo "<option class=\"dropdown-item\" value=\"" . $department_name . "\">" . $department_name . "</option>";
                                    }
                                    ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="submit">
                        <span class="text"> Create </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Error Message Card -->

        <?php
        // Get the error string and show its message in a new card under the registeration form.

        $error_code = addUserErrorGetErrorCode();

        if (!is_null($error_code)) {
            $error_str = addUserErrorGetString($error_code);
            $error_str_color = "text-danger";

            if ($error_code == ERR_REG_NONE) {
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