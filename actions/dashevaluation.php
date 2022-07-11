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
include"menus/aheader.php";
  }else{
include"menus/sheader.php";
  }
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
         
      <div class="card mb-3">
        <div class="card-header">
          <h5 style="text-transform: uppercase;"><center><i class="fa fa-table"> <u>Inspection statistics</u> </i></center></h5></div>
          
          <br><br><br><br>
         <!--  <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                    <td colspan="2"> -->
 <?php
                    $stt_e="E";
                    $stt_nw="Nw";
$sel_schl_gra=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
$sel_schl_grb=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
$sel_schl_grc=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
$sel_schl_grd=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
/*
$sel_tsk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id' AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname ASC")or die(mysql_error());
$sel_t_cnt_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id' AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname ASC")or die(mysql_error());
$cl_bg_t_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id' AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname ASC")or die(mysql_error());
$cl_brd_t_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id' AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname ASC")or die(mysql_error());
*/
                    if ($cnt_sel_tsk_tch=mysql_num_rows($sel_schl_gra)>0) {

                      ?>
<div style="position: absolute; margin-top: -40%">
    <canvas id="myChart" style="width: 100%;height: 100%;position: relative;flex-flow: all;"></canvas>
</div>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {

    type: 'line',
    data: {
        labels: [<?php
        while ($ft_data=mysql_fetch_assoc($sel_schl_gra))
            echo '"'.$ft_data['school_full_name'].'",';
                                $i=0;
                      while ($ft_thrr=mysql_fetch_assoc($sel_schl_gra)) {
                        $tch_iiid[$i]=$ft_thrr['school_id'];
                        $i++;
                      }
        ?>],
        datasets: [{
            label: "Schools' students",
            data: [<?php
        while ($ft_dataaa=mysql_fetch_assoc($sel_schl_grb)){
          $tch_id=$ft_dataaa['school_id'];
          $sel_tsk_cnt_tchr=mysql_query("SELECT * FROM tis_students WHERE student_xkul='$tch_id'")or die(mysql_error());
          $cnt_sel_tsk_cnt_tchr=mysql_num_rows($sel_tsk_cnt_tchr);
          $ft_sel_tsk_cnt_tchr=mysql_fetch_assoc($sel_tsk_cnt_tchr);
          $cnt_tt_cnt=$cnt_sel_tsk_cnt_tchr;

          if ($cnt_sel_tsk_cnt_tchr>0) {
            $my_cnt_tt_cnt=$cnt_tt_cnt;
          }else{
            $my_cnt_tt_cnt=0;
          }

            echo $my_cnt_tt_cnt.',';
        }
        ?>],
            backgroundColor: [<?php
            echo '"transparent"';
        ?>],
            borderColor: [<?php
            echo '"#235344",';
        ?>],
            fill: true,
            borderWidth: 3
        }]
    },
  options: {
    animation: {
      onProgress: drawBarValues,
      onComplete: drawBarValues,
    },
      layout: {
            padding: {
                left: 50,
                right: 20,
                top: 0,
                bottom: 0
            }
        },
    responsive: true,
    tooltips: {
      mode: 'index',
      intersect: false,
    },
   hover: {
      mode: 'nearest',
      intersect: true
    },
scales: {

    xAxes: [{
      display:true,
        stacked: false,
        beginAtZero: true,
        scaleLabel: {
            labelString: 'Seveeen Ltd'
        },
        ticks: {
            display:true,
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },

    }]
},
  }
});
function drawBarValues()
{
  // render the value of the chart above the bar
  var ctx = this.chart.ctx;
  ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
  ctx.fillStyle = this.chart.config.options.defaultFontColor;
  ctx.textAlign = 'center';
  ctx.textBaseline = 'bottom';
  this.data.datasets.forEach(function (dataset) {
    for (var i = 0; i < dataset.data.length; i++) {
      if(dataset.hidden === true && dataset._meta[Object.keys(dataset._meta)[0]].hidden !== false){ continue; }
      var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
      if(dataset.data[i] !== null){
        ctx.fillText(dataset.data[i], model.x - 1, model.y - 5);
      }
    }
  });
}
</script>
                      <?php
                    }

                    ?>
                    <!-- </td>   
                </tr>
              </tbody>
            </table>
          </div> -->
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
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="libs/parts/logout.php">Logout</a>
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
    <script type="text/javascript" src="../js/web/index.js"></script>
  </div>
</body>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="..///translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>


  <?php
  }

}else{
$ntstt="Ny";
$mdstt="Md";
$all_flnm=$_SESSION['seveeen_tis_usrnm'];
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
  <script src="../js/chart/Chart.bundle.js"></script>
  <script src="../js/chart/utils.js"></script>
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
  <style>
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
  </style>
  <script src="../js/chart/Chart.bundle.js"></script>
  <script src="../js/chart/utils.js"></script>
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
          <h5 style="text-transform: uppercase;"><center><i class="fa fa-table"> <u>Inspection statistics</u> </i><button type="button" class="btn btn-primary btn-sm pull-right" onclick="demoFromHTML()"><i class="fa fa-download"></i> Export</button></center>
          </h5></div> <!-- <div id="yearInfoHeader">
            Academic Year<span id="acYear"></span>&nbsp;&nbsp;&nbsp;
            Trimester<span id="trimester"></span>
          </div> -->
          <div class="form-group">
            Filter by Period
            <select class="form-control" id="selPeriod">Select Period</select>
          </div>
          <div id="invalidResponse"></div>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                    <td colspan="2">
<!--
                      <h1>hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</h1>


======================================================================chart

-->
<!-- <canvas id="canvas_cls_avg"></canvas> -->
<?php
$sl_ct_clsa=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$all_id' order by class_name asc")or die(mysql_error());
$sl_ct_clsb=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$all_id' order by class_name asc")or die(mysql_error());

?>
  <script>
function ChrtClsAvg(){
   var config = {
      type: 'line',
      data: {
        labels: [<?php
        while ($ft_data=mysql_fetch_assoc($sl_ct_clsa))
            echo '"'.$ft_data['class_name'].'",';
                                $i=0;
                      while ($ft_thrr=mysql_fetch_assoc($sl_ct_clsa)) {
                        $tch_iiid[$i]=$ft_thrr['class_id'];
                        $i++;
                      }
        ?>],
        datasets: [{
          label: 'Class Average',
          fill: false,
          borderColor: window.chartColors.red,
          backgroundColor: window.chartColors.red,
          data: [<?php
        while ($ft_dataaa=mysql_fetch_assoc($sl_ct_clsb)){
          $cls=$ft_dataaa['class_id'];
          $se_ct_tskmks=mysql_query("SELECT AVG(tis_task_marks.task_marks_marks*100/tis_task_marks.task_marks_overall) FROM tis_task_marks INNER JOIN tis_tasks ON tis_task_marks.task_marks_task=tis_tasks.task_id WHERE tis_task_marks.task_marks_class='$cls' AND tis_task_marks.task_marks_xkul='$all_id' AND tis_tasks.task_status='Md'")or die(mysql_error());
          $ft_se_ct_tskmks=mysql_fetch_assoc($se_ct_tskmks);
        echo (number_format(floatval(array_sum($ft_se_ct_tskmks)), 1)).',';
        }
        ?>]
        },]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Class Marks Average'
        },
        scales: {
          xAxes: [{
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: false
          }]
        }
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('canvas_cls_avg').getContext('2d');
      window.myLine = new Chart(ctx, config);
    };
}
//ChrtClsAvg();
  </script>
<!-- ============================================================================================================================== -->
<div id="evaluationResult">
<canvas id="canvas_tcr_ev"></canvas>
</div>
<?php
$sel_crt_tchr=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'")or die(mysql_error());
?>
  <script>
  //  ChrtTchrEvl();
function ChrtTchrEvl(){
   var config = {
      type: 'line',
      data: {
        labels: [<?php
        //  $selQy01="SELECT AVG(st_t_mark_$i) AS FROM tis_st_t_evaluation WHERE st_t_xkul='$all_id'";
        $selQy=mysql_query("SELECT tis_teachers.*,LEFT(tis_st_t_evaluation.st_t_period,6) AS period,AVG(tis_st_t_evaluation.st_t_mark_1) AS ability,AVG(tis_st_t_evaluation.st_t_mark_2) AS availability,AVG(tis_st_t_evaluation.st_t_mark_3) AS model,AVG(tis_st_t_evaluation.st_t_mark_4) AS assignments,AVG(tis_st_t_evaluation.st_t_mark_5) AS personality FROM tis_teachers LEFT JOIN tis_st_t_evaluation ON tis_st_t_evaluation.st_t_teacher=tis_teachers.teacher_id WHERE tis_teachers.teacher_school='5' GROUP BY tis_st_t_evaluation.st_t_teacher,LEFT(tis_st_t_evaluation.st_t_period,6) ");

while ($ft_sel_crt_tchr=mysql_fetch_assoc($selQy)) {
  $tchr_t_id=$ft_sel_crt_tchr['teacher_id'];
  echo '"'.$ft_sel_crt_tchr['teacher_fullname'].'",';
}
          ?>],
        datasets: [<?php
        $selQy01="SELECT AVG(st_t_mark_$i) AS FROM tis_st_t_evaluation WHERE st_t_xkul='$all_id'";
        $selQy="SELECT tis_teachers.*,LEFT(tis_st_t_evaluation.st_t_period,6) AS period,AVG(tis_st_t_evaluation.st_t_mark_1) AS ability,AVG(tis_st_t_evaluation.st_t_mark_2) AS availability,AVG(tis_st_t_evaluation.st_t_mark_3) AS model,AVG(tis_st_t_evaluation.st_t_mark_4) AS assignments,AVG(tis_st_t_evaluation.st_t_mark_5) AS personality FROM tis_teachers LEFT JOIN tis_st_t_evaluation ON tis_st_t_evaluation.st_t_teacher=tis_teachers.teacher_id WHERE tis_teachers.teacher_school='5' GROUP BY tis_st_t_evaluation.st_t_teacher,LEFT(tis_st_t_evaluation.st_t_period,6) ";

          $sel_ev_tchr=mysql_query($selQy)or die(mysql_error());
$ability=array();$model=array();
            while ($ft_sel_ev_tchr=$ft_sel_ev_tchr=mysql_fetch_assoc($sel_ev_tchr)) {
              $ability[$i][]= ($ft_sel_ev_tchr['ability']==null?0:$ft_sel_ev_tchr['ability']);
              $model[]= ($ft_sel_ev_tchr['model']==null?0:$ft_sel_ev_tchr['model']);
              $availability[]= ($ft_sel_ev_tchr['availability']==null?0:$ft_sel_ev_tchr['availability']);
              $assignments[]= ($ft_sel_ev_tchr['assignments']==null?0:$ft_sel_ev_tchr['assignments']);
              $personality[]= ($ft_sel_ev_tchr['personality']==null?0:$ft_sel_ev_tchr['personality']);
            };

          echo "{";
          echo "label: 'Ability',";
          echo "fill: false,";
          echo "borderColor: 'red',";
          echo "backgroundColor: 'red',";
          $cnt_sel_ev_tchr=mysql_num_rows($sel_ev_tchr);
          if ($cnt_sel_ev_tchr==0) {
            echo "data: [0,0,0,0,0]";
          }else{
            ?>
            //data: [
            <?php 
            echo "data:".json_encode($ability[0]);
          }
          //echo "data: [4,2,5,3]";
          echo "},";
          echo "{";
          echo "label: 'Model',";
          echo "fill: false,";
          echo "borderColor: 'blue',";
          echo "backgroundColor: 'blue',";
          $cnt_sel_ev_tchr=mysql_num_rows($sel_ev_tchr);
          if ($cnt_sel_ev_tchr==0) {
            echo "data: [0,0,0,0,0]";
          }else{
            ?>
            //data: [
            <?php 
            echo "data:".json_encode($model);
          }
          //echo "data: [4,2,5,3]";
          echo "},";
          echo "{";
          echo "label: 'Availability',";
          echo "fill: false,";
          echo "borderColor: 'yellow',";
          echo "backgroundColor: 'yellow',";
          $cnt_sel_ev_tchr=mysql_num_rows($sel_ev_tchr);
          if ($cnt_sel_ev_tchr==0) {
            echo "data: [0,0,0,0,0]";
          }else{
            ?>
            //data: [
            <?php 
            echo "data:".json_encode($availability);
          }
          //echo "data: [4,2,5,3]";
          echo "},";
          echo "{";
          echo "label: 'Assignments',";
          echo "fill: false,";
          echo "borderColor: 'pink',";
          echo "backgroundColor: 'pink',";
          $cnt_sel_ev_tchr=mysql_num_rows($sel_ev_tchr);
          if ($cnt_sel_ev_tchr==0) {
            echo "data: [0,0,0,0,0]";
          }else{
            ?>
            //data: [
            <?php 
            echo "data:".json_encode($assignments);
          }
          //echo "data: [4,2,5,3]";
          echo "},";
          echo "{";
          echo "label: 'Personality',";
          echo "fill: false,";
          echo "borderColor: 'green',";
          echo "backgroundColor: 'green',";
          $cnt_sel_ev_tchr=mysql_num_rows($sel_ev_tchr);
          if ($cnt_sel_ev_tchr==0) {
            echo "data: [0,0,0,0,0]";
          }else{
            ?>
            //data: [
            <?php 
            echo "data:".json_encode($personality);
          }
          //echo "data: [4,2,5,3]";
          echo "}";
       // }
          ?>],
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Teachers Evaluation Performance'
        },

        scales: {
          xAxes: [{
            ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: true
          }]
        }
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('canvas_tcr_ev').getContext('2d');
      window.myLine = new Chart(ctx, config);
    };
}
//ChrtTchrEvl();
  </script>
                    </td>  
                </tr>
              </tbody>
            </table>
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
  <script src="../js/chart/Chart.bundle.js"></script>
  <script src="../js/chart/utils.js"></script>
    <script type="text/javascript" src="../Scripts/jqdepend.js"></script>
    <script type="text/javascript" src="../Scripts/jspdf.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
  </div>
</body>
  <script type="text/javascript">
    loadAvailablePeriodFilter();//for filtering by period
      loadEvaluation('setContent',null);
      function demoFromHTML() {
    var pdf = new jsPDF('landscape');
      $("#sidenavToggler").click();
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = document.getElementById('canvas_tcr_ev').toDataURL();
    pdf.addImage(source, 'PNG', 10, 40);
    pdf.text(10, 15, "Tutor Inspection System");
    pdf.text(10,23,$("#fullname").html())
    pdf.text(50,32," Teacher Evaluation statistics Period   "+$("#selPeriod").val());
    pdf.text(180,200," downloaded on "+getDate()+" at "+getTime());
    pdf.save($("#fullname").html()+' Teacher Evaluation statistics.pdf');
      $("#sidenavToggler").click();
}

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
$("#selPeriod").change(function(){
  if($(this).val()!=='default'){
  loadEvaluation('setContent',$(this).val());
}
});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php

}}
}
?>