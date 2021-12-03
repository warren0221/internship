<?php 
include('../db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM students where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<style>
	input[name = "name"],[name = "password"],[id= "username2"]{
  border-color: #2ecc71;
  color:#000;
}	

#space{
		margin-left: 130px;
	}

</style>
 <center><img src="../logo.png"width="70px" height="70px"></center>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required >
			<small id="name1"></small>
		</div>
		<div class="form-group">

			<label for="password">Password</label><small><i id="space">Leave this blank if you dont want to change the password.</i></small>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<?php if(isset($meta['id'])): ?>
			<small id="pass"></small>
		<?php endif; ?>
		</div>
		

	</form>
</div>
<script>
	$('[name="name"]').keyup(function(){
		var name = $('[name="name"]').val()
		if(name.length >0){
			$('[name="name"]').removeClass("border-danger")
			$('#msg').html('')
		}
		
		
	})
	
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
		var name = $('[name="name"]').val()
		e.preventDefault();
		start_load()
		if(pass.length >0 && pass.length <=5){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Password Range Must be (6-20) Characters*</i>')
			
			end_load()
				return false;
		}
		if(name.length ==0){
			$('[name="name"]').addClass("border-danger")
			$('#msg').html('<div class="alert alert-danger">Please Enter your Name</i>')
			
				end_load()
				return false;
		}

		$.ajax({
			url:'../ajax.php?action=save_student',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})

</script>