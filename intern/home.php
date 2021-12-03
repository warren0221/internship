<?php include '../db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
    .bg-gradient-primary{
        background: rgb(119,172,233);
        background: linear-gradient(149deg, rgba(119,172,233,1) 5%, rgba(83,163,255,1) 10%, rgba(46,51,227,1) 41%, rgba(40,51,218,1) 61%, rgba(75,158,255,1) 93%, rgba(124,172,227,1) 98%);
    }
    .btn-primary-gradient{
        background: linear-gradient(to right, #1e85ff 0%, #00a5fa 80%, #00e2fa 100%);
    }
    .btn-danger-gradient{
        background: linear-gradient(to right, #f25858 7%, #ff7840 50%, #ff5140 105%);
    }
   .container{
    margin-top: 30px;
   }
  .start{
  background-color: #912c2c;
  color:white;
  
  
}
.start:hover{
    background-color:#DCDCDC;
    color: black;
}
#end_time:hover{
  background-color: #912c2c;
  color:white;
}
#end_time{
    background-color:#DCDCDC;
        color: black;
       
        
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
.fc th {
    background-color: gray;
    
  }
 .fc .fc-button {
    border-radius: 0;
    overflow: visible;
    text-transform: none;
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
   background-color: #912c2c;
   border-radius: 10%;
  }
.fc .fc-button:focus {
    outline: 1px dotted;
    outline: 5px auto -webkit-focus-ring-color;
  }
.fc .fc-button {
    -webkit-appearance: button;
  }
</style>
<?php 
$time = $conn->query("SELECT * FROM timesheets where student_id = {$_SESSION['login_id']}");
$data = array();
$rendered= 0;
while($row=$time->fetch_assoc()){
  if($row['timer_status'] == 0){
    $dif = strtotime($row['date'].' '.$row['time_end']) - strtotime($row['date'].' '.$row['time_start']);
    $rendered += abs($dif/(60*60));
  }
  
  $row['time_start'] = date("H:i",strtotime($row['date'].' '.$row['time_start']));
  $row['time_end'] = $row['time_end'] == '00:00:00' ? '' : date("H:i",strtotime($row['date'].' '.$row['time_end']));
  $row['remarks'] = str_replace(array("\n", "\r"), " ", $row['remarks']);
  $data[] = $row;
}
$current_timer = $conn->query("SELECT * FROM timesheets where date(`date`) = '".date('Y-m-d')."' and timer_status = 1 and student_id = {$_SESSION['login_id']} order by abs(id) desc limit 1");
$res = $current_timer->num_rows > 0 ? $current_timer->fetch_array() : array();
$ct_id = isset($res['id']) ? $res['id'] : 0;
$ct_start = isset($res['time_start']) ?  date("Y-m-d H:i",strtotime($res['date'].' '.$res['time_start'])) : '';

?>
 

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card bg-light">
        <div class="card-body">
          <div id="my_camera"></div><br><div class="container-fluid">
            <h6 class="d-flex justify-content-between"><span><b>Required Duration:</b></span> <span><b><?php echo $_SESSION['login_required_duration'] ?> hr/s.</b></span></h6>
            <h6 class="d-flex justify-content-between"><span><b>Total Rendered:</b></span> <span><b><?php echo number_format($rendered,2)?> hr/s.</b></span></h6>
            <hr>
            <h6 class="d-flex justify-content-between"><span><b>Remaining:</b></span> <span><b><?php echo number_format($_SESSION['login_required_duration']-$rendered,2) ?> hr/s.</b></span></h6>
          </div>
        </div>
      </div>
    </div>
  	<div class="col-lg-8">
     <div class="card">
        <div class="card-body">
          <div class="d-flex w-100 bg-light p-2 rounded mb-4 justify-content-between">
            <h6 class=""><b id="dnow"></b></h6>
            <?php if($ct_id == 0): ?>
            <button class='btn btn-primary start' type="button" id="start_time"><i class="fa fa-clock" onClick="take_snapshot()"></i> Start</button>
            <?php else: ?>
            <h6><b>Duration: <span id="dur">0</span></b></h6>
            <p class="invisible" id="dur2"></p>
            <button class='btn btn-primary stop' type="button" id="end_time"><i class="fa fa-clock"></i> Stop Timer</button>
            <?php endif; ?>
          </div>
          <div id="calendar"></div>
        </div>
      </div> 
    </div>
  </div>
</div>
<style>
#my_camera{
 width: 320px;
 height: 240px;
 margin-left: -7.5px;
 border: 1px solid black;
}
</style>

<!-- -->
<center>

<br />

<div id="results" ></div>
 </center>
<!-- Script -->
<script type="text/javascript" src="webcam.min.js"></script>

<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">

 // Configure a few settings and attach camera
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });
 Webcam.attach( '#my_camera' );


</script>
<script>
    var data = '<?php echo json_encode($data) ?>';
     var calendarEl = document.getElementById('calendar');
    var calendar;
    var evt = [];
    data = JSON.parse(data)
      if(Object.keys(data).length > 0){
         Object.keys(data).map(k=>{
                var obj = {};
                  if(data[k].timer_status == 1)
                    obj['title']="Started Time of Current Timer";
                  else
                    obj['title']=data[k].remarks;
                  obj['start']=data[k].date+'T'+data[k].time_start;
                  if(data[k].time_end != '')
                  obj['end']=data[k].date+'T'+data[k].time_end;
                  evt.push(obj)
         })
      }
  document.addEventListener('DOMContentLoaded', function() {
   

        calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
             
          },
          initialView: 'listMonth',
          initialDate: '<?php echo date('Y-m-d') ?>',
          weekNumbers: true,
          eventColor: "#912c2c",
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          // showNonCurrentDates: false,
          events: evt
        });
        calendar.render();
     

  });
  dnow();
  dur();
  function dnow(){
    setInterval(function(){
      $('#dnow').text(moment().format('MMMM D YYYY, h:mm:ss A'))
    },1000)
  }
  $('#start_time').click(function(){
    start_load()

    $.ajax({

      url:'../ajax.php?action=start_time',
      success:function(resp){
        Webcam.snap( function(data_uri) {
    Webcam.upload( data_uri, 'saveimage.php', function(code, text,Name) {
                    document.getElementById('results').innerHTML = 
                    '' + 
      '<img src="' + data_uri + '"style=" width: 300px;">';
 } );
  
  
 } );
        if(resp == 1){
          location.reload()
        }
      }
    })
  })
  function dur(){
    setInterval(function(){
      var start = new Date('<?php echo $ct_start ?>')
      var end = new Date(moment().format())
      var dif = end.getTime() - start.getTime();
      dif = dif / (1000 * 60 * 60)
      console.log(end.getTime(),start.getTime())
      $('#dur').text((parseFloat(dif).toLocaleString('en-US',{style:'decimal',maximimumFractionDigits:3}))+ " Hr/s.")
      $('#dur2').text((parseFloat(dif).toLocaleString('en-US',{style:'decimal',maximimumFractionDigits:3})))
    },1000)
  }
  $('#end_time').click(function(){
    uni_modal("<i class='fa fa-hourglass-end'></i>End Timer","manage_end_time.php?id=<?php echo $ct_id ?>&start=<?php echo $ct_start ?>&dur="+$('#dur2').text());
  })
</script>