<style>
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
.card-body1{
   padding-bottom: 550px;
  animation: transitionIn 1s;
  width: 250px;
  margin-left: 1400px;
  top: 5rem;
 position: absolute;
display: inline-block;
  height: 20rem;
  box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); 
  border-radius: 5px;
  z-index: 1;
  background: inherit;
  overflow: hidden;
  background-color: white;
}
.card-body1:before {
  content: "";
  position: absolute;
  background: inherit;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  box-shadow: inset 0 0 2000px rgba(255, 255,255, .5);
  filter: blur(10px);
  margin: -20px;
}
.green{
  color:green;
}

#status{
  
  height: 8px;
  width: 8px;
  border-radius: 50%;
  margin-left:20px;
  margin-right:2px; 
}

.title{
font-size: 12px;
 

}
.card1{
  animation: transitionIn 1s;
  
 display: inline-block;
 margin-left: 30px;
 margin-top: 60px;


}

.name{
 margin-left: 510px;
}

</style>


<div class="all">
<div class="card-body1">
  <div id="load"hidden></div>
  
            <table class="table-hover  load"id="online">
             
            <tbody>
              
                 <i><b><p class="title">Intern Students</p></b></i>
                <?php 
                $i = 1;
                $cname[0] = "Not Set";
                $companies = $conn->query("SELECT * FROM companies  ");
                while($row = $companies->fetch_assoc()){
                  $cname[$row['id']] = ucwords($row['name']);
                }
                $student = $conn->query("SELECT DISTINCT s.*,c.student_id FROM students s inner join timesheets c on c.student_id = s.id where stats='Online' ");
                while($row=$student->fetch_assoc()):
                ?>
                <tr>
                  
                  <td class="name ">
                    <p><b><?php echo $row['name'] ?></b></p>
                  </td>

                  <td class="green ">
                  
                    <p><b><img  src="../intern/green.png"  id="status"></b></p>
                  </td>
                 
                </tr>
                <?php endwhile; ?>
                
              </tbody>

</table> 
</div>
</div>  

<script >
   var counter = 10;

    // The countdown method.
    window.setInterval(function () {
        counter--;
        if (counter >= 0) {
            var span;
            span = document.getElementById("load");
            span.innerHTML = counter;
        }
        if (counter === 0) {
            clearInterval(counter);
        }

    }, 1000);

    window.setInterval('refresh()', 10000);

    // Refresh or reload page.
    function refresh() {
        window .location.reload();
    }
</script>
<?php if($_SESSION['login_type'] == 2): ?>
<?php include 'db_connect.php' ?>
<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
.card-body{
   
  animation: transitionIn 1s;
  margin-left: 20px;
 position: absolute;
display: inline-block;
  height: 55rem;
  width: 77rem;
  box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); 
  border-radius: 5px;
  z-index: 1;
  background: inherit;
  overflow: hidden;
 
}
.imgs{
    margin: .5em;
    max-width: calc(100%);
    max-height: calc(100%);
  }
  .imgs img{
    max-width: calc(100%);
    max-height: calc(100%);
    cursor: pointer;
  }
  #imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
    height: 60vh !important;background: black;
  }
  #imagesCarousel .carousel-item.active{
    display: flex !important;
  }
  #imagesCarousel .carousel-item-next{
    display: flex !important;
  }
  #imagesCarousel .carousel-item img{
    margin: auto;
  }
  #imagesCarousel img{
    width: auto!important;
    height: auto!important;
    max-height: calc(100%)!important;
    max-width: calc(100%)!important;
  }
</style>
<?php 
$time = $conn->query("SELECT t.*,s.name as sname FROM timesheets t inner join students s on s.id = t.student_id");
$data = array();
while($row=$time->fetch_assoc()){
  $row['time_start'] = date("H:i",strtotime($row['date'].' '.$row['time_start']));
  $row['time_end'] = $row['time_end'] == '00:00:00' ? '' : date("H:i",strtotime($row['date'].' '.$row['time_end']));
  $row['sname'] = ucwords($row['sname']);
  $row['remarks'] = str_replace(array("\n", "\r"), " ", $row['remarks']);
  $data[] = $row;
}
?>
<div class="containe-fluid">
  <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                    <hr>
                    <div id="calendar"></div>
                </div>
            </div>            
        </div>
    </div>
</div>
<script>
var calendarEl = document.getElementById('calendar');
var calendar;
 var data = '<?php echo json_encode($data) ?>';
 var evt = [];
    data = JSON.parse(data)
      if(Object.keys(data).length > 0){
         Object.keys(data).map(k=>{
                var obj = {};
                  if(data[k].timer_status == 1)
                    obj['title']=data[k].sname+" - Started Time of Current Timer";
                  else
                    obj['title']=data[k].sname+' - '+data[k].remarks;
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
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          initialView: 'timeGridDay',
          initialDate: '<?php echo date('Y-m-d') ?>',
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          events: evt
        });
        calendar.render();
     

  });
</script>
<?php endif; ?>
<?php if($_SESSION['login_type'] == 1 ||$_SESSION['login_type'] == 3): ?>
<?php

$dbhandle= new mysqli('localhost','root','','soits_db');
echo $dbhandle->connect_error;

$query =("SELECT s.*,c.course,count(*) as number FROM students s inner join courses c on c.id = s.course_id group by s.course_id");

$res=$conn->query($query);

?>

<script type="text/javascript" src="loader.js"></script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart(){

    var data=google.visualization.arrayToDataTable([
      ['name','address'],

      <?php
while($row=$res->fetch_assoc()){
        echo"['".$row['course']."',".$row['number']."],";
      }
      ?>

      ]);

    var options={
      title:'Courses of Intern Students:',
      is3D:true,
      backgroundColor:  '#676767',
                   'width':400,
                   'height':400,
      //colors: ['#F0FFF0', '#fff', '#000', '#abc']

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
  
</script>
  <div class="card1">
  <div id="piechart"></div>

</div>
<?php
$dbhandle= new mysqli('localhost','root','','soits_db');
echo $dbhandle->connect_error;
$query =("SELECT s.*,c.name,count(*) as number FROM students s inner join companies c on c.id = s.company_id group by s.company_id");

$res=$conn->query($query);

?>



<script type="text/javascript" src="loader.js"></script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart1);


  function drawChart1(){

    var data=google.visualization.arrayToDataTable([
      ['name','address'],

      <?php
while($row=$res->fetch_assoc()){
        echo"['".$row['name']."',".$row['number']."],";
      }
      ?>

      ]);

    var options={
      title:'Intern Students in Companies:',
      is3D:true,
      backgroundColor:  '#676767',
                   'width':400,
                   'height':400,

    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
    chart.draw(data, options);
  }
  
</script>


  <div class="card1">
  <div id="piechart1"></div>

</div>
<?php endif; ?>
