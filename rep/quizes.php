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
if (@!$_SESSION['usrnm']) {
?>
<script type="text/javascript">
  window.location="../login.php";
</script>
<?php
}else{
@$usr_id=$_SESSION['usr_id'];
$all_flnm=$_SESSION['usrnm'];
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
  <meta name="description" content="Register Teacher -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Register Teacher | Tutor Inspection System</title>
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
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="position: absolute;">
    <a class="navbar-brand" href="../index.php">Tutor Inspection System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text"> Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registration">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-book"></i>
            <?php
            if (isset($_SESSION['teacher_nm'])) {
              echo "<span class='nav-link-text'> Actions-class task </span>";
            }else{echo "<span class='nav-link-text'> Registrations </span>";}
            ?>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
<?php
    if (isset($_SESSION['teacher_nm'])){

          }else{
          ?>
            <li>
              <a href="../reg/reg_class.php"> Class</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../reg/reg_course.php"> Course</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../reg/reg_teacher.php"> Teacher</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../reg/reg_orient_teacher.php">Orient Teachers</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="../reg/reg_orient_student.php">Orient New Students</a>
            </li>
          <?php
          }
         if (isset($_SESSION['teacher_nm'])){
?>
            <li>
<?php
$quizes=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode("quizess")))))))));
$tests=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode("testss")))))))));
$quizes=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode("quizess")))))))));
$exams=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode("examss")))))))));
?>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMultiw2">Quizes</a>
              <ul class="sidenav-third-level collapse" id="collapseMultiw2">
                <li>
                  <a href="../actions/set.php?reid=<?php echo $quizes;?>">Set up</a>
                </li>
                <li>
                  <a href="../actions/view.php?reid=<?php echo $quizes;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2q">Quizes</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2q">
                <li>
                  <a href="../actions/set.php?reid=<?php echo $quizes;?>">Set up</a>
                </li>
                <li>
                  <a href="../actions/view.php?reid=<?php echo $quizes;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2tt">Tests ( CAT )</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2tt">
                <li>
                  <a href="../actions/set.php?reid=<?php echo $tests;?>">Set up</a>
                </li>
                <li>
                  <a href="../actions/view.php?reid=<?php echo $tests;?>">View</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2ee">Exams</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2ee">
                <li>
                  <a href="../actions/set.php?reid=<?php echo $exams;?>">Set up</a>
                </li>
                <li>
                  <a href="../actions/view.php?reid=<?php echo $exams;?>">View</a>
                </li>
              </ul>
            </li>
<?php
          }else{

          }
          ?>
          </ul>
        </li>
        <?php
        if (isset($_SESSION['teacher_nm'])){
          }else{
            ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports" id="frNnSbnwpr">
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
                    $go_cl_id=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($cl_iid+2018)))))))));
                    echo "<li><a href='../rep/classes.php?reeiidd=$go_cl_id' target='_blank' style='color: #b2a110;font-size:15px'>".$clnnm."</a></li>";
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
                    $go_cl_id=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($tch_iddd+2018)))))))));
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
          if (isset($_SESSION['teacher_nm'])) {
          }else{
$go_cl_id=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(2018)))))))));
            ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tasks" id="frNnSbpr">
          <a class="nav-link" href="../rep/tasks.php?reeiidd=<?php echo $go_cl_id?>">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Tasks</span>
          </a>
        </li>
            <?php
          }
          if (isset($_SESSION['teacher_nm'])) {
          }else{
            ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
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
$sub_id=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($ft_sel_my_sub['teacher_id']+2018)))))))));
                  echo "<li><a href='#' target='_blank' class='my_sub_usrs_lst'style='color:#55aaff'>".$ft_sel_my_sub['teacher_fullname']."</a></li>";
                }
              }else{
                echo "<a href='#'>No Teacher Available.</a>";
              }
              ?>
              </ul>
            </li>
            <li>
              <a href="../reg/reg_teacher.php">Add Teacher</a>
            </li>
            <li>
              <a href="../change_password.php">Change Password</a>
            </li>
          </ul>
        </li>
            <?php
          }
if (isset($_SESSION['teacher_nm'])) {
  ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text"> My Acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess">
            <li>
              <a href="reg/reg_teacher.php">My documents</a>
            </li>
            <li>
              <a href="change_password.php">Change Password</a>
            </li>
          </ul>
        </li>
  <?php
    }else{}
        ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Help">
          <a class="nav-link" href="../help.php" target="_blank">
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
              if (isset($_SESSION['teacher_nm'])) {
              echo"<span id='full_sub_name' style='text-decoration:none'>".$_SESSION['teacher_nm']."</span>&nbsp&nbsp";
              echo"<span id='full_sub_name' style='text-decoration:none'>|| </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
              }
               echo"<span id='fullname' style='text-decoration:none'>".$_SESSION['usrnm']."</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"?>
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

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRegisterQuiz" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                         <h4 class="modal-title">New Quiz registration form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                            <div class="modal-body">
      <div id="regQuizResponse"></div>
          <form name="quizesregoform" action="" method="post" novalidate>
                    <div class="form-group">
          <label>Select Class</label>
           
                <?php
              $tchr_id=$_SESSION['teacher_id'];
              echo "<select class='form-control' id='tsskclss'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $se_crs=mysql_query("SELECT * FROM tis_courses WHERE course_teacher='$tchr_id' AND course_xkul='$usr_id' group by course_class");
              $cnt_se_crs=mysql_num_rows($se_crs);
              if ($cnt_se_crs>0) {
                $verify=1;
                while ($ft_se_crs=mysql_fetch_assoc($se_crs)) {
                  $cls_idd=$ft_se_crs['course_class'];
                  $sel_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_id='$cls_idd'");
                  $cnt_sel_clss=mysql_num_rows($sel_clss);
                  if ($cnt_sel_clss!=1) {
                    echo "<option value='No' selected id='chs_slctd'>ERROR 33-ff occured</option>";
                  }else{
                    
                    $ft_classes=mysql_fetch_assoc($sel_clss);
                    echo "<option>".$ft_classes['class_name']."</option>";
                  }
                }
              }else{
                echo "<option value='No' selected id='chs_slctd'> No Class available for you</option>";
              }
              echo "</select";
              ?>
              </div>
      <input type="hidden" id="tskhddn" value="quizess">
      <div class="form-group">
        <label>Select Lesson</label>
        <select class="form-control" id="tsklssn"><style>#resp_sp{color:#058f19;font-weight:bolder;font-style:oblique;font-size:26px;font-family:Baskerville Old Face}</style><option value="choose"> Choose Lesson</option><option>CHE</option><option>REL</option></select>
      </div>
      <div class="col-md-12">
&nbsp;&nbsp;&nbsp;<br><br>
      </div>
      <div class="form-group">
        <label>Quiz Title</label><label style="margin-left: 10%;color: #f45;font-size: 15px;">&nbsp;(&nbsp; Maximum characters: <span style="color: #435344;font-weight: bolder"> 25 characters</span>)<label id="cnt_chr_resp"></label></label>
        <input type="text" class="form-control" oninput="return countTskTtlChrs()" id="tskttl" placeholder="Given Quiz" maxlength="25">
      </div>
      <div class="form-group">
        <label>Overall marks</label>
        <input type="number" class="form-control" id="tskovll" placeholder="" style="font-size: ">
      </div></form></div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" onclick="return setTsk()" id="sttsk"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; Set Quiz</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                        </div>
            </div>
          </div>
        </div><!--end Quiz Dialog-->
        
		<div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateQuiz" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update Quiz form</h4>
                    </div>
                     <div class="modal-body">
      <div id="updQuizResponse"></div>
          <form name="quizesupdform" action="" method="post" novalidate>
                    <div class="form-group">
          <label>Select Class</label>
          <?php
              $tchr_id=$_SESSION['teacher_id'];
              echo "<select class='form-control' id='updtsskclss'>";
              echo "<option value='choose' selected id='updchs_slctd'> Select Class</option>";
              $se_crs=mysql_query("SELECT * FROM tis_courses WHERE course_teacher='$tchr_id' AND course_xkul='$usr_id' group by course_class");
              $cnt_se_crs=mysql_num_rows($se_crs);
              if ($cnt_se_crs>0) {
                $verify=1;
                while ($ft_se_crs=mysql_fetch_assoc($se_crs)) {
                  $cls_idd=$ft_se_crs['course_class'];
                  $sel_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_id='$cls_idd'");
                  $cnt_sel_clss=mysql_num_rows($sel_clss);
                  if ($cnt_sel_clss!=1) {
                    echo "<option value='No' selected id='chs_slctd'>ERROR 33-ff occured</option>";
                  }else{
                    
                    $ft_classes=mysql_fetch_assoc($sel_clss);
                    echo "<option>".$ft_classes['class_name']."</option>";
                  }
                }
              }else{
                echo "<option value='No' selected id='chs_slctd'> No Class available for you</option>";
              }
              echo "</select";
              ?></div>
      <input type="hidden" id="updtskhddn" value="quizess">
      <div class="form-group">
        <label>Select Lesson</label>
        <select class="form-control" id="updtsklssn"><style>#resp_sp{color:#058f19;font-weight:bolder;font-style:oblique;font-size:26px;font-family:Baskerville Old Face}</style><option value="choose"> Choose Lesson</option><option>CHE</option><option>REL</option></select>
      </div>
      <div class="col-md-12">
&nbsp;&nbsp;&nbsp;<br><br>
      </div>
      <div class="form-group">
        <label>Quiz Title</label><label style="margin-left: 10%;color: #f45;font-size: 15px;">&nbsp;(&nbsp; Maximum characters: <span style="color: #435344;font-weight: bolder"> 25 characters</span>)<label id="updcnt_chr_resp"></label></label>
        <input type="text" class="form-control" oninput="return countTskTtlChrs()" id="tskttl" placeholder="Given Quiz" maxlength="25">
      </div>
      <div class="form-group">
        <label>Overall marks</label>
        <input type="number" class="form-control" id="updtskovll" placeholder="" style="font-size: ">
      </div></form></div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdQuiz" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                        </div>
                    </div>
                  </div>
        </div><!--end Quiz Dialog-->
        
		      <div class="row" id="quizviewform" style="padding:2%;margin-top: -3%">
        <form action="" method="GET">
          <div class="col-lg-12 input-goup">
            <!--input type="text" name="keyQuiz" id="keyQuiz" placeholder="Quiz name..." class="form-control srch"-->
          </div></form>
        <span style="color:green"></span>
        <!-- Example DataTables Card-->

        <div class="table">
       <h4>List of Your Quizes Available</h4>
        <table class="table table-bordered" id="tblQuizes">
          <thead>
            <tr>
              <th>#Counts</th>
              <th>Class </th>
              <th>Lesson </th>
              <th>Title </th>
              <th>Marks</th>
              <th>Category </th>
              <th>Status</th>
              <th>  Date 
                <button class="btn btn-primary glyphicon glyphicon-plus-sign pull-right" data-toggle='modal' data-target='#modalRegisterQuiz'> New</button></th>
              <!--th class="prodmore">  Modifications
<button data-toggle="modal" data-target="#modalQuiz" class="btn btn-primary pull-right" style="margin-right:3%;margin-bottom:0.5%;margin-top: -1%"><span class="glyphicon glyphicon-plus"></span>Add Quizes</button></th-->
            </tr>
          </thead>
          <tbody id="loadedquizes">
		  <?php
$ntstt="Ny";
$mdstt="Md";
$sel_tasts=mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tchr_id' AND task_xkul='$usr_id' AND task_type='quizess' AND ((task_status='$mdstt') OR (task_status='$ntstt'))");
$cnt_sel_tasts=mysql_num_rows($sel_tasts);
if ($cnt_sel_tasts>0) {
  $counter=0;
  while ($ft_sel_tasts=mysql_fetch_assoc($sel_tasts)) {
    $counter++;
    $cors_id=$ft_sel_tasts['task_course'];
    $clss_idd=$ft_sel_tasts['task_class'];
    $selcrs=mysql_query("SELECT * FROM tis_courses WHERE course_id='$cors_id' AND course_xkul='$usr_id'")or die(mysql_error());
    $fet_selcrs=mysql_fetch_assoc($selcrs);
    $crs_nm=$fet_selcrs['course_name'];

    $selclss=mysql_query("SELECT * FROM tis_classes WHERE class_id='$clss_idd' AND class_xkul='$usr_id'")or die(mysql_error());
    $fet_selclss=mysql_fetch_assoc($selclss);
    $clss_nm=$fet_selclss['class_name'];
    ?>
<tr>

  <td>
    <?php
    echo $counter;
    ?>
  </td>
  <td>
    <?php
    echo $clss_nm
    ?>
  </td>
  <td>
    <?php
    echo $crs_nm
    ?>
  </td>
  <td>
    <?php
    echo "<span style='font-size:10px;font-weight: bolder;text-decoration:underline'>".$ft_sel_tasts['task_title']."<span>";
    ?>
  </td>
  <td>
    <?php
    echo $ft_sel_tasts['task_overall'];
    ?>
  </td>
  <td>
    <?php
     if ($ft_sel_tasts['task_type']=="workss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Work</span>";
    }elseif ($ft_sel_tasts['task_type']=="quizess") {
      echo "<span style='font-size:11px;'>".$task_ttype="Quiz</span>";
    }elseif ($ft_sel_tasts['task_type']=="testss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Test</span>";
    }elseif ($ft_sel_tasts['task_type']=="examss") {
      echo "<span style='font-size:11px;'>".$task_ttype="Exam</span>";
    }else{

    }
    ?>
  </td>
    <td>
    <?php
    $tsk_dtls=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($ft_sel_tasts['task_id']+2018)))))))));
    if ($ft_sel_tasts['task_status']=='Ny') {
      echo "<a href='task_marks.php?rei=$tsk_dtls' id='ntyt' target='_blank' >Not Yet</a>";
    }elseif ($ft_sel_tasts['task_status']=='Md') {

      echo "<a href='task_marks.php?rei=$tsk_dtls' id='mrkd' target='_blank'>Marked</a>";
    }
    ?>
  </td>
    <td>
    <?php
    echo "<span style='font-size:11px;font-weight: bolder;text-decoration:underline'>".substr($ft_sel_tasts['task_date'], 0,10).' | '.substr($ft_sel_tasts['task_date'], 11,2).'h</span>';
    ?>
  </td>
</tr>
    <?php
  }
}
?>              
          </tbody>
        </table>
        </div>
      </div><!--end employeeviewform-->


	  <!--End Optional-->
	    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delProdReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelQuiz" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
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
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>

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