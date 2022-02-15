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
						<th>Plate Number</th>
						<th>Trailer Number</th>
						<th>Vehicle Status</th>
						<th>Add to Ramp</th>

					</tr>
				</thead>
				<?php
				$rampid=$_GET['ramp_id'];
				$sql = "select * from vehicles where vehicle_status=3";
				$res = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($res)) {
					echo "<tr>";
					echo "<td>" . $row["driver_name"] . "</td>";
					echo "<td>" . $row["driver_surname"] . "</td>";
					echo "<td>" . $row["plate_number"] . "</td>";
					echo "<td>" . $row["trailer_number"] . "</td>";
					echo "<td>" . $row["vehicle_status"] . "</td>";
					$selection=$_GET['selection'];
					
					if($selection==0)
					{
						echo "<td>"; ?> 
						<a href="./includes/ramp_next_state.inc.php?ramp_id=<?php echo $rampid; ?>&vehicle_id=<?php echo $row['vehicle_id']; ?>&status=<?php echo 3; ?>" class="btn btn-success btn-circle">
						<i class="fas fa-check"></i>
					</a>
					<?php }
				
					else if($selection==1)
					{
						echo "<td>"; ?> 
						<a href="./includes/sms-api.inc.php?phonenumber=<?php echo $row['phone_number']; ?>" class="btn btn-success btn-circle">
						<i class="fas fa-check"></i>
					</a>
					<?php }
					

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