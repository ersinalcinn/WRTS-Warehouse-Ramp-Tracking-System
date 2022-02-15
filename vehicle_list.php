<?php
include_once 'header.php';
?>

<!-- Start of Page Content -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Vehicle List</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Surname</th>
						<th>Phone Number</th>
						<th>Plate Number</th>
						<th>Trailer Number</th>
						<th>Vehicle Status</th>
						<th>Vehicle Type</th>
						<th>Edit</th>
						

					</tr>
				</thead>
				<?php
				
				$sql = "select * from vehicles";
				$res = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					
					$state_id  = $row["vehicle_status"];
					if ($row['vehicle_status'] == 1 ) {
                        echo "<tr  style='background-color:#FFF59D;'>";
                    } 
					else if ($row['vehicle_status'] == 2 ||  $row['vehicle_status'] == 3 ) {
                        echo "<tr  style='background-color:#78FFA9;'>";
                    }
					
					else if ($row['vehicle_status'] == 4 ||  $row['vehicle_status'] == 5 || $row['vehicle_status'] == 6  || $row['vehicle_status'] == 7) {
                        echo "<tr  style='background-color:#FF5E4F;'>";
                    } 
					else if ($row['vehicle_status'] == 8 ) {
                        echo "<tr  style='background-color:#A9A9A9;'>";
                    } 
				
					
					echo "<td>" . $row["driver_name"] . "</td>";
					echo "<td>" . $row["driver_surname"] . "</td>";
					echo "<td>" . $row["phone_number"] . "</td>";
					echo "<td>" . $row["plate_number"] . "</td>";
					echo "<td>" . $row["trailer_number"] . "</td>";
					$type = $row["vehicle_type_id"];
					$sql1 = "select * from vehicle_states where vehicle_state_id='$state_id'";
					$res1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_fetch_assoc($res1);
					echo "<td>" . $row1["vehicle_state_name"] . "</td>";
					$sql2 = "select * from vehicle_types where vehicle_type_id='$type'";
					$res2 = mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($res2);
					echo "<td>" . $row2["vehicle_type_name"] . "</td>";
					
					if($row["vehicle_status"] == 1 ||  $row["vehicle_status"] == 7 )
					{
						echo "<td>";
						 ?> <a href="update_vehicle_form.php?vehicle_id=<?php echo $row['vehicle_id']; ?>" class="btn btn-info btn-circle">
						<i class="fas fa-fw fa-wrench"></i>
					</a><?php
						
					}
					else
					{
						echo "<td>";
						
					}
					

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