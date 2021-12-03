<?php include('db_connect.php');?>
<style>
#row{
	margin-left: 350px;
}
.card-header{
	background-color: #912c2c;
	color:white;
}
#new_student{
background-color: white;
color:#912c2c;
border:none;
margin-left: 685px;
}
.edit_student{
	background-color:#696969;
	color:white;
	border:none;
}
.edit_student1{
	background-color:#696969;
	color:white;
	border:none;
}
.delete_student{
	background-color: #912c2c;
	color:white;
	border:none;
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
.card{
	animation: transitionIn 1s;
}

</style>
<div class="col-lg-12">
		<div id="row" class="row">
			<span class="float:right"><a class="btn btn-primary btn-sm col-sm-3 float-right" href="javascript:void(0)" id="new_student">
			                    <i class="fa fa-plus"></i> New 
			                </a></span>
					</div>
				</div>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Student List</b>
						
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">ID</th>
									<th class="text-center">Student Info</th>
									<th class="text-center">Course</th>
									<th class="text-center">Internship Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($_SESSION['login_type'] == 1||$_SESSION['login_type'] == 3): ?>
								<?php 
								$i = 1;
								$cname[0] = "Not Set";
								$companies = $conn->query("SELECT * FROM companies  ");
								while($row = $companies->fetch_assoc()){
									$cname[$row['id']] = ucwords($row['name']);
								}
								$student = $conn->query("SELECT s.*,c.course FROM students s inner join courses c on c.id = s.course_id  order by id asc");
								while($row=$student->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo $row['id_no'] ?></b></p>
									</td>
									<td class="">
										<p>Name: <b><?php echo $row['name'] ?></b></p>
										<p><small>Contact #: <b><?php echo $row['contact'] ?></b></small></p>
										<p><small>Address: <b><?php echo $row['address'] ?></b></small></p>
									</td>
									<td class="">
										<p><b><?php echo $row['course'] ?></b></p>
									</td>
									<td class="">
										<p>Company: <b><?php echo $cname[$row['company_id']] ?></b></p>
										<p><small>Required Duration: <b><?php echo $row['required_duration'] ?> hrs.</b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_student" type="button" data-id="<?php echo $row['id'] ?>"><b>Edit</button>
										<button class="btn btn-sm btn-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>">Delete</b></button>
									</td>
								</tr>
								<?php endwhile; ?>
								<?php endif; ?>
								<?php if($_SESSION['login_type'] == 2): ?>
								<?php 
								$i = 1;
								$cname[0] = "Not Set";
								$companies = $conn->query("SELECT * FROM companies ");
								while($row = $companies->fetch_assoc()){
									$cname[$row['id']] = ucwords($row['name']);
								}
								$student = $conn->query("SELECT s.*,c.course FROM students s inner join courses c on c.id = s.course_id  order by id asc");
								while($row=$student->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p><b><?php echo $row['id_no'] ?></b></p>
									</td>
									<td class="">
										<p>Name: <b><?php echo $row['name'] ?></b></p>
										<p><small>Contact #: <b><?php echo $row['contact'] ?></b></small></p>
										<p><small>Address: <b><?php echo $row['address'] ?></b></small></p>
									</td>
									<td class="">
										<p><b><?php echo $row['course'] ?></b></p>
									</td>
									<td class="">
										<p>Company: <b><?php echo $cname[$row['company_id']] ?></b></p>
										<p><small>Required Duration: <b><?php echo $row['required_duration'] ?> hrs.</b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_student1" type="button" data-id="<?php echo $row['id'] ?>"><b>Evaluate</button>
										<button class="btn btn-sm btn-danger delete_student" type="button" data-id="<?php echo $row['id'] ?>">Delete</b></button>
									</td>
								</tr>
								<?php endwhile; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
	
	
</style>
<script>
	$('#new_student').click(function(){
		uni_modal("New Student","manage_student.php","large")
	})
	$('.edit_student').click(function(){
		uni_modal("Edit Student","manage_student_edit.php?id="+$(this).attr('data-id'),"large")
	})
	$('.edit_student1').click(function(){
		uni_modal("Edit Student","manage_student_evaluate.php?id="+$(this).attr('data-id'),"large")
	})
	$('#manage-student').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#manage-student').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_student',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.delete_student').click(function(){
		_conf("Are you sure to delete this student?","delete_student",[$(this).attr('data-id')])
	})
	function delete_student($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_student',
			method:'POST',
			data:{id:$id},
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
	$('table').dataTable()
</script>