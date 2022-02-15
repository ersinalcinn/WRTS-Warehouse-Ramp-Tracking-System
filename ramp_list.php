<?php
include_once 'header.php';
?>

<!-- Begin Page Content -->

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ramp List</h6>
		
	</div>
	
	<div class="card-body">

		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Ramp ID</th>
						<th>Ramp Status</th>
						<th>Vehicle Plate Number</th>
						<th>Vehicle Trailer Number </th>
						<th>Operations </th>
						<th>Fault </th>

					</tr>
				</thead>

				<tbody>

					<?php
					$sql = "SELECT * from ramp WHERE user_id = '" . $id . "'";
					$sorgu = mysqli_query($conn, $sql);
					while ($dizi = mysqli_fetch_array($sorgu)) {

						$vehicle_id = $dizi['vehicle_id'];
						$ramp_state_id = $dizi['ramp_states'];

						$sql1 = "SELECT * from vehicles where vehicle_id='$vehicle_id' ";
						$sorgu1 = mysqli_query($conn, $sql1);
						$dizi1 = mysqli_fetch_array($sorgu1);
						$vehicle_state_id=$dizi1['vehicle_status'];
						$sql2 = "SELECT * from vehicle_states where vehicle_state_id='$vehicle_state_id' ";
						$sorgu2 = mysqli_query($conn, $sql2);
						$dizi2 = mysqli_fetch_array($sorgu2);
						if ($dizi['vehicle_id'] == null && $dizi['ramp_states']==2) {
							echo "<tr style='background-color:#78ffa9;'>";

							$durum = "NULL";
						} else if ( $dizi['ramp_states']==1 ) {
								echo "<tr style='background-color:#dddfeb;'>";
								$durum = "MAINTENANCE";
							  
							}else {
							if ( $dizi2['vehicle_state_name'] == 'Ready to Leave' ) {
								echo "<tr style='background-color:#ffff5c;'>";
								$durum = "WAITING TO GO";
							  
							}else if ($dizi2['vehicle_state_name'] == 'Getting Processed' || $dizi2['vehicle_state_name'] == 'Entered Ramp') {
								echo "<tr style='background-color:#ff5e4f;'>";
								$durum = "PROCESS";
							} else {
								echo "<tr>";
							}
						}
						echo '<td>' . $dizi['ramp_id'] . '</td>';

						$sql3 = "SELECT * from ramp_states where ramp_state_id='$ramp_state_id' ";
						$sorgu3 = mysqli_query($conn, $sql3);
						$dizi3 = mysqli_fetch_array($sorgu3);
						echo '<td>' . $dizi3['ramp_state_name'] . '</td>';
						echo '<td>' . $dizi1['plate_number'] . '</td>';
						echo '<td>' . $dizi1['trailer_number'] . '</td>';



						if ($durum == 'WAITING TO GO') {
					?> <td><a href="./includes/ramp_next_state.inc.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $vehicle_id; ?>&status=<?php echo 0; ?>"><button name="buton" style="width:200px; margin-left:50px;" class="btn btn-primary">Next process</button></a></td>
					<td><a href="maintenance_update_list.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $dizi['vehicle_id'];  ?>" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">Report Faulty Ramp</span>
                                    </a></td>
							<?php }
							if ($durum == 'MAINTENANCE') {
					?> 
					<td></td>
					<td><a href="./includes/ramp_next_state.inc.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $vehicle_id; ?>&status=<?php echo 1; ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Ramp Failure Over</span>
                                    </a></td>
					
							<?php }
						if ($durum == 'PROCESS') {
							?>
							<td><a href="./includes/ramp_next_state.inc.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $vehicle_id; ?>&status=<?php echo 2; ?>"><button name="buton" style="width:200px; margin-left:50px;" class="btn btn-primary">The vehicle is loaded. Waiting for driver</button></a></td>
							<td><a href="maintenance_update_list.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $dizi['vehicle_id'];  ?>" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">Report Faulty Ramp</span>
                                    </a></td>
							<?php
						}
						if ($durum == 'NULL') {

							?>
							<td><a href="ramp_vehicle_list.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&selection=<?php echo 0;  ?>"><button name="buton" style="width:200px; margin-left:50px;" class="btn btn-primary">Add a vehicle to the ramp</button></a>
							<a href="ramp_vehicle_list.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&selection=<?php echo 1;  ?>"><button name="buton" style="width:200px; margin-left:50px;" class="btn btn-primary">Call a vehicle to the ramp</button></a></td>
							<td><a href="./includes/maintenance_ramp_report.inc.php?ramp_id=<?php echo $dizi['ramp_id']; ?>" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">Report Faulty Ramp</span>
                                    </a></td>


							
								
							<?php 
								}
							} ?>
							






					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
include_once 'footer.php';
?>


<!-- Bootstrap core JavaScript-->

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>