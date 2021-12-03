<?php include('db_connect.php');?>
<style>
	.card-header{
	background-color: #912c2c;
	color:white;
}
.edit_company{
	background-color:#696969;
	color:white;
	border:none;
}
.delete_company{
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
	border-color:#912c2c;
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
			<form action="" id="manage-company">
				<div class="card">
					<div class="card-header">
						    <b>Company Form</b>
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div id="commsg" class="form-group"></div>
							<div class="form-group">
								<label class="control-label">Company Name</label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label class="control-label">Contact #</label>
								<input type="text" class="form-control" name="contact" required>
							</div>
							<div class="form-group">
								<label class="control-label">Address</label>
								<textarea name="address" id="address" cols="30" rows="4" class="form-control" required></textarea>
							</div>
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3 save"><b>Save</b></button>
								<button class="btn btn-sm btn-default col-sm-3 cancel" type="button" onclick="$('#manage-company').get(0).reset()"> <b>Cancel</b></button>
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
						<b>Company List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Company Info.</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$company = $conn->query("SELECT * FROM companies order by id asc");
								while($row=$company->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="a">
										<p>name: <b><?php echo $row['name'] ?></b></p>
										<p><small>Contact #: <b><?php echo $row['contact'] ?></b></small></p>
										<p><small>Address: <b><?php echo $row['address'] ?></b></small></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_company" type="button" data-id="<?php echo $row['id'] ?>" data-address="<?php echo $row['address'] ?>" data-name="<?php echo $row['name'] ?>" data-contact="<?php echo $row['contact'] ?>" ><b>Edit</b></button>
										<button class="btn btn-sm btn-danger delete_company" type="button" data-id="<?php echo $row['id'] ?>"><b>Delete</b></button>
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
	$('#manage-company').on('reset',function(){
		$('input:hidden').val('')
	})
	
	$('#manage-company').submit(function(e){
		e.preventDefault()
		start_load()
		$('#commsg').html('')
		$.ajax({
			url:'ajax.php?action=save_company',
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
					$('#commsg').html('<div class="alert alert-danger">Company already exist.</div>')
					end_load()

				}
			}
		})
	})
	$('.edit_company').click(function(){
		start_load()
		var cat = $('#manage-company')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='address']").val($(this).attr('data-address'))
		cat.find("[name='contact']").val($(this).attr('data-contact'))
		end_load()
	})
	$('.delete_company').click(function(){
		_conf("Are you sure to delete this company?","delete_company",[$(this).attr('data-id')])
	})
	function delete_company($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_company',
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