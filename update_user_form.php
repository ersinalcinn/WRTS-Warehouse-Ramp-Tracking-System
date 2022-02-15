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

                <h5 class="title text-center"> Update the Account </h5>
                <hr>

                <!-- Form Items -->

                <?php

                $sql = "SELECT * FROM users where user_id = " . $_GET['ID'];
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);

                ?>

                <form action="includes/update_user_form.inc.php?ID=<?php echo $_GET["ID"]; ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" placeholder="<?php echo "Email - " . $row["email"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="password" placeholder="<?php echo "Password - " . $row["password"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="firstname" placeholder="<?php echo "Name - " . $row["name"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="lastname" placeholder="<?php echo "Surname - " . $row["surname"]; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="phonenumber" placeholder="<?php echo "Phone Number - " . $row["phonenumber"]; ?>">
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