<?php
require_once 'header.php';
require_once 'includes/connect_database.inc.php';
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
						<th>Number</th>
						<th>Plate Number</th>
						<th>Name</th>
						<th>Surname</th>
						<th>Notify Security</th>
					</tr>
				</thead>
				<?php
				
				$index = 0;
				$sql = "select * from vehicles";
				$res = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($res)) 
				{
					if($row["vehicle_status"] == 3)
					{	
						$state_id  = $row["vehicle_status"];

						$index += 1;
						echo "<tr>";
						echo "<td width = 50>" . $index . "</td>";
						echo "<td>" . $row["plate_number"] . "</td>";
						echo "<td>" . $row["driver_name"] . "</td>";
						echo "<td>" . $row["driver_surname"] . "</td>";


						$sql_user = "SELECT * FROM users WHERE user_id = '" . $_SESSION["ID"] . "'";
						$res_user = mysqli_query($conn, $sql_user);
						$row_user = mysqli_fetch_assoc($res_user);

						?>

						<form action="includes/ramp_staff_notify_security.inc.php" method="post">
		                    <input type="hidden" class="form-control form-control-user" name="rid"    value="<?php echo $_SESSION["ID"]?>">
		                    <input type="hidden" class="form-control form-control-user" name="rname"  value="<?php echo $row_user["name"] . " " . $row_user["surname"]?>">
		                    <input type="hidden" class="form-control form-control-user" name="vid"    value="<?php echo $row["vehicle_id"]?>">
		                    <input type="hidden" class="form-control form-control-user" name="vplate" value="<?php echo $row["plate_number"]?>">
		                    <!-- Submit Button -->

		                    <td width = 50>
		                    <button type="submit" class="btn btn-success btn-circle" name="submit">
		                        <i class="fas fa-fw fa-envelope"></i>
		                    </button>
		                    </td>
	                	</form>

	            <?php
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