<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->


	<!-- Buttons -->

	<div class="row">

		<!-- Add Shipment Button -->

		<div class="col-auto mb-3">
			<div class="card-body">
				<a href="dispatcher_shipments_create_shipment.php" class="btn btn-success btn-icon-split">
					<span class="text">Add a Shipment</span>
				</a>
			</div>
		</div>
	</div>

	<?php
	if ($_GET["delete"] == 1){
	?>
		<div class="col mb-3 text-success font-weight-bold text-center">
			Shipment Deleted Succesfully
		</div>
	<?php
	}
	if ($_GET["delete"] == 2){?>
		<div class="col mb-3 text-danger font-weight-bold text-center">
			Shipment Could not Deleted
		</div>
	<?php
	}
	?>

	<!-- Shipment List -->

	
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Shipment List</h6>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Number</th>
								<th>Waybill</th>
								<th>Vehicle Type</th>
								<th>Company Name</th>
							    <th>Plate Number</th>
							    <th>Trailer Number</th>
								<th>Details</th>
							</tr>
						</thead>
						<?php

                    	$sql_vehicles = "SELECT * FROM vehicles";
                    	$res_vehicles = mysqli_query($conn, $sql_vehicles);

						$index = 0;

						while ($row_vehicles = mysqli_fetch_assoc($res_vehicles)) {
							$index += 1;

                    		$sql_vehicle_type = "SELECT vehicle_type_name FROM vehicle_types WHERE vehicle_type_id = '" . $row_vehicles["vehicle_type_id"] . "'";
                    		$res_vehicle_type = mysqli_query($conn, $sql_vehicle_type);
                    		$row_vehicle_type = mysqli_fetch_assoc($res_vehicle_type);

							echo "<tr>";
							echo "<td>" . $index . "</td>";
							echo "<td>" . $row_vehicles["waybill"] . "</td>";
							echo "<td>" . $row_vehicle_type["vehicle_type_name"] . "</td>";
							echo "<td>" . $row_vehicles["company_name"] . "</td>";
							echo "<td>" . $row_vehicles["plate_number"] . "</td>";
							echo "<td>" . $row_vehicles["trailer_number"] . "</td>";

						?> 
							<td> 
								<a href="dispatcher_shipments_details.php?wid=<?php echo $row_vehicles["waybill"]; ?>" class="btn btn-info btn-circle">
                                    <i class="fas fa-info-circle"></i>
                                </a>
							</td>
						<?php
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