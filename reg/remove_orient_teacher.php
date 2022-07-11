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
  <meta name="description" content="Orient Teacher -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>REMOVE Orient Teacher | Tutor Inspection System</title>
<style>
.loader01 {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 35px;
  height: 35px;
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
</style>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <link href="../css/web/register_class.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  <?php
include"../menus/sheader.php";
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <h2 align="center" class="list-group-item" id="crt_nw_cl_ttl">Remove Course Teacher</h2>
      <center><h5><span id="hdn_crt_nw_cls">&nbsp&nbsp&nbsp&nbsp</span></h5></center>
  <table id="new_cls_tbl" class="table table-responsive">
    <thead>
      <tr>
        <th><u>Available Teachers</u></th>
        <th><u>Available Classes</u></th>
        <th><u>Untaken Courses</u></th>
        <th>&nbsp&nbsp&nbsp</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <span class="form-group">
           
              <?php
              echo "<select class='form-control' id='re_or_tch_tchr'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Teacher</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$usr_id' order by teacher_fullname asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['teacher_id']."'>".$ft_sel_tch['teacher_fullname']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select";
              ?>
              
         </span>
        </td>
        <td>
          <span class="form-group">
              <?php
              echo "<select class='form-control' id='re_or_tch_cls'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' order by class_name asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['class_id']."'>".$ft_sel_tch['class_name']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select";
              ?>     
         </span>       
        </td>
        <td>
          <span class="form-group">
          <span class="form-group">
              <?php
              echo "<select class='form-control' id='or_tch_crs'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Course</option>";
              echo "</select";
              ?>     
         </span>    
         </span>
        </td>
        <td>
          <span class="form-group">
          <button class="btn btn-success" id="okset" onclick="return removeOrientTchr()"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp&nbsp Remove</button> 
         </span>
        </td>
      </tr>
    </tbody>
<!-- _____________________________________________________________________________________________________________________________ -->
  </table>
              </div>
            </div>
          </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../libs/parts/footer.php");
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
    <script src="../js/web/index.js"></script>
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