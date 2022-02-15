<?php session_start();
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
                                            <h6>Email</h6>
                                            <input placeholder="Enter Username" type="text" class="form-control" name="email">
                                            <h6>Password</h6>
                                            <input Placeholder="Enter Password" type="password" class="form-control" name="pass">
                                            <div class="row form-footer">
                                                <div class="col-md-6 forget-paswd">
                                                    <a href="forgetpass.php">Forget Password ?</a>
                                                </div>

                                                <div class="col-md-6 button-div">

                                                    <button name="buton" class="btn btn-primary">Login</button>


                                                </div>

                                            </div>
                                        </form>
                                        <?php


                                        if (isset($_POST["email"]) && isset($_POST["pass"])) {
                                            $email = $_POST["email"];
                                            $password = $_POST["pass"];

                                            $sql = "SELECT * from users where email='$email' and password='$password'";
                                            $sorgu = mysqli_query($conn, $sql);
                                            $dizi = mysqli_fetch_array($sorgu);
                                            if ($dizi != 0) {
                                                $_SESSION["ID"] = $dizi["user_id"];
												
                                                echo $_SESSION["ID"];
												$user = $dizi["user_id"];
                                               $sql1 = "SELECT * from users where user_id='$user' ";
												$sorgu1 = mysqli_query($conn, $sql1);
												$dizi1 = mysqli_fetch_array($sorgu1);
												$department = $dizi1["department_id"];
												echo $department;
												if($department == 1)
												{
														header("location:vehicle_list.php");
												}
												if($department == 4)
												{
														header("location:ramp_list.php");
												}
												if($department == 2)
												{
														header("location:dispatcher_shipments.php");
												}
												if($department == 3)
												{
														header("location:admin_users.php");
												}
                                            } else {
                                                echo "Yanlış kullanıcı adı veya şifre girdiniz...";
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