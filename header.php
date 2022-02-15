<?php
session_start();
require_once 'includes/connect_database.inc.php';
$id = $_SESSION["ID"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <META http-equiv=content-type content=text/html;charset=iso-8859-9>
<META http-equiv=content-type content=text/html;charset=windows-1254>
<META http-equiv=content-type content=text/html;charset=x-mac-turkish>

    <title>WRTS - CONTROL PANEL</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3">WRTS CONTROL PANEL</sup></div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
           

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading mb-2">
                Operations
            </div>

            <!-- Nav Item - Side Bar Menu-->

            <?php
            $id = $_SESSION["ID"];

            $sql = "SELECT * FROM users WHERE user_id = " . $id;
            $query = mysqli_query($conn, $sql);
            $res = mysqli_fetch_array($query);
            $department_id = $res["department_id"];

            $sql = "SELECT * FROM department WHERE department_id = " . $department_id;
            $query = mysqli_query($conn, $sql);
            $res = mysqli_fetch_array($query);
            $department = $res["department_name"];
            ?>

            <!-- Side Bar - Admin -->

            <?php
            if ($department == "Admin") {
                
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="admin_users.php">
                        <span>User Operations</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_ramps.php">
                        <span>Ramp Operations</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_parking_lot.php">
                        <span>Parking Lot Operations</span></a>
                </li>


            <?php
            }
            ?>

            <!-- Side Bar - Security -->

            <?php
            if ($department == "Security") {
                
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="vehicle_list.php">
                        <span>List Vehicles</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parking_list.php">
                        <span>Parking Lot</span></a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="security_notify.php">
                        <span>Notifications</span></a>
                </li>
            <?php
            }
            ?>

            <!-- Side Bar - Dispatcher -->

            <?php
            if ($department == "Dispatcher") {
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="dispatcher_shipments.php">
                        <span>Shipment Operations</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dispatcher_ramps.php">
                        <span>Ramp Operations</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dispatcher_parking_lot.php">
                        <span>Parking Lot Operations</span></a>
                </li>

            <?php
            }
            ?>

            <!-- Side Bar - Ramp Staff -->

            <?php
            if ($department == "Ramp Staff") {
            ?>

                <li class="nav-item">
                    <a class="nav-link" href="ramp_list.php">
                        <span>Ramps</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ramp_staff_notify_security_list.php">
                        <span>Notify Security</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ramp_staff_notification.php">
                        <span>Notifications</span></a>
                </li>

            <?php
            }
            ?>

            <!-- Divider -->

            <hr class="sidebar-divider">

            <!-- Heading -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                                    <?php
                                    $id = $_SESSION["ID"];
                                    $sql = "SELECT * FROM users WHERE user_id = '$id'";
                                    $query = mysqli_query($conn, $sql);
                                    $res = mysqli_fetch_array($query);
                                    echo $res["name"];
                                    echo " ";
                                    echo $res["surname"];
                                    ?>

                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="user_profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- End of Topbar -->