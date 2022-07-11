<?php
session_start();
require("../libs/parts/didier_igihozo.php");
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */

@$tchr_id=$_SESSION['seveeen_tis_teacher_id'];
if (!$sel || !$con) {
  print_r("<center><h2><font color='red'>PROBLEM OF SERVER CONNECTION...</font></h2></center>");
}else{
if (@!$_SESSION['seveeen_tis_usrnm']) {
?>
<script type="text/javascript">
  window.location="../login.php";
</script>
<?php
}else{
@$usr_id=$_SESSION['seveeen_tis_usr_id'];
$all_flnm=$_SESSION['seveeen_tis_usrnm'];
$se_all_id=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['school_id'];
if (isset($_GET['rei'])) {
@$val_stts=dt_dec($_GET['rei'])-2018;
@$ttt=dt_dec($_GET['rrr'])-2018;
$sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$val_stts' AND task_xkul='$usr_id' AND ((task_teacher='$tchr_id') OR (task_teacher='$ttt'))");
$cnt_sel_tsk=mysql_num_rows($sel_tsk);
if ($cnt_sel_tsk==1) {
  $ft_sel_tsk=mysql_fetch_assoc($sel_tsk);
  $tsk_ttl=$ft_sel_tsk['task_title'];
  $tsk_cls=$ft_sel_tsk['task_class'];
  $crs_id=$ft_sel_tsk['task_course'];
  $en_crs=dt_enc($crs_id+2018);
  $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$tsk_cls' AND class_xkul='$usr_id'");
  $ft_sel_cls=mysql_fetch_assoc($sel_cls);
  $clss_nm=$ft_sel_cls['class_name'];
  $sel_crsses=mysql_query("SELECT * FROM tis_courses WHERE course_id='$crs_id' AND course_xkul='$usr_id'");
  $ft_sel_crsses=mysql_fetch_assoc($sel_crsses);
  $crs_nmm=$ft_sel_crsses['course_name'];
     if ($ft_sel_tsk['task_type']=="workss") {
      $task_ttype="Work";
    }elseif ($ft_sel_tsk['task_type']=="quizess") {
      $task_ttype="Quiz";
    }elseif ($ft_sel_tsk['task_type']=="testss") {
      $task_ttype="Test";
    }elseif ($ft_sel_tsk['task_type']=="examss") {
      $task_ttype="Exam";
    }else{

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Task marks -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Task marks | Tutor Inspection System</title>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../js/web/index.js"></script>
<style>
#chgexampleModal button:hover,#delexampleModal button:hover,#ssdbtnn button:hover,#bcckstt:hover,ssdbtnn button:hover{
  cursor: pointer;
  color: #40063a;
}
#dyrrldel{
  font-size:30px;
  color: red;
  font-weight: bolder;
}
#gen_fter{
      position: relative;margin-left: 10%
    }
.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 15px solid #432445;
  border-right:1 5px solid #6478aa;
  border-bottom: 15px solid #a24021;
  border-left: 15px solid #cd5679;
  width: 70px;
  height: 70px;
float: right;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
/*
#btncmdtsk {
  -webkit-animation: cmbstk 2s linear infinite;
  animation: cmbstk 2s linear infinite;
}
#btncmdtsk:hover {
  -webkit-animation: cmbstk 4s linear infinite;
  animation-play-state: paused;
}
*/
#lldd{
  width: 20px;
  height: 20px;
  border-top: #444212 dashed 5px;
  border-bottom: #444212 dashed 5px;
  border-radius: 50%;
  -webkit-animation: spin 4s linear infinite;
  animation: spin 4s linear infinite;
  margin-left:155px;
  margin-top: 10px;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@-webkit-keyframes cmbstk {
  0% { background-color: #0bb97e;padding: 15px}
  250% { background-color: #b9b30b;padding: 10px}
  50% { background-color: #5d1b0d;}
  75% { background-color: #b90b34;padding: 10px}
  100% { background-color: #b96d0b;padding: 15px}
}

@keyframes cmbstk {
  0% { background-color: #0bb97e;padding: 15px}
  250% { background-color: #b9b30b;padding: 10px}
  50% { background-color: #5d1b0d;}
  75% { background-color: #b90b34;padding: 10px}
  100% { background-color: #b96d0b;padding: 15px}
}
</style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <input type="hidden" value="<?php echo $val_stts;?>" id="ttsk_iidt">
  <div class="container-fluid">
    
  </div>
  <div class="card-body" id="sdsdsd">
    <div class="text-center" id="hhdder_crdpymt">
    <a  href="../index.php" style="float: left;color: white" id="ttrinsttl"><span"><label>Tutor Inspection System</label></span></a>
<br>
     <a href="../index.php" id="hme_lgo"><span id="home_glyph"><label for="gyl_home">&nbsp&nbspHome</label><span class="glyphicon glyphicon-home" id="gyl_home"></span></span></a>
   
</div>
     <div class="table-responsive">
       <div id="mnny">
     <center id="ssdbtnn">
    <p>
      Task for  class: <?php  echo "<span id='hhdder_crdpymt_prnm'>".$ft_sel_cls['class_name']."</span>";?>
      Lesson: <?php echo "<span id='hhdder_crdpymt_prnm'>".$ft_sel_crsses['course_name']."</span>";?>
      Title:  <?php echo "<span id='hhdder_crdpymt_prnm'>".$ft_sel_tsk['task_title']."</span>";?>
      on <?php echo "<span id='hhdder_crdpymt_prnm'>".substr($ft_sel_tsk['task_date'], 0,10)."</span>";?>
      <span class= 'langue' id="google_translate_element" style="float:right;"></span>
    </p>
<nav id="nnnavv">
        <button id="seeovlm" class="btn btn-lg btn-info" onclick="return seeTotlTsks()"><b><big><strong><span class="glyphicon glyphicon-tree-conifer"></span>&nbsp&nbspSee total </strong></big></b></button>&nbsp;&nbsp;
<?php
if (isset($_SESSION['seveeen_tis_teacher_id'])) {
 ?>
<a data-toggle="modal" data-target="#chgexampleModal"><button class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Change overall marks</button>&nbsp;&nbsp;</a>

<a data-toggle="modal" data-target="#delexampleModal"><button class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete this <?php if ($ft_sel_tsk['task_type']=="workss"){echo "work";}else if ($ft_sel_tsk['task_type']=="quizess"){echo "quiz";}else if ($ft_sel_tsk['task_type']=="testss"){echo "test";}else if ($ft_sel_tsk['task_type']=="examss"){echo "exam";}else {echo "task";}?></button></a>
<!--
<a data-toggle="modal" data-target="#combexampleModal"><button class="btn btn-primary" id="btncmdtsk"><span class="glyphicon glyphicon-resize-small"></span>&nbsp;&nbsp;Combine tasks</button>&nbsp;&nbsp;</a>
-->

<!-- COMBINE TASK   Commented -->
<a href="combine_tasks.php?crs=<?php echo $en_crs?>"><button class="btn btn-primary" id="btncmdtsk"><span class="glyphicon glyphicon-resize-small"></span>&nbsp;&nbsp;Combine tasks</button>&nbsp;&nbsp;</a>
<!-- <button class="btn btn-primary" onclick="alert('Not working... we are upgrading some issues');"><span class="glyphicon glyphicon-resize-small"></span>&nbsp;&nbsp;Combine tasks</button> -->
 <?php
}
?>
<button onclick="return rnkStndt()" class="btn btn-info"><span class="glyphicon glyphicon-sort-by-attributes"></span>&nbsp;&nbsp;<big><b>Rank Students</b></big></button>
<?php
$sel_tsksk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$val_stts' AND task_xkul='$usr_id' AND ((task_teacher='$tchr_id') OR (task_teacher='$ttt'))")or die(mysql_error());
$cnt_sel_tsksk=mysql_num_rows($sel_tsksk);
if ($cnt_sel_tsksk==1) {
  $ft_sel_tsksk=mysql_fetch_assoc($sel_tsksk);
  
  $task_resson=$ft_sel_tsksk['task_course'];
  $tsk_tchrr=$ft_sel_tsksk['task_teacher'];
  $tsk_ttypp=$ft_sel_tsksk['task_type'];
  $tsk_cclass=$ft_sel_tsksk['task_class'];
  $tsk_iiidd=$ft_sel_tsksk['task_id'];
  $tsk_ovrl_d=$ft_sel_tsksk['task_overall'];
  echo "<input type='hidden' id='task_resson' value='".$task_resson."'>";
  echo "<input type='hidden' id='tsk_tchrr' value='".$tsk_tchrr."'>";
  echo "<input type='hidden' id='tsk_ttypp' value='".$tsk_ttypp."'>";
  echo "<input type='hidden' id='tsk_cclass' value='".$tsk_cclass."'>";
  echo "<input type='hidden' id='tsk_iidd' value='".$tsk_iiidd."'>";
if (!isset($_SESSION['seveeen_tis_teacher_id'])) {
  $reitsk=dt_enc($tsk_iiidd+2018);
  $reicls=dt_enc($tsk_cclass+2018);
 // echo "<a href='tsksend_sms.php?rreidtsk=$reitsk&rreidcls=$reicls'><button style='float: right;' onclick='return sndMsgMks()' class='btn btn-success'><span class='glyphicon glyphicon-send'></span>&nbsp;&nbsp;<span class='glyphicon glyphicon-phone'></span>&nbsp;&nbsp;<big><b>Send SMS</b></big></button></a>";
  echo "<script> var notDsbldfrXkl='This function is not enabled for your school.';</script>";
  echo "<button style='float: right;font-size:14px' onclick='return alert(notDsbldfrXkl)' class='btn btn-success'><span class='glyphicon glyphicon-send'></span>&nbsp;&nbsp;<span class='glyphicon glyphicon-phone'></span>&nbsp;&nbsp;<big><b>Send SMS to Parent</b></big></button>";
}
?>                
</nav>
 </center>
<table id="st_task_lis_marks">

<?php
  echo "<thead><th>Students names</th><th>Marks/&nbsp;".$ft_sel_tsksk['task_overall']."</th></thead>";
  echo "<tbody>";
  echo "<tr><td></td><td></td></tr>";
$sel_stcl=mysql_query("SELECT * FROM tis_students WHERE student_class='$tsk_cclass' AND student_xkul='$usr_id' ORDER BY student_fullname ASC")or die(mysql_error());
if (mysql_num_rows($sel_stcl)>0) {
  $re=1;
  echo "<script> var wCnt=1;</script>";//counting which student i reach while updating
  ?>
<script>
  $(document).ready(function(){
    $('#upd_mrks_btn').click(function(){
      $('#upd_mrks_btn').attr("disabled","disabled");
      wCnt=1;
    })
  })
</script>
  <?php
  while ($ft_sel_stcl=mysql_fetch_assoc($sel_stcl)) {
    $ststtid=$ft_sel_stcl['student_id'];
    $sel_stmkst=mysql_query("SELECT * FROM tis_task_marks WHERE task_marks_task='$tsk_iiidd' AND task_mark_student='$ststtid' AND task_marks_xkul='$usr_id'")or die(mysql_error());
    if (mysql_num_rows($sel_stmkst)==1) {
      $tf_sel_stmkst=mysql_fetch_assoc($sel_stmkst);
      $tsk_mmksstt=$tf_sel_stmkst['task_marks_marks'];
      $tskmk_ovrll=$tsk_ovrl_d;
        }
    echo "<tr id='trtrmmk'>";
    echo "<td>".$re.")&nbsp;&nbsp;".$ft_sel_stcl['student_fullname']."</td>";
    ?>
<td id="iinmk"><input type='number' class='form-control' style='width:40%' id='tsk_mmk<?php echo $ststtid;?>' value='<?php echo $tsk_mmksstt?>'></td>
<script type="text/javascript">
  $(document).ready(function(){
    $("#upd_mrks_btn").click(function(){
      $("#upd_mrks_btn").attr("disabled","disabled");
      var sstid="<?php echo $ststtid;?>";
      var tskkid="<?php echo $tsk_iiidd;?>";
      var mmkksss=document.getElementById("tsk_mmk<?php echo $ststtid;?>").value;
      var updNwMk=true;
      $.ajax({url:"../js/ajax/index.php",
      type:"GET",data:{updNwMk:updNwMk,mmkksss:mmkksss,tskkid:tskkid,sstid:sstid,wCnt:wCnt},cache:false,success:function(res){$("#resbttn").html(res);}
      }); 
      wCnt++;
    });
    $("#tsk_mmk<?php echo $ststtid;?>").click(function(){
      if ( event.which==13) {
        $("#upd_mrks_btn").click();
        event.preventDefault();
      }
    });
  })
  wCnt++;
</script>
    <?php
    echo "</tr>";
    $re++;

  }
}
   echo "<a id='rereprnt' href='' style='display:none;float: right;margin-top: 300px;margin-right: 500px;font-size: 30px;font-weight: bolder;color: #1212ff'><span class='glyphicon glyphicon-refresh'></span> Reload...</a>"; 
}else{
  echo "<h1 style='color:red'><center>ERROR: 11 -h Something went wrong... ||  Please contact your administrator</center></h1>";
}
?>
               <tbody><!--

          <a id="rereprnt" href="" style="display: none;float: right;margin-top: 300px;margin-right: 500px;font-size: 30px;font-weight: bolder;color: #1212ff"><span class="glyphicon glyphicon-refresh"></span> Reload...</a>
               -->
<?php
if (isset($_GET['rrr'])) {
  # code...
}else{
  ?>
                 <tr style="max-height:50px;" id="lsttrr">
                   </div></td>
                   <td>
                     <center>
                       <p>
                         <button class="btn btn-primary" id="upd_mrks_btn"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp; Update&nbsp;&nbsp;</button>
                       <span id="resbttn" style="color: #07422c;font-style: oblique;font-family: Cooper Black;font-weight: bolder"></span>
                       </p>
                     </center>
                   </td>
                 </tr>
  <?php
}
?>
               </tbody>
             </table><button class="btn btn-info" id="prnt_btn_crt" onclick="return prntPdfCrtTskMks()"><span class="glyphicon glyphicon-print" style="font-size: 20px"></span>&nbsp&nbspPrint PDF</button>
           </td>
         </tr>
       </table>
    </td>
    <td>
       <div style="position: initial;float: right; margin-right: 40% ;" id="resp_nwps">&nbsp</div>
     
    </td>
  </tr>
</table>
     </div>  
<?php
require("../libs/parts/footer.php");
?>      
    </div>
  </div>
  </div>
<!-----------------------------------------------------------CHANGE OVERALL MODAL-------------------------------------------------->
    <div class="modal fade" id="chgexampleModal" tabindex="-1" role="dialog" aria-labelledby="chgexampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="chgexampleModalLabel">Changing <?php if ($ft_sel_tsk['task_type']=="workss"){echo "work";}else if ($ft_sel_tsk['task_type']=="quizess"){echo "quiz";}else if ($ft_sel_tsk['task_type']=="testss"){echo "test";}else if ($ft_sel_tsk['task_type']=="examss"){echo "exam";}else {echo "task";}?> averall marks</h5><span id="newovlresp" style="float: right;color: red;
            font-weight: bold;position: relative;"></span>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
<form class="form-inline">
  <label for="fldfrom"> From: &nbsp;&nbsp;&nbsp;</label>
  <input type="number" class="form-control" id="fldfrom" style="width: 20%" value="<?php echo $ft_sel_tsk['task_overall'];?>" disabled readonly> &nbsp;&nbsp;&nbsp;
  <label for="fldto"> To: &nbsp;&nbsp;&nbsp;</label>
  <input type="number" class="form-control" id="ttsk_new_iidt" style="width: 40%" placeholder="New overall marks">
</form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="cngOvrllMks" onclick="return cngOvrllMks()"><span class="glyphicon glyphicon-ok"></span> Change</button>
          </div>
        </div>
      </div>
    </div>
<!-----------------------------------------------------------DELETE TASK MODAL-------------------------------------------------->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" id="deltsshd">
            <h5 class="modal-title" id="delexampleModalLabel"><span id="dyrrldel" class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;Do you really want to delete this <?php if ($ft_sel_tsk['task_type']=="workss"){echo "work";}else if ($ft_sel_tsk['task_type']=="quizess"){echo "quiz";}else if ($ft_sel_tsk['task_type']=="testss"){echo "test";}else if ($ft_sel_tsk['task_type']=="examss"){echo "exam";}else {echo "task";}?> ? </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="deltssbd">
            <p>
              Make sure that you want to delete this <?php if ($ft_sel_tsk['task_type']=="workss"){echo "work";}else if ($ft_sel_tsk['task_type']=="quizess"){echo "quiz";}else if ($ft_sel_tsk['task_type']=="testss"){echo "test";}else if ($ft_sel_tsk['task_type']=="examss"){echo "exam";}else {echo "task";}?> because this action <b>can't be undone</b>. By clicking <b>"<u><i>Yes Delete</i></u>"</b> button; this <?php if ($ft_sel_tsk['task_type']=="workss"){echo "work";}else if ($ft_sel_tsk['task_type']=="quizess"){echo "quiz";}else if ($ft_sel_tsk['task_type']=="testss"){echo "test";}else if ($ft_sel_tsk['task_type']=="examss"){echo "exam";}else {echo "task";}?>  will be deleted <strong>permanently</strong>. So, be responsible for your decision...
            </p>
          </div>
          <div class="modal-footer" id="deltssft">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="deltTskk" onclick="return deltTskk()">Yes Delete</button>
          </div>
        </div>
      </div>
    </div>
  <!-- ----------------------------------------------------------------------COMBINE TASKS MODAL------------------------------------------------ -->
    <div width="600px" height="200px" class="modal fade-in" id="combexampleModal" role="dialog" aria-labelledby="combexampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" id="deltsshd">
            <h5 class="modal-title" id="combexampleModalLabel">Combine two or more tasks to <b>one task</b>.</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="deltssbd">
            <h3 style="font-weight: bolder;color: #e435a1">Coming soon</h3>
            <label>This will help teacher to join more tasks into one task so that at the end of semester, each course will be made by one task (assembly of works, quizes and tests [excluding EXAM]) which will help to make school report at the end.</label>
          </div>
          <input type="hidden" value="<?php echo $tchr_id;?>" id=cnnttchriid>
          <input type="hidden" value="<?php echo $usr_id;?>" id=cnnttxkliid>
          <div class="modal-footer" id="usrcmt"> 
            <label style="font-weight: bold;text-align: left;font-size: 14px" id="yrcmt">*Say something on this* </label>
            <span id="cmt_resp">
            <button class="btn btn-success" onclick="return cmtHlpf()">This is helpful.</button>
            <button class="btn btn-danger" onclick="return cmtUsls()">No need for this.</button>
            </span>
            <button id="mdl_cncl" style="display: none;" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <span></span>
          </div>
        </div>
      </div>
    </div>

</body>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../css/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>
<?php
}else{
   echo "<h1 style='color:red'><center>This task have been deleted or combined with another... Please reload task-list</center></h1>";
}
}else{
    echo "<h1 style='color:red'><center>ERROR: 35 -h Something went wrong... ||  Please contact your administrator</center></h1>";
 
}
}}
}
?>