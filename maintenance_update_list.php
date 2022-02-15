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

					</tr>
				</thead>

				<tbody>

					<?php
					$sql = "SELECT * from ramp where ramp_states=2";
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
							  
							} else {
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


						$faulty_ramp_id=$_GET["ramp_id"];
						$vehicle_id=$_GET["vehicle_id"];
						
					 
							
							
						
						if ($durum == 'NULL') {

							?>
							<td><a href="./includes/ramp_next_state.inc.php?ramp_id=<?php echo $dizi['ramp_id']; ?>&vehicle_id=<?php echo $vehicle_id; ?>&status=<?php echo 4; ?>&faulty_ramp_id=<?php echo $faulty_ramp_id; ?>"><button name="buton" style="width:200px; margin-left:50px;" class="btn btn-primary">Steer the vehicle onto the ramp</button></a>
							</td>


							
								
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