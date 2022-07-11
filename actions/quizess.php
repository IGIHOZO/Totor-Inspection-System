<?php
session_start();
require("../libs/parts/didier_igihozo.php");
require_once"../Classes/AcademicCalendar.php";
      $acal=new AcademicCalendar;
      $calendar=json_decode($acal->getAutomaticActiveCalendar(array("uid"=>$_SESSION['seveeen_tis_usr_id'])),TRUE);
      $calendarStart=$calendar[0]['start'];$calendarStop=$calendar[0]['close'];
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */

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
$ntstt="Ny";
$mdstt="Md";
$se_all_id=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['school_id'];

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Set New Task -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Set New Task | Tutor Inspection System</title>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/web/index.css" rel="stylesheet">
<style>
.loader {
  margin: 50%;
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 55px;
  height: 55px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
.loader01 {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 30px;
  height: 30px;
  -webkit-animation: spinn 2s linear infinite;
  animation: spinn 2s linear infinite;
}
@-webkit-keyframes spinn {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spinn {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  <?php include_once"../menus/sheader.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRegisterQuiz" class="modal fade" style="margin-top: -70px;">
            <div class="modal-dialog">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                         <h4 class="modal-title">New Quiz registration form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                          <span id="hdn_crt_nw_cls"></span>
                            <div class="modal-body">
      <div id="regQuizResponse"></div>
          <form name="quizesregoform" action="" method="post" novalidate>
                    <div class="form-group">
          <label>Select Class  </label>
           
                <?php
              $tchr_id=$_SESSION['seveeen_tis_teacher_id'];
              echo "<select class='form-control' id='tsskclss'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $se_crs=mysql_query("SELECT DISTINCT tis_courses.* FROM tis_courses WHERE course_teacher='$tchr_id' AND course_xkul='$usr_id'");
              $cnt_se_crs=mysql_num_rows($se_crs);
              if ($cnt_se_crs>0) {
                $verify=1;
                while ($ft_se_crs=mysql_fetch_assoc($se_crs)) {
                  $cls_idd=$ft_se_crs['course_class'];
                  $sel_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_id='$cls_idd' AND LEFT(class_date,4)='".date("Y")."'");
                  $cnt_sel_clss=mysql_num_rows($sel_clss);
                  if ($cnt_sel_clss!=1) {
                    echo "<option value='No' selected id='chs_slctd'>ERROR 33-ff occured</option>";
                  }else{
                    
                    $ft_classes=mysql_fetch_assoc($sel_clss);
                    echo "<option value='".$ft_classes['class_id']."'>".$ft_classes['class_name']."</option>";
                  }
                }
              }else{
                echo "<option value='No' selected id='chs_slctd'> No Class available for you</option>";
              }
              echo "</select";
              ?>
              </div>
      <input type="hidden" id="tskhddn" value="quizess">
      <div class="form-group">
        <label>Select Lesson</label>
        <select class="form-control" id="tsklssn"><style>#resp_sp{color:#058f19;font-weight:bolder;font-style:oblique;font-size:26px;font-family:Baskerville Old Face}</style><option value="choose"> Choose Lesson</option></select>
      </div>
      <div>
&nbsp;&nbsp;&nbsp;<br><br>
      </div>
      <div class="form-group">
        <label>Quiz Title</label><label style="margin-left: 10%;color: #f45;font-size: 15px;">&nbsp;(&nbsp; Maximum characters: <span style="color: #435344;font-weight: bolder"> 25 characters</span>)<label id="cnt_chr_resp"></label></label>
        <input type="text" class="form-control" oninput="return countTskTtlChrs()" id="tskttl" placeholder="Given Quiz" maxlength="25">
      </div>
      <div class="form-group">
        <label>Overall marks</label>
        <input type="number" class="form-control" id="tskovll" placeholder="" style="font-size: ">
      </div></form></div>
                        <div class="modal-footer" style="margin-top: -30px;">
                            <button class="btn btn-primary" onclick="return setTsk()" id="sttsk"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Set Quiz</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                        </div>
            </div>
          </div>
        </div><!--end Quiz Dialog-->
        
		<div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateQuiz" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update Quiz form</h4>
                    </div>
                     <div class="modal-body">
      <div id="updQuizResponse"></div>
          <form name="quizesupdform" action="" method="post" novalidate>
                    <div class="form-group">
          <label>Select Class</label>
          <?php
              $tchr_id=$_SESSION['seveeen_tis_teacher_id'];
              echo "<select class='form-control' id='updtsskclss'>";
              echo "<option value='choose' selected id='updchs_slctd'> Select Class</option>";
              $se_crs=mysql_query("SELECT * FROM tis_courses WHERE course_teacher='$tchr_id' AND course_xkul='$usr_id' GROUP BY course_name");
              $cnt_se_crs=mysql_num_rows($se_crs);
              if ($cnt_se_crs>0) {
                $verify=1;
                while ($ft_se_crs=mysql_fetch_assoc($se_crs)) {
                  $cls_idd=$ft_se_crs['course_class'];
                  $sel_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_id='$cls_idd' AND LEFT(class_date,4)='".date("Y")."'");
                  $cnt_sel_clss=mysql_num_rows($sel_clss);
                  if ($cnt_sel_clss!=1) {
                    echo "<option value='No' selected id='chs_slctd'>ERROR 33-ff occured</option>";
                  }else{
                    
                    $ft_classes=mysql_fetch_assoc($sel_clss);
                    echo "<option value='".$ft_classes['class_id']."'>".$ft_classes['class_name']."</option>";
                  }
                }
              }else{
                echo "<option value='No' selected id='chs_slctd'> No Class available for you</option>";
              }
              echo "</select";
              ?></div>
      <input type="hidden" id="updtskhddn" value="quizess">
      <div class="form-group">
        <label>Select Lesson</label>
        <select class="form-control" id="updtsklssn"><style>#resp_sp{color:#058f19;font-weight:bolder;font-style:oblique;font-size:26px;font-family:Baskerville Old Face}</style><option value="choose"> Choose Lesson</option></select>
      </div>
      <div class="col-md-12">
&nbsp;&nbsp;&nbsp;<br><br>
      </div>
      <div class="form-group">
        <label>Quiz Title</label><label style="margin-left: 10%;color: #f45;font-size: 15px;">&nbsp;(&nbsp; Maximum characters: <span style="color: #435344;font-weight: bolder"> 25 characters</span>)<label id="updcnt_chr_resp"></label></label>
        <input type="text" class="form-control" oninput="return countTskTtlChrs()" id="tskttl" placeholder="Given Quiz" maxlength="25">
      </div>
      <div class="form-group">
        <label>Overall marks</label>
        <input type="number" class="form-control" id="updtskovll" placeholder="" style="font-size: ">
      </div></form></div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdQuiz" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                        </div>
                    </div>
                  </div>
        </div><!--end Quiz Dialog-->
        
		      <div class="row" id="quizviewform" style="padding:2%;margin-top: -3%">
        <form action="" method="GET">
          <div class="col-lg-12 input-goup">
            <!--input type="text" name="keyQuiz" id="keyQuiz" placeholder="Quiz name..." class="form-control srch"-->
          </div></form>
        <span style="color:green"></span>
        <!-- Example DataTables Card-->

        <div class="table">
          
                <button class="btn btn-primary glyphicon glyphicon-plus-sign pull-right" data-toggle='modal' data-target='#modalRegisterQuiz' style="margin-right:17px;"> New</button>
       <h4>List of Your Quizes Available</h4>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" id="tblQuizes">
          <thead>
            <tr>
              <th>#Counts</th>
              <th>Class </th>
              <th>Lesson </th>
              <th>Title </th>
              <th>Marks</th>
              <th>Category </th>
              <th>Status</th>
              <th>  Date </th>
              <!--th class="prodmore">  Modifications
<button data-toggle="modal" data-target="#modalQuiz" class="btn btn-primary pull-right" style="margin-right:3%;margin-bottom:0.5%;margin-top: -1%"><span class="glyphicon glyphicon-plus"></span>Add Quizes</button></th-->
            </tr>
          </thead>
          <tbody id="loadedquizes">
		  <?php
$ntstt="Ny";
$mdstt="Md";
$sel_tasts=mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tchr_id' AND task_xkul='$usr_id' AND task_type='quizess' AND ((task_status='$mdstt') OR (task_status='$ntstt')) AND tis_tasks.task_date BETWEEN '".$calendarStart."' AND '".$calendarStop."'");
$cnt_sel_tasts=mysql_num_rows($sel_tasts);
if ($cnt_sel_tasts>0) {
  $counter=0;
  while ($ft_sel_tasts=mysql_fetch_assoc($sel_tasts)) {
    $counter++;
    $cors_id=$ft_sel_tasts['task_course'];
    $clss_idd=$ft_sel_tasts['task_class'];
    $selcrs=mysql_query("SELECT * FROM tis_courses WHERE course_id='$cors_id' AND LEFT(course_date,4)='".date("Y")."' AND course_xkul='$usr_id'")or die(mysql_error());
    $fet_selcrs=mysql_fetch_assoc($selcrs);
    $crs_nm=$fet_selcrs['course_name'];

    $selclss=mysql_query("SELECT * FROM tis_classes WHERE class_id='$clss_idd' AND class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."'")or die(mysql_error());
    $fet_selclss=mysql_fetch_assoc($selclss);
    $clss_nm=$fet_selclss['class_name'];
    ?>
<tr>

  <td>
    <?php
    echo $counter;
    ?>
  </td>
  <td>
    <?php
    echo $clss_nm
    ?>
  </td>
  <td>
    <?php
    echo $crs_nm
    ?>
  </td>
  <td>
    <?php
    echo "<span style='font-size:10px;font-weight: bolder;text-decoration:underline'>".$ft_sel_tasts['task_title']."<span>";
    ?>
  </td>
  <td>
    <?php
    echo $ft_sel_tasts['task_overall'];
    ?>
  </td>
  <td>
    <?php
     if ($ft_sel_tasts['task_type']=="workss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Work</span>";
    }elseif ($ft_sel_tasts['task_type']=="quizess") {
      echo "<span style='font-size:11px;'>".$task_ttype="Quiz</span>";
    }elseif ($ft_sel_tasts['task_type']=="testss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Test</span>";
    }elseif ($ft_sel_tasts['task_type']=="examss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Exam</span>";
    }else{

    }
    ?>
  </td>
    <td>
    <?php
    $tsk_dtls=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($ft_sel_tasts['task_id']+2018)))))))));
    if ($ft_sel_tasts['task_status']=='Ny') {
      echo "<a href='task_marks.php?rei=$tsk_dtls' id='ntyt' target='_blank' >Not Yet</a>";
    }elseif ($ft_sel_tasts['task_status']=='Md') {

      echo "<a href='task_marks.php?rei=$tsk_dtls' id='mrkd' target='_blank'>Marked</a>";
    }
    ?>
  </td>
    <td>
    <?php
    echo "<span style='font-size:11px;font-weight: bolder;text-decoration:underline'>".substr($ft_sel_tasts['task_date'], 0,10).' | '.substr($ft_sel_tasts['task_date'], 11,2).'h</span>';
    ?>
  </td>
</tr>
    <?php
  }
}
?>              
          </tbody>
        </table>
        </div>
      </div><!--end employeeviewform-->


	  <!--End Optional-->
	    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delProdReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelQuiz" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
</div>
</div>				
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
    <script src="../js/web/index.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
  </div>
</body>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php
}}
}
?>