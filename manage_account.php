<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<style>
	#space{
		margin-left: 130px;
	}
	input[name = "name"],[name = "password"],[id= "username2"]{
  border-color: #2ecc71;
  color:#000;
}	
input[id = "username1"]{
cursor: not-allowed;
}
} 
select[name="type"]{
	border-color: #2ecc71;
	color:#000;
}
#type{
	border-color: #2ecc71;
	color:#000;
}

<?php include_once('processForm.php') ?>
</style>
<div class="container-fluid">
	<div id="msg"></div>
	<center><img id="logo" src="logo.png"width="70px" height="70px"></center>
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<?php if($_SESSION['login_type'] == 1||$_SESSION['login_type'] == 3): ?>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username1" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off" required readonly>
		</div>
		<?php endif; ?>
		<br>
		<?php if($_SESSION['login_type'] == 2): ?>
			<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username2" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off" required >
		</div>
		<?php endif; ?>
		<br>
		<b class="text-muted"><h5><sup><center><u>Account</u></center></b></sup></h5>
		<div class="form-group">
			<label for="password">Password</label>
			<small><i id="space">Leave this blank if you dont want to change the password.</i></small>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off" required>
			<small id="pass"></small><br>
			<?php if(isset($meta['id'])): ?>
			<label for="type">Type</label>
				<select name="type" id="type" class="custom-select">
					<?php if($_SESSION['login_type'] == 1): ?>
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 3): ?>
				<option value="3" <?php echo isset($meta['type']) && $meta['type'] == 3 ? 'selected': '' ?>>Admin2</option>
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 2): ?>
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>disabled>Staff</option>
				<?php endif; ?>
			</select>
		<?php endif; ?>
		</div>
		<?php if(isset($meta['type']) && $meta['type'] == 3): ?>
			<input type="hidden" name="type" value="3">
		<?php else: ?>
		<?php if(!isset($_GET['mtype'])): ?>
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="3" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin2</option>
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
			</select>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		

	</form>
</div>
<script>
	
	
	$('[name="password"]').keyup(function(){
		var pass = $('[name="password"]').val()
		if(pass.length >5){
			$('#pass').html('')
			$('[name="password"]').removeClass("border-danger")
			
		}
		else if(pass.length >0 && pass.length <=5){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Password Range Must be (6-20) Characters*</i>')
			
		}
		else if($("[name='password']").val()==''){
			$('#pass').html('')
			$('[name="password"]').removeClass("border-danger")
		}
		
		
	})
	$('#manage-user').submit(function(e){
		var pass = $('[name="password"]').val()
		var user = $('[name="username"]').val()
		var user2 = $('[name="username"]').val()
		var user3 = $('[name="username"]').val()
		var name = $('[name="name"]').val()
		e.preventDefault();
		start_load()
		if(pass.length >0 && pass.length <=5){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Password Range Must be (6-20) Characters*</i>')
			
			end_load()
				return false;
		}
		if(name.length <=0){
			$('[name="name"]').addClass("border-danger")
			$('#msg').html('<div class="alert alert-danger">Please Enter your Name</i>')
			
				end_load()
				return false;
		}
		if(user.length <=0||user2.length <=0){
			$('[name="username"]').addClass("border-danger")
			$('#msg').html('<div class="alert alert-danger">Please Enter your Username</i>')
			
				end_load()
				return false;
		}
		
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				<?php if($_SESSION['login_type'] == 2): ?>
				if(user2=="admin"){
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
					
					
				}else{
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 1): ?>
				if(user !="admin"){
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()	
					
				}else{
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 3): ?>
				if(user3!="admin2"){
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
					
					
				}else{
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				<?php endif; ?>
			}
		})
	})

</script>