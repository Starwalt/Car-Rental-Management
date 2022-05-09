<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of movements</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_movement">
					<i class="fa fa-plus"></i> New Entry
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Borrower</th>
									<th class="">Date Pick-up</th>
									<th class="">Date Drop-off</th>
									<th class="">Car Info</th>
									<th class="">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cat = array();
								$cat[] = '';
								$qry = $conn->query("SELECT * FROM categories ");
								while($row = $qry->fetch_assoc()){
									$cat[$row['id']] = $row['name'];
								}
								$tt = array();
								$tt[] = '';
								$qry = $conn->query("SELECT * FROM transmission_types ");
								while($row = $qry->fetch_assoc()){
									$tt[$row['id']] = $row['name'];
								}
								$et = array();
								$et[] = '';
								$qry = $conn->query("SELECT * FROM engine_types ");
								while($row = $qry->fetch_assoc()){
									$et[$row['id']] = $row['name'];
								}
								$movements = $conn->query("SELECT bc.status as bstatus,b.*,c.model,c.brand,c.transmission_id,c.engine_id FROM borrowed_cars bc inner join books b on b.id = bc.booked_id inner join cars c on c.id = b.car_id ");
								while($row=$movements->fetch_assoc()):
									
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo date("M d,Y h:i A",strtotime($row['pickup_datetime'])) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo date("M d,Y h:i A",strtotime($row['dropoff_datetime'])) ?></b></p>
									</td>
									<td>
										 <p>Brand: <b><?php echo ucwords($row['brand']) ?></b></p>
										 <p>Model: <b><?php echo ucwords($row['model']) ?></b></p>
										 <p>Registration #: <b><?php echo ($row['car_registration_no']) ?></b></p>
										 <p>Plate #: <b><?php echo ($row['car_plate_no']) ?></b></p>
									</td>
									<td>
										<?php if($row['bstatus'] == 1): ?>
										<span class="badge badge-primary">Picked-up</span>
										<?php else: ?>
										<span class="badge badge-success">Droped-off</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_movement" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_movement" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	
	$('.view_movement').click(function(){
		window.open("../index.php?page=view_movement&id="+$(this).attr('data-id'))
		
	})
    $('#new_movement').click(function(){
		uni_modal("New Entry","manage_movement.php","mid-large")
		
	})
	$('.edit_movement').click(function(){
		uni_modal("Manage movement Details","manage_movement.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_movement').click(function(){
		_conf("Are you sure to delete this movement?","delete_movement",[$(this).attr('data-id')])
	})
	
	function delete_movement($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_movement',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>