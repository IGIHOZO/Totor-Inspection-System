<?php
session_start();
require("../didier_igihozo.php");
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
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Panel-LOGS -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Panel-LOGS | Tutor Inspection System</title>
  <link rel="shortcut icon" href="../../../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <link href="../../../css/web/register_class.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../../../css/sb-admin.css" rel="stylesheet">
  <link href="../../../css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="position: absolute;">
    <?php
    $works=dt_enc("workss");
    $tests=dt_enc("testss");
    $quizes=dt_enc("quizess");
    $exams=dt_enc("examss");
    ?>
    <a class="navbar-brand" href="../../../index.php">Tutor Inspection System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../../../index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text"> Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registration">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-book"></i>
            <?php
            if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
              echo "<span class='nav-link-text'> Actions-class task </span>";
            }else{echo "<span class='nav-link-text'> Registrations </span>";}
            ?>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
<?php
    if (isset($_SESSION['seveeen_tis_teacher_nm'])){

          }else{
          ?>
            <li>
              <a href="../../../reg/reg_class.php"> Class</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../../../reg/reg_course.php"> Course</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../../../reg/reg_teacher.php"> Teacher</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../../../reg/reg_orient_teacher.php">Orient Teachers</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../../../reg/reg_orient_student.php">Orient New Students</a>
            </li>
          <?php
          }
         if (isset($_SESSION['seveeen_tis_teacher_nm'])){
?>            
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMultiw2">Works</a>
              <ul class="sidenav-third-level collapse" id="collapseMultiw2">
                <li>
                  <a href="../../../actions/set.php?reid=<?php echo $works;?>">Set</a>
                </li>
                <li>
                  <a href="../../../actions/view.php?reid=<?php echo $works;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2q">Quizes</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2q">
                <li>
                  <a href="../../../actions/set.php?reid=<?php echo $quizes;?>">Set</a>
                </li>
                <li>
                  <a href="../../../actions/view.php?reid=<?php echo $quizes;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2tt">Tests ( CAT )</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2tt">
                <li>
                  <a href="../../../actions/set.php?reid=<?php echo $tests;?>">Set</a>
                </li>
                <li>
                  <a href="../../../actions/view.php?reid=<?php echo $tests;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2ee">Exams</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2ee">
                <li>
                  <a href="../../../actions/set.php?reid=<?php echo $exams;?>">Set</a>
                </li>
                <li>
                  <a href="../../../actions/view.php?reid=<?php echo $exams;?>">View</a>
                </li>
              </ul>
            </li>


  
          <li>
<?php
$works=dt_enc("workss");
$tests=dt_enc("testss");
$quizes=dt_enc("quizess");
$exams=dt_enc("examss");
?>

<?php
          }else{

          }
          ?>
          </ul>
        </li>
        <?php
        if (isset($_SESSION['seveeen_tis_teacher_nm'])){
          }else{
            ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report" id="frNnSbnwpr">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesPR" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text"> Reports </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagesPR">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Classes</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <?php
                $sel_cl=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$all_id' AND class_status='E' order by  class_name asc");
                $cnt_sel_cl=mysql_num_rows($sel_cl);
                if ($cnt_sel_cl>0) {
                  while ($ft_sel_cl=mysql_fetch_assoc($sel_cl)) {
                    $clnnm=$ft_sel_cl['class_name'];
                    $cl_iid=$ft_sel_cl['class_id'];
                    $go_cl_id=dt_enc($cl_iid+2018);
                    echo "<li><a href='rep/classes.php?reeiidd=$go_cl_id' target='_blank' style='color: #b2a110;font-size:15px'>".$clnnm."</a></li>";
                  }
                }else{
                  echo "<li><a href='# id='no_cl' style='color: #eee350'>No Class available in this school</a></li>";
                }
                ?>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3">Teacher</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti3">
                <?php
                $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id' AND teacher_status='E' order by  teacher_fullname asc");
                $cnt_sel_tch=mysql_num_rows($sel_tch);
                if ($cnt_sel_tch>0) {
                  while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                    $tchnnm=$ft_sel_tch['teacher_fullname'];
                    $tch_iddd=$ft_sel_tch['teacher_id'];
                    $go_cl_id=dt_enc($tch_iddd+2018);
                    echo "<li><a href='../rep/teachers.php?reeiidd=$go_cl_id' style='color: #91fb4b;font-size:12px' target='_blank'>".$tchnnm."</a></li>";
                  }
                }else{
                  echo "<li><a href='# id='no_cl' style='color: #eee350'>No Teacher available in this school</a></li>";
                }
                ?>
              </ul>
            </li>
          </ul>
        </li>
            <?php
          }
          if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
          }else{
$go_cl_id=dt_enc(2018);
            ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tasks" id="frNnSbpr">
          <a class="nav-link" href="../../../rep/tasks.php?reeiidd=<?php echo $go_cl_id?>">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Tasks</span>
          </a>
        </li>
            <?php
          }
        if (!isset($_SESSION['seveeen_tis_teacher_nm'])) {
          ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#sndPanel" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class='nav-link-text'> Panel </span>
          </a>
          <ul class="sidenav-second-level collapse" id="sndPanel">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#trdPanel" style="text-decoration: underline;unicode-range: inherit;">Teacher Evaluation</a>
              <ul class="sidenav-third-level collapse" id="trdPanel">
                <?php
                $evcat_st=dt_enc("Student");
                $evcat_xk=dt_enc("School");
                ?>
                   <li>
                    <a href="../../../actions/t_evaluation.php?evcat=<?php echo $evcat_st;?>" style="color: #b2a110;font-size:15px;font-weight: bolder;">By-Student</a>
                  </li>
                   <li>
                    <a href="../../../actions/t_evaluation.php?evcat=<?php echo $evcat_xk;?>" style="color: #b2a110;font-size:15px;font-weight: bolder;">By-School</a>
                  </li>
              </ul>
            </li>
<!--

            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#trdPanel2">Teacher</a>
              <ul class="sidenav-third-level collapse" id="trdPanel2">
                    <li><a href='rep/teachers.php?reeiidd=$go_cl_id' target='_blank'>KKKKKK</a></li>
              </ul>
            </li>

-->
          </ul>
        </li>
          <?php
        }
          if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
          }else{
            ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text"> My Acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti22">My Teachers</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti22">
              <?php
              $sel_my_sub=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$all_id'");
              $cnt_sel_my_sub=mysql_num_rows($sel_my_sub);
              if ($cnt_sel_my_sub>0) {
                while ($ft_sel_my_sub=mysql_fetch_assoc($sel_my_sub)) {
$sub_id=dt_enc($ft_sel_my_sub['teacher_id']+2018);
                  echo "<li><a href='actions/t_documents.php?dcmtchr=$sub_id' target='_blank' class='my_sub_usrs_lst'style='color:#55aaff'>".$ft_sel_my_sub['teacher_fullname']."</a></li>";
                }
              }else{
                echo "<a href='#'>No Teacher Available.</a>";
              }
              ?>
              </ul>
            </li>
            <li>
              <a href="../../../reg/reg_teacher.php">Add Teacher</a>
            </li>
            <li>
              <a href="../../../change_password.php">Change Password</a>
            </li>
          </ul>
        </li>
            <?php
          }
if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
  ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text"> My Acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess">
            <li>
              <a href="../../../actions/t_mydocs.php">My documents</a>
            </li>
            <li>
              <a href="../../../change_password.php">Change Password</a>
            </li>
          </ul>
        </li>
  <?php
    }else{}
        ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Help">
          <a class="nav-link" href="../../../help.php" target="_blank">
            <i class="fa fa-fw fa-support"></i>
            <span class="nav-link-text">Help</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>



      <ul class="navbar-nav ml-auto">


        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <?php
              if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
              echo"<span id='full_sub_name' style='text-decoration:none'>".$_SESSION['seveeen_tis_teacher_nm']."</span>&nbsp&nbsp";
              echo"<span id='full_sub_name' style='text-decoration:none'>|| </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
              }
              if (!isset($_SESSION['seveeen_tis_seveeen_admin_id'])) {
                echo"<span id='fullname' style='text-decoration:none'>".$_SESSION['seveeen_tis_usrnm']."</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
              }else{
                echo"<span id='fullname' style='text-decoration:none'>Administration </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
              }
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Logs Status</a>
        </li>
        <li class="breadcrumb-item active">Log level</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>&nbsp&nbspCounted Logs</div>
        <div class="card-body">
          <div class="table-responsive">
<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th></th>
      <th>Time</th>
      <th>Names</th>
      <th>School</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sel_cont=mysql_query("SELECT * FROM tis_count_loogs ORDER BY log_id DESC");
    $cnt_sel_count=mysql_num_rows($sel_cont);
    if ($cnt_sel_count>0) {
      $ii=1;
      while ($ft_sel_cont=mysql_fetch_assoc($sel_cont)) {
       ?>
<tr>
    <?php
    $usr_tppy=$ft_sel_cont['log_type'];
    $usr_schll=$ft_sel_cont['log_xkul'];
    $usr_id=$ft_sel_cont['log_usr'];
    $usr_log_date=$ft_sel_cont['log_date'];
    $sel_xkkl=mysql_query("SELECT * FROM tis_schools WHERE school_id='$usr_schll'");
    $cnt_sel_xkul=mysql_num_rows($sel_xkkl);
    if ($cnt_sel_xkul==1) {
      $ft_xkl=mysql_fetch_assoc($sel_xkkl);
      $xkl_nm=$ft_xkl['school_full_name'];
    }else{
      $xkl_nm="Not set";
    }
    if ($usr_tppy=='School') {
      $usr_fllnm='#S/ '.$xkl_nm;
    }else{
      $sel_usr=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id='$usr_id' AND teacher_school='$usr_schll'");
      $cnt_sel_usr=mysql_num_rows($sel_usr);
      if ($cnt_sel_usr==1) {
        $ft_sel_usr=mysql_fetch_assoc($sel_usr);
        $usr_fllnm=$ft_sel_usr['teacher_fullname'];
      }else{
        if ($usr_tppy=='School') {
          $usr_fllnm=$xkl_nm;
        }
      }
    }
    ?>
  <td>
    <?php
    echo $ii.'. ';
    ?>
  </td>
  <td>
    <?php
    //echo$usr_log_date ;
    
    $date = strtotime($usr_log_date);

    $hourago = $date - 3600;
    echo date('D, d/m/Y  -  H:i:s', $hourago);
    ?>
  </td>
  <td>
    <?php
    echo $usr_fllnm;
    ?>
  </td>
  <td>
    <?php
    echo $xkl_nm;
    ?>
  </td>
  <td>
    <?php
    echo $usr_tppy;
    ?>
  </td>
</tr>
       <?php
       $ii++;
      }
    }
    ?>
  </tbody>
</table>
          </div>
        </div>
<?php 
//------------------------------------------------------last Logs modification
$sel_llst=mysql_query("SELECT * FROM tis_count_loogs");
$cnt_sel_llst=mysql_num_rows($sel_llst);
if ($cnt_sel_llst>=1) {
?>
<div class="card-footer small text-muted"><?php echo"<span id='tl_tsk'>".$cnt_sel_llst ."</span> Total logs."?> </div>
<?php
}
?>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../../../libs/parts/footer.php");
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
            <a class="btn btn-primary" href="../../../libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/popper/popper.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../../js/sb-admin-datatables.min.js"></script>
    <script src="../../../js/web/index.js"></script>
  </div>
</body>

</html>
    <?php
}
?>