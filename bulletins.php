<?php
session_start();
require("libs/parts/didier_igihozo.php");
require("Classes/Archives.php");
$arch=new Archives(); 
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
        <li class="breadcrumb-item active">Sample Bulletins</li>
      </ol> <?php
              echo "<select class='form-control' id='selclassdash' onchange='loadStudentReport()'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='".$_SESSION['seveeen_tis_usr_id']."' AND LEFT(clasS_date,4)='".date("Y")."' order by class_name asc");
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
      <div class="row" style="border:3px solid black;margin-right:1%;margin-left:1%;padding-bottom: 60px;width: 1000px;">
        <div class="row-header" style="margin-left: 0.5%;height: 200px;">
          <div class="row-header-left pull-left" style="font-weight: bold;font-size: 15px;margin-top: 10px;margin-left: 10px;">
            REPUBLIC OF RWANDA<br>
            MINISTRY OF EDUCATION<br>
            <div id="schoolNameTitle">Groupe Scolaire Remera</div><br>
            Phone:
            <span id="schoolPhoneTitle">0788744817</span><br>
            E-mail:
            <span id="schoolEmailTitle">gsremera@gmail.com</span><br>
          </div>
        </div>
        <h4 style="margin-top: 150px;margin-left: 150px;">PROGRESSIVE REPORT (Sample) </h4><hr>
        <div class="row-student" style="margin-right: 2%;font-weight: bold;font-size: 15px;margin-top: 3%">
          Student's Name:<span id="studentName"> MANISHIMWE Eric</span><br>
          <!-- Student's Number:<span id="studentNumber">17</span> --><br>
           Class:<span id="studentClass">S6 MCB</span><br>
          School year:<span id="acYear">2019</span><br>
        </div>
        <table class="table table-bordered" id="tblArchive" style="width: 100%">
          <thead>
            <tr>
              <th rowspan="2">Subject</th>
              <th colspan="3">Maxpoints</th>
              <th colspan="3" id="termTitle">1<sup>st</sup> Term </th><!-- 
              <th colspan="3">2<sup>nd</sup> Term </th>
              <th colspan="3">3<sup>rd</sup> Term </th> -->
              <!-- <th colspan="3">Annual Points </th> -->
            </tr><!-- 
            <tr>
              <th colspan="3">O.P </th>
              <th colspan="3">O.P </th>
              <th colspan="3">O.P </th>
              <th colspan="2">Tot </th>
              <th rowspan="2">% </th>
            </tr> -->
            <tr>
              <th>TEST</th>
              <th>EX </th>
              <th>TOT </th>

              <th>TEST</th>
              <th>EX </th>
              <th>TOT </th>

              <!-- <th>TEST</th>
              <th>EX </th>
              <th>TOT </th>

              <th>TEST</th>
              <th>EX </th>
              <th>TOT </th> -->

             <!--  <th>MAX</th>
              <th>O.P </th> -->
            </tr>
            <tr>
              <th>Behaviour</th>
              <th colspan="3">40</th>
              <td colspan="3">28</td>
             <!--  <th colspan="3">23 </th>
              <th colspan="3">30 </th>
              <th colspan="3">35 </th>
              <th>120 </th>
              <th>101</th>
              <th>81.3% </th> -->
            </tr>
          </thead>
          <tbody id="loadedBulletin">

            <tr>
              <th>English</th>
              <th>20</th>
              <th>20</th>
              <th>40 </th>

              <td>12</td>
              <td>16 </td>
              <td>25 </td>
<!-- 
              <td>8</td>
              <td>13</td>
              <td>21 </td>

              <td>16</td>
              <td>14</td>
              <td>30 </td>

              <td>120</td>
              <td>76</td>
              <td>68.3% </td> -->
            </tr>
            
          </tbody>
          <tfoot>
            <tr>
              <th>Total</th>
              <th>360</th>
              <th>360</th>
              <th>720 </th>

              <!-- <td>216</td>
              <td>290 </td>
              <td>506 </td>

              <td>220</td>
              <td>190</td>
              <td>410 </td>

              <td>197</td>
              <td>219</td>
              <td>416 </td>

              <td>2160</td>
              <td>1332</td>
              <td>59.3% </td> -->
            </tr>
            <tr>
              <th >%</th>
              <th colspan="6">64%</th>
              <!-- <th colspan="3">62.8%</th>
              <th colspan="3">61.3%</th>
              <th colspan="3">63.1%</th> -->
            </tr>
          <tr>
              <th >Position</th>
              <th colspan="6">30/44</th>
              <!-- <th colspan="3">19/44</th>
              <th colspan="3">21/44</th>
              <th colspan="3">24/44</th> -->
            </tr>
          <tr>
              <th rowspan="2">Teacher's Signature</th>
              <th rowspan="2" colspan="6"></th>
             <!--  <th rowspan="2" colspan="3"></th>
              <th rowspan="2" colspan="3"></th>
              <th rowspan="2" colspan="3"></th> -->
            </tr><tr></tr>
          <tr>
              <th rowspan="2">Parent's Signature</th>
              <th rowspan="2" colspan="6"></th>
             <!--  <th rowspan="2" colspan="3"></th>
              <th rowspan="2" colspan="3"></th>
              <th rowspan="2" colspan="3"></th> -->
            </tr><tr></tr>
          </tfoot>
        </table>
        <div class="row-header-footer">
          <h5 style="margin-left: 100px;display: none">VERDICT OF THE JURY</h5>
          <div class="formJury" style="margin-left: 150px;display: none;">
            <label>Promoted</label>
            <input type="checkbox" name="checkjury" value="promoted"><br>
            <label>Advised Repeat</label>
            <input type="checkbox" name="checkjury" value="advisedrepeat"><br>
            <label>Discontinued</label>
            <input type="checkbox" name="checkjury" value="discontinued"><br>
            <label>Proposed to resit</label>
            <input type="checkbox" name="checkjury" value="resit">
          </div>
          <div class="masterValidation" style="margin-left:550px;margin-top:20px;">
            <p>Done on <span id="bulletinPrintDate"></span></p><br>
            <p>Headmaster(Stamp and Signature)</p>
          </div>
        </div><br><br><br>
        </div>
       <div id="archivePanel"></div><br><br><br>
      </div><!--end employeeviewform-->

  <!--Logout-->
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
            <a class="btn btn-primary" href="<?php echo $indexPath.'libs/parts/logout.php';?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/web/index.js"></script>
    <script src="Scripts/jqdepend.js"></script>
  </div>
</body>
</html>
<script type="text/javascript">
    loadStudentReport();
</script>