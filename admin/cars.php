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
						<b>List of Cars</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="index.php?page=manage_car" id="new_car">
					<i class="fa fa-plus"></i> New Entry
				</a></span>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Brand</th>
									<th class="">Model</th>
									<th class="">Category</th>
									<th class="">Other Info</th>
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
								$cars = $conn->query("SELECT * FROM cars order by brand asc,model asc ");
								while($row=$cars->fetch_assoc()):
									$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
									unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
									$desc = strtr(html_entity_decode($row['description']),$trans);
									$desc=str_replace(array("<li>","</li>"), array("",","), $desc);
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p> <b><?php echo ucwords($row['brand']) ?></b></p>
									</td>
									<td class="">
										 <p> <b><?php echo ucwords($row['model']) ?></b></p>
									</td>
									<td>
										 <p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
									</td>
									<td>
										 <p>Transmission: <b><?php echo ucwords($tt[$row['transmission_id']]) ?></b></p>
										 <p>Engine: <b><?php echo ucwords($et[$row['engine_id']]) ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_car" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_car" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_car" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
	
	$('.view_car').click(function(){
		uni_modal("Car Details","view_car.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.edit_car').click(function(){
		location.href ="index.php?page=manage_car&id="+$(this).attr('data-id')
		
	})
	$('.delete_car').click(function(){
		_conf("Are you sure to delete this car?","delete_car",[$(this).attr('data-id')])
	})
	
	function delete_car($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_car',
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