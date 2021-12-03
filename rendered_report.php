<?php
    include 'db_connect.php';
?>
<style>
    .body{
        background-color:#912c2c;
        padding-bottom: 20px;
    }
    .mt-2{
        color:white;
    }
    .table{
    background-color: #DCDCDC;
    border-color: black;
    }
    #print{
        background-color: #912c2c;
        color: white;
       border-color: white;
    }
    #print:hover{
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
}

</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card"> 
            <div class="card_body">
                <div class="body">
                 <div class="row justify-content-center pt-4">
                <label for="" class="mt-2"><b>Student</b></label>

                <div class="col-sm-4">
                
                    <select name="" id="student_id" class="custom-select custom-select-sm select2">

                        <option value=""></option>
                        <?php 
                        $students = $conn->query("SELECT * FROM students order by name asc");
                        while($row=$students->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['sid']) && $_GET['sid'] == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']).' ['.$row['id_no'].'] ' ?></option>
                    <?php endwhile; ?>

                    </select>
                </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <?php
                if(!isset($_GET['sid'])):
                ?>
                <center><h6>Please select student first.</h6></center>
                <?php else: ?>
                <?php
                $s_query = $conn->query("SELECT  s.*,c.course,co.name as cname from students s inner join courses c on c.id= s.course_id inner join companies co on co.id = s.company_id where s.id = {$_GET['sid']} ");
                foreach($s_query->fetch_array() as $k => $v){
                    $$k = $v;
                }
                ?> 
                <hr>
                <table class="table table-condensed table-bordered table-hover" id="report-list">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Date</th>
                                    <th class="">Remarks</th>
                                    <th class="">Time</th>
                                    <th class="">Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $sheet = $conn->query("SELECT * FROM timesheets where student_id = {$_GET['sid']} order by abs(id) desc");
                                $rendered = 0;
                                while($row=$sheet->fetch_assoc()):
                                    $dif = 0;
                                    if($row['timer_status'] == 0){
                                        $dif = strtotime($row['date'].' '.$row['time_end']) - strtotime($row['date'].' '.$row['time_start']);
                                        $rendered += abs($dif/(60*60));
                                        $dif = abs($dif/(60*60));
                                    }
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td>
                                        <p> <b><?php echo date("M d,Y",strtotime($row['date'])) ?></b></p>
                                    </td>
                                    <td class="">
                                        <p><i><b><?php echo $row['remarks'] ?></b></i></p>
                                    </td>
                                    <td>
                                        <p> <b><?php echo date("h:i A",strtotime($row['date'].' '.$row['time_start'])).' - '.date("h:i A",strtotime($row['date'].' '.$row['time_end'])) ?></b></p>
                                    </td>
                                    <td>
                                        <p class="text-right"> <b><?php echo number_format($dif,2) ?> hr/s.</b></p>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total Rendered Time</th>
                                    <th class="text-right"><b><?php echo number_format($rendered,2) ?> hr/s.</b></th>
                                </tr>
                                <tr>
                                    <th colspan="4">Required Duration</th>
                                    <th class="text-right"><b><?php echo number_format($required_duration,2) ?> hrs.</b></th>
                                </tr>
                                 <tr>
                                    <th colspan="4">Remaining</th>
                                    <th class="text-right"><b><?php echo number_format($required_duration - $rendered,2) ?> hr/s.</b></th>
                                </tr>

                            </tfoot>

                        </table>

                <div class="col-md-12 mb-4">
                    <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> <b>Print Report</b></button>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print1"><i class="fa fa-print"></i> <b>Print Evaluation</b></button>
                    </center>
                </div>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</div>

<noscript>
    <style>
        table#report-list{
            width:100%;
            border-collapse:collapse
        }
        table#report-list td,table#report-list th{
            border:1px solid
        }
        p{
            margin:unset;
        }
        .text-center{
            text-align:center
        }
        .text-right{
            text-align:right
        }
    </style>
    <table width="100%">
        <tr>
            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="35%">Student ID: </td>
                        <td width="65%"><?php echo isset($id_no) ? $id_no : '' ?></td>
                    </tr>
                    <tr>
                        <td>Student Name: </td>
                        <td><?php echo isset($name) ? $name : '' ?></td>
                    </tr>
                    <tr>
                        <td>Address: </td>
                        <td><?php echo isset($address) ? $address : '' ?></td>
                    </tr>
                    <tr>
                    
                        <td>Evaluator: </td>
                       <td><?php echo isset($evaluator) ? $evaluator : '' ?></td>
                        </tr>
                </table>
            </td>

            <td width="50%">
                <table width="100%">
                    <tr>
                        <td width="35%">Course: </td>
                        <td width="65%"><?php echo isset($course) ? $course : '' ?></td>
                    </tr>
                    <tr>
                        <td>Company: </td>
                        <td><?php echo isset($cname) ? $cname : '' ?></td>
                    </tr>
                    <tr>
                    
                        <td>Contact: </td>
                       <td><?php echo isset($contact) ? $contact : '' ?></td>
                        </tr>
                    <tr>
                    
                        <td>Position: </td>
                       <td><?php echo isset($position) ? $position : '' ?></td>
                        </tr>
                </table>
            </td>
        </tr>
    </table>

</noscript>
<script>
$('#student_id').change(function(){
    location.replace('index.php?page=rendered_report&sid='+$(this).val())
})
$('#report-list').dataTable()
$('#print').click(function(){
            $('#report-list').dataTable().fnDestroy()
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
            ns.append(_c)
        var nw = window.open('','_blank','width=900,height=600')
        nw.document.write('<center><img src="logo.png"width="100px" height="100px"></center>')
        nw.document.write('<p class="text-center"><b>Internship Rendered Time report')       
        nw.document.write(ns.html())
    
    
        nw.document.close()
        nw.print()
        setTimeout(() => {
            nw.close()
            $('#report-list').dataTable()
        }, 500);

    })


$('#print1').click(function(){
            
        var _c = $('').clone();
        var ns = $('noscript').clone();
            ns.append(_c)
        var nw = window.open('','_blank','width=900,height=600')
        nw.document.write('<center><img src="logo.png"width="100px" height="100px"></center>')
        nw.document.write('<p class="text-center"><b>Evaluation report')       
        nw.document.write(ns.html())
        nw.document.write('<br><b><center><i><h6>Directions.  Using the scale below,  please select the rating that best describe the competencies of  the intern.</i></b></h6></center><br> <p><center><table id="table" border="1" width="900" height="270" ><tr><td>5</td><td>Outstanding(O)</td><td>Performance exceeds the required standard.</td></tr> <tr><td>4</td><td>Very Satisfactory (VS)</td><td>Performance fully met the training requirements. The intern performed what was expected of him/her.</td></tr><tr><td>3</td><td>Satisfactory (S)</td><td>Performance has met the required standards, the intern performed duties with minimal supervision.</td></tr><tr><td>2</td><td>Fair (F)</td><td>Performance partially meets the required standard, observed to be less than satisfactory, a lot could be done better.</td></tr><tr><td>1</td><td>Needs Improvement (NI)</td><td>Performance does not meet the required standard. Major improvement may be needed.</td></tr><tr><td>0</td><td>Not applicable N/A</td><td>Performance indicator is not relevant to the training.</td></tr></p></table><br><br>' )
         nw.document.write('<p><center><table border="1" width="900" height="270" ><tr><td><center><b>COMPETENCIES</b></td><td><b><center>RATE</b><tr><td><b>TEAMWORK</b></td></tr> <tr><td>1. Consistently works with others to accomplish goals and tasks.</td><td><?php echo isset($choice1) ? $choice1 : '' ?></td><tr><td>2. Treats all team members in respectful and courteous manner.</td><td><?php echo isset($choice2) ? $choice2 : '' ?></td><tr><td>3. Actively participates in activities and assigned tasks.</td><td><?php echo isset($choice3) ? $choice3 : '' ?></td><tr><td>4. Willingly works with team members to continuously improve team collaboration</td><td><?php echo isset($choice4) ? $choice4 : '' ?></td><tr><td>5. Considers feedbacks and views of team members when completing assigned tasks.</td><td><?php echo isset($choice5) ? $choice5 : '' ?></td><tr><td>5. Considers feedbacks and views of team members when completing assigned tasks.</td><td><?php echo isset($choice5) ? $choice5 : '' ?></td><tr><td><b>COMMUNICATION</b></td></tr><tr><td>6. Listens conscientiously to supervisor and co-workers.</td><td><?php echo isset($choice6) ? $choice6 : '' ?></td><tr><td>7. Comprehends written and oral information.</td><td><?php echo isset($choice7) ? $choice7 : '' ?></td><tr><td>8. Consistently delivers accurate information.</td><td><?php echo isset($choice8) ? $choice8 : '' ?></td><tr><td>9. Reliably provides feedback as required, both internally and externally.</td><td><?php echo isset($choice9) ? $choice9 : '' ?></td><tr><td>5. Considers feedbacks and views of team members when completing assigned tasks.</td><td><?php echo isset($choice5) ? $choice5 : '' ?></td><tr><td><b> ATTENDANCE & PUNCTUALITY</b></td></tr><tr><td>10. Is consistently punctual.</td><td><?php echo isset($choice10) ? $choice10 : '' ?></td><tr><td>11. Maintains good attendance and participation.</td><td><?php echo isset($choice11) ? $choice11 : '' ?></td><tr><td>12. Informs supervisor promptly if absent or late.</td><td><?php echo isset($choice12) ? $choice12 : '' ?></td><tr><td><b> PRODUCTIVITY/RESILIENCE</b></td></tr><tr><td>13. Consistently delivers quality results.</td><td><?php echo isset($choice13) ? $choice13 : '' ?></td><tr><td>14. Meets deadlines and manages time well.</td><td><?php echo isset($choice14) ? $choice14 : '' ?></td><tr><td>15. Works around problems and obstacles in a stressful situation in order to achieve required tasks.</td><td><?php echo isset($choice15) ? $choice15 : '' ?></td><tr><td>16. Time management is effective and efficient</td><td><?php echo isset($choice16) ? $choice16 : '' ?></td><tr><td>17. Informs supervisor of any challenges or barriers that transpire in tasks</td><td><?php echo isset($choice17) ? $choice17 : '' ?></td><tr><td><b> INITIATIVE/PROACTIVITY</b></td></tr><tr><td>18. Completes assignments with minimal supervision</td><td><?php echo isset($choice18) ? $choice18 : '' ?></td><tr><td>19. Successfully completes tasks independently and accurately</td><td><?php echo isset($choice19) ? $choice19 : '' ?></td><tr><td>20. Seeks additional support when necessary</td><td><?php echo isset($choice20) ? $choice20 : '' ?></td><tr><td>21. Recognizes and takes appropriate action to effectively address problems</td><td><?php echo isset($choice21) ? $choice21 : '' ?></td><tr><td>22. Engages in continuous learning</td><td><?php echo isset($choice22) ? $choice22 : '' ?></td><tr><td>23. Contributes new ideas and seek ways to improve the organization or work place</td><td><?php echo isset($choice23) ? $choice3 : '' ?></td><tr><td><b> JUDGEMENT/DECISION-MAKING</b></td></tr><tr><td>24. Analyzes problems effectively</td><td><?php echo isset($choice24) ? $choice24 : '' ?></td><tr><td>25. Demonstrates the ability to make creative and effective solutions to problems</td><td><?php echo isset($choice25) ? $choice25 : '' ?></td><tr><td>26. Demonstrates good judgement in handling routine problems</td><td><?php echo isset($choice26) ? $choice26 : '' ?></td><tr><td><b> DEPENDABILITY/RELIABILITY</b></td></tr><tr><td>27. Ably follows through and meet required deadlines</td><td><?php echo isset($choice27) ? $choice27 : '' ?></td><tr><td>28. Is personally accountable for his/her actions</td><td><?php echo isset($choice28) ? $choice28 : '' ?></td><tr><td>29. Adapts effectively to changes in the work environment</td><td><?php echo isset($choice29) ? $choice29 : '' ?></td><tr><td>30. Displays a consistent level of high performance</td><td><?php echo isset($choice30) ? $choice30 : '' ?></td><tr><td><b> ATTITUDE</b></td></tr><tr><td>31. Willingly offers assistance when needed</td><td><?php echo isset($choice31) ? $choice31 : '' ?></td><tr><td>32. Makes positive contribution to the organization’s morale</td><td><?php echo isset($choice32) ? $choice32 : '' ?></td><tr><td>33. Shows sensitivity to and consideration for other’s feeling</td><td><?php echo isset($choice33) ? $choice33 : '' ?></td><tr><td>34. Accepts constructive criticism positively</td><td><?php echo isset($choice34) ? $choice34 : '' ?></td><tr><td>35. Shows pride in performing tasks</td><td><?php echo isset($choice35) ? $choice35 : '' ?></td><tr><td><b>  PROFESSIONALISM</b></td></tr><tr><td>36. Respects those in authority</td><td><?php echo isset($choice36) ? $choice36 : '' ?></td><tr><td>37. Responsibly uses tools, equipment and machines</td><td><?php echo isset($choice37) ? $choice37 : '' ?></td><tr><td>38. Follows all policies and procedures when issues and conflicts arise</td><td><?php echo isset($choice38) ? $choice38 : '' ?></td><tr><td>39. Sticks with policies and procedures as issues and conflicts arise</td><td><?php echo isset($choice39) ? $choice39 : '' ?></td><tr><td>40. Physical appearance is appropriate with the work environment and placement rules.</td><td><?php echo isset($choice40) ? $choice40 : '' ?></td></table><table width="900px" height="50" border="1">    <tr><td style="width: 138px;" ><b><center><h5>Total Score/Equivalent Rating</center></b></td></center><td style="width: 57.1px;"><center><h4><?php echo isset($total) ? $total : '' ?></td></tr></table><br><table id="score" border="0"><tr><td><b>Raw score</b></td><td>&nbsp;&nbsp;&nbsp;<b> Equivalent rating</b></td><td> &nbsp;&nbsp;&nbsp;<b>Verbal interpretation</b></td></tr><tr><td>172 – 200</td><td>&nbsp;&nbsp;&nbsp; 96 – 100</td><td>&nbsp;&nbsp;&nbsp; Outstanding</td> </tr><tr><td>146 – 171</td><td>&nbsp;&nbsp;&nbsp;91 -   95</td><td>&nbsp;&nbsp;&nbsp; Excellent  </td> </tr><tr><td>120 -  145</td><td>&nbsp;&nbsp;&nbsp; 86  -  90</td><td>&nbsp;&nbsp;&nbsp; Very Good  </td> </tr> <tr><td>94 – 119</td><td>&nbsp;&nbsp;&nbsp; 81  -  85</td><td>&nbsp;&nbsp;&nbsp; Good       </td> </tr><tr><td> 68  –  93</td><td>&nbsp;&nbsp;&nbsp; 76  -  80</td><td>&nbsp;&nbsp;&nbsp; Fair</td> </tr><tr><td>40  -   67</td><td>&nbsp;&nbsp;&nbsp; 71  -  75</td><td>&nbsp;&nbsp;&nbsp; Conditional</td> </tr></table><br><br><p>Remarks/Comments/Suggestions: </p></center><p>_______________________________</p><br><br><table border="0"><tr><td><b>Evaluator’s Signature: _____________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ____________________</b></td></tr></table>')
     
    
        nw.document.close()
        nw.print()
        setTimeout(() => {
            nw.close()
            $('#report-list').dataTable()
        }, 500);

    })
</script>