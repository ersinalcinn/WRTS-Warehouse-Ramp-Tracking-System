<?php
require_once 'header.php';
require_once 'includes/add_ramp_constants.inc.php';
?>

<div class="row my-5 justify-content-center">
    <div class="col-lg-3">

        <!-- Registeration Form -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <!-- Title -->

                <h5 class="title text-center"> Update Ramp </h5>
                <hr>

                <!-- Form Items -->

                <?php

                $sql = "SELECT * FROM ramp where ramp_id = " . $_GET['ID'];
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);

                ?>

                <form action="includes/update_ramp_form_dispatcher.inc.php?ID=<?php echo $_GET["ID"]; ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="ramp_name" placeholder="<?php echo $row["ramp_name"]; ?>">
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