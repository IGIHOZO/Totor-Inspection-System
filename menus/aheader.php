<?php
//set dynamic link path
$otherPath="";$indexPath="";
$pageArr=explode("/",$_SERVER['PHP_SELF']);
$page=$pageArr[count($pageArr)-1];
$actualPath=dirname($_SERVER['REQUEST_URI']);
$actualPathArr=explode("/",$actualPath);
switch ($page) {
  case 'index.php':
  case 'archive.php':
  case 'issues.php':
  case 'acalendar.php':
  case 'change_password.php':
    //$indexPath="";$otherPath="actions/admin/";
    $indexPath="./";$regPath="reg/";$repPath="rep/";$tPath="actions/";$otherPath="actions/admin/";
    break;
   case 'issues.php':
    $indexPath="";$otherPath="";
      break;
  default:
   // $indexPath="../../";$otherPath="";
    $indexPath="../../";$otherPath="";

    break;
}
?><input type="hidden" name="" id="ajaxPath" value="<?php echo $indexPath;?>">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="position: absolute;">
    <a class="navbar-brand" href="index.php">Tutor Inspection System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input type="hidden" name="usercate" id="usercate" value="System">
    <input type="hidden" name="sessid" id="sessid" value="<?php echo $_SESSION['seveeen_tis_seveeen_admin_id'];?>">
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo $indexPath.'index.php';?>">
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
              <a href="<?php echo $otherPath.'add_school.php';?>">School</a>
            </li>
            <!-- <li>
              <a  href="actions/admin/av_schools.php">Available Schools</a>
            </li> -->
            <li>
              <a  href="<?php echo $otherPath.'user_comments.php';?>">Comments</a>
            </li>
            <li>
              <a  href="<?php echo $otherPath.'user_messages.php';?>">Messages</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" data-original-title="Archive">
              <a class="nav-link" href="<?php echo $indexPath.'archive.php';?>"><i class='fa fa-folder'></i> <span class="nav-link-text">Archives</span></a>
            </li>
            <li  class="nav-item" data-toggle="tooltip" data-placement="right" data-original-title="Support">
              <a class="nav-link" href="<?php echo $indexPath.'issues.php';?>"><i class='fa fa-cog'></i> <span class="nav-link-text">Support</span><span id="supportCount" class="pull-right"></span></a>
            </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My acount" id="frNnSb2">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagess2" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text"> My acount </span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagess2">
            <li>
              <a href="#">My logs</a>
            </li>
            <li>
              <a href="libs/parts/panel/logs.php">Other logs</a>
            </li>
            <li>
              <a href="#">Change password</a>
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