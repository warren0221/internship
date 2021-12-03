<style>
		.card-header{
	background-color: #912c2c;
	color:white;
}
.edit_user{
	background-color:#696969;
	color:white;
	border:none;
}
.delete_user{
	background-color: #912c2c;
	color:white;
	border:none;
}
#new_user{
background-color: white;
color:#912c2c;
border:none;
padding-left: 50px;
padding-right: 50px;
}
table{
	background-color: #DCDCDC;
	border-color: black;
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
	<br>
	<div class="col-lg-12">
		<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
		<div class="card ">
			<div class="card-header"><b>User List</b></div>
			<div class="card-body">
				<table class="table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Type</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Company","Admin2");
 					$users = $conn->query("SELECT * FROM users where type!=1 order by type asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['name']) ?>
				 	</td>
				 	
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<?php echo $type[$row['type']] ?>
				 	</td>
				 	<td>
				 		<center>
							<button class="btn btn-sm btn-primary edit_user" type="button" data-id='<?php echo $row['id'] ?>'><b>Edit</b></button>
							<button class="btn btn-sm btn-danger delete_user" type="button" data-id='<?php echo $row['id'] ?>'><b>Delete</b></button>

						</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('table').dataTable();
$('#new_user').click(function(){
	uni_modal('New User','manage_user_add.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user_edit.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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
</script>