<?php
session_start();
require("libs/parts/didier_igihozo.php");
require("Classes/AcademicCalendar.php");
$arch=new AcademicCalendar(); 
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
//  window.location="login.php";
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
}
}
}
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Register Teacher -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="libs/datepiker/plugs/css/bootstrap-datepicker.min.css">
  <title>Documents | Tutor Inspection System</title>
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
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  
  <?php
  if(isset($_SESSION['seveeen_tis_seveeen_admin_id'])){
include"menus/aheader.php";
  }elseif(isset($_SESSION['seveeen_tis_usr_id']) || isset($_SESSION['seveeen_tis_taecher_id'])){
include"menus/sheader.php";
}
  ?>
  <div class="content-wrapper" style="width:100%">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
      <ol class="breadcrumb" id="breadcrumb">
        <li class="breadcrumb-item">
          <a href="adhome.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Academic Calendar</li>
      </ol>
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalAcademicCalendar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">New Academic year information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                               <div class="modal-body">
                    <div id="regAcademicCalendarResponse"></div>
                        <div class="form-group">
                            <p>Academic Year</p>
                            <input type="text" name="acyear" id="acyear" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester Index</p>
                            <input type="text" name="index" id="index" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester start</p>
                            <input type="text" name="start" id="start" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester end</p>
                            <input type="text" name="end" id="end" required class="form-control"">
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnSaveAcademicCalendar" name="btnSaveAcademicCalendar" type="button"><i class="fa fa-check-square-o"></i> Save</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                            </div>
                        </div>
            </div>
        </div><!--end AcademicCalendar Dialog-->
        
		<div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateAcademicCalendar" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Academic Calendar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                     <div id="updAcademicCalendarResponse"></div>
<input type="hidden" id="acalid">          
                        <div class="form-group">
                            <p>Academic Year</p>
                            <input type="text" name="" id="updacyear" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester Index</p>
                            <input type="text" name="updindex" id="updindex" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester start</p>
                            <input type="text" name="updstart" id="updstart" required class="form-control"">
                           </div>
                        <div class="form-group">
                            <p>Trimester end</p>
                            <input type="text" name="updend" id="updend" required class="form-control"">
                           </div>
                         </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdAcademicCalendar" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                        </div>
                    </div>
        </div><!--end AcademicCalendar Dialog-->
        
		      <div class="col-lg-10" id="archiveviewform" style="padding-left:2%;margin-top: -1%;">
        <span style="color:green"></span>
        <div class="table-responsive">
                <?php
//check whether user storage exists
if(isset($_SESSION['seveeen_tis_seveeen_admin_id'])==true){
  $archPath="Ad".$_SESSION['seveeen_tis_seveeen_admin_id'];
}elseif(isset($_SESSION['seveeen_tis_teacher_id'])==true){
  $archPath="Te".$_SESSION['seveeen_tis_teacher_id'];
}else{
  $archPath="Sc".$_SESSION['seveeen_tis_usr_id'];
  }
   ?>
        <table class="table table-bordered" id="tblAcademicCalendar">
          <caption>Registered Academic Calendar</caption>
             
          <thead>
            <tr>
              <th>#Count</th>
              <th>Ac. Year</th>
              <th>Trimester </th>
              <th>Start </th>
              <th>End </th>
              <th>Status</th>
              <th>  Reg. Date</th>
              <th colspan="2">  Modifications<br><button data-toggle="modal" data-target="#modalAcademicCalendar" class="btn btn-primary" style="margin-left: 10%"><span class="glyphicon glyphicon-plus"></span>Add</button>
                <button data-toggle="modal" data-target="#autoModal" class="btn btn-success" style="margin-left: 10%"><span class="glyphicon glyphicon-link"></span>Auto</button>
                <button data-toggle="modal" data-target="#showModal"  onclick="showAcademicCalendar()" class="btn btn-info" style="margin-left: 3%"><i  class="fa fa-eye"></i> &nbsp;Calendar</button>
              
              </th>
            </tr>
          </thead>
          <tbody id="loadedacal">
		  
          </tbody>
        </table>
        </div>
      </div><!--end employeeviewform-->

        <div id='enableModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="enableModalTitle">Enable Period</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="enableResponse">  </p> 
<h6 class="jumbotron alert alert-primary">What happens when you enable academic calendar options?</h6>
<div class="alert alert-success">The automatic detection of academic calendar will be disabled,and enabled options is what teachers and schools will be working in<br>Means when teacher add tasks,will be added on enabled options while when it is automatic system will detect the active trimester and academic year</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnEnableAcademicCalendar" class="btn btn-success" ><i class="fa fa-check-square-o"></i>
              Enable</button><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end enable Modal-->
        <div id='autoModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h5 class="modal-title" id="autoModalTitle">Enable Automatic detect academic calendar</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="autoResponse">  </p>
            <h6 class="jumbotron alert alert-primary">What happens when you make academic calendar automatic detected?</h6>
<div class="jumbotron alert alert-success">The automatic detection of academic calendar will be enabled,and is what teachers and schools will be working in<br>Means when teacher add tasks,system will detect the active trimester and academic year.</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnAutoAcademicCalendar" class="btn btn-success" ><i class="fa fa-check-square-o"></i>
              Auto</button><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end auto Modal-->
        <div id='showModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h5 class="modal-title" id="showModalTitle">Active Academic calendar</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="showResponse">  </p>
           <div class="table-responsive">
              <caption>Automatic Detection for Active Calendar</caption><br><br>
            <table class="table-striped" style="width: 100%">
                <td>Academic Year</td><td><span id="autoyear"></span></td></tr>
                <tr><td>Trimester</td><td ><span id="autotrimester"></span></td></tr>
                <tr><td>Start</th><td><span id="autotstart"></span></td></tr>
                <tr><td>End</td><td><span id="autoclose"></span></td></tr>
            </table><br><br>
              <caption>Enabled Calendar for viewing Reports and Statistics</caption><br><br>
            <table class="table-striped" style="width: 100%">
                <td>Academic Year</td><td><span id="year"></span></td></tr>
                <tr><td>Trimester</td><td ><span id="trimester"></span></td></tr>
                <tr><td>Start</th><td><span id="tstart"></span></td></tr>
                <tr><td>End</td><td><span id="close"></span></td></tr>
            </table>
           </div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end show calendar Modal-->
        <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p> 
			<label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelAcademicCalendar" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
</div>
</div><!--end container-->						
	<?php
require("libs/parts/footer.php");
?>
 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="libs/datepiker/plugs/js/bootstrap-datepicker.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/web/index.js"></script>
    <script src="Scripts/jqdepend.js"></script>
  </div>
</body>
</html>

<script>
	//function autoloading

  
//load academic calendar options
loadAcademicCalendar(); 

//Asua-->own object for javascript

//events for AcademicCalendar
//AcademicCalendar Infos
$("#btnSaveAcademicCalendar").click(function(e){
  e.preventDefault();
    if($("#acyear").val()!='' && $("#index").val()!='' && $("#start").val()!='' && $("#end").val()!=''){
  registerAcademicCalendar();
    }else{
      $("#regAcademicCalendarResponse").html("<font color='red'>All Form Components Are required");
    }
})
$("#btnUpdAcademicCalendar").click(function(e){
  e.preventDefault();
    if($("#updacyear").val()!='' && $("#updindex").val()!='' && $("#updstart").val()!='' && $("#updend").val()!=''){
        updateAcademicCalendar();
    }else{
        $("#updAcademicCalendarResponse").html("<font color='red'>All Form Components Are required");
    }
    clearMsg("#updAcademicCalendarResponse");
});

$("#btnDelAcademicCalendar").click(function(e){
        e.preventDefault();
        deleteAcademicCalendar();
    })
$("#btnEnableAcademicCalendar").click(function(e){
  e.preventDefault();
  enableAcademicCalendar();
})
$("#btnAutoAcademicCalendar").click(function(e){
  e.preventDefault();
    autoAcademicCalendar();
})
$("#btnShowAcademicCalendar").click(function(e){
  e.preventDefault();
  showAcademicCalendar();
})
$("#start").datepicker({format:'yyyy-mm-dd'});
$("#end").datepicker({format:'yyyy-mm-dd'});
$("#updstart").datepicker({format:'yyyy-mm-dd'});
$("#updend").datepicker({format:'yyyy-mm-dd'});
</script>