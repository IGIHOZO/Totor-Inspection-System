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
if (!isset($_GET['crs'])) {
?>
<script type="text/javascript">
  window.location="../libs/parts/logout.php";
</script>
<?php
}else{
$crs_id=dt_dec($_GET['crs'])-2018;
$sel_crs=mysql_query("SELECT course_name,course_class,course_teacher FROM tis_courses WHERE Course_id='$crs_id' AND course_teacher='$tchr_id' AND course_xkul='$usr_id'")or die(mysql_error());
if (mysql_num_rows($sel_crs)==1) {
	$ft_sel_crs=mysql_fetch_assoc($sel_crs);
	$crs_nm=$ft_sel_crs['course_name'];
	$crs_cls=$ft_sel_crs['course_class'];
	$crs_tch=$ft_sel_crs['course_teacher'];
	$sel_tasks=mysql_query("SELECT * FROM tis_tasks WHERE task_class='$crs_cls' AND task_course='$crs_id' AND (task_teacher='$crs_tch' AND task_teacher='$tchr_id') AND task_xkul='$usr_id'");
	if (mysql_num_rows($sel_tasks)>0) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Combine Tasks -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Combine Tasks | Tutor Inspection System</title>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <style type="text/css">
    #combplwt{
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
    }
@-webkit-keyframes spin {
  0% { color: #047b47;font-weight: lighter; }
  50% { color: #07577d;font-weight: bold; }
  100% { color: #d24e06;font-weight: bolder; }

}

@keyframes spin {
  0% { color: #047b47;font-weight: lighter; }
  50% { color: #07577d;font-weight: bold; }
  100% { color: #d24e06;font-weight: bolder; }
}
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div id="hdn_cmb" style="display: none;"></div>
  <div class="container-fluid">
    
  </div>
  <div class="card-body">
    <div class="text-center" id="hhdder_crdpymt">
    <a  href="../index.php" style="float: left;color: white"><span"><label>Tutor Inspection System</label></span></a>
<div class="row">
  <div class="container-fluid" id="setcoo" style="position: relative;">
    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
<label style="text-transform: uppercase;">
	combine Tasks
</label>
    </div>
  </div>
</div>
     <a href="../index.php" id="hme_lgo"><span id="home_glyph"><label for="gyl_home">&nbsp&nbspHome</label><span class="glyphicon glyphicon-home" id="gyl_home"></span></span></a>
   
</div>
     <div class="table-responsive">
       <div id="mnny">
      <div class="form-group">
      	<div class="form-row">
	      		<div class="col-md-3">
<div id="fssd">
	      			

      			      <div class="card-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-11">
                <label for="protName">Select Class</label><span id="resp_cmbtk">&nbsp;</span>
                <select id="crssel" class="form-control" oninput="return cmbTskChsCls()">
                	<option value="default" style="color: #ea4545" selected>Select class</option>
                	<?php
                	$sel_clss=mysql_query("SELECT tis_classes.*,tis_courses.* FROM tis_classes,tis_courses WHERE tis_courses.course_class=tis_classes.class_id AND tis_courses.course_teacher='$tchr_id' AND tis_classes.class_xkul='$usr_id' AND LEFT(tis_classes.class_date,4)='".date("Y")."'")or die("<option>".mysql_error()."</option>");
  if (mysql_num_rows($sel_clss)>0) {
    while ($ft_sel_cl=mysql_fetch_assoc($sel_clss)) {
      echo "<option value='".$ft_sel_cl['class_id']."'>".$ft_sel_cl['class_name']."</option>";
    }
  }else{
    echo "<option value=''>Error Occured...</option>";
  }
                	?>
                </select>
              </div>
              <div class="col-md-11">
                <label for="protType">Choose Course</label>
<div class="input-group">
                <select class="form-control" id="chsclsel" >
                	<option></option>
                </select>
        <span style="height: 40px;background-color: transparent;border:0px" class="input-group-addon"><button onclick="return tkCmbDtls()" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Check</button></span>
</div>
<br>
<div class="input-group">
	<span style="height: 40px;background-color: transparent;border:0px" class="input-group-addon">
		<a data-toggle="modal" data-target="#combexampleModal">
		<button style="display: none;" class="btn btn-success" id="okcmb">
			<span class="glyphicon glyphicon-saved"></span>
		&nbsp;&nbsp;<strong><big>Ok, combine</big></strong>
		</button>
		</a>
	</span>
</div>
              </div>
              <div style="display: none;" class="col-md-11" id="hddn_thswn">
                <label for="protCategry">New Overll Mark</label>
                <input type="number" class="form-control" id="conf_pass">
              </div>
            </div>
          </div>
      </div>


</div>
      		</div>
      		<div class="col-md-9" id="ssasa">
      			<div class="card-body">
      				<div  id="comb_newresp">
      					
      				</div>
      			</div>
      		</div>
      	</div>	<!--               END row                -->
      </div> 	<!--               END form group                -->
     </div>  <!--               END mnny                -->
<?php
require("../libs/parts/footer.php");
?>      
    </div>
  </div>
</body>
  </div>
 <input type="hidden" id="hdn_comb_tsks">
<!-----------------------------------------------------------OK,COMBINE MODAL-------------------------------------------------->
    <div class="modal fade" id="combexampleModal" tabindex="-1" role="dialog" aria-labelledby="combexampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
        	<h3><span style="color: #f11;}" class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;&nbsp;This action can not be undone...</h3>
            <span id="newovlresp" style="float: right;color: red;
            font-weight: bold;position: relative;"></span>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="dsfasfsdf">
<form class="form-inline">
<i><u><b><strong><p class="modal-title" id="combexampleModalLabel">Do you really want to combine these selected tasks into one task ? </p></strong></b></u></i>
</form>
<hr>
<form class="form-inline">
  <label for="fldfrom"> <b><strong>New Title:</strong></b> &nbsp;&nbsp;&nbsp;</label><label style="margin-left: 5%;color: #f45;font-size: 15px;">&nbsp;(&nbsp; Maximum characters: <span style="color: #435344;font-weight: bolder"> 25 characters</span>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="cmb_cnt_chr_resp_cmb"></label></label>

  <input type="test" oninput="return combCountTskTtlChrs()" id="tskttl" class="form-control" style="width: 100%" placeholder="Maximmum Characters: 25" maxlength="25"> &nbsp;&nbsp;&nbsp;
</form>

<form class="form-inline">
  <label for="fldfrom"> <b><strong>New Category:</strong></b> &nbsp;&nbsp;&nbsp;</label>
  <select class="form-control" style="width: 100%" id="tskctgr">
  	<option style="color: red" value="default">Select category</option>
  	<option value="workss">Work</option>
  	<option value="quizess">Quiz</option>
  	<option value="testss">Test</option>
  	<option value="examss">Exam</option>
  </select> &nbsp;&nbsp;&nbsp;
</form>

<form class="form-inline">
  <label for="fldfrom"> <b><strong>New Overall:</strong></b> &nbsp;&nbsp;&nbsp;</label>
  <input type="number" class="form-control" style="width: 100%" id="tskovll" placeholder="Set new overall marks"> &nbsp;&nbsp;&nbsp;<br>
  <span id="yscmb_resp">&nbsp;&nbsp;</span>
</form>
          </div>
          <div class="modal-footer">
            <button class="btn btn-link" style="display: none;" id="combplwt">Combining, please wait...</button>
            <button id="yscmn_ccl"  class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id="yscmb"><span class="glyphicon glyphicon-ok"></span> Yes, combine</button>
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
<script type="text/javascript" src="../js/web/index.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
</html>

<?php
	}else{
		echo "<h1 style='color:red'><center>ERROR: 19 - G Something went wrong... ||  Please contact your administrator</center></h1>";
	}
}else{
	echo "<h1 style='color:red'><center>ERROR: 67 -h Something went wrong... ||  Please contact your administrator</center></h1>";
}
	}
	}
}
}
?>