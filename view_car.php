<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
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
}
?>
<style type="text/css">
	.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 40vh !important;background: black;

	}
	#imagesCarousel{
		margin-left:unset !important ;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
		margin-top: unset;
		margin-bottom: unset;
	}
	#imagesCarousel img{
		width: calc(100%)!important;
		height: auto!important;
		/*max-height: calc(100%)!important;*/
		max-width: calc(100%)!important;
		cursor :pointer;
	}
	#banner{
		display: flex;
		justify-content: center;
	}
	#banner img{
		max-width: calc(100%);
		max-height: 50vh;
		cursor :pointer;
	}
	<?php if(!empty($img_path)): ?>
	 header.masthead {
	    background: url('admin/assets/uploads/cars_img/<?php echo $img_path ?>') !important;
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	<?php endif; ?>
</style>
<header class="masthead">
	<div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-4 align-self-end mb-4 pt-2 page-title">
                    	<h4 class="text-center text-white"><b><?php echo ucwords($model) ?></b></h4>
                    	<small class="text-white"><?php echo $brand ?></small>
                        <hr class="divider my-4" />
                     
                    </div>
                    
                </div>
            </div>
</header>
<section></section>
<div class="container">
	<div class="col-lg-12">
		<div class="card mt-4 mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						
					</div>
					<div class="col-md-12" id="content">
					<div class="">
						<?php echo html_entity_decode($description); ?>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr class="divider" style="max-width: calc(100%);"/>
						<div class="text-center">
								<a class="btn btn-primary" id="" href="./index.php">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#imagesCarousel img,#banner img').click(function(){
		viewer_modal($(this).attr('src'))
	})
	$('#participate').click(function(){
        _conf("Are you sure to commit that you will participate to this event?","participate",[<?php echo $id ?>],'mid-large')
    })

    function participate($id){
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=participate',
            method:'POST',
            data:{event_id:$id},
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
