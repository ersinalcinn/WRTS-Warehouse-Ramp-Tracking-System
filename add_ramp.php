<?php
require_once 'header.php';
require_once 'includes/add_ramp_functions.inc.php';
require_once 'includes/add_ramp_constants.inc.php';
?>

<!-- Start of Page Content -->

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Create an Ramp </h5>
                <hr>

                <!-- Form Items -->

                <form action="includes/add_ramp_submit_form.inc.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="ramp_name" placeholder="Ramp Name">
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

        $error_code = addRampErrorGetErrorCode();

        if (!is_null($error_code)) {
            $error_str = addRampErrorGetString($error_code);
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