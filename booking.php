<?php 
include 'admin/db_connect.php'; 

$qry = $conn->query("SELECT * FROM cars where id= ".$_GET['car_id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
?>
<div class="container-fluid">
	<form action="" id="manage-book">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="car_id" value="<?php echo isset($_GET['car_id']) ? $_GET['car_id'] :'' ?>">
		<p>
			<large><b>Book for: <?php echo $model ?></b></large>
		</p>
		<div class="form-group">
	        <label for="" class="control-label">Pickup Date/Time</label>
	        <input type="text" class="form-control " readonly required="" name="pickup_datetime" value="<?php echo date("Y-m-d H:i",strtotime($_GET['pickup'])) ?>" autocomplete="off">
	      </div>
	      <div class="form-group">
	        <label for="" class="control-label">Drop off Date/Time</label>
	        <input type="text" class="form-control " readonly required="" name="dropoff_datetime" value="<?php echo date("Y-m-d H:i",strtotime($_GET['dropoff'])) ?>" autocomplete="off">
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
	</form>
</div>
<script>
	
	$('#manage-book').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'admin/ajax.php?action=save_book',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Booking Request Sent.",'success')
						end_load()
				}
			}
		})
	})
</script>