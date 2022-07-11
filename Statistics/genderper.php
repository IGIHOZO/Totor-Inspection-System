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
  if (@!isset($_SESSION['seveeen_tis_seveeen_admin_id'])) {
    ?>
<script type="text/javascript">
  window.location="../libs/parts/logout.php";
</script>
<?php
  }else{
  }
}
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Dashboard -- Tutor Inspection System by SEVEEEN Ltd " />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/main.css">
  <title>Dashboard | Tutor Inspection System</title>
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
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
<link href="../css/web/index.css" rel="stylesheet">
<style type="text/css">
  #pnticnann{
    -webkit-animation: spin 4s linear infinite;
    animation: spin 4s linear infinite;
    font-size: 30px;
}
#pnticnann:hover{
    animation-play-state: paused;
}
@-webkit-keyframes spin {
  0% { color: red;font-weight: bolder;transform: rotate(0deg); }
  35% {  color: #11ff22;font-weight: bold;transform: rotate(90deg); }
  70% {  color: red;font-weight: bold;transform: rotate(180deg); }
  100% {  color: #11ff22;font-weight: bold;transform: rotate(360deg); }
}

@keyframes spin {
  0% { color: red;font-weight: bolder;transform: rotate(0deg); }
  35% {  color: #11ff22;font-weight: bold;transform: rotate(90deg); }
  70% {  color: red;font-weight: bold;transform: rotate(180deg); }
  100% {  color: #11ff22;font-weight: bold;transform: rotate(360deg); }
}
</style>
  <script type="text/javascript" src="../js/chart.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000">
  <!-- Navigation-->
  <?php
if(isset($_SESSION['seveeen_tis_seveeen_admin_id'])){
include"../menus/aheader.php";
  }else{
include"../menus/sheader.php";

  }
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <h5 style="text-transform: uppercase;"><center><i class="fa fa-table"> <u>Inspection statistics</u> </i></center></h5>
          <button type="button" class="btn btn-primary btn-sm pull-right" id="btnPrintGenderStatistics" onclick="demoFromHTML()"><i class="fa fa-download" ></i>Export</button></div>
           <?php
              echo "<select class='form-control' id='selclassdash' style='display:none'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='".$_SESSION['seveeen_tis_usr_id']."' AND LEFT(class_date,4)='".date("Y")."' order by class_name asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['class_id']."'>".$ft_sel_tch['class_name']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select>";
              ?>
          <div id="invalidResponse" style="text-align: center;"></div>
      <div class="row">
        <h4>Student Bar chart based on Performance</h4>
      <div class="row" style="width: 80%;margin-left: 5%"> 
        <div class="col-lg-4 col-md-4" style="background-color: rgba(220,220,220,0.5)">O'Level</div>
        <div class="col-lg-4 col-md-4" style="background-color: rgba(151,187,205,0.5)">A'Level</div>
        <div class="col-lg-4 col-md-4" style="background-color: rgba(151,107,80,0.5)">Both</div>
        </div>
        <div id="graphBarPresent" class="col-lg-12"> <canvas id="gender_performance_statistics"></canvas>
         </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
//require("../libs/parts/footer.php");
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
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>



    <!-- Bootstrap core JavaScript>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script> 
     <script src="../js/chart/Chart.bundle.js"></script>
  <script src="../js/chart/utils.js"></script>
  <script src="../libs/chart/js/Chart.js"></script>
  -->

  <script src="../BSHelper/vendor/popper/popper.min.js"></script>
      <script src="../BSHelper/vendor/jquery/jquery.min.js"></script>
     <script src="../BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../BSHelper/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../BSHelper/vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../BSHelper/js/make-charts.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../css/bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../js/web/index.js"></script>

    <script type="text/javascript" src="../Scripts/jqdepend.js"></script>
    <script type="text/javascript" src="../Scripts/jspdf.js"></script>
  </div>
</body>
  <script type="text/javascript">
    $(document).ready(function(){
    loadGenderStatistics('setContentByPerformance',"gender_performance_statistics");
    });

function demoFromHTML() {
    var pdf = new jsPDF('landscape');
      $("#sidenavToggler").click();
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = document.getElementById('gender_performance_statistics').toDataURL();
    pdf.addImage(source, 'PNG', 10, 40);
    pdf.text(10, 15, "Tutor Inspection System");
    pdf.text(10,23,$("#fullname").html())
    pdf.text(50,32,"Gender based performance "+getSelectedHtml("selclassdash"));
    pdf.text(180,200," downloaded on "+getDate()+" at "+getTime());
    pdf.save($("#fullname").html()+' gender based performance.pdf');
      $("#sidenavToggler").click();
}
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
//====events
$("#selclassdash").change(function(e){
  e.preventDefault();
   if($("#selclassdash").val()!='choose'){
    loadGenderStatistics('setContent',"gender_count_statistics");
    }
});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>