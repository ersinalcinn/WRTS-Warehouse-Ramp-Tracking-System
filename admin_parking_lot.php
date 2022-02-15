<?php
include_once 'header.php';
require_once 'includes/connect_database.inc.php';
?>

<!-- Start of Page Content -->
<div class="container-fluid">

	<?php
	if ($_GET["success"] == 1){
	?>
		<div class="col mb-3 text-success font-weight-bold text-center">
			<p>Parking Lot Deleted Succesfully<br></p>
		</div> 
	<?php
	}
	if ($_GET["success"] == 2){?>
		<div class="col mb-3 text-danger font-weight-bold text-center">
			<th>Parking Lot Could not Deleted</th>
		</div>
	<?php
	}
	?>

	<div class="row">

		<!-- Parking Lot Creation Button -->

		<div class="col-auto mb-3">
			<div class="card-body">
				<a href="admin_parking_lot_create_park.php" class="btn btn-success btn-icon-split" style="width: 7rem; height: 7rem;">
						<span class="text">Add a Parking Lot</span>
				</a>
			</div>
		</div>

		<!-- Parking Lot Buttons -->

		<?php
       	$sql_parking_lot = "SELECT * FROM parking_lot";
       	$query_parking_lot = mysqli_query($conn, $sql_parking_lot);
       	$index = 0;

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
				echo "<a href=\"admin_parking_lot_park.php?parkid=" . $parking_lot_id . "\" class=\"btn btn-info btn-icon\" style=\"width: 12rem; height: 7rem;\">";
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
<!-- End of Page Content -->

<?php
include_once 'footer.php';
?>