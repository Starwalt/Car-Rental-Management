
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=movement" class="nav-item nav-movement"><span class='icon-field'><i class="fa fa-th-list"></i></span> Pickup/Drop-off</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-list"></i></span> Car Category</a>
				<a href="index.php?page=transmissions" class="nav-item nav-transmissions"><span class='icon-field'><i class="fa fa-cog"></i></span> Transmission Types</a>
				<a href="index.php?page=engine_types" class="nav-item nav-engine_types"><span class='icon-field'><i class="fa fa-bolt"></i></span> Engine Types</a>
				<a href="index.php?page=books" class="nav-item nav-books"><span class='icon-field'><i class="fa fa-book"></i></span> Books</a>
				<a href="index.php?page=cars" class="nav-item nav-cars"><span class='icon-field'><i class="fa fa-car"></i></span> Cars</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
