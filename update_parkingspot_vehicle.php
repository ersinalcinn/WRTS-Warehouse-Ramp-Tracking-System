<?php
include_once 'header.php';
$parkid = $_GET["parkid"];
$vehicletype = $_GET["vehicletype"];
?>

<!-- Start of Page Content -->
<div class="card shadow mb-4">
	
	<?php
	
		if($vehicletype == 1)
		{
			?>
			<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Vehicles Entering The Warehouse(Truck)</h6>
			</div><?php
		}
		else
		{
			?>
			<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Vehicles Entering The Warehouse(Non-Truck)</h6>
			</div><?php
			
		}
		?>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Language</th>
						<th>Phone Number</th>
						<th>Citizenship</th>
						<th>Plate Number</th>
						<th>Trailer Number</th>
						<th>Company Name</th>
						<th>Waybill Number</th>
						<th>Arrival Time</th>
						<th>Departure Time</th>
						<th>Vehicle Status</th>
						<th>Description</th>
						<th></th>

					</tr>
				</thead>
				<?php
				$sql = "select * from vehicles where vehicle_status=2 and vehicle_type_id='$vehicletype'";
				$res = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					$state_id  = $row["vehicle_status"];
					echo "<tr>";
					echo "<td>" . $row["driver_name"] . "</td>";
					echo "<td>" . $row["driver_surname"] . "</td>";
					echo "<td>" . $row["driver_language"] . "</td>";
					echo "<td>" . $row["phone_number"] . "</td>";
					echo "<td>" . $row["citizenship_no"] . "</td>";
					echo "<td>" . $row["plate_number"] . "</td>";
					echo "<td>" . $row["trailer_number"] . "</td>";
					echo "<td>" . $row["company_name"] . "</td>";
					echo "<td>" . $row["waybill"] . "</td>";

					echo "<td>" . $row["arrival_time"] . "</td>";
					echo "<td>" . $row["departure_time"] . "</td>";
					$sql1 = "select * from vehicle_states where vehicle_state_id='$state_id'";
					$res1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_fetch_assoc($res1);
					echo "<td>" . $row1["vehicle_state_name"] . "</td>";
					echo "<td>" . $row["description"] . "</td>";

					echo "<td>"; ?> <a href="includes/update_parkingspots.inc.php?parkid=<?php echo $parkid; ?>&vehicle_id=<?php echo $row['vehicle_id']; ?>" class="btn btn-success btn-circle btn-lg">
                                        <i class="fas fa-check"></i>
                                    </a><?php

					}
					mysqli_close($conn);


						?>


				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>

<!-- Bootstrap core JavaScript-->

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>