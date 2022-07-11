<?php
$otherPath="";$indexPath="";$regPath="";$repPath="";$tPath="";
$pageArr=explode("/",$_SERVER['PHP_SELF']);
$page=$pageArr[count($pageArr)-1];
$actualPath=dirname($_SERVER['REQUEST_URI']);
$actualPathArr=explode("/",$actualPath);
switch ($page) {
  case 'index.php':
  case 'archive.php':
  case 'issues.php':
  case 'acalendar.php':
  case 'shared.php':
  case 'bulletins.php':
  case 'change_password.php':
    $indexPath="./";$regPath="reg/";$repPath="rep/";$tPath="actions/";$statPath="Statistics/";
    break;
    default:
    $indexPath="../";$regPath="../reg/";$repPath="../rep/";$tPath="../actions/";$statPath="../Statistics/";
    break;
}

?>
<input type="hidden" name="" id="ajaxPath" value="<?php echo $indexPath;?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="position: absolute;">
    <?php
    $works=dt_enc("workss");
    $tests=dt_enc("testss");
    $quizes=dt_enc("quizess");
    $exams=dt_enc("examss");
    ?>
    <a class="navbar-brand" href="../index.php">Tutor Inspection System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php
if(isset($_SESSION['seveeen_tis_usr_id'])){
$sessid=$_SESSION['seveeen_tis_usr_id'];
}
      ?>
      
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo $indexPath.'index.php';?>">
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
 $sklid=$_SESSION['seveeen_tis_usr_id'];
          ?>
          <input type="hidden" id="decsklid" value="<?php echo $sklid;?>">
          <input type="hidden" name="usercate" id="usercate" value="School">
            <li>
              <a href="<?php echo $regPath.'reg_class.php';?>"> Class</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="<?php echo $regPath.'reg_course.php';?>"> Course</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="<?php echo $regPath.'reg_teacher.php';?>"> Teacher</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="<?php echo $regPath.'reg_orient_teacher.php';?>">Orient Teachers</a>
            </li>
            <li id="frNnSbnwpr">
              <a href="<?php echo $regPath.'reg_orient_student.php';?>">Orient New Students</a>
            </li>
          <?php
          }
         if (isset($_SESSION['seveeen_tis_teacher_nm'])){
 $teacherid=$_SESSION['seveeen_tis_teacher_id'];
 $sklid=$_SESSION['seveeen_tis_usr_id'];
          ?>
          <input type="hidden" id="teacherschoolid" value="<?php echo $sklid;?>">
          <input type="hidden" id="decteacherid" value="<?php echo $teacherid;?>">
          <input type="hidden" name="usercate" id="usercate" value="Teacher">
            <li>
              <a href="<?php echo $tPath.'works.php';?>">Works</a>
            </li>
            <li>
              <a  href="<?php echo $tPath.'quizes.php';?>">Quizes</a>
            </li>
            <li>
              <a  href="<?php echo $tPath.'tests.php';?>">Tests ( CAT )</a>
            </li>
            <li>
              <a href="<?php echo $tPath.'exams.php';?>">Exams</a>
            </li>
            <li>
              <a href="<?php echo $tPath.'attendance.php';?>">Attendance</a>
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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tasks" id="frNnSbnwpr">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#tasksDrops" data-parent="#collapseExamplePagesPR">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text"> Tasks </span>
          </a>
          <ul class="sidenav-third-level collapse" id="tasksDrops">
            <li>
              <a  href="<?php echo $repPath.'rep_tasks.php';?>">All</a>
            </li>
            <li>
              <a  href="<?php echo $repPath.'rep_classes.php';?>">Classes</a>
            </li>
            <li>
              <a  href="<?php echo $repPath.'rep_teachers.php';?>">Teacher</a>
              </li>
          </ul>
        </li>
        <li>
          <a  href="<?php echo $indexPath.'bulletins.php';?>">
            <i class="fa fa-file"></i>
            <span class="nav-link-text">Bulletin</span>
          </a>
        </li>
      </ul>
    </li>
            <?php
          }
          if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
 ?>
<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tasks" id="frNnSbpr">
          <a class="nav-link" href="<?php echo $repPath.'rep_tasks.php';?>">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Tasks</span>
          </a>
        </li>

<?php         }else{
$go_cl_id=dt_enc(2018);
            ?>
                  <?php
          }
        if (!isset($_SESSION['seveeen_tis_teacher_nm'])) {
          ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Panel">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#sndPanel" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cog"></i>
            <span class='nav-link-text'> Panel <i class="pull-right" id="supportCount"></i></span>
          </a>
          <ul class="sidenav-second-level collapse" id="sndPanel">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#trdPanel" style="text-decoration:;unicode-range: inherit;"><i class='fa fa-pie-chart'></i>Teacher Evaluation</a>
              <ul class="sidenav-third-level collapse" id="trdPanel">
                <?php
                $evcat_st=dt_enc("Student");
                $evcat_xk=dt_enc("School");
                ?>
                  <li>
                    <a href="<?php echo $tPath.'dashevaluation.php'?>">Dashboard</a>
                  </li>
                   <li>
                    <a href="<?php echo $tPath.'t_evaluation.php?evcat='.$evcat_st;?>">By-Student</a>
                  </li>
                   <li>
                    <a href="<?php echo $tPath.'t_evaluation.php?evcat='.$evcat_xk;?>" >By-School</a>
                  </li>
              </ul>
            </li>

            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#statisticsPanel" style="text-decoration:;unicode-range: inherit;"><i class='fa fa-area-chart'></i>Statistics</a>
              <ul class="sidenav-third-level collapse" id="statisticsPanel">
                  <!-- <li>
                    <a href="<?php echo $statPath.'class.php'?>">Class</a>
                  </li> -->
                  <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#statisticsClassPanel" style="text-decoration:;unicode-range: inherit;"><i class='fa fa-area-chart'></i>Class</a>
              <ul class="sidenav-third-level collapse" id="statisticsClassPanel">
                  <li>
                    <a href="<?php echo $statPath.'class.php'?>">General</a>
                  </li>
                   <li>
                    <a href="<?php echo $statPath.'spclass.php';?>">Specific</a>
                  </li>
              </ul>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#statisticsGenderPanel" style="text-decoration:;unicode-range: inherit;"><i class='fa fa-area-chart'></i>Gender</a>
              <ul class="sidenav-third-level collapse" id="statisticsGenderPanel">
                  <li>
                    <a href="<?php echo $statPath.'gendercount.php'?>">Counter</a>
                  </li>
                   <li>
                    <a href="<?php echo $statPath.'genderper.php';?>">Performance</a>
                  </li>
              </ul>
            </li>

                   <li>
                    <a href="<?php echo $statPath.'course.php';?>">Course</a>
                  </li>
              </ul>
            </li>
            <li>
              <a href="<?php echo $indexPath.'acalendar.php';?>"><i class='fa fa-calendar'></i>Calendar</a>
            </li>
            <!-- <li>
              <a href="<?php echo $indexPath.'archive.php';?>">Archives</a>
            </li> -->
             <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Archives"><!-- 
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Archives"> -->
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#archiveSubMenu"><i class='fa fa-folder'></i>Archives</a>
              <ul class="sidenav-third-level collapse" id="archiveSubMenu">
                   <li>
                    <a href="<?php echo $indexPath.'archive.php';?>" >Personal</a>
                  </li>
                   <li>
                    <a href="<?php echo $indexPath.'shared.php';?>" >Shared</a>
                  </li>
              </ul>
            </li>
            <li>
              <a href="<?php echo $indexPath.'issues.php';?>"><i class='fa fa-comment'></i>Support</a>
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
            
            <li>  <a href="<?php echo $indexPath.'change_password.php';?>">Change Password</a>
            </li>
          </ul>
        </li>
            <?php
          }
if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
  ?>
           <li class="nav-item" data-toggle='tooltip' data-placement="right" data-original-title="Archives">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#archiveSubMenu"><i class='fa fa-folder'></i> <span class="nav-link-text">Archives</span></a>
              <ul class="sidenav-third-level collapse" id="archiveSubMenu">
                   <li>
                    <a href="<?php echo $indexPath.'archive.php';?>" >Personal</a>
                  </li>
                   <li>
                    <a href="<?php echo $indexPath.'shared.php';?>" >Shared</a>
                  </li>
              </ul>
            </li>            <li  class="nav-item" data-toggle="tooltip" data-placement="right" data-original-title="Support">
              <a class="nav-link" href="<?php echo $indexPath.'issues.php';?>"><i class='fa fa-cog'></i> <span class="nav-link-text">Support</span></a>
            </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text"> My Acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess">
            <li>
              <a href="<?php echo $indexPath.'change_password.php';?>">Change Password</a>
            </li>
          </ul>
        </li>
  <?php
    }else{}
        ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Help">
          <a class="nav-link" href="<?php echo $indexPath.'help.php';?>" target="_blank">
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
               echo"<span id='fullname' style='text-decoration:none'>".$_SESSION['seveeen_tis_usrnm']."</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"?>
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