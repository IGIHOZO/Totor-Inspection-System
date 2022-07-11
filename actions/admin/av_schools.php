<?php
session_start();
require("../../libs/parts/didier_igihozo.php");
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
if (@!$_SESSION['seveeen_tis_seveeen_admin_name']) {
?>
<script type="text/javascript">
  window.location="../../login.php";
</script>
<?php
}else{
@$usr_id=$_SESSION['seveeen_tis_seveeen_admin_id'];
$all_flnm=$_SESSION['seveeen_tis_seveeen_admin_name'];
$dc_all_flnm=seveeen_my_fl_nm_enc($all_flnm);
$ntstt="Ny";
$mdstt="Md";
$se_all_id=mysql_query("SELECT * FROM tis_seveeen_ltd WHERE seveeen_ltd_id='$usr_id' AND seveeen_ltd_name='$dc_all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['seveeen_ltd_id'];

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Register School -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Available Schools | Tutor Inspection System</title>
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
  <link rel="shortcut icon" href="../../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link href="../../css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="position: absolute;">
    <a class="navbar-brand" href="../../index.php">Tutor Inspection System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../../index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text"> Home</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class="nav-link-text"> Panel </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess">
            <li>
              <a href="../../actions/admin/add_school.php">Register School</a>
            </li>
            <li>
              <a  href="../../actions/admin/av_schools.php">Available Schools</a>
            </li>
            <li>
              <a  href="../../actions/admin/user_comments.php">Comments</a>
            </li>
            <li>
              <a  href="../../actions/admin/user_messages.php">Messages</a>
            </li>
          </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess2" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text"> My acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess2">
            <li>
              <a  href="#">My logs</a>
            </li>
            <li>
              <a  href="#">Other logs</a>
            </li>
            <li>
              <a  href="#">Change password</a>
            </li>
          </ul>
        </li>
      </ul>



      <ul class="navbar-nav ml-auto">


        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <?php
              echo"<span id='fullname' style='text-decoration:none'>".$_SESSION['seveeen_tis_seveeen_admin_name']."</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
              ?>
<div class= 'langue' id="google_translate_element" style="float:right"></div>
            </div>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Schools</a>
        </li>
        <li class="breadcrumb-item active">Registration date
<li><span class="form-inline my-2 my-lg-0 mr-lg-2" id="dte_grp"><div class="input-group"><label for="lblefrom"><b>&nbsp;Choose Day: &nbsp </b></label><input type="text" name="lblefrom" id="lblefrom" class="form-control" placeholder="Month / Day / Year"><button class="btn btn-primary" id="tke_btn" onclick="return gnTskDatPckr()"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Take...</button></div></div></li>
        </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Available Schools</div>
        <div class="card-body">
          <div class="table-responsive">
<div id="bbdtsktbbl">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Church</th>
                  <th>Brought by:</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Church</th>
                  <th>Brought by:</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
<?php
$sel_xkl_av=mysql_query("SELECT * FROM tis_schools");
if (mysql_num_rows($sel_xkl_av)>0) {
  $cnt=1;
  while ($ft_sel_xkl_av=mysql_fetch_assoc($sel_xkl_av)) {
    echo "<tr>";
    echo "<td>".$cnt.". </td>";
    echo "<td>".ucwords($ft_sel_xkl_av['school_full_name'])."</td>";
    echo "<td>".$ft_sel_xkl_av['school_category']."</td>";
    //----Church-based
    switch ($ft_sel_xkl_av['church_based']) {
      case 'CAT':
        echo "<td>Catholic</td>";
        break;
      case 'ADV':
        echo "<td>Adventists</td>";
        break;
      case 'ANG':
        echo "<td>Anglicans</td>";
        break;
      case 'BAP':
        echo "<td>Baptists</td>";
        break;
      case 'ISL':
        echo "<td>Islamic</td>";
        break;
      default:
        echo "<td><center>-</center></td>";
        break;
    }
    //----Church-based
    switch ($ft_sel_xkl_av['school_brt_by']) {
      case 'SVN':
        echo "<td>Seveeen Ltd</td>";
        break;
      case 'BFG':
        echo "<td>BFG Ltd</td>";
        break;
      default:
        echo "<td><span style='font-weight:bolder;'># </span>".$ft_sel_xkl_av['school_brt_by']."</td>";
        break;
    }
echo "<td>".$ft_sel_xkl_av['school_date']."</td>";
    echo "</tr>";
    $cnt++;
  }
}
?>
              </tbody>
            </table>
  </div>
         </div>
        </div>
<?php 
//------------------------------------------------------Total Schools
$sel_llst=mysql_query("SELECT * FROM tis_schools");
$cnt_sel_llst=mysql_num_rows($sel_llst);
if ($cnt_sel_llst>=1) {
?>
<div class="card-footer small text-muted"><?php echo"<span id='tl_tsk'>".$cnt_sel_llst ."</span> Available total Schools."?> </div>
<?php
}
?>
      </div>
          </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../../libs/parts/footer.php");
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
            <a class="btn btn-primary" href="../../libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/popper/popper.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.min.js"></script>
    <script src="../../js/web/index.js"></script>
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