<?php include('db_connect.php');?>
<style>
	.card-header{
	background-color: #912c2c;
	color:white;
}
.edit_course{
	background-color:#696969;
	color:white;
	border:none;
}
.delete_course{
	background-color: #912c2c;
	color:white;
	border:none;
}
.table{
	background-color: #DCDCDC;
	border-color: black;

}
.cancel{
	border-color: gray;
}
.cancel:hover{
	border-color: #912c2c;
}
.save{
	background-color: #912c2c;
	color:white;
	border-color: white;
}
.save:hover{
		background-color:#DCDCDC;
        color: black;
        border-color:#912c2c;
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
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-course">
				<div class="card">
					<div class="card-header">
						    <b>Course Form</b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div id="cormsg" class="form-group"></div>
							<div class="form-group">
								<label class="control-label">Course</label>
								<input type="text" class="form-control" name="course" required>
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea name="description" id="description" cols="30" rows="4" class="form-control" required></textarea>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3 save"><b> Save</b></button>
								<button class="btn btn-sm btn-default col-sm-3 cancel" type="button" onclick="$('#manage-course').get(0).reset()"><b> Cancel</b></button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Course List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Course Info.</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$course = $conn->query("SELECT * FROM courses order by id asc");
								while($row=$course->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<p>Course: <b><?php echo $row['course'] ?></b></p>
										<p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_course" type="button" data-id="<?php echo $row['id'] ?>" data-description="<?php echo $row['description'] ?>" data-course="<?php echo $row['course'] ?>" ><b>Edit</b></button>
										<button class="btn btn-sm btn-danger delete_course" type="button" data-id="<?php echo $row['id'] ?>"><b>Delete</b></button>
									</td>
								</tr>
								<?php endwhile; ?>
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
</style>
<script>
	$('#manage-course').on('reset',function(){
		$('input:hidden').val('')
	})
	
	$('#manage-course').submit(function(e){
		e.preventDefault()
		start_load()
		$('#cormsg').html('')
		$.ajax({
			url:'ajax.php?action=save_course',
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
					$('#cormsg').html('<div class="alert alert-danger">Course already exist.</div>')
					end_load()

				}
			}
		})
	})
	$('.edit_course').click(function(){
		start_load()
		var cat = $('#manage-course')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='course']").val($(this).attr('data-course'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		end_load()
	})
	$('.delete_course').click(function(){
		_conf("Are you sure to delete this course?","delete_course",[$(this).attr('data-id')])
	})
	function delete_course($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_course',
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