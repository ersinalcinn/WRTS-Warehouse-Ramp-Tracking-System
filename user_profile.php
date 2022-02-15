<?php
include_once 'header.php';
require_once 'includes/user_profile_functions.inc.php';
require_once 'includes/user_profile_constants.inc.php';
?>

<!-- Start of Page Content -->

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> User Profile </h5>
                <hr>

                <!-- Form Items -->

                <?php
                $sql_user = "SELECT * FROM users WHERE user_id = " . $_SESSION["ID"];
                $query_user = mysqli_query($conn, $sql_user);
                $row_user = mysqli_fetch_assoc($query_user);
                ?>

                <form action="includes/user_profile_update_form.inc.php?ID=<?php echo $_SESSION["ID"]; ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" disabled placeholder="<?php  echo "Email : " . $row_user["email"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="password" placeholder="<?php  echo "Password : " . $row_user["password"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="firstname" placeholder="<?php  echo "Name : " . $row_user["name"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="lastname" placeholder="<?php  echo "Surname : " . $row_user["surname"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="phonenumber" placeholder="<?php  echo "Phone Number : " . $row_user["phonenumber"]; ?>">
                    </div>
                    <hr>

                    <!-- Submit Button -->

                    <button type="submit" class="btn btn-success btn-block" name="submit">
                        <span class="text"> Update </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Error Message Card -->

        <?php
        // Get the error string and show its message in a new card under the registeration form.

        $error_code = userProfileErrorGetErrorCode();

        if (!is_null($error_code)) {
            $error_str = userProfileErrorGetString($error_code);
            $error_str_color = "text-danger";

            if ($error_code == ERR_UPD_NONE) {
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