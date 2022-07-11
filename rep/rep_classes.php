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
  <meta name="description" content="Report Classes -- Tutor Inspection System by SEVEEEN Ltd " />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Report Classes| Tutor Inspection System</title>
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
  <link href="../libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="../css/web/index.css" rel="stylesheet">
  <style type="text/css">
    #gen_fter{
      position: relative;margin-left: 10%
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <input type="hidden" value="<?php echo @$class_iid?>" id="hidcllid">
  <!-- Navigation-->
  
  <?php
include"../menus/sheader.php";
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Task status</a>
        </li>
        <li class="breadcrumb-item active">Task level
<li><span class="form-inline my-2 my-lg-0 mr-lg-2" id="dte_grp">
<div class="form-group">
<label>Class&nbsp;</label>
<select class="form-control" id="classId">
<?php
$dr="";
//echo $usr_id;exit;
$qy=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='".$usr_id."' AND LEFT(class_date,4)='".date("Y")."' AND class_status='E'");
while($ft=mysql_fetch_assoc($qy)){
  $dr.="<option value='".$ft['class_id']."'>".$ft['class_name']."</option>";
}
echo $dr;
?>
</select>
</div>
<div class="form-group">
<label>Status</label>
<select class="form-control" id="taskStatus">
  <option value="default">All</option>
  <option value="Md">Marked</option>
  <option value="Ny">Not Yet</option>
</select>
</div>
  <div class="input-group"><label for="lblefrom"><b>
&nbsp;Choose Day: &nbsp </b></label><input type="text" name="lblefrom" id="lblefrom" class="form-control" placeholder="Month / Day / Year"><button class="btn btn-primary" id="tke_btn" onclick="return clTskDatPckr()"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Take...</button></div></div></li>
        </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
          <?php include_once"../Classes/Issues.php";?>
        <div class="card-header">
          <i class="fa fa-table"></i> Available Tasks
         <button type="button" class="btn btn-primary pull-right" id="btnPrintClassTask"><i class="fa fa-print"></i>Print</button></div>
        <div class="card-body">
          <div class="table-responsive" id="tblclasstask">
<div id="bbdtsktbbl">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Course</th>
                  <th>Teacher</th>
                  <th>Title</th>
                  <th>Overall</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Course</th>
                  <th>Teacher</th>
                  <th>Title</th>
                  <th>Overall</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
  
              </tbody>
            </table>
          </div>
        </div>
<?php 
/*
//------------------------------------------------------last products modification
$sel_llst=mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tchr_id' AND task_xkul='$usr_id' AND ((task_status='$mdstt') OR (task_status='$ntstt')) order by task_date desc");
$cnt_sel_llst=mysql_num_rows($sel_llst);
if ($cnt_sel_llst>=1) {
?>
<div class="card-footer small text-muted"><?php echo"<span id='tl_tsk'>".$cnt_sel_llst ."</span> Available total tasks."?> </div>
<?php
}
*/
?>
      </div>
    </div>
  </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../libs/parts/footer.php");
include"../report.html";
?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to get out of your acount.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
    <script src="../js/web/index.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>

  </div>
</body>
  <script type="text/javascript">

function getSelectedHtml(value){
  var el=document.getElementById("classId").getElementsByTagName("option");
for(var i=0;i<el.length;i++){
  if(el[i].value==value){
    return el[i].innerHTML;
  }
}
return "None";
}    $("#btnPrintClassTask").click(function(){
  $(this).hide();
  $("#headingReport").show();$(".content-wrapper").hide();
$("#footerlg").hide();
$("#reportBody").html($("#tblclasstask").html());
$("#schoolName").html($("#fullname").html());
$("#reportTitle").html("Given Task for class "+getSelectedHtml($("#classId").val()));
$("tfoot").hide();
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
  $("#headingReport").hide();
  $(".content-wrapper").show();
  $("#footerlg").show();
  $(this).show();
$("tfoot").show();

});
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>


<?php
/*}else{
    echo "<h1 style='color:red'><center>ERROR: 11 -A Something went wrong... ||  Please contact your administrator</center></h1>";
 
}
*/
}}
}
?>