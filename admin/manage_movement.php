<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT bc.status as bstatus,bc.id as bcid,b.*,c.model,c.brand,c.transmission_id,c.engine_id FROM borrowed_cars bc inner join books b on b.id = bc.booked_id inner join cars c on c.id = b.car_id where bc.id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-movement">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Borrower</label>
				<select name="book_id" id="" class="custom-select select2">
				<option value=""></option>
					<?php 
						$book = $conn->query("SELECT * FROM books where status = 2 and id not in (SELECT booked_id from borrowed_cars ) ".(isset($id) ? " or id = $id " : "" )." ");
						while($row=$book->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($id) && $id == $row['id'] ? "selected" : '' ?>><?php echo $row['name'] ?></option>
					<?php endwhile; ?>
				</select>
			</div>
		</div>
		<div class="" id="booked_details">
		<?php if(isset($_GET['id'])): ?>
			<p>Car Brand: <b><?php echo $brand ?></b></p>
			<input type="hidden" name="car_id" value="<?php echo $card_id ?>" />
			<p>Car Model: <b><?php echo $model ?></b></p>
			<p>Pickup Schedule: <b><?php echo $pickup_datetime ?></b></p>
			<p>Drop-off Schedule: <b><?php echo $dropoff_datetime ?></b></p>
		<?php endif; ?>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Car Registration No.</label>
				<input type="text" class="form-control" name='car_registration_no' value="<?php echo isset($car_registration_no) ? $car_registration_no : '' ?>" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Car Plate No.</label>
				<input type="text" class="form-control" name='car_plate_no' value="<?php echo isset($car_plate_no) ? $car_plate_no : '' ?>" required>
			</div>
		</div>
		<?php if(isset($_GET['id'])): ?>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Status</label>
				<select name="status" id="" class="custom-select">
					<option value="1">Picked-up</option>
					<option value="2">Droped-off</option>
				</select>
			</div>
		</div>
		<?php endif; ?>
	</form>
</div>

<script>
	$('.text-jqte').jqte();
	$('.select2').select2({
		placeholder:'Please select here',
		width:'100%'
	})
	$('[name="book_id"]').change(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=get_booked_details',
			method:'POST',
			data:{id:$(this).val()},
			success:function(resp){
				if(resp){
					var _html = '';
					resp = JSON.parse(resp)
					_html += '<p>Car Brand: <b>'+resp.brand+'</b></p>';
					_html += '<input type="hidden" name="car_id" value="'+resp.car_id+'" />';
					_html += '<p>Car Model: <b>'+resp.model+'</b></p>';
					_html += '<p>Pickup Schedule: <b>'+resp.pickup_datetime+'</b></p>';
					_html += '<p>Drop-off Schedule: <b>'+resp.dropoff_datetime+'</b></p>';
					console.log(_html)
					$('#booked_details').html(_html)
				}
			},
			complete:function(){
				end_load()
			}
		})
	})
	$('#manage-movement').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_movement',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Data successfully saved.",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	})
</script>