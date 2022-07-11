<?php
session_start();
require("libs/parts/didier_igihozo.php");
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
  window.location="libs/parts/logout.php";
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
  <title>Dashboard | Tutor Inspection System</title>
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="css/bootstrap/css/glyphicon.css" rel="stylesheet">
<link href="css/web/index.css" rel="stylesheet">
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
  <script type="text/javascript" src="js/chart.js"></script>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d9f98f1fbec0f2fe3b927a8/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                    <td colspan="2">
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
<div style="position: absolute; width: 100%;height: 400px">
    <canvas id="myChart" style="width: 100%;height: 98%;position: relative;flex-flow: allss;"></canvas>
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
          $sel_tsk_cnt_tchr=mysql_query("SELECT * FROM tis_students WHERE student_xkul='$tch_id' AND LEFT(tis_students.student_date,4)='".date("Y")."'")or die(mysql_error());
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
require("libs/parts/footer.php");
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="css/bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/web/index.js"></script>
    <!-- <script type="text/javascript" src="Scripts/jqdepend.js"></script> -->
  </div>
</body>
  <script type="text/javascript">   
 //load new Issues and its issues Chat
 loadNewIssuesChat();

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Dashboard | Tutor Inspection System</title>
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="css/bootstrap/css/glyphicon.css" rel="stylesheet">
<link href="css/web/index.css" rel="stylesheet">
<!-- FOR TEWACHERS' TESKS PERFORMANCE CHART -->
    <script src="js/chart/Chart.bundle.js"></script>
    <script src="js/chart/utils.js"></script>
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
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        margin-top: -40px;
        font-weight: bolder;
    }
</style>
  <script type="text/javascript" src="js/chart.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000">
  <!-- Navigation-->
  <?php include_once"menus/sheader.php";?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
      <div class="card mb-3" style="margin-top: -20px">
        <div class="card-header">
          <h6 style="text-transform: uppercase;height: 20px"><center><i class="fa fa-table"> <u>Inspection statistics</u> </i>
            <button type="button" class="btn btn-primary btn-sm pull-right" id="btnPrintTask" onclick="demoFromHTML()"><i class='fa fa-download'></i>Export</button></center></h6></div>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td colspan="2" >
                    <?php
                    $stt_e="E";
                    $stt_nw="Nw";
@$sel_tsk_tch = mysql_query("SELECT tis_teachers.*,tis_count_teacher_tasks.* FROM tis_teachers, tis_count_teacher_tasks WHERE tis_count_teacher_tasks.count_task_teacher=tis_teachers.teacher_id AND tis_teachers.teacher_school=$all_id AND (tis_teachers.teacher_status='$stt_e' OR tis_teachers.teacher_status='$stt_nw') AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' ORDER BY tis_count_teacher_tasks.count_tt_count DESC,tis_teachers.teacher_fullname ASC")or die(mysql_error());
@$sel_t_cnt_sk_tch = mysql_query("SELECT tis_teachers.*,tis_count_teacher_tasks.* FROM tis_teachers, tis_count_teacher_tasks WHERE tis_count_teacher_tasks.count_task_teacher=tis_teachers.teacher_id AND tis_teachers.teacher_school=$all_id AND (tis_teachers.teacher_status='$stt_e' OR tis_teachers.teacher_status='$stt_nw') AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' ORDER BY tis_count_teacher_tasks.count_tt_count DESC,tis_teachers.teacher_fullname ASC")or die(mysql_error());
@$cl_bg_t_sk_tch = mysql_query("SELECT tis_teachers.*,tis_count_teacher_tasks.* FROM tis_teachers, tis_count_teacher_tasks WHERE tis_count_teacher_tasks.count_task_teacher=tis_teachers.teacher_id AND tis_teachers.teacher_school=$all_id AND (tis_teachers.teacher_status='$stt_e' OR tis_teachers.teacher_status='$stt_nw') AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' ORDER BY tis_count_teacher_tasks.count_tt_count DESC,tis_teachers.teacher_fullname ASC")or die(mysql_error());

@$cl_brd_t_sk_tch = mysql_query("SELECT tis_teachers.*,tis_count_teacher_tasks.* FROM tis_teachers, tis_count_teacher_tasks WHERE tis_count_teacher_tasks.count_task_teacher=tis_teachers.teacher_id AND tis_teachers.teacher_school=$all_id AND (tis_teachers.teacher_status='$stt_e' OR tis_teachers.teacher_status='$stt_nw') AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' ORDER BY tis_count_teacher_tasks.count_tt_count DESC,tis_teachers.teacher_fullname ASC")or die(mysql_error());

$cncnt=mysql_num_rows($sel_tsk_tch);
//echo $cncnt;
//$sel_tsk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'  AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname DESC")or die(mysql_error());
//$sel_t_cnt_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'  AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname DESC")or die(mysql_error());
//$cl_bg_t_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'  AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname DESC")or die(mysql_error());
//$cl_brd_t_sk_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'  AND (teacher_status='$stt_e' OR teacher_status='$stt_nw') ORDER BY teacher_fullname DESC")or die(mysql_error());

$sel_schl_gra=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
//$sel_schl_grb=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
//$sel_schl_grc=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
//$sel_schl_grd=mysql_query("SELECT * FROM tis_schools WHERE school_status='$stt_e'")or die(mysql_error());
                    $cnt_sel_tsk_tch=mysql_num_rows($sel_tsk_tch);
                    if ($cnt_sel_tsk_tch>0) {

                      ?>

<!-- TEACHERS' TASKS PERFORMANCE CHART -->
    <div style="width:100%;">
        <canvas style="width:100%;font-weight: bolder;" id="myCharts"></canvas>
    </div>


<script type="text/javascript">
    var lineChartData = {
        labels: [<?php
          $tch_nbr = 1;
        while ($ft_data=mysql_fetch_assoc($sel_tsk_tch)){
            echo '"'.$ft_data['teacher_fullname'].'    ( '.$tch_nbr.' )",';
                                $i=0;
                      while ($ft_thrr=mysql_fetch_assoc($sel_schl_gra)) {
                        $tch_iiid[$i]=$ft_thrr['school_id'];
                        $i++;
                      }
                      $tch_nbr++;
                    }
                      
        ?>],
        datasets: [{
            label: "Total",
            borderColor: window.chartColors.blue,
            backgroundColor: window.chartColors.blue,
            fill: false,
            data: [
                    <?php
                      while ($ft_dataaa=mysql_fetch_assoc($sel_t_cnt_sk_tch)){
                        $tch_id=$ft_dataaa['teacher_id'];
                        $sl_cnt_tst_ct=mysql_query("SELECT count_tt_count FROM tis_count_teacher_tasks WHERE count_task_teacher='$tch_id' AND count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' AND count_task_xkul='$all_id'")or die(mysql_error());
                        $ft_sl_cnt_tst_ct=mysql_fetch_assoc($sl_cnt_tst_ct);
                        if ($ft_sl_cnt_tst_ct['count_tt_count']) {
                          echo $ft_sl_cnt_tst_ct['count_tt_count'].',';
                        }else{
                          echo 0 .',';
                        }
                         }
                    ?>
            ],
            //yAxisID: "y-axis-1"
        },{
            label: "Marked",
            borderColor: window.chartColors.green,
            backgroundColor: window.chartColors.green,
            fill: false,
            data: [
                    <?php
                      while ($ft_dataaa=mysql_fetch_assoc($cl_bg_t_sk_tch)){
                        $tch_id=$ft_dataaa['teacher_id'];
                        $sl_cnt_tst_ct=mysql_query("SELECT count_tt_marked FROM tis_count_teacher_tasks WHERE count_task_teacher='$tch_id' AND count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' AND count_task_xkul='$all_id'")or die(mysql_error());
                        $ft_sl_cnt_tst_ct=mysql_fetch_assoc($sl_cnt_tst_ct);
                        if ($ft_sl_cnt_tst_ct['count_tt_marked']) {
                          echo $ft_sl_cnt_tst_ct['count_tt_marked'].',';
                        }else{
                          echo 0 .',';
                         }
                        }
                    ?>
            ],
            //yAxisID: "y-axis-1",
        },
       {
            label: "Not Yet",
            borderColor: window.chartColors.red,
            backgroundColor: window.chartColors.red,
            fill: false,
            data: [
                    <?php
                      while ($ft_dataaa=mysql_fetch_assoc($cl_brd_t_sk_tch)){
                        $tch_id=$ft_dataaa['teacher_id'];
                        $sl_cnt_tst_ct=mysql_query("SELECT count_tt_count,count_tt_marked FROM tis_count_teacher_tasks WHERE count_task_teacher='$tch_id' AND count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop' AND count_task_xkul='$all_id'")or die(mysql_error());
                        $ft_sl_cnt_tst_ct=mysql_fetch_assoc($sl_cnt_tst_ct);
                          echo $ft_sl_cnt_tst_ct['count_tt_count']-$ft_sl_cnt_tst_ct['count_tt_marked'].',';
                         }
                    ?>
            ],
            //yAxisID: "y-axis-2"
        }
        ]
    };

    window.onload = function() {
        var ctx = document.getElementById("myCharts").getContext("2d");
        window.myLine = Chart.Line(ctx, {
            data: lineChartData,
            options: {
                responsive: true,
                hoverMode: 'index',
                stacked: false,
                title:{
                    display: true,
                    text:'Teachers\' Tasks',
                },
                // scales: {
                //     yAxes: [{
                //         type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                //         display: true,
                //         position: "left",
                //         id: "y-axis-1",
                //         ticks: {
                //             autoSkip: false
                //         }
                //     }, {
                //         type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                //         display: true,
                //         position: "right",
                //         id: "y-axis-2",

                //         // grid line settings
                //         gridLines: {
                //             drawOnChartArea: true, // only want the grid lines for one axis to show up
                //         },
                //     }],
                // }
                scales: {
    xAxes: [{
        stacked: false,
        beginAtZero: true,
        scaleLabel: {
            labelString: 'Teacher'
        },
        ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false
        }
    }]
}
            }
        });
    };
</script>






                      <?php
                    }

                    ?>
                  </td>    </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
require("libs/parts/footer.php");
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
  <script src="js/push.js-master/bin/push.js" type="text/javascript"></script>
  <script src="BSHelper/vendor/popper/popper.min.js"></script>
      <script src="BSHelper/vendor/jquery/jquery.min.js"></script>
     <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="BSHelper/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="BSHelper/vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="BSHelper/js/make-charts.js"></script>


  <script src="BSHelper/vendor/popper/popper.min.js"></script>
      <script src="BSHelper/vendor/jquery/jquery.min.js"></script>
     <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="BSHelper/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="BSHelper/vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="BSHelper/js/make-charts.js"></script>

    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="css/bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="Scripts/jqdepend.js"></script>
    <script type="text/javascript" src="Scripts/jspdf.js"></script>
    <script type="text/javascript" src="js/web/index.js"></script>
  </div>
</body>
  <script type="text/javascript">

      //load statisticgraph
    loadTaskAnalysis('setContent');
    function demoFromHTML() {
      $("#sidenavToggler").click();
    var pdf = new jsPDF('landscape');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = document.getElementById('myCharts').toDataURL();
    pdf.addImage(source, 'PNG', 10, 40);
    pdf.text(10, 15, "Tutor Inspection System");
    pdf.text(10,23,$("#fullname").html())
    pdf.text(50,32," Tasks given statistics ");
    pdf.text(180,200," downloaded on "+getDate()+" at "+getTime());
    pdf.save($("#fullname").html()+' tasks statistics.pdf');
      $("#sidenavToggler").click();
}
    //load new issues
    loadNewIssuesChat();
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php

}}
}

// $sel_teachers=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'")or die(mysql_error());
// while ($ft_sel_teachers=mysql_fetch_assoc($sel_teachers)) {
//   $tea_id=$ft_sel_teachers['teacher_id'];

// $sel_tsk_md=mysql_query("SELECT * FROM tis_tasks WHERE task_status='Md' AND task_teacher='$tea_id' AND task_date BETWEEN '2019-04-22' AND '2019-07-19' AND task_xkul='$all_id'")or die(mysql_error());
// $sel_tsk_ny=mysql_query("SELECT * FROM tis_tasks WHERE task_status='Ny' AND task_teacher='$tea_id' AND task_date BETWEEN '2019-04-22' AND '2019-07-19' AND task_xkul='$all_id'")or die(mysql_error());
// $sel_tsk_tt=mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tea_id' AND task_date BETWEEN '2019-04-22' AND '2019-07-19' AND task_xkul='$all_id'")or die(mysql_error());
// $ft_sel_tsk_md = mysql_num_rows($sel_tsk_md);
// $ft_sel_tsk_ny = mysql_num_rows($sel_tsk_ny);
// $ft_sel_tsk_tt = mysql_num_rows($sel_tsk_tt);
// echo $tea_id." || Marked: ".$ft_sel_tsk_md."- Not yet: ".$ft_sel_tsk_ny."- Total: ".$ft_sel_tsk_tt."<br>";
// $ins_count_tsk=mysql_query("INSERT INTO tis_count_teacher_tasks VALUES('','$tea_id','$ft_sel_tsk_tt','$ft_sel_tsk_md','$reg_date','$all_id')")or die(mysql_error());
// if ($ins_count_tsk) {
//   echo"<script>alert('Data Inserted Successful');</script>";
// }else{
//    echo"<script>alert('Data Not Inserted ....');</script>";
// }
// }

















?>