<?php 
session_start();
include 'includes/connect_database.inc.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> WRTS</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/fav.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container-fluid bg-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 login-card">
                    <div class="row">

                        <div class="col-md-7 logn-part">
                            <div class="row">
                                <div class="col-lg-10 col-md-12 mx-auto">
                                    <div class="logo-cover">
                                        <img src="assets/images/logo.png" alt="">
                                    </div>
                                    <div class="form-cover">
                                        <form action="" method="post">
                                            <h5 style="text-align:center;">Forget Password</h5>
                                            <h6 style="margin-top:80px;">Email</h6>
                                            <input placeholder="Enter Username" type="text" class="form-control" name="email">


                                            <div class="row form-footer">


                                                <div class="col-md-6 button-div">

                                                    <button style="margin-left:110px;" name="buton" class="btn btn-primary">Send</button>


                                                </div>

                                            </div>
                                        </form>
                                        <?php


                                        if (isset($_POST["email"])) {
                                            $email = $_POST["email"];


                                            $sql = "SELECT * from users where email='$email' ";
                                            $sorgu = mysqli_query($conn, $sql);
                                            $dizi = mysqli_fetch_array($sorgu);
                                            if ($dizi != 0) {
                                                $_SESSION["ID"] = $dizi["user_id"];

                                                header("location:forget_password.php");
                                            } else {
                                                echo "Kullanıcı bulunamadı.";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</html>