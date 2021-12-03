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
	input[name = "name"],[type = "password"],[name="company_id"]{
  border-color: #2ecc71;
  color:#000;
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
input[name = "username"]{
cursor: not-allowed;
}

</style>
<div class="container-fluid">
	
	<center><img src="logo.png"width="70px" height="70px"></center>
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<br>
		<b class="text-muted"><h5><sup><center><u>Account</u></center></b></sup></h5>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off" required readonly>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off" required>
			<small id="pass"></small>
		</div>
		
		<?php if(!isset($_GET['mtype'])): ?>
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Company</option>
				<option value="3" <?php echo isset($meta['type']) && $meta['type'] == 3 ? 'selected': '' ?>hidden>Admin2</option>
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>hidden>Admin</option>
			</select>
		</div>
		
		<?php endif; ?>
		
<div id="msg"></div>
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
			$('#msg').html('')
		}
		else if($("[name='password']").val()==''){
			$('#pass').html('')
			$('[name="password"]').removeClass("border-danger")
		}
		})

	$('[name="username"]').keyup(function(){
		var user = $('[name="username"]').val()
			if(user.length >0){
			$('[name="username"]').removeClass("border-danger")
			$('#msg').html('')
		}
	})
	$('[name="name"]').keyup(function(){
		var name = $('[name="name"]').val()
			if(name.length >0){
			$('[name="name"]').removeClass("border-danger")
			$('#msg').html('')
		}
	})

	$('#manage-user').submit(function(e){
		var pass = $('[name="password"]').val()
		var user = $('[name="username"]').val()
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
		if(user.length <=0){
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
				var user = $('[name="username"]').val()
				if(user !='admin'){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
					
				}else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>');;
					$('[name="username"]').addClass("border-danger")
					end_load()
				}
					
					
				
			}
		})
	})

</script>