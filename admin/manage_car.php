<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM cars where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<style>
	
	.jqte_editor{
		min-height: 30vh !important
	}
	#drop {
   	min-height: 15vh;
    max-height: 30vh;
    overflow: auto;
    width: calc(100%);
    border: 5px solid #929292;
    margin: 10px;
    border-style: dashed;
    padding: 10px;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
	#uploads {
		min-height: 15vh;
	width: calc(100%);
	margin: 10px;
	padding: 10px;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	}
	#uploads .img-holder{
	    position: relative;
	    margin: 1em;
	    cursor: pointer;
	}
	#uploads .img-holder:hover{
	    background: #0095ff1f;
	}
	#uploads .img-holder .form-check{
	    display: none;
	}
	#uploads .img-holder.checked .form-check{
	    display: block;
	}
	#uploads .img-holder.checked{
	    background: #0095ff1f;
	}
	#uploads .img-holder img {
		height: 39vh;
    width: 22vw;
    margin: .5em;
		}
	#uploads .img-holder span{
	    position: absolute;
	    top: -.5em;
	    left: -.5em;
	}
	#dname{
		margin: auto 
	}
img.imgDropped {
    height: 16vh;
    width: 7vw;
    margin: 1em;
}
.imgF {
    border: 1px solid #0000ffa1;
    border-style: dashed;
    position: relative;
    margin: 1em;
}
span.rem.badge.badge-primary {
    position: absolute;
    top: -.5em;
    left: -.5em;
    cursor: pointer;
}
label[for="chooseFile"]{
	color: #0000ff94;
	cursor: pointer;
}
label[for="chooseFile"]:hover{
	color: #0000ffba;
}
.opts {
    position: absolute;
    top: 0;
    right: 0;
    background: #00000094;
    width: calc(100%);
    height: calc(100%);
    justify-items: center;
    display: flex;
    opacity: 0;
    transition: all .5s ease;
}
.img-holder:hover .opts{
    opacity: 1;

}
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
button.btn.btn-sm.btn-rounded.btn-sm.btn-dark {
    margin: auto;
}
img#img_path-field{
		max-height: 15vh;
		max-width: 8vw;
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form action="" id="manage-car">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
					<div class="form-group row">
						<div class="col-md-4">
							<label for="" class="control-label">Brand</label>
							<input type="text" class="form-control" name="brand"  value="<?php echo isset($brand) ? $brand :'' ?>" required>
						</div>
						<div class="col-md-4">
							<label for="" class="control-label">Model</label>
							<input type="text" class="form-control" name="model"  value="<?php echo isset($model) ? $model :'' ?>" required autocomplete="off">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<label for="" class="control-label">Category</label>
							<select class="custom-select select2" name="category_id">
								<option value=""></option>
								<?php
								$qry = $conn->query("SELECT * FROM categories order by name asc");
								while($row=$qry->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="" class="control-label">Engine Type</label>
							<select class="custom-select select2" name="engine_id">
								<option value=""></option>
								<?php
								$qry = $conn->query("SELECT * FROM engine_types order by name asc");
								while($row=$qry->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($engine_id) && $engine_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="col-md-4">
							<label for="" class="control-label">Transmission Type</label>
							<select class="custom-select select2" name="transmission_id">
								<option value=""></option>
								<?php
								$qry = $conn->query("SELECT * FROM transmission_types order by name asc");
								while($row=$qry->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($transmission_id) && $transmission_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-10">
							<label for="" class="control-label">Description</label>
							<textarea name="description" id="description" class="form-control jqte" cols="30" rows="5" required><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-4">
							<label for="" class="control-label">Price</label>
							<input type="number" class="form-control text-right" name="price" value="<?php echo isset($price) ? $price : 0 ?>">
						</div>
						<div class="col-md-4">
							<label for="" class="control-label">QTY</label>
							<input type="number" class="form-control text-right" name="qty" value="<?php echo isset($qty) ? $qty : 0 ?>">
						</div>
					</div>
					<div class=" row form-group">
						<div class="col-md-5">
							<label for="" class="control-label">Car Image</label>
							<input type="file" class="form-control" name="img" onchange="displayImg2(this,$(this))">
						</div>

						<div class="col-md-5">
							<img src="<?php echo isset($img_path) ? 'assets/uploads/cars_img/'.$img_path :'' ?>" alt="" id="img_path-field">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-sm btn-block btn-primary col-sm-2"> Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="imgF" style="display: none " id="img-clone">
			<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>
<script>
	$('#payment_status').on('change keypress keyup',function(){
		if($(this).prop('checked') == true){
			$('#amount').closest('.form-group').hide()
		}else{
			$('#amount').closest('.form-group').show()
		}
	})
	$('.jqte').jqte();

	$('#manage-car').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_car',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.href = "index.php?page=cars"
					},1500)

				}
				
			}
		})
	})
	if (window.FileReader) {
  var drop;
  addcarHandler(window, 'load', function() {
    var status = document.getElementById('status');
    drop = document.getElementById('drop');
    var dname = document.getElementById('dname');
    var list = document.getElementById('list');

    function cancel(e) {
      if (e.preventDefault) {
        e.preventDefault();
      }
      return false;
    }

    // Tells the browser that we *can* drop on this target
    addcarHandler(drop, 'dragover', cancel);
    addcarHandler(drop, 'dragenter', cancel);

    addcarHandler(drop, 'drop', function(e) {
      e = e || window.car; // get window.car if e argument missing (in IE)   
      if (e.preventDefault) {
        e.preventDefault();
      } // stops the browser from redirecting off to the image.
      $('#dname').remove();
      var dt = e.dataTransfer;
      var files = dt.files;
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        //attach car handlers here...

        reader.readAsDataURL(file);
        addcarHandler(reader, 'loadend', function(e, file) {
          var bin = this.result;
          var imgF = document.getElementById('img-clone');
          	imgF = imgF.cloneNode(true);
          imgF.removeAttribute('id')
          imgF.removeAttribute('style')

          var img = document.createElement("img");
          var fileinput = document.createElement("input");
          var fileinputName = document.createElement("input");
          fileinput.setAttribute('type','hidden')
          fileinputName.setAttribute('type','hidden')
          fileinput.setAttribute('name','img[]')
          fileinputName.setAttribute('name','imgName[]')
          fileinput.value = bin
          fileinputName.value = file.name
          img.classList.add("imgDropped")
          img.file = file;
          img.src = bin;
          imgF.appendChild(fileinput);
          imgF.appendChild(fileinputName);
          imgF.appendChild(img);
          drop.appendChild(imgF)
        }.bindTocarHandler(file));
      }
      return false;

    });

    Function.prototype.bindTocarHandler = function bindTocarHandler() {
      var handler = this;
      var boundParameters = Array.prototype.slice.call(arguments);
      return function(e) {
        e = e || window.car; // get window.car if e argument missing (in IE)   
        boundParameters.unshift(e);
        handler.apply(this, boundParameters);
      }
    };
  });
} else {
  document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
}

function addcarHandler(obj, evt, handler) {
  if (obj.addcarListener) {
    // W3C method
    obj.addcarListener(evt, handler, false);
  } else if (obj.attachcar) {
    // IE method.
    obj.attachcar('on' + evt, handler);
  } else {
    // Old school method.
    obj['on' + evt] = handler;
  }
}
function displayIMG(input){

    	if (input.files) {
	if($('#dname').length > 0)
		$('#dname').remove();

    			Object.keys(input.files).map(function(k){
    				var reader = new FileReader();
				        reader.onload = function (e) {
				        	// $('#cimg').attr('src', e.target.result);
          				var bin = e.target.result;
          				var fname = input.files[k].name;
          				var imgF = document.getElementById('img-clone');
						  	imgF = imgF.cloneNode(true);
						  imgF.removeAttribute('id')
						  imgF.removeAttribute('style')
				        	var img = document.createElement("img");
					          var fileinput = document.createElement("input");
					          var fileinputName = document.createElement("input");
					          fileinput.setAttribute('type','hidden')
					          fileinputName.setAttribute('type','hidden')
					          fileinput.setAttribute('name','img[]')
					          fileinputName.setAttribute('name','imgName[]')
					          fileinput.value = bin
					          fileinputName.value = fname
					          img.classList.add("imgDropped")
					          img.src = bin;
					          imgF.appendChild(fileinput);
					          imgF.appendChild(fileinputName);
					          imgF.appendChild(img);
					          drop.appendChild(imgF)
				        }
		        reader.readAsDataURL(input.files[k]);
    			})
    			
rem_func()

    }
    }
function displayImg2(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#img_path-field').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function rem_func(_this){
		_this.closest('.imgF').remove()
		if($('#drop .imgF').length <= 0){
			$('#drop').append('<span id="dname" class="text-center">Drop Files Here</label></span>')
		}
}
</script>