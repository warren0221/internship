<?php include "db_connect.php"
 ?>

<?php 

if(isset($_GET['id'])){

	$qry = $conn->query("SELECT * FROM students where id = ".$_GET['id']);
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}

?>
<style>



 #score{
 	
 	font-size: 15px;
 	
 }
img{
	margin-left: 1rem;
	
}
#scroll{
	width: 1300px; height:480px;
	overflow: scroll;

}
#table{
	color:black;
}
#table1{
	color: black;
	font-size: 15px;
}
input[type='radio'] {

  
  vertical-align: middle;
-webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  display: inline-block;
  width: 23px;
  height: 23px;
  padding: 2px;
  
  background-clip: content-box;
  border: 1px solid #bbbbbb;
  background-color: white;
  border-radius: 50%;

}
input[type="radio"]:checked {
  background-color: maroon;

}
::-webkit-scrollbar {
width: 12px;
height: 12px;
}

::-webkit-scrollbar-track {
width: 2px;
border: 1px solid maroon;
}

::-webkit-scrollbar-thumb {
background: maroon;
}

::-webkit-scrollbar-thumb:hover {
background: firebrick;  
}
</style>

<div class="container-fluid">
<div id="scroll">
	<form action="" id="manage-student" method="post">
		<img src="logo.png"width="50px" height="50px">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6 border-right">
					
					<div class="form-group">
						<label class="label control-label">Student ID No.</label>
						<input type="number" class="form-control form-control-sm w-100"maxlength="8" name="id_no"   value="<?php echo isset($id_no) ? $id_no : '' ?>" readonly>
						<small id="id" ></small>
					</div>
					
					<div class="form-group">
						<label class="label control-label">Evaluator</label>
						<input type="text" class="form-control form-control-sm w-100" name="evaluator" value="<?php echo isset($evaluator) ? $evaluator : '' ?>" >
						<small id="evaluator" ></small>
					</div>
				</div>
				<div class="col-md-6">
					
					<div class="form-group">
						<label class="label control-label">Full Name</label>
						<input type="text" class="form-control form-control-sm w-100" name="name" value="<?php echo isset($name) ? $name : '' ?>" readonly >
						<small id="name" ></small>
					</div>
					<div class="form-group">
						<label class="label control-label">Position</label>
						<input type="text" class="form-control form-control-sm w-100" name="position" value="<?php echo isset($position) ? $position : '' ?>" >
						<small id="position" ></small>
					</div>
					
					<div class="form-group">
						
						<input type="password" class="form-control form-control-sm w-100" name="password" maxlength="20"style="display: none" >
						<small id="pass" ></small>

						
					</div>
					
					<div class="form-group">
						
						<input type="password" class="form-control form-control-sm w-100" name="cpass"maxlength="20" style="display: none">
						<small id="pass_match" data-status=''></small>
					</div>
				</div>
			</div>

		</div>

<br><b><center><i><h6>Directions.  Using the scale below,  please select the rating that best describe the competencies of  the intern.</i></b></h6></center><br>
<p><center><table id="table" border="1" width="900" height="270" >
	<tr>
	<td>5</td>
	<td>Outstanding(O)</td>
	<td>Performance exceeds the required standard.</td>
	</tr>
	<tr>
	<td>4</td>
	<td>Very Satisfactory (VS)</td>
	<td>Performance fully met the training requirements. The intern performed what was expected of him/her.</td>
	</tr>
	<tr>
	<td>3</td>
	<td>Satisfactory (S)</td>
	<td>Performance has met the required standards, the intern performed duties with minimal supervision.</td>
	</tr>
	<tr>
	<td>2</td>
	<td>Fair (F)</td>
	<td>Performance partially meets the required standard, observed to be less than satisfactory, a lot could be done better.</td>
	</tr>
	<tr>
	<td>1</td>
	<td>Needs Improvement (NI)</td>
	<td>Performance does not meet the required standard. Major improvement may be needed.</td>
	</tr>
	<tr>
	<td>0</td>
	<td>Not applicable N/A</td>
	<td>Performance indicator is not relevant to the training.</td>
	</tr>
</p>
</table>
<p><center><table id="table1" border="1" width="900" height="270">
	<tr>
	<td><center><b>COMPETENCIES</b></td>
	<td>O (5)</td>
	<td>VS (4)</td>
	<td>S (3)</td>
	<td>F (2)</td>
	<td>NI (1)</td>
	<td>N/A (0)</td>
	</center>
	</tr>
	<tr>
	<td>&nbsp;&nbsp;<b>TEAMWORK</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td>1. Consistently works with others to accomplish goals and tasks.</td>
	<td><center><input type="radio" name="choice1" value="5" 
		<?php 
	 if($choice1=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice1" value="4" 	
		<?php 
	 if($choice1=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice1" value="3"
		<?php 
	 if($choice1=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice1" value="2"
		<?php 
	 if($choice1=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice1" value="1" 
		<?php 
	 if($choice1=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice1" value="0"
		<?php 
	 if($choice1=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>

	<tr>
	<td>2. Treats all team members in respectful and courteous manner.</td>
	<td><center><input type="radio" name="choice2" value="5" 
		<?php 
	 if($choice2=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice2" value="4" 	
		<?php 
	 if($choice2=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice2" value="3"
		<?php 
	 if($choice2=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice2" value="2"
		<?php 
	 if($choice2=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice2" value="1" 
		<?php 
	 if($choice2=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice2" value="0"
		<?php 
	 if($choice2=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	
	<tr>
	<td>3. Actively participates in activities and assigned tasks.</td>
	<td><center><input type="radio" name="choice3" value="5" 
		<?php 
	 if($choice3=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice3" value="4" 	
		<?php 
	 if($choice3=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice3" value="3"
		<?php 
	 if($choice3=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice3" value="2"
		<?php 
	 if($choice3=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice3" value="1" 
		<?php 
	 if($choice3=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice3" value="0"
		<?php 
	 if($choice3=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr>
	<td>4. Willingly works with team members to continuously improve team 
    collaboration</td>
	<td><center><input type="radio" name="choice4" value="5" 
		<?php 
	 if($choice4=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice4" value="4" 	
		<?php 
	 if($choice4=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice4" value="3"
		<?php 
	 if($choice4=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice4" value="2"
		<?php 
	 if($choice4=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice4" value="1" 
		<?php 
	 if($choice4=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice4" value="0"
		<?php 
	 if($choice4=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr>
	<td>5. Considers feedbacks and views of team members when completing 
     assigned tasks.</td>
	<td><center><input type="radio" name="choice5" value="5" 
		<?php 
	 if($choice5=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice5" value="4" 	
		<?php 
	 if($choice5=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice5" value="3"
		<?php 
	 if($choice5=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice5" value="2"
		<?php 
	 if($choice5=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice5" value="1" 
		<?php 
	 if($choice5=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice5" value="0"
		<?php 
	 if($choice5=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<br><br>
	<td>&nbsp;&nbsp;<b>COMMUNICATION</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<tr>
	<td>6. Listens conscientiously to supervisor and co-workers</td>
	<td><center><input type="radio" name="choice6" value="5" 
		<?php 
	 if($choice6=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice6" value="4" 	
		<?php 
	 if($choice6=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice6" value="3"
		<?php 
	 if($choice6=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice6" value="2"
		<?php 
	 if($choice6=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice6" value="1" 
		<?php 
	 if($choice6=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice6" value="0"
		<?php 
	 if($choice6=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>7. Comprehends written and oral information</td>
	<td><center><input type="radio" name="choice7" value="5" 
		<?php 
	 if($choice7=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice7" value="4" 	
		<?php 
	 if($choice7=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice7" value="3"
		<?php 
	 if($choice7=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice7" value="2"
		<?php 
	 if($choice7=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice7" value="1" 
		<?php 
	 if($choice7=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice7" value="0"
		<?php 
	 if($choice7=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	</tr>
	<tr>
	<td>8. Consistently delivers accurate information</td>
	<td><center><input type="radio" name="choice8" value="5" 
		<?php 
	 if($choice8=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice8" value="4" 	
		<?php 
	 if($choice8=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice8" value="3"
		<?php 
	 if($choice8=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice8" value="2"
		<?php 
	 if($choice8=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice8" value="1" 
		<?php 
	 if($choice8=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice8" value="0"
		<?php 
	 if($choice8=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>9. Reliably provides feedback as required, both internally and externally</td>
	<td><center><input type="radio" name="choice9" value="5" 
		<?php 
	 if($choice9=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice9" value="4" 	
		<?php 
	 if($choice9=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice9" value="3"
		<?php 
	 if($choice9=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice9" value="2"
		<?php 
	 if($choice9=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice9" value="1" 
		<?php 
	 if($choice9=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice9" value="0"
		<?php 
	 if($choice9=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<td>&nbsp;&nbsp;<b>ATTENDANCE & PUNCTUALITY</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<tr>
	<td>10. Is consistently punctual</td>
	<td><center><input type="radio" name="choice10" value="5" 
		<?php 
	 if($choice10=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice10" value="4" 	
		<?php 
	 if($choice10=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice10" value="3"
		<?php 
	 if($choice10=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice10" value="2"
		<?php 
	 if($choice10=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice10" value="1" 
		<?php 
	 if($choice10=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice10" value="0"
		<?php 
	 if($choice10=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	</tr>
	<tr>
	<td>11. Maintains good attendance and participation</td>
	<td><center><input type="radio" name="choice11" value="5" 
		<?php 
	 if($choice11=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice11" value="4" 	
		<?php 
	 if($choice1=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice11" value="3"
		<?php 
	 if($choice11=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice11" value="2"
		<?php 
	 if($choice11=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice11" value="1" 
		<?php 
	 if($choice11=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice11" value="0"
		<?php 
	 if($choice11=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>12. Informs supervisor promptly if absent or late</td>
	<<td><center><input type="radio" name="choice12" value="5" 
		<?php 
	 if($choice12=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice12" value="4" 	
		<?php 
	 if($choice12=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice12" value="3"
		<?php 
	 if($choice12=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice12" value="2"
		<?php 
	 if($choice12=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice12" value="1" 
		<?php 
	 if($choice12=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice12" value="0"
		<?php 
	 if($choice12=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<td>&nbsp;&nbsp;<b>PRODUCTIVITY/RESILIENCE</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<tr>
	<td>13. Consistently delivers quality results</td>
	<td><center><input type="radio" name="choice13" value="5" 
		<?php 
	 if($choice13=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice13" value="4" 	
		<?php 
	 if($choice13=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice13" value="3"
		<?php 
	 if($choice13=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice13" value="2"
		<?php 
	 if($choice13=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice13" value="1" 
		<?php 
	 if($choice13=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice13" value="0"
		<?php 
	 if($choice13=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>14. Meets deadlines and manages time well</td>
	<td><center><input type="radio" name="choice14" value="5" 
		<?php 
	 if($choice14=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice14" value="4" 	
		<?php 
	 if($choice14=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice14" value="3"
		<?php 
	 if($choice14=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice14" value="2"
		<?php 
	 if($choice14=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice14" value="1" 
		<?php 
	 if($choice14=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice14" value="0"
		<?php 
	 if($choice14=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>15. Works around problems and obstacles in a stressful situation in 
      order  to achieve required tasks
</td>
	<td><center><input type="radio" name="choice15" value="5" 
		<?php 
	 if($choice15=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice15" value="4" 	
		<?php 
	 if($choice15=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice15" value="3"
		<?php 
	 if($choice15=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice15" value="2"
		<?php 
	 if($choice15=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice15" value="1" 
		<?php 
	 if($choice15=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice15" value="0"
		<?php 
	 if($choice15=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>16. Time management is effective and efficient</td>
	<td><center><input type="radio" name="choice16" value="5" 
		<?php 
	 if($choice16=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice16" value="4" 	
		<?php 
	 if($choice16=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice16" value="3"
		<?php 
	 if($choice16=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice16" value="2"
		<?php 
	 if($choice16=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice16" value="1" 
		<?php 
	 if($choice16=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice16" value="0"
		<?php 
	 if($choice16=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>17.  Informs supervisor of any challenges or barriers that transpire in tasks</td>
	<td><center><input type="radio" name="choice17" value="5" 
		<?php 
	 if($choice17=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice17" value="4" 	
		<?php 
	 if($choice17=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice17" value="3"
		<?php 
	 if($choice17=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice17" value="2"
		<?php 
	 if($choice17=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice17" value="1" 
		<?php 
	 if($choice17=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice17" value="0"
		<?php 
	 if($choice17=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<td>&nbsp;&nbsp;<b>INITIATIVE/PROACTIVITY</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td> 
	<tr>
	<td>18. Completes assignments with minimal  supervision</td>
	<td><center><input type="radio" name="choice18" value="5" 
		<?php 
	 if($choice18=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice18" value="4" 	
		<?php 
	 if($choice18=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice18" value="3"
		<?php 
	 if($choice18=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice18" value="2"
		<?php 
	 if($choice18=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice18" value="1" 
		<?php 
	 if($choice18=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice18" value="0"
		<?php 
	 if($choice18=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>19. Successfully completes tasks independently and accurately</td>
	<td><center><input type="radio" name="choice19" value="5" 
		<?php 
	 if($choice19=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice19" value="4" 	
		<?php 
	 if($choice19=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice19" value="3"
		<?php 
	 if($choice19=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice19" value="2"
		<?php 
	 if($choice19=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice19" value="1" 
		<?php 
	 if($choice19=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice19" value="0"
		<?php 
	 if($choice19=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>20. Seeks additional support when necessary</td>
	<td><center><input type="radio" name="choice20" value="5" 
		<?php 
	 if($choice20=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice20" value="4" 	
		<?php 
	 if($choice20=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice20" value="3"
		<?php 
	 if($choice20=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice20" value="2"
		<?php 
	 if($choice20=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice20" value="1" 
		<?php 
	 if($choice20=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice20" value="0"
		<?php 
	 if($choice20=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>21. Recognizes and takes appropriate action to effectively address 
      problems</td>
	<td><center><input type="radio" name="choice21" value="5" 
		<?php 
	 if($choice21=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice21" value="4" 	
		<?php 
	 if($choice21=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice21" value="3"
		<?php 
	 if($choice21=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice21" value="2"
		<?php 
	 if($choice21=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice21" value="1" 
		<?php 
	 if($choice21=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice21" value="0"
		<?php 
	 if($choice21=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>22. Engages in continuous learning</td>
	<td><center><input type="radio" name="choice22" value="5" 
		<?php 
	 if($choice22=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice22" value="4" 	
		<?php 
	 if($choice22=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice22" value="3"
		<?php 
	 if($choice22=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice22" value="2"
		<?php 
	 if($choice22=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice22" value="1" 
		<?php 
	 if($choice22=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice22" value="0"
		<?php 
	 if($choice22=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>23. Contributes new ideas and seek ways to improve the organization or 
       work  place</td>
	<td><center><input type="radio" name="choice23" value="5" 
		<?php 
	 if($choice23=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice23" value="4" 	
		<?php 
	 if($choice23=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice23" value="3"
		<?php 
	 if($choice23=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice23" value="2"
		<?php 
	 if($choice23=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice23" value="1" 
		<?php 
	 if($choice23=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice23" value="0"
		<?php 
	 if($choice23=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<td>&nbsp;&nbsp;<b>JUDGEMENT/ DECISION-MAKING</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td> 
	<tr>
	<td>24. Analyzes problems effectively </td>
	<td><center><input type="radio" name="choice24" value="5" 
		<?php 
	 if($choice24=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice24" value="4" 	
		<?php 
	 if($choice24=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice24" value="3"
		<?php 
	 if($choice24=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice24" value="2"
		<?php 
	 if($choice24=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice24" value="1" 
		<?php 
	 if($choice24=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice24" value="0"
		<?php 
	 if($choice24=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>25. Demonstrates the ability to make creative and effective solutions to 
       problems</td>
	<td><center><input type="radio" name="choice25" value="5" 
		<?php 
	 if($choice25=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice25" value="4" 	
		<?php 
	 if($choice25=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice25" value="3"
		<?php 
	 if($choice25=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice25" value="2"
		<?php 
	 if($choice25=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice25" value="1" 
		<?php 
	 if($choice25=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice25" value="0"
		<?php 
	 if($choice25=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr> 
	<td>26. Demonstrates good judgement in handling routine problems</td>
	<td><center><input type="radio" name="choice26" value="5" 
		<?php 
	 if($choice26=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice26" value="4" 	
		<?php 
	 if($choice26=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice26" value="3"
		<?php 
	 if($choice26=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice26" value="2"
		<?php 
	 if($choice26=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice26" value="1" 
		<?php 
	 if($choice26=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice26" value="0"
		<?php 
	 if($choice26=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<td>&nbsp;&nbsp;<b>DEPENDABILITY/RELIABILITY</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td> 
	<tr>
	<td>27. Ably follows through and meet required deadlines</td>
	<td><center><input type="radio" name="choice27" value="5" 
		<?php 
	 if($choice27=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice27" value="4" 	
		<?php 
	 if($choice27=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice27" value="3"
		<?php 
	 if($choice27=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice27" value="2"
		<?php 
	 if($choice27=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice27" value="1" 
		<?php 
	 if($choice27=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice27" value="0"
		<?php 
	 if($choice27=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>28. Is personally accountable for his/her actions</td>
	<td><center><input type="radio" name="choice28" value="5" 
		<?php 
	 if($choice28=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice28" value="4" 	
		<?php 
	 if($choice28=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice28" value="3"
		<?php 
	 if($choice28=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice28" value="2"
		<?php 
	 if($choice28=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice28" value="1" 
		<?php 
	 if($choice28=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice28" value="0"
		<?php 
	 if($choice28=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr>
	<td>29. Adapts effectively to changes in the work environment</td>
	<td><center><input type="radio" name="choice29" value="5" 
		<?php 
	 if($choice29=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice29" value="4" 	
		<?php 
	 if($choice29=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice29" value="3"
		<?php 
	 if($choice29=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice29" value="2"
		<?php 
	 if($choice29=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice29" value="1" 
		<?php 
	 if($choice29=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice29" value="0"
		<?php 
	 if($choice29=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	</tr>
	<tr> 
	<td>30. Displays a consistent level of high performance</td>
	<td><center><input type="radio" name="choice30" value="5" 
		<?php 
	 if($choice30=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice30" value="4" 	
		<?php 
	 if($choice30=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice30" value="3"
		<?php 
	 if($choice30=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice30" value="2"
		<?php 
	 if($choice30=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice30" value="1" 
		<?php 
	 if($choice30=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice30" value="0"
		<?php 
	 if($choice30=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<td>&nbsp;&nbsp;<b>ATTITUDE</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td> 
	<tr> 
	<td>31. Willingly offers assistance when needed</td>
	<td><center><input type="radio" name="choice31" value="5" 
		<?php 
	 if($choice31=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice31" value="4" 	
		<?php 
	 if($choice31=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice31" value="3"
		<?php 
	 if($choice31=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice31" value="2"
		<?php 
	 if($choice31=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice31" value="1" 
		<?php 
	 if($choice31=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice31" value="0"
		<?php 
	 if($choice31=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>32. Makes positive contribution to the organization’s morale</td>
	<td><center><input type="radio" name="choice32" value="5" 
		<?php 
	 if($choice32=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice32" value="4" 	
		<?php 
	 if($choice32=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice32" value="3"
		<?php 
	 if($choice32=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice32" value="2"
		<?php 
	 if($choice32=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice32" value="1" 
		<?php 
	 if($choice32=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice32" value="0"
		<?php 
	 if($choice32=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>33. Shows sensitivity to and consideration for other’s feeling</td>
	<td><center><input type="radio" name="choice33" value="5" 
		<?php 
	 if($choice33=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice33" value="4" 	
		<?php 
	 if($choice33=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice33" value="3"
		<?php 
	 if($choice33=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice33" value="2"
		<?php 
	 if($choice33=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice33" value="1" 
		<?php 
	 if($choice33=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice33" value="0"
		<?php 
	 if($choice33=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>34. Accepts constructive criticism positively</td>
	<td><center><input type="radio" name="choice34" value="5" 
		<?php 
	 if($choice34=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice34" value="4" 	
		<?php 
	 if($choice34=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice34" value="3"
		<?php 
	 if($choice34=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice34" value="2"
		<?php 
	 if($choice34=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice34" value="1" 
		<?php 
	 if($choice34=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice34" value="0"
		<?php 
	 if($choice34=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>35. Shows pride in performing tasks</td>
	<td><center><input type="radio" name="choice35" value="5" 
		<?php 
	 if($choice35=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice35" value="4" 	
		<?php 
	 if($choice35=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice35" value="3"
		<?php 
	 if($choice35=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice35" value="2"
		<?php 
	 if($choice35=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice35" value="1" 
		<?php 
	 if($choice35=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice35" value="0"
		<?php 
	 if($choice35=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<td>&nbsp;&nbsp;<b>PROFESSIONALISM</b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<tr> 
	<td>36. Respects those in authority</td>
	<td><center><input type="radio" name="choice36" value="5" 
		<?php 
	 if($choice36=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice36" value="4" 	
		<?php 
	 if($choice36=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice36" value="3"
		<?php 
	 if($choice36=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice36" value="2"
		<?php 
	 if($choice36=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice36" value="1" 
		<?php 
	 if($choice36=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice36" value="0"
		<?php 
	 if($choice36=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>37. Responsibly uses tools, equipment and machines</td>
	<td><center><input type="radio" name="choice37" value="5" 
		<?php 
	 if($choice37=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice37" value="4" 	
		<?php 
	 if($choice37=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice37" value="3"
		<?php 
	 if($choice37=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice37" value="2"
		<?php 
	 if($choice37=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice37" value="1" 
		<?php 
	 if($choice37=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice37" value="0"
		<?php 
	 if($choice37=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr> 
	<td>38. Follows all policies and procedures when issues and conflicts arise</td>
	<td><center><input type="radio" name="choice38" value="5" 
		<?php 
	 if($choice38=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice38" value="4" 	
		<?php 
	 if($choice38=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice38" value="3"
		<?php 
	 if($choice38=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice38" value="2"
		<?php 
	 if($choice38=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice38" value="1" 
		<?php 
	 if($choice38=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice38" value="0"
		<?php 
	 if($choice38=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr>
	<td>39. Sticks with policies and procedures as issues and conflicts arise</td>
	<td><center><input type="radio" name="choice39" value="5" 
		<?php 
	 if($choice39=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice39" value="4" 	
		<?php 
	 if($choice39=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice39" value="3"
		<?php 
	 if($choice39=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice39" value="2"
		<?php 
	 if($choice39=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice39" value="1" 
		<?php 
	 if($choice39=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice39" value="0"
		<?php 
	 if($choice39=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>

	
	</tr>
	<tr>
	<td>40. Physical appearance is appropriate with the work environment and 
      placement rules.</td>
	<td><center><input type="radio" name="choice40" value="5" 
		<?php 
	 if($choice40=='5'){
	 	echo "checked";
	 }
	 ?> ><h6>5</td>
	<td><center><input type="radio" name="choice40" value="4" 	
		<?php 
	 if($choice40=='4'){
	 	echo "checked";
	 }
	 ?>><h6>4</td>
	<td><center><input type="radio" name="choice40" value="3"
		<?php 
	 if($choice40=='3'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>3</td>
	<td><center><input type="radio" name="choice40" value="2"
		<?php 
	 if($choice40=='2'){
	 	echo "checked";
	 }
	 ?>
	 ><h6>2</td>
	<td><center><input type="radio" name="choice40" value="1" 
		<?php 
	 if($choice40=='1'){
	 	echo "checked";
	 }
	 ?>><h6>1</td>
	<td><center><input type="radio" name="choice40" value="0"
		<?php 
	 if($choice40=='0'){
	 	echo "checked";
	 }
	 ?> ><h6>0</td>
	</tr>

	</p>
</table>

<table width="900px" height="50" border="1">	<tr>
	<td style="width: 138px;" ><b><center><h5>Total Score/Equivalent Rating</center></b></td>
	
</center><td style="width: 57.1px;"><center><h4>
	
						
		<?php
		$total = $choice1+$choice2+$choice3+$choice4+$choice5+$choice6+$choice7+$choice8+$choice9+$choice10+$choice11
		+$choice12+$choice13+$choice14+$choice15+$choice16+$choice17+$choice18+$choice19+$choice20+$choice21+$choice22+$choice23+$choice24+$choice25+$choice26+$choice27+$choice28+$choice29+$choice30+$choice31+$choice32+$choice33+$choice34+$choice35+$choice36+$choice37+$choice38+$choice39+$choice40;
	?><input type="number" style="font-size: 20px;" class="form-control form-control-sm w-100" name="total" value="<?php echo isset($total) ? $total : '' ?>" readonly></td>
	
	</tr></table>
<br>
<table id="score" border="0">
	
<tr><td><b>Raw score</b></td><td>&nbsp;&nbsp;&nbsp;<b> Equivalent rating</b></td><td> &nbsp;&nbsp;&nbsp;<b>Verbal interpretation</b></td></tr>
<tr><td>172 – 200</td><td>&nbsp;&nbsp;&nbsp; 96 – 100</td><td>&nbsp;&nbsp;&nbsp; Outstanding</td> </tr>
<tr><td>146 – 171</td><td>&nbsp;&nbsp;&nbsp;91 -   95</td><td>&nbsp;&nbsp;&nbsp; Excellent	</td> </tr>
<tr><td>120 -  145</td><td>&nbsp;&nbsp;&nbsp; 86  -  90</td><td>&nbsp;&nbsp;&nbsp; Very Good  </td> </tr> 
<tr><td>94 – 119</td><td>&nbsp;&nbsp;&nbsp; 81  -  85</td><td>&nbsp;&nbsp;&nbsp; Good       </td> </tr>
<tr><td> 68  –  93</td><td>&nbsp;&nbsp;&nbsp; 76  -  80</td><td>&nbsp;&nbsp;&nbsp; Fair</td> </tr>
<tr><td>40  -   67</td><td>&nbsp;&nbsp;&nbsp; 71  -  75</td><td>&nbsp;&nbsp;&nbsp; Conditional</td> </tr>

</table>
	</form>


<script>
	//password
	
	
	//submit
	$('#manage-student').submit(function(e){
		
		e.preventDefault()

		start_load()
		
		
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