<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Parking Lot</h6>
    </div>
	<div class="container-fluid">
	
		<div class="row">
		<!-- Parking Lot Buttons -->

		<?php
       	$sql_parking_lot = "SELECT * FROM parking_lot";
       	$query_parking_lot = mysqli_query($conn, $sql_parking_lot);
       	$index = 0;
		$counter = 0;
       	while ($row_parking_lot = mysqli_fetch_assoc($query_parking_lot)) {
       		$index += 1;
			
       		$parking_lot_id = $row_parking_lot["parking_lot_id"];
       		$parking_lot_name = $row_parking_lot["parking_lot_name"];
			$vehicle_type_id = $row_parking_lot["vehicle_type_id"];
       		if($parking_lot_name == "NULL")
       		{
       			$parking_lot_name = "Park " . $index;
       		}
		?>
		


		<div class="col-auto mb-3">
			<div class="card-body">
				
				<?php
				echo "<a href=\"dispatcher_list_park.php?parkid=" . $parking_lot_id . "\" class=\"btn btn-info btn-icon\" style=\"width: 16rem; height: 6rem;\">";

				?>
				
					<?php
					$query = "SELECT * FROM parking_spots where parking_lot_id='$parking_lot_id'";
       				$query_num_spots = mysqli_query($conn, $query);
					$num = mysqli_num_rows($query_num_spots);
					
					$query1 = "SELECT * FROM parking_spots where parking_lot_id='$parking_lot_id' and park_status='NULL'";
       				$query_num_spots1 = mysqli_query($conn, $query1);
					$num1 = mysqli_num_rows($query_num_spots1);
					
					
					
					$sql1 = "SELECT * FROM vehicle_types where vehicle_type_id='$vehicle_type_id'";
					$res1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_fetch_assoc($res1);
					
					
					echo "<span class=\"text\" style=\"font-size: larger;\">" . $parking_lot_name . "</span>";
					echo "<br/>";
					echo "<span class=\"text\" style=\"font-size: larger; margin-top:10px;\" >" ."Type : ". $row1["vehicle_type_name"] . "</span>";
					echo "<br/>";
					echo "<span class=\"text\" style=\"font-size: larger; margin-top:10px;\" >" ."Full : ". $num . "</span>";
					echo "<span class=\"text\" style=\"font-size: larger; margin-top:10px;\" >" ."/". ($num-$num1) . "</span>";
					?>
				</a>

			</div>
		</div>

		<?php
       	}
		?>

	</div>
</div>
    
</div>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="#">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Profile
    </a>
    <a class="dropdown-item" href="#">
        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
        Settings
    </a>
    <a class="dropdown-item" href="#">
        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
        Activity Log
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>
<!-- End of Page Content -->


<?php
include_once 'footer.php';
?>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>