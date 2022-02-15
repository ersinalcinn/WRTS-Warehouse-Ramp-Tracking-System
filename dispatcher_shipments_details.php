<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->
<div class="container-fluid">

	<!-- Buttons -->
	
	<div class="row">

		<!-- Edit Shipment Button -->

		<div class="col-auto mb-3">
			<div class="card-body">
				<a href="dispatcher_shipments_edit_form.php?wid=<?php echo $_GET["wid"]; ?>" class="btn btn-success btn-icon-split">
					<span class="text">Edit the Shipment</span>
				</a>
			</div>
		</div>

        <!-- Delete Shipment Button -->

        <div class="col-auto mb-3">
            <div class="card-body">
                <a href="includes/dispatcher_shipments_delete.inc.php?wid=<?php echo $_GET["wid"]; ?>" class="btn btn-danger btn-icon-split">
                    <span class="text">Delete the Shipment</span>
                </a>
            </div>
        </div>

	</div>

	<?php
	if ($_GET["success"] == 1){
	?>
		<div class="col mb-3 text-success font-weight-bold text-center">
			Shipment Updated Succesfully
		</div>
	<?php
	}
	if ($_GET["success"] == 2){?>
		<div class="col mb-3 text-danger font-weight-bold text-center">
			Shipment Could not Updated
		</div>
	<?php
	}
	?>

	<!-- Shipment List -->

	<div class="col-auto mb-3">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Shipment Details</h6>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="20%">Title</th>
								<th >Content</th>
							</tr>
						</thead>
						<?php

                    	$sql_vehicles = "SELECT * FROM vehicles WHERE waybill = '" . $_GET["wid"] . "'";
                    	$res_vehicles = mysqli_query($conn, $sql_vehicles);

						while ($row_vehicles = mysqli_fetch_assoc($res_vehicles)) {

                    		$sql_vehicle_type = "SELECT vehicle_type_name FROM vehicle_types WHERE vehicle_type_id = '" . $row_vehicles["vehicle_type_id"] . "'";
                    		$res_vehicle_type = mysqli_query($conn, $sql_vehicle_type);
                    		$row_vehicle_type = mysqli_fetch_assoc($res_vehicle_type);

							echo "<tr>";
							echo "<td>" . "Waybill" . "</td>";
							echo "<td>" . $row_vehicles["waybill"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Vehicle Type" . "</td>";
							echo "<td>" . $row_vehicle_type["vehicle_type_name"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Company Name" . "</td>";
							echo "<td>" . $row_vehicles["company_name"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Plate Number" . "</td>";
							echo "<td>" . $row_vehicles["plate_number"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Trailer Number" . "</td>";
							echo "<td>" . $row_vehicles["trailer_number"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Driver Citizenship No" . "</td>";
							echo "<td>" . $row_vehicles["citizenship_no"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Driver Name" . "</td>";
							echo "<td>" . $row_vehicles["driver_name"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Driver Surname" . "</td>";
							echo "<td>" . $row_vehicles["driver_surname"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Driver Phone Number" . "</td>";
							echo "<td>" . $row_vehicles["phone_number"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Driver Language" . "</td>";
							echo "<td>" . $row_vehicles["driver_language"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Arrival Time" . "</td>";
							echo "<td>" . $row_vehicles["arrival_time"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Departure Time" . "</td>";
							echo "<td>" . $row_vehicles["departure_time"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Vehicle Status" . "</td>";
							echo "<td>" . $row_vehicles["vehicle_status"] . "</td>";

							echo "<tr>";
							echo "<td>" . "Description" . "</td>";
							echo "<td>" . $row_vehicles["description"] . "</td>";

						}
						mysqli_close($conn);
						?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>