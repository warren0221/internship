<?php include "db_connect.php" ?>
<?php 
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM students where id = ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
<style>
body{
  margin: 0;
  padding: 0;
  
  background-size: cover;
  
}


  input[type = "text"],[type = "password"],[type = "number"]{
  border-color: #2ecc71;
  color:#000;

}	

textarea[name = "address"]{
  border-color: #2ecc71;
  color:#000;
}
select[name="course_id"],[name="company_id"]{
	border-color: #2ecc71;
	color:#000;
}
img#a{
	margin-left: 1rem;
	
}

</style>
<div class="container-fluid">

	<form action="" id="manage-student">
		<img src="logo.png" id="a" width="50px" height="50px">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6 border-right">
					<b class="text-muted"><h5><sup><center><u>Student Informations</u></center></b></sup></h5>
					<div class="form-group">
						<label class="label control-label">Student ID No.</label>
						<input type="number" class="form-control form-control-sm w-100"maxlength="8" name="id_no"   value="<?php echo isset($id_no) ? $id_no : '' ?>">
						<small id="id" ></small>
					</div>
					<div class="form-group">
						<label class="label control-label">Full Name</label>
						<input type="text" class="form-control form-control-sm w-100" name="name" value="<?php echo isset($name) ? $name : '' ?>">
						<small id="name" ></small>
					</div>
					<div class="form-group">
						<label class="label control-label">Contact</label>
						<input type="number" class="form-control form-control-sm w-100" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>">
						<small id="contact" ></small>
					</div>
					<div class="form-group">
						<label class="label control-label">Address</label>
						<textarea name="address" id="" cols="30" rows="3" class="form-control" ><?php echo isset($address) ? $address : '' ?></textarea>
						<small id="address" ></small>
					</div>

					<div class="form-group">
						<label class="label control-label">Course</label>
						<select name="course_id" id="" class="custom-select custom-select-sm select2" >
							<option value=""></option>
							<?php
							$courses = $conn->query("SELECT * FROM courses order by course asc");
							while($row= $courses->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($course_id) && $course_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['course']) ?></option>
						<?php endwhile; ?>
						</select>
						<small id="course" ></small>
					</div>
				</div>
				<div class="col-md-6">
					<b class="text-muted"><h5><sup><center><u>Internship Details</u></center></b></sup></h5>
					<div class="form-group">
						<label class="label control-label">Company</label>
						<select name="company_id" id="" class="custom-select custom-select-sm select2" >
							<option value=""></option>
							<?php
							$companies = $conn->query("SELECT * FROM companies order by name asc");
							while($row= $companies->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($company_id) && $company_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
						<?php endwhile; ?>
						</select>
						<small id="company" ></small>
					</div>
					<div class="form-group">
						<label class="label control-label">Required Duration (hr.)</label>
						<input type="number" class="form-control form-control-sm w-100" name="required_duration" value="<?php echo isset($required_duration) ? $required_duration : '' ?>">
						<small id="duration" ></small>
					</div>
					<b class="text-muted"><sup><center><u>System Credential</b></u></center></sup>
					<div class="form-group">
						<label class="label control-label">Password</label>
						<input type="password" class="form-control form-control-sm w-100" name="password" maxlength="20" >
						
						<small id="pass" ></small>
					</div>
					
					<div class="form-group">
						<label class="label control-label">Confirm Password</label>
						<input type="password" class="form-control form-control-sm w-100" name="cpass"maxlength="20" >
						<small id="pass_match" data-status=''></small>
					</div>
				</div>
			</div>
			
		</div>

<div id="msg" class="form-group"></div>
	</form>
</div>

<script>
	//password
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		var name = $('[name="name"]').val()
		var contact = $('[name="contact"]').val()
		var address = $('[name="address"]').val()
		var course = $('[name="course_id"]').val()
		var company = $('[name="company_id"]').val()
		var duration = $('[name="required_duration"]').val()
		var id = $('[name="id_no"]').val()

		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
			$('#msg').html("<div></div>")
		}else{
			if(cpass == pass||pass ==cpass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched*</i>')
				$('[name="password"]').removeClass("border-danger")
				$('[name="cpass"]').removeClass("border-danger")
			}else{
				if(cpass!=pass||pass!=cpass ){
				$('[name="password"]').addClass("border-danger")
				$('[name="cpass"]').addClass("border-danger")
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match*</i>')
				}
			}
		}
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','1').html('<i class="text-success"></i>')
			$('[name="password"]').removeClass("border-danger")
			$('#pass_match').attr('data-status','2').html('<i class="text-danger"></i>')
		}
		if(cpass != '' ||pass != ''){
			$('#pass_match').attr('data-status','')
			$('#msg').html('<i> </i>')
		}
	})
	//id
$('[name="id_no"]').keyup(function(){
		var id = $('[name="id_no"]').val()
		if(id.length >0&&id.length <=7 ){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Student ID must consist of 8 digits*</i>')
		}
		else if(id.length >8 ){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Student ID must consist of 8 digits*</i>')
			
		}
		else if(id =='' ){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Please Enter your Student ID*</i>')
			
		}
		else{
			$('#id').html('')
			$('[name="id_no"]').removeClass("border-danger")
			$('#msg').html('')
		}
		
	})
//name
$('[name="name"]').keyup(function(){
		var name = $('[name="name"]').val()
		if(name.length >0){
			$('#name').html('')
			$('[name="name"]').removeClass("border-danger")
			$('#msg').html('')
		}
		else if($("[name='name']").val()==''){
			$('[name="name"]').addClass("border-danger")
			$('#name').html('<i class="text-danger">Please Enter your Name*</i>')
		}
		
		
	})
$('[name="contact"]').keyup(function(){
		var contact = $('[name="contact"]').val()
		if(contact.length >0&&contact.length <=10 ){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Contact Number must consist of 11 digits*</i>')
			$('#msg').html('')
		}
		else if(contact.length >11 ){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Contact Number must consist of 11 digits*</i>')
			
		}
		else if($("[name='contact']").val()==''){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Please Enter your Contact Number*</i>')
		}
		else{
			$('#contact').html('')
			$('[name="contact"]').removeClass("border-danger")
		}

		
	})
$('[name="address"]').keyup(function(){
		var address = $('[name="address"]').val()
		if(address.length >0){
			$('#address').html('')
			$('[name="address"]').removeClass("border-danger")
			$('#msg').html('')
		}
		else if($("[name='address']").val()==''){
			$('[name="address"]').addClass("border-danger")
			$('#address').html('<i class="text-danger">Please Enter your Address*</i>')
		}
		
		
	})
$('[name="required_duration"]').keyup(function(){
		var duration = $('[name="required_duration"]').val()
		if(duration.length >0){
			$('#duration').html('')
			$('[name="required_duration"]').removeClass("border-danger")
			$('#msg').html('')
		}
		else if($("[name='required_duration']").val()==''){
			$('[name="required_duration"]').addClass("border-danger")
			$('#duration').html('<i class="text-danger">Please Enter your Required Duration*</i>')
		}
		
		
	})
$('[name="password"]').keyup(function(){
		var pass = $('[name="password"]').val()
		if(pass.length >5){
			$('#pass').html('')
			$('[name="password"]').removeClass("border-danger")
			$('#msg').html('')
		}
		else if(pass.length >0 && pass.length <=5){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Password Range Must be (6-20) Characters*</i>')
			$('#msg').html('')
		}
		else if($("[name='password']").val()==''){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Please Enter your Password*</i>')
		}
		
		
	})

	//submit
	$('#manage-student').submit(function(e){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		var name = $('[name="name"]').val()
		var address = $('[name="address"]').val()
		var contact = $('[name="contact"]').val()
		var course = $('[name="course_id"]').val()
		var company = $('[name="company_id"]').val()
		var duration = $('[name="required_duration"]').val()
		var id = $('[name="id_no"]').val()
		e.preventDefault()
		
		start_load()
		$('#msg').html('')
		$('#id').html('')
		$('#name').html('')
		$('#contact').html('')
		$('#address').html('')
		$('#course').html('')
		$('#company').html('')
		$('#duration').html('')
		if($("[name='id_no']").val()==''&& $("[name='name']").val()==''&& $("[name='contact']").val()==''&& $("[name='address']").val()==''&& $("[name='contact']").val()==''&& $("[name='course_id']").val()==''&& $("[name='company_id']").val()==''&& $("[name='required_duration']").val()==''&& $("[name='password']").val()==''){

			$('[name="id_no"],[name="name"],[name="contact"],[name="address"],[name="course_id"],[name="company_id"],[name="required_duration"],[name="password"],[name="cpass"]').addClass("border-danger")

			$('#msg').html("<div class='alert alert-danger'>Please Fill up all fields</div>")
				end_load()
				return false;
			}
				else {
					$('[name="course_id"]').removeClass("border-danger")
					$('[name="company_id"]').removeClass("border-danger")
					$('[name="address"]').removeClass("border-danger")
					$('[name="name"]').removeClass("border-danger")
					$('[name="contact"]').removeClass("border-danger")
					$('[name="required_duration"]').removeClass("border-danger")
					$('[name="password"]').removeClass("border-danger")
					$('[name="cpass"]').removeClass("border-danger")
				}
				if(cpass!=pass||pass!=cpass ){
				$('[name="password"]').addClass("border-danger")
				$('[name="cpass"]').addClass("border-danger")
				
				}

		if($("[name='id_no']").val()==''){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Please Enter your Student ID*</i>')
			end_load()
				return false;
		}
		
		else if(id.length >0 && id.length <=7 ){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Student ID must consist of 8 digits*</i>')
			end_load()
				return false;
		}
		else if(id.length >8 ){
			$('[name="id_no"]').addClass("border-danger")
			$('#id').html('<i class="text-danger">Student ID must consist of 8 digits*</i>')
			end_load()
				return false;
		}
		
				
				 
		
		if($("[name='name']").val()==''){
			$('[name="name"]').addClass("border-danger")
			$('#name').html('<i class="text-danger">Please Enter your Name*</i>')
				end_load()
				return false;
		}
		if($("[name='contact']").val()==''){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Please Enter your Contact Number*</i>')
				end_load()
				return false;
		}
		else if(contact.length >0 && contact.length <=10 ){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Contact Number must consist of 11 digits*</i>')
			end_load()
				return false;
		}
		else if(contact.length >11 ){
			$('[name="contact"]').addClass("border-danger")
			$('#contact').html('<i class="text-danger">Contact Number must consist of 11 digits*</i>')
			end_load()
				return false;
		}

		if($("[name='address']").val()==''){
			$('[name="address"]').addClass("border-danger")
			$('#address').html('<i class="text-danger">Please Enter your Address*</i>')
				end_load()
				return false;
		}
		if(course==''){
			if(course==''){
			$('[name="course_id"]').addClass("border-danger")
			$('#course').html('<i class="text-danger">Please Choose your Course*</i>')
				end_load()
				return false;	
				}
		}
		
					
				
		if($("[name='company_id']").val()==''){
			$('[name="company_id"]').addClass("border-danger")
			$('#company').html('<i class="text-danger">Please Choose your Company*</i>')
				end_load()
				return false;
		}
		if($("[name='required_duration']").val()==''){
			$('[name="required_duration"]').addClass("border-danger")
			$('#duration').html('<i class="text-danger">Please Enter your Required Duration*</i>')
				end_load()
				return false;
		}
		if($("[name='password']").val()==''){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Please Enter your Password*</i>')
				end_load()
				return false;
		}
		
		else if(pass.length >0 && pass.length <=5){
			$('[name="password"]').addClass("border-danger")
			$('#pass').html('<i class="text-danger">Password Range Must be (6-20) Characters*</i>')
			$('#msg').html('')
			end_load()
				return false;
		}
		if($("[name='cpass']").val()==''){
			$('[name="cpass"]').addClass("border-danger")
			$('#pass_match').html('<i class="text-danger">Please Confirm your Password*</i>')
				end_load()
				return false;
		}
		if($('#pass_match').attr('data-status') != 1){
			if(cpass!=pass||pass!=cpass){
				$('[name="password"]').addClass("border-danger")
				$('[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
		$.ajax({
			url:'ajax.php?action=save_student',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.reload()
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>ID Number already exist.</div>");
					$('[name="id_no"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>