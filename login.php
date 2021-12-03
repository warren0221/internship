<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){
	
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Internship Management System</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;

	}
#type{
	display: none;
}
.card{
	background-color: #912c2c;
animation: transitionIn 1s;
}

.card-body{
	color:white;
}
input[type = "text"],[type = "password"]{
  border-color: #2ecc71;
  color:#000;
  border-width: 3px;
  
  box-shadow: 2px 2px 2px rgba(0,0,0.3);
}
#button{
	box-shadow: 2px 2px 2px rgba(0,0,0.3);
	background-color: white;
    color: black;
    border-color: white;
    border-radius: 8px;
}
#button:hover{
    background-color:#A9A9A9;
    color: black;
    border-color:#912c2c;
    box-shadow: 2px 2px 2px rgba(0,0,0.3);
    }
@keyframes transitionIn{
	from{
		opacity: 0;
		transition: rotateX(-10deg);
	}
	to{
		opacity: 1;
		transition: rotateX(0);
	}
}

#logo{
	
	position: center;
}

</style>

<body class="bg-dark">


  <main id="main" >
  	
  		<div class="align-self-center w-100">
  			
		
  		<div id="login-center" class="bg-dark row justify-content-center">
  			<div class="card col-md-4">
  				<div class="card-body">

  					<center><img id="logo"src="logo.png"width="130px" height="130px"></center>
  					<h4 class="text-white text-center"><b>LOGIN</b></h4>
  					<form id="login-form" >

  						<div class="form-group">
  							<label for="username" class="control-label"><i class="fa fa-user"></i>&nbsp;Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  							
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label"><i class="fa fa-lock"></i>&nbsp;Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<div class="form-group">
  							
  							<select name="type" id="type" class="custom-select"type="hidden">
  								<option value="1">Admin</option>
  								<option value="2">Student</option>
  								
  							</select>

  						</div>
  						<center><button id="button" class="btn-sm btn-block btn-wave col-md-4 btn-primary"><b>Login</b></button></center>
  					</form>
  				</div>
  			</div>
  		</div>
  		</div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>

	$('[name="username"]').keyup(function(){
		var username = $('[name="username"]').val()
		var type = $('[name="type"]').val()
		if(username=="admin"){
			$('[name="type"]').val(1)
		}
		
		else{
			$('[name="type"]').val(1)
		}
		
		})
	$('[name="username"]').keyup(function(){
		var username = $('[name="username"]').val()
		var type = $('[name="type"]').val()
		if(username.length==8){	
			$('[name="type"]').val(2)	
		}
		else{
			$('[name="type"]').val(1)
		}
		
		})
	
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();

		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				
				if(resp == 1){
					
					location.href ='index.php?page=home';
					
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
	$('.number').on('input',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        $(this).val(val)
    })
    
</script>	
</html>