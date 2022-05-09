<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM books where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-book">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="form-group">
	        <label for="" class="control-label">Car</label>
			<select name="car_id" id="" class="custom-select select2" required>
				<option value=""></option>
				<?php
				$qry = $conn->query("SELECT * FROM cars order by model asc ,brand asc ");
				while($row=$qry->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($car_id) && $row['id'] == $car_id ? 'selected' : '' ?>><?php echo $row['model'].' | '.$row['brand'] ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
	        <label for="" class="control-label">Pickup Date/Time</label>
	        <input type="text" class="form-control datetimepicker"  required="" name="pickup_datetime" value="<?php echo isset($pickup_datetime) ? date("Y-m-d H:i",strtotime($pickup_datetime)) : '' ?>" autocomplete="off">
	      </div>
	      <div class="form-group">
	        <label for="" class="control-label">Drop off Date/Time</label>
	        <input type="text" class="form-control datetimepicker"  required="" name="dropoff_datetime" value="<?php echo isset($dropoff_datetime) ? date("Y-m-d H:i",strtotime($dropoff_datetime)) : '' ?>" autocomplete="off">
	      </div>
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" class="form-control" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Status</label>
			<select class="custom-select" name="status">
				<option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ?>>Pending</option>
				<option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ?>>Confirmed</option>
				<option value="2" <?php echo isset($status) && $status == 0 ? "selected" : '' ?>>Canceled</option>
			</select>
		</div>
	</form>
</div>
<script>
	$('.select2').select2({
		placeholder:'Please Select Here',
		width:"100%"
	})
	$('.datetimepicker').datetimepicker({
		format:"Y-m-d H:i"
	})
	$('#manage-book').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_book',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Booking Request Sent.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}
			}
		})
	})
</script>