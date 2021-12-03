<?php 
include('db_connect.php');
$i = 1;
								$cname[0] = "Not Set";
								$companies = $conn->query("SELECT * FROM companies ");
								while($row = $companies->fetch_assoc()){
									$cname[$row['id']] = ucwords($row['name']);
								}
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users");

}
?>

<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

:root{
	--main-color:  #912c2c;
	--color-dark: #1D2231;
	--text-grey: #fff;
}

	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		
	background-color: #912c2c;
	padding-top: 25px;
	margin-top: -30px;
	box-shadow: 0.2px 0.2px 10px rgba(0,0,0.3);
	z-index: 101;
	}

#logo1{
	margin-bottom: 20px;
	
}
.cid{
color:white;

}

}
</style>

<nav id="sidebar"  >
		
		<div class="sidebar-list">
				<?php if($_SESSION['login_type'] == 2||$_SESSION['login_type'] == 3): ?>
				<center><img id="logo1"src="logo.png"width="120px" height="120px"></center>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 1): ?>
					
				<center><img id="logo1"src="logo.png"width="130px" height="130px"></center>
				<?php endif; ?>
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
				<?php if($_SESSION['login_type'] == 2 ||$_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=internship_attendance" class="nav-item nav-internship_attendance"><span class='icon-field'><i class="fa fa-clipboard-list "></i></span> 
				Attendance</a>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 1||$_SESSION['login_type'] == 3): ?>
				<a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fa fa-users "></i></span> Student List</a>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 2): ?>
				<a href="index.php?page=students" class="nav-item nav-students"><span class='icon-field'><i class="fa fa-users "></i></span> Evaluate Students</a>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 1||$_SESSION['login_type'] == 3): ?>
				<div class="mx-2 text-white">Master List</div>
				<a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i class="fa fa-scroll "></i></span> Courses</a>
				<a href="index.php?page=companies" class="nav-item nav-companies"><span class='icon-field'><i class="fa fa-building "></i></span> Companies</a>
				<?php endif; ?>
				<div class="mx-2 text-white">Report</div>
				<a href="index.php?page=rendered_report" class="nav-item nav-rendered_report"><span class='icon-field'><i class="fa fa-th-list"></i></span> Internship Report</a>
				<?php if($_SESSION['login_type'] == 1||$_SESSION['login_type'] == 3): ?>
				<div class="mx-2 text-white">Systems</div>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a> -->
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
