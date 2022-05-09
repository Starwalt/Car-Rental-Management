<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM cars where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
$cat_qry = $conn->query("SELECT * FROM categories where id = $category_id");
$category = $cat_qry->num_rows > 0 ? $cat_qry->fetch_array()['name'] : '' ;
$engine_qry = $conn->query("SELECT * FROM engine_types where id = $engine_id");
$engine = $engine_qry->num_rows > 0 ? $engine_qry->fetch_array()['name'] : '' ;
$trans_qry = $conn->query("SELECT * FROM transmission_types where id = $category_id");
$transmission = $trans_qry->num_rows > 0 ? $trans_qry->fetch_array()['name'] : '' ;
}
?>
<style type="text/css">
	
	.avatar {
	    max-width: calc(100%);
	    max-height: 27vh;
	    align-items: center;
	    justify-content: center;
	    padding: 5px;
	}
	.avatar img {
	    max-width: calc(100%);
	    max-height: 27vh;
	}
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: block
	}
</style>
<div class="container-field">
	<div class="col-lg-12">
		<div>
			<center>
				<div class="avatar">
				 <img src="assets/uploads/cars_img/<?php echo $img_path ?>" class="" alt="">
				</div>
			</center>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<p>Brand: <b><?php echo $brand ?></b></p>
				<p>Model: <b><?php echo $model ?></b></p>
				<p>Category: <b><?php echo $category ?></b></p>
				<p>Transmission: <b><?php echo $transmission ?></b></p>
				<p>Engine: <b><?php echo $engine ?></b></p>
				<p>Price: <b><?php echo number_format($price,2) ?></b></p>
				<p>Qty: <b><?php echo $qty ?></b></p>
			</div>
			<div class="col-md-6">
				<p>Description:</p>
				<p><?php echo html_entity_decode($description) ?></p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<script>
	
</script>
