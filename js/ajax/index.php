<?php
session_start();
include_once("../../libs/parts/didier_igihozo.php");
include"../../Classes/AcademicCalendar.php";
$calendar=new AcademicCalendar();$acal=null;
if(isset($_SESSION['seveeen_tis_usr_id'])){
$acal=json_decode($calendar->getAutomaticActiveCalendar(array("uid"=>$_SESSION['seveeen_tis_usr_id'])),TRUE)[0];
}elseif(isset($_SESSION['seveeen_tis_admin_id'])){

}
echo "<style>#resp_sp{color:#058f19;font-weight:bolder;font-style:oblique;font-size:26px;font-family:Baskerville Old Face}</style>";
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Didier_igihozo

 */
@$tchr_id=$_SESSION['seveeen_tis_teacher_id'];

if (!$sel || !$con) {
  print_r("<center><h2><font color='red'>PROBLEM OF SERVER CONNECTION...</font></h2></center>");
}else{
  @$ss_usr=$_SESSION['seveeen_tis_usrnm'];
  @$usr_id=$_SESSION['seveeen_tis_usr_id'];
$ntstt="Ny";
$mdstt="Md";
//----------------------------------------------------------------------------------------------LOGIN
if (isset($_GET['tisLg'])) {
  $usrnm=mysql_real_escape_string(stripslashes($_GET['usrnm']));
  $usrpss=mysql_real_escape_string(stripslashes($_GET['psswrd']));
  $stt="E";
  $nw_stt="Nw";
  $sel_usr=mysql_query("SELECT * FROM tis_schools WHERE (school_username='$usrnm' || school_phone='$usrnm' || school_email='$usrnm') AND school_password='$usrpss' AND school_status='$stt'") or die("Error ".mysql_error());
  $cnt_sel_usr=mysql_num_rows($sel_usr);
  if ($cnt_sel_usr==1) {
      $ft_sel_usr=mysql_fetch_assoc($sel_usr);
      $_SESSION['seveeen_tis_usrnm']=$ft_sel_usr['school_full_name'];
      $_SESSION['seveeen_tis_usr_id']=$ft_sel_usr['school_id'];
      $_SESSION['ucate']='School';
      $xk_id=$ft_sel_usr['school_id'];
      $logg_stt="School";
        echo "<span style='color:green'>Login successfully.</span> || <span style='color:#2235a1;'>Redirecting...</span>";  
      echo "<script type='text/javascript'>window.location='index.php';</script>";
    mysql_query("INSERT INTO tis_count_loogs (log_usr,log_xkul,log_type) VALUES('$xk_id',$xk_id,'$logg_stt')");
      
  }else{
    $sel_usr_tc=mysql_query("SELECT * FROM tis_teachers WHERE teacher_username='$usrnm' AND teacher_password='$usrpss' AND teacher_status='$stt'") or die("Error ".mysql_error());;
    $cnt_sel_usr_tc=mysql_num_rows($sel_usr_tc);
    if ($cnt_sel_usr_tc==1) {
      $ft_sel_usr_tc=mysql_fetch_assoc($sel_usr_tc);
      $fttc_xkl_id=$ft_sel_usr_tc['teacher_school'];
      $sel_usr_xkl=mysql_query("SELECT * FROM tis_schools WHERE school_id='$fttc_xkl_id'");
      $ft_sel_usr_xkl=mysql_fetch_assoc($sel_usr_xkl);
      $_SESSION['seveeen_tis_teacher_nm']=$ft_sel_usr_tc['teacher_fullname'];
      $_SESSION['seveeen_tis_teacher_id']=$ft_sel_usr_tc['teacher_id'];
      //Asua-->Code
      $_SESSION['ucate']='Teacher';
      $_SESSION['seveeen_tis_usrnm']=$ft_sel_usr_xkl['school_full_name'];
      $_SESSION['seveeen_tis_usr_id']=$ft_sel_usr_xkl['school_id'];
      $tcr_id=$ft_sel_usr_tc['teacher_id'];
      $log_stt="Teacher";
        echo "<span style='color:green'>Login successfully.</span> || <span style='color:#2235a1;'>Redirecting...</span>";  
      echo "<script type='text/javascript'>window.location='index.php';</script>";
    mysql_query("INSERT INTO tis_count_loogs (log_usr,log_xkul,log_type) VALUES('$tcr_id',$fttc_xkl_id,'$log_stt')");
      
    }else{
      $sel_usr_tc_nw=mysql_query("SELECT * FROM tis_teachers WHERE teacher_username='$usrnm' AND teacher_password='$usrpss' AND teacher_status='$nw_stt'");
    $cnt_sel_usr_tc_nw=mysql_num_rows($sel_usr_tc_nw);
    if ($cnt_sel_usr_tc_nw==1) {
      $ft_sel_usr_tc_nw=mysql_fetch_assoc($sel_usr_tc_nw);
      $fttc_xkl_id_nw=$ft_sel_usr_tc_nw['teacher_school'];
      $sel_usr_xkl_nw=mysql_query("SELECT * FROM tis_schools WHERE school_id='$fttc_xkl_id_nw'");
      $ft_sel_usr_xkl_nw=mysql_fetch_assoc($sel_usr_xkl_nw);
      $_SESSION['seveeen_tis_nwe_nw_teacher_nm']=$ft_sel_usr_tc_nw['teacher_fullname'];
      $_SESSION['seveeen_tis_nw_usrnm']=$ft_sel_usr_xkl_nw['school_full_name'];
      $_SESSION['seveeen_tis_nw_usr_id']=$ft_sel_usr_xkl_nw['school_id'];
        echo "<span style='color:green'>Login successfully.</span> || <span style='color:#2235a1;'>Redirecting...</span>";
      echo "<script type='text/javascript'>window.location='new.php';</script>";
    }else{
      $lvsvusr=seveeen_my_grant($usrnm);
      $lvsvps=seveeen_my_grant($usrpss);
      $se_log_svn=mysql_query("SELECT * FROM tis_seveeen_ltd WHERE seveeen_ltd_user='$lvsvusr' AND seveeen_ltd_pass='$lvsvps'")or die(mysql_error());
      if (mysql_num_rows($se_log_svn)==1) {
        $ft_se_log_svn=mysql_fetch_assoc($se_log_svn);
        $svn_fl_nm=seveeen_my_fl_nm_dec($ft_se_log_svn['seveeen_ltd_name']);
        //Asua-->Code
        $_SESSION['ucate']='System';//ENd Asua code
        $_SESSION['seveeen_tis_seveeen_admin_id']=$ft_se_log_svn['seveeen_ltd_id'];
        $_SESSION['seveeen_tis_seveeen_admin_name']=$svn_fl_nm;
        //echo $_SESSION['seveeen_tis_seveeen_admin_id']."<br>";
        //echo $_SESSION['seveeen_tis_seveeen_admin_name'];
          echo "<span style='color:green'>Login successfully.</span> || <span style='color:#2235a1;'>Redirecting...</span>";
        echo "<script type='text/javascript'>window.location='index.php';</script>";
      }else{
        echo "Wrong Password or Username";
      }
    }}
  }
}
//--------------------------------------------------------------------------------------REGISTERING CLASSES
//check up new msg
include_once"../../Classes/Issues.php";
if (isset($_GET['clName'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sub_new_clss").removeAttr("disabled");
  });
</script>
  <?php
  include"../../Classes/Courses.php";
  $class_nm=mysql_real_escape_string(stripslashes($_GET['clName']));
  $stt="E";
  
  $sel_class=mysql_query("SELECT * FROM tis_classes WHERE class_id='$class_nm' AND class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."'");
  $nt_sel_class=mysql_num_rows($sel_class);
  if ($nt_sel_class>0) {
    echo "Class already availble";
  }else{
    $in_clss=mysql_query("INSERT INTO tis_classes VALUES(null,'$class_nm','$usr_id','$stt','$reg_date')")or die(mysql_error());
    $classLastId=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' ORDER BY class_date DESC LIMIT 1");
    $classid=mysql_fetch_assoc($classLastId)['class_id'];
    //import all courses from previous course year
    $courses=new Courses;
    $courses->synchCourses(array("classid"=>$classid,"clname"=>$class_nm,"xkul"=>$usr_id));
    if ($in_clss) {
      echo "<span id='resp_sp'>Registered Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#class_level,#class_name,#class_option,#class_option_mmre").val("");
  </script>
      <?php
    }
  }
}
//-----------------------------------------------------------REFRESHING CLASSES
if (isset($_GET['crt_cl_refr'])) {
  $sel_cc=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' ORDER BY class_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.")&nbsp&nbsp";?></td>
  <td><?php echo $ft_sel_cc['class_name']."<br>"?></td>
</tr>
      <?php
        $i++;

    }
  }
}

//---------------------------------------------------------------------------------CREATING COURSES
if (isset($_GET['regCrs'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sub_new_clss").removeAttr("disabled");
  });
</script>
  <?php
  $cr_cl=mysql_real_escape_string(stripslashes($_GET['crCl']));
  $cr_nm=mysql_real_escape_string(stripslashes($_GET['crNm']));
  $cr_mks=mysql_real_escape_string(stripslashes($_GET['crOvllMk']));
  
  $sel_clls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$cr_cl' AND class_xkul='$usr_id'");
  $cnt_ccl=mysql_num_rows($sel_clls);
  if ($cnt_ccl!=1) {
    echo "<b><h3>ERROR 1 Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }else{
  $ft_sel_clls=mysql_fetch_assoc($sel_clls);
  $clss_id=$ft_sel_clls['class_id'];
  $sel_crs=mysql_query("SELECT * FROM tis_courses WHERE course_name='$cr_nm' AND course_class='$clss_id'");
  $cnt_sel_crs=mysql_num_rows($sel_crs);
  if ($cnt_sel_crs>0) {
        echo "Course arleady exists in this class...";
      }else{
        $stt="E";
        $in_crs=mysql_query("INSERT INTO tis_courses VALUES(null,'$cr_nm','$cr_mks','$clss_id','','$usr_id','$stt','$reg_date')")or die(mysql_error());
        if ($in_crs) {
      echo "<span id='resp_sp'>Registered Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#avCls,#crsNm,#ovlMks").val("");
  </script>
      <?php
        }else{
          echo "Course registration failed. || Please try again later...";
        }
      }   
  }
}
//-----------------------------------------------------------REFRESHING COURSES
if (isset($_GET['refrcrs'])) {
  $crscl=$_GET['crsclnm'];
  $sel_crcl=mysql_query("SELECT * FROM tis_classes WHERE class_id='$crscl' AND class_xkul='$usr_id'");
  $cnt_sel_crcl=mysql_num_rows($sel_crcl);
  if ($cnt_sel_crcl!=1) {
    echo "<b><h3>ERROR 1-a Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }else{
    $ft_sel_crcl=mysql_fetch_assoc($sel_crcl);
    $crlc_id=$ft_sel_crcl['class_id'];
    $sel_cc=mysql_query("SELECT * FROM tis_courses WHERE course_xkul='$usr_id' AND course_class='$crlc_id' ORDER BY course_name ASC");
    $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.")&nbsp&nbsp";?></td>
  <td><?php echo $ft_sel_cc['course_name']?></td>
  <td><?php echo "<b style='font-size:10px;font-weight:bolder;'> &nbsp;/".$ft_sel_cc['course_marks']."</b><br>"?></td>
</tr>
      <?php
        $i++;

    }
  }else{
    echo "<span id='spcrcl'>No Courses available for this class...</span>";
  }
  }
}
//-------------------------------------------------------------------------------------------REGISTER NEW TEACHER

if (isset($_GET['crNwtch'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sub_new_tchr").removeAttr("disabled");
  });
</script>
  <?php
  $tchr_fnm=mysql_real_escape_string(stripslashes($_GET['tfNm']));
  $tchr_lnm=mysql_real_escape_string(stripslashes($_GET['tlNm']));
  $badge=mysql_real_escape_string(stripslashes($_GET['badge']));
  $uname=mysql_real_escape_string(stripslashes($_GET['uname']));
  $tchr_fullnm=$tchr_fnm." ".$tchr_lnm;
  $tchr_usr_nm=$tchr_fnm.".".$tchr_lnm;
  $tchr_pss=$ss_usr."123";
  $stt="E"; 
  $nw_stt="Nw";
  
  //echo "fname: ".$tchr_fnm." , lname: ".$tchr_lnm." , fullnm: ".$tchr_fullnm." , usrnm: ".$tchr_usr_nm." , passwrd: ".$tchr_pss;
  $sel_chr=mysql_query("SELECT * FROM tis_teachers WHERE teacher_fullname='$tchr_fullnm' AND teacher_username='$uname' AND teacher_badge='$badge' AND teacher_password='$tchr_pss' AND teacher_school='$usr_id'");
  $cnt_sel_chr=mysql_num_rows($sel_chr);
  if ($cnt_sel_chr>0) {
    echo "This Username arleady exist in system. Please check if there is no teacher diplication or add other characters to make difference.";
  }else{
    $in_tchr=mysql_query("INSERT INTO tis_teachers VALUES(null,'$tchr_fullnm','$uname','','','','$badge','$tchr_pss','$usr_id','$nw_stt','$reg_date')")or die(mysql_error());
    if ($in_tchr) {
      echo "<span id='resp_sp'>Registered Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#techfnm,#techlnm,#tchusrnm").val("");
  </script>
      <?php
    }else{
      echo "<b><h3>Registration Failed : ERROR 4-f Occured. || Please contact Administrator to solve this issue...</h3></b>";
    }
  }
}
//---------------------------------refresh teachers table
if (isset($_GET['crt_thr_refr'])) {
  $sel_cc=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$usr_id' ORDER BY teacher_fullname ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.")&nbsp&nbsp";?></td>
  <td><?php echo $ft_sel_cc['teacher_fullname']."<br>";?></td>
</tr>
      <?php
        $i++;

    }
  }
}

//-------------------------------------------------------------------------------------------------ORIENT TEACHER
if (isset($_GET['orThrCrs'])) {
  $or_cll=mysql_real_escape_string(stripslashes($_GET['orThCls']));
  $ortchr=mysql_real_escape_string(stripslashes($_GET['orThTchr']));
  $stt="E";
  $or_se_crs=mysql_query("SELECT * FROM tis_classes WHERE class_id='$or_cll' AND class_xkul='$usr_id' AND class_status='$stt' AND LEFT(class_date,4)='".date("Y")."'");
  $cnt_or_se_crs=mysql_num_rows($or_se_crs);
  if ($cnt_or_se_crs==1) {
    $ft_or_se_crs=mysql_fetch_assoc($or_se_crs);
    $or_cl_id=$ft_or_se_crs['class_id'];
    $or_selcrs=mysql_query("SELECT * FROM tis_courses WHERE course_class='$or_cl_id' AND course_teacher='0' AND course_xkul='$usr_id' AND LEFT(course_date,4)='".date("Y")."'");
    $cnt_or_selcrs=mysql_num_rows($or_selcrs);
    if ($cnt_or_selcrs>0) {
        echo "<option value='choose' selected id='chs_slctd'> Select Course</option>";
      while ($ft_or_selcrs=mysql_fetch_assoc($or_selcrs)) {
        echo "<option value='".$ft_or_selcrs['course_id']."'>".$ft_or_selcrs['course_name']."</option>";
      }
      exit;
    }else{
      echo "<option value='No'>No Courses available</option>";
    }
  }else{
    echo "<option value='choose' selected id='chs_slctd'> Select Course</option>";
  }
}
//-------------------------Clicking Submit button
if (isset($_GET['orTchhFn'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#okset").removeAttr("disabled");
  });
</script>
  <?php
  $orr_tch=mysql_real_escape_string(stripslashes($_GET['ortTchr']));
  $orr_cls=mysql_real_escape_string(stripslashes($_GET['ortCls']));
  $orr_crs=mysql_real_escape_string(stripslashes($_GET['ortCrs']));
  $stt="E";
  $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$orr_cls' AND class_xkul='$usr_id' AND class_status='$stt' AND LEFT(class_date,4)='".date("Y")."'");
  $cnt_sel_cls=mysql_num_rows($sel_cls);
  if ($cnt_sel_cls==1) {
    $ft_sel_cls=mysql_fetch_assoc($sel_cls);
    $or_cls_id=$ft_sel_cls['class_id'];
    $sel_course=mysql_query("SELECT * FROM tis_courses WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
    $cnt_sel_course=mysql_num_rows($sel_course);
    if ($cnt_sel_course==1) {
      $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id = '$orr_tch' AND teacher_school='$usr_id'");
      $cnt_sel_tch=mysql_num_rows($sel_tch);
      if ($cnt_sel_tch==1) {
        $ft_sel_tch=mysql_fetch_assoc($sel_tch);
        $tchr_id=$ft_sel_tch['teacher_id'];
        $Orient_tchr=mysql_query("UPDATE tis_courses SET course_teacher = '$tchr_id' WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
        if ($Orient_tchr) {
          echo "<span id='resp_sp'>Oriented Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#or_tch_tchr,#or_tch_cls,#or_tch_crs").val("");
  </script>
      <?php
        }else{
          echo "<b><h3>Action Failed : ERROR 00 - A1 Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }
      }else{
        echo "<b><h3>Action Failed : ERROR 08 - g Occured. || Please contact Administrator to solve this issue...</h3></b>";
      }
    }else{
      echo "<b><h3>Action Failed : ERROR 26 - h Occured. || Please contact Administrator to solve this issue...</h3></b>";
    }
  }else{
    echo "<b><h3>Action Failed : ERROR 23 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }

}


//------------------------------------------------------------------------------------------------------REGISTEERIN NEW STUDENT
if (isset($_GET['regStt'])) {

  $stfnm=mysql_real_escape_string(stripslashes($_GET['stFnm']));
  $stlnm=mysql_real_escape_string(stripslashes($_GET['stLnm']));
  $stclss=mysql_real_escape_string(stripslashes($_GET['stClss']));
  $stsxx=mysql_real_escape_string(stripslashes($_GET['stSx']));
  $st_fllnm=$stfnm." ".$stlnm;
  $stt="E";
  
  $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$stclss' AND class_xkul='$usr_id'");
  $cnt_sel_cls=mysql_num_rows($sel_cls);
  if ($cnt_sel_cls==1) {
    $ft_sel_cls=mysql_fetch_assoc($sel_cls);
    $st_cl_id=$ft_sel_cls['class_id'];
    $sel_stt=mysql_query("SELECT * FROM tis_students WHERE student_fullname='$st_fllnm' AND student_class='$st_cl_id' AND student_xkul='$usr_id'");
    $cnt_sel_stt=mysql_num_rows($sel_stt);
    if ($cnt_sel_stt==0) {
      $ins_stt=mysql_query("INSERT INTO tis_students(student_fullname,student_sex,student_class,student_xkul,student_status,student_date) VALUES('$st_fllnm','$stsxx','$st_cl_id','$usr_id','$stt','$reg_date')")or die(mysql_error());
      $sel_st=mysql_query("SELECT * FROM tis_students WHERE student_fullname='$st_fllnm' AND student_sex='$stsxx' AND student_class='$st_cl_id' AND student_xkul='$usr_id' AND student_status='$stt'")or die(mysql_error());
      if (mysql_num_rows($sel_st)==1) {
        $ft_sel_st=mysql_fetch_assoc($sel_st);
        $sstiiid=$ft_sel_st['student_id'];
        $stt_cl=$ft_sel_st['student_class'];
        $sel_st_mrk=mysql_query("SELECT * FROM tis_tasks WHERE task_class='$stt_cl' AND task_xkul='$usr_id'");
        $cnt_sel_st_mrk=mysql_num_rows($sel_st_mrk);
        $wrkd=0;//INSERTED MARKS
        $outf=$cnt_sel_st_mrk; //TOTAL UNREGISTERED TASKS
        $inns_mkk=false;
        if ($cnt_sel_st_mrk>0) {
          while ($ft_sel_st_mrk=mysql_fetch_assoc($sel_st_mrk)) {
            $tsk_ovl=$ft_sel_st_mrk['task_overall'];
            $tsk_id=$ft_sel_st_mrk['task_id'];
            $tsk_tch=$ft_sel_st_mrk['task_teacher'];
            $inns_mkk=mysql_query("INSERT INTO tis_task_marks VALUES(null,'$sstiiid',0,'$tsk_ovl','$tsk_id','$stt_cl','$tsk_tch','$usr_id','$stt','$reg_date')")or die(mysql_error());
            if ($inns_mkk) {
              $wrkd++;
            }
          }
        }else{
          $inns_mkk=true;
          echo "<span id='resp_sp'>Student Registered Successfully</span><span style='color:#220934' id='dlld'>, tasks updated: <span style='color:#3ed540'>".$wrkd."</span> out of ".$outf."</span>";
        }
      }else{
        echo "Duplication of students...";
      }
      if ($ins_stt && $inns_mkk) {
        if ($cnt_sel_st_mrk>0) {
          echo "<span id='resp_sp'>Student Registered Successfully</span><span style='color:#220934' id='dlld'>, tasks updated: <span style='color:#3ed540'>".$wrkd."</span> out of ".$outf."</span>";
        }
              ?>
          <script type="text/javascript">
              function hhidef(){
                $("#resp_sp,#dlld").hide();
              }
            window.setTimeout(hhidef,5000);

              $("#fname,#lname,#or_tch_cls,#sssex").val("");
          </script>
              <?php
      }else{
        echo "Something went Wrong while registering. Please try again, or contact Administrator...";
      }
    }else{
      echo "Student arleady available in this class.";
    }
  }else{
    echo "<b><h3>Matching Class Failed || Please contact Administrator to solve this issue...</h3></b>";
  }
}

//------------------------------------------------------------------------------------------NEw teacher change password
if (isset($_GET['nwCngpss'])) {
  $tch_nm=$_SESSION['seveeen_tis_nwe_nw_teacher_nm'];
  $xkl_iid=$_SESSION['seveeen_tis_nw_usr_id'];
  $stt="E";
  $pss=mysql_real_escape_string(stripslashes($_GET['crPss']));
  $nwpss=mysql_real_escape_string(stripslashes($_GET['nwPss']));
  $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_fullname='$tch_nm' AND teacher_school='$xkl_iid' AND teacher_password='$pss'");
  $cnt_sel_tch=mysql_num_rows($sel_tch);
  if ($cnt_sel_tch==1) {
    $up_pss=mysql_query("UPDATE tis_teachers SET teacher_password='$nwpss',teacher_status='$stt' WHERE teacher_fullname='$tch_nm' AND teacher_school='$xkl_iid'")or die(mysql_error());
    if ($up_pss) {
          echo "<span id='resp_sp'>Password Changed Successfully...</span>";
          echo "<span id='resp_lg'>&nbsp&nbsp&nbsp Please Click <b>LOGIN</b> button to access your acount.</span><br><br><br>";
              ?>
          <script type="text/javascript">

              $("#nw_pss,#nw_nwpss,#nw_cmfpss").val("");
          </script>
              <?php
    }else{
      echo "Something went Wrong while Changing password. Please try again, or contact Administrator...";
    }
  }else{
    echo "You entered a wrong password...";
  }

}
//-----------------------------------------------------------------------------------------------------------SETING NEW TASK
if (isset($_GET['tocrs'])) {
  $lsn_clss=$_GET['lsnClss'];
  $tchr_id=$_SESSION['seveeen_tis_teacher_id'];
  $sel_cls_id=mysql_query("SELECT * FROM tis_classes WHERE class_id='$lsn_clss' AND LEFT(class_date,4)='".date("Y")."' AND class_xkul='$usr_id'");
  $cnt_sel_cls_id=mysql_num_rows($sel_cls_id);
  if ($cnt_sel_cls_id==1) {
    $ft_sel_cls_id=mysql_fetch_assoc($sel_cls_id);
    $course_id=$ft_sel_cls_id['class_id'];
    $sel_crss=mysql_query("SELECT * FROM tis_courses WHERE course_teacher='$tchr_id' AND course_class='$course_id' AND LEFT(course_date,4)='".date("Y")."' AND course_xkul='$usr_id'");
    $cnt_sel_crss=mysql_num_rows($sel_crss);
    if ($cnt_sel_crss>0) {
        echo "<option value='choose'> Choose Lesson</option>";
      while ($ft_sel_crss=mysql_fetch_assoc($sel_crss)) {
        echo "<option value='".$ft_sel_crss['course_id']."'>".$ft_sel_crss['course_name']."</option>";
      }
    }else{
      echo "<option value='No'> No Courses Available</option>";
    }
  }else{
    echo "<option value='No'> Error: EA - 7 no such data </option>";
  }
  /*
  
  */
}
if (isset($_GET['rskk'])) {
        if(count($acal)==0){echo "<font color='red' size='4'>Sorry this Operation can be done only during academic trimester</font>";exit;}
  ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#sttsk").removeAttr("disabled");
  });
</script>
  <?php
  $crss=mysql_real_escape_string(stripslashes($_GET['lsnNm']));
  $cstl=mysql_real_escape_string(stripslashes($_GET['tskTtl']));
  $chp=mysql_real_escape_string(stripslashes($_GET['tskChp']));
  $ovl=mysql_real_escape_string(stripslashes($_GET['tskOvmks']));
  $valstt=mysql_real_escape_string(stripslashes($_GET['tskvlstt']));
  $xk_iid=$_SESSION['seveeen_tis_usr_id'];
  $stt="Ny";
  
  $tchr_id=$_SESSION['seveeen_tis_teacher_id'];
  $st_m="E";
  $sel_cccl=mysql_query("SELECT * FROM tis_classes WHERE class_id ='$crss' AND class_xkul='$xk_iid'");
  $cnt_sel_cccl=mysql_num_rows($sel_cccl);
  if ($cnt_sel_cccl==1) {
    $ft_sel_cccl=mysql_fetch_assoc($sel_cccl);
    $st_cl_id=$ft_sel_cccl['class_id'];
    $sel_crss=mysql_query("SELECT * FROM tis_courses WHERE course_id ='$cstl' AND course_class='$st_cl_id' AND course_xkul='$xk_iid'");  
    $cnt_sel_crss=mysql_num_rows($sel_crss);
    if ($cnt_sel_crss==1) {
      $ft_sel_crss=mysql_fetch_assoc($sel_crss);
      $lesson=$ft_sel_crss['course_name'];
      $lesson_id=$ft_sel_crss['course_id'];
      //echo $crss." AND ".$cstl." AND ".$chp." AND ".$ovl." AND ".$valstt." AND ".$st_cl_id." AND ".$xk_iid." AND ".$lesson;
      $sel_sttt=mysql_query("SELECT * FROM tis_students WHERE student_class='$st_cl_id' AND student_xkul='$xk_iid'");
      $cnt_sel_sttt=mysql_num_rows($sel_sttt);
      $task_temp=rand(0,9999);
      if ($cnt_sel_sttt>0) {
      $sel_ch_ttsk=mysql_query("SELECT * FROM tis_tasks WHERE task_course='$lesson_id' AND task_title='$chp' AND task_overall='$ovl' AND task_xkul='$xk_iid' AND task_teacher='$tchr_id' AND task_type='$valstt' AND task_class='$st_cl_id' AND ((task_status='$mdstt') OR (task_status='$ntstt'))");
      $cnt_sel_ch_ttsk=mysql_num_rows($sel_ch_ttsk);
      if ($cnt_sel_ch_ttsk>0) {
        echo "This task has been already registered, check it out ...";
      }else{
    $in_tsk=mysql_query("INSERT INTO tis_tasks VALUES (null,'$lesson_id','$st_cl_id','$tchr_id','$xk_iid','$ovl','$chp','$valstt','$stt','$reg_date','$task_temp')")or die(mysql_error());
      if ($in_tsk) {
        $sel_tsksk=mysql_query("SELECT * FROM tis_tasks WHERE task_temp='$task_temp' AND task_course='$lesson_id' AND task_teacher='$tchr_id' AND task_overall='$ovl' AND task_type='$valstt' AND task_xkul='$xk_iid' AND ((task_status='$mdstt') OR (task_status='$ntstt'))");
        $cnt_sel_tsksk=mysql_num_rows($sel_tsksk);
        if ($cnt_sel_tsksk==1) {
          $ft_sel_tsksk=mysql_fetch_assoc($sel_tsksk);
          $tsk_iiddi=$ft_sel_tsksk['task_id'];
          while ($fft_sel_sttt=mysql_fetch_assoc($sel_sttt)) {
            $ft_stid=$fft_sel_sttt['student_id'];
            $inmrk=mysql_query("INSERT INTO tis_task_marks VALUES(null,'$ft_stid','0','$ovl','$tsk_iiddi','$st_cl_id','$tchr_id','$xk_iid','$st_m','$reg_date')")or die(mysql_error());
          }
          if ($inmrk) {
            $sel_cnt_tt=mysql_query("SELECT * FROM tis_count_teacher_tasks WHERE count_task_teacher='$tchr_id' AND count_task_xkul='$usr_id' AND count_tt_last_date BETWEEN '".$acal['start']."' AND '".$acal['close']."'")or die(mysql_error());
            if (mysql_num_rows($sel_cnt_tt)==0) {
              $in_cnt_tt=mysql_query("INSERT INTO tis_count_teacher_tasks VALUES(null,'$tchr_id','1','0','$reg_date','$usr_id')")or die(mysql_error());
      echo "<span id='resp_sp'>**Task Registered Successfully---1**</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        window.location.reload(true);
      }
    window.setTimeout(hhidef,3000);

      $("#tsskclss,#tsklssn,#tskttl,#tskovll").val("");
      $("#cnt_chr_resp").html("");
  </script>
      <?php
            }else{
              $new_cnt_tsk_cnt=mysql_fetch_assoc($sel_cnt_tt)['count_tt_count']+1;
              $up_cnt_tt=mysql_query("UPDATE tis_count_teacher_tasks SET count_tt_count='$new_cnt_tsk_cnt' WHERE count_task_teacher='$tchr_id' AND count_task_xkul='$usr_id' AND count_tt_last_date BETWEEN '".$acal['start']."' AND '".$acal['close']."'")or die(mysql_error());
      echo "<span id='resp_sp'>*Task Registered Successfully---2*</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        window.location.reload(true);
      }
    window.setTimeout(hhidef,3000);

      $("#tsskclss,#tsklssn,#tskttl,#tskovll").val("");
      $("#cnt_chr_resp").html("");
  </script>
      <?php
            }
          }
        }else{
          echo "<b><h3>Action Failed : ERROR 71 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }
      }else{
        echo "Class task registration faied. || Please try again later...";
      }
      }
      
      }else{
        echo "<b><h5>You can't set TASK on a class which doesn't contain any student. || Please Request for students in that class...</h5></b>";
      }
    }else{
      echo "<b><h3>Action Failed : ERROR 21 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
    }
  }else{
    echo "<b><h3>Action Failed : ERROR 65 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }

}

//-------------------------------------------------------------------------------------------------------------CHANGING PASSSWORD-------
if (isset($_GET['cngpss'])) {
  $crnt_pss=mysql_real_escape_string(stripslashes($_GET['crPss']));
  $new_pss=mysql_real_escape_string(stripslashes($_GET['nwPss']));
  $comf_pss=mysql_real_escape_string(stripslashes($_GET['cmfPss']));
if (isset($_SESSION['seveeen_tis_teacher_id'])) {
  $sel=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id='$tchr_id'");
  $ftt=mysql_fetch_assoc($sel);
  $cnt_sel=mysql_num_rows($sel);
  if ($cnt_sel==1) {
    $np_lng=strlen($new_pss);
    $usrr_pss=$ftt['teacher_password'];
    if ($crnt_pss==$usrr_pss) {
      if ($np_lng>7) {
        if ($np_lng<37) {
            $updt_pss=mysql_query("UPDATE tis_teachers SET teacher_password='$new_pss' WHERE teacher_id='$tchr_id' AND teacher_school='$usr_id' AND teacher_password='$usrr_pss'")or die(mysql_error());
            if ($updt_pss) {
              echo "<span id='ressc' style='color:#a9ace7;font-weight:bolder;font-size:17px'>Password updated Successful | LOGOUT to be sure..</span>";
                        ?>

                <script type="text/javascript">
                    $("#curr_pass,#new_pass,#conf_pass").val("");
                </script>
                    <?php
            }else{
              echo "<span id='ressc'>Password updating failed..</span>";
            }
        }else{
          echo "<span id='ressc'>Too long | Password range : <b> 8-36</b> characters.</span>";  
          }
      }else{
          echo "<span id='ressc'>Too short | Password range : <b> 8-36</b> characters.</span>"; 
          }
    }else{
      ?>
      <script> 
  function Redirect() {     window.location="libs/parts/logout.php"; }  
  document.getElementById("resp_chg_pss").innerHTML="Wrong Password | You will be redirected to main page in 4 sec"; setTimeout('Redirect()', 4000);
      </script>
      <?php
    }
  }else{
    echo "<span id='ressc'>Your Changing Password failed  Unfortunately.</span>";
  }
}else{
  $sel=mysql_query("SELECT * FROM tis_schools WHERE school_id='$usr_id'");
  $ftt=mysql_fetch_assoc($sel);
  $cnt_sel=mysql_num_rows($sel);
  if ($cnt_sel==1) {
    $np_lng=strlen($new_pss);
    $usrr_pss=$ftt['school_password'];
    if ($crnt_pss==$usrr_pss) {
      if ($np_lng>7) {
        if ($np_lng<37) {
            $updt_pss=mysql_query("UPDATE tis_schools SET school_password='$new_pss' WHERE school_id='$usr_id' AND school_password='$usrr_pss'")or die(mysql_error());
            if ($updt_pss) {
              echo "<span id='ressc' style='color:#a9ace7;font-weight:bolder;font-size:17px'>Password updated Successful | LOGOUT to be sure..</span>";
                        ?>

                <script type="text/javascript">
                    $("#curr_pass,#new_pass,#conf_pass").val("");
                </script>
                    <?php
            }else{
              echo "<span id='ressc'>Password updating failed..</span>";
            }
        }else{
          echo "<span id='ressc'>Too long | Password range : <b> 8-36</b> characters.</span>";  
          }
      }else{
          echo "<span id='ressc'>Too short | Password range : <b> 8-36</b> characters.</span>"; 
          }
    }else{
      ?>
      <script> 
  function Redirect() {     window.location="libs/parts/logout.php"; }  
  document.getElementById("resp_chg_pss").innerHTML="Wrong Password | You will be redirected to main page in 4 sec"; setTimeout('Redirect()', 4000);
      </script>
      <?php
    }
  }else{
    echo "<span id='ressc'>Your Changing Password failed  Unfortunately.</span>";
  }
}
}

//----------------------------------------------------------------------EXCEL
if (isset($_GET['okatt'])) {
  echo "ok";
}

//---------------------------------------------------------------------------------------------------------------------------CHANGE  OVERALL VALUE
if (isset($_GET['sstNwOvvl'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cngOvrllMks").removeAttr("disabled");
  });
</script>
  <?php
  $oldiid=mysql_real_escape_string(stripslashes($_GET['taskid']));
  $newvvld=mysql_real_escape_string(stripslashes($_GET['taskNewId']));//new task averall
  $selupd_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$oldiid' AND task_xkul='$usr_id' AND ((task_status='$mdstt') OR (task_status='$ntstt'))")or die(mysql_error());
  $cnt_selupd_tsk=mysql_num_rows($selupd_tsk);
  if ($cnt_selupd_tsk==1) {
      $sel_tsssk=mysql_query("SELECT * FROM tis_task_marks WHERE task_marks_task='$oldiid' AND task_marks_xkul='$usr_id' AND task_marks_teacher='$tchr_id'");
      $cnn_sel_tsssk=mysql_num_rows($sel_tsssk);
      if ($cnn_sel_tsssk>0) {
        while ($ft_sel_tsssk=mysql_fetch_assoc($sel_tsssk)) {
          $tsk_mkk_id=$ft_sel_tsssk['task_marks_id'];//tsk id
          $tsk_ovrl_old=$ft_sel_tsssk['task_marks_overall'];//old task averall
          $tsk_mmkkss=$ft_sel_tsssk['task_marks_marks'];//old task_marks
          $new_tsk_mmrk=round($tsk_mmkkss*$newvvld/$tsk_ovrl_old,2);//new task marks
          $upd_ts_mk=mysql_query("UPDATE tis_task_marks SET task_marks_marks='$new_tsk_mmrk',task_marks_overall='$newvvld' WHERE task_marks_id='$tsk_mkk_id' AND task_marks_task='$oldiid' AND task_marks_xkul='$usr_id'")or die(mysql_error());
          if ($upd_ts_mk) {
            $s=true;
          }else{
            $s=false;
          }
          
        }
      }
      $upd_tsk=mysql_query("UPDATE tis_tasks SET task_overall='$newvvld' WHERE task_id='$oldiid' AND task_xkul='$usr_id'")or die(mysql_error());
      if ($upd_tsk && $s) {
        echo "<span id='resp_sp' style='font-size:18px;'>Changed successfully...</span>";
echo "<script type='text/javascript'> window.location.reload(true);</script>";
}else{
        echo "Updating  failed. || Please try again later...";
      }
  }else{
    echo "<b><h3>ERROR C1-a Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }
}

//-------------------------------------------------------------------------------------------------------------------------------DELETING TASK
if (isset($_GET['deltTtsk'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#deltTtsk").removeAttr("disabled");
  });
</script>
  <?php
  $tskkidd=mysql_real_escape_string(stripslashes($_GET['taskid']));
  $sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$tskkidd' AND task_xkul='$usr_id' AND task_teacher='$tchr_id' AND ((task_status='$mdstt') OR (task_status='$ntstt'))");
  $cnt_sel_tsk=mysql_num_rows($sel_tsk);
  if ($cnt_sel_tsk==1) {
    $ft_sel_tsk=mysql_fetch_assoc($sel_tsk);
    $task_stt=$ft_sel_tsk['task_status'];
    $newstt=$task_stt."Del";
    $del_tsk=mysql_query("DELETE FROM tis_tasks WHERE task_id='$tskkidd' AND task_xkul='$usr_id' AND task_teacher='$tchr_id'")or die(mysql_error());
    if ($del_tsk) {
      $sel_mrk_tt=mysql_query("SELECT * FROM tis_task_marks WHERE task_marks_task='$tskkidd' AND task_marks_xkul='$usr_id' AND task_marks_teacher='$tchr_id'")or die(mysql_error());
      $cnt_sel_mrk_tt=mysql_num_rows($sel_mrk_tt);
      if ($cnt_sel_mrk_tt>0) {
        $newstt="Del";
        $del_mmks=mysql_query("DELETE FROM tis_task_marks WHERE task_marks_task='$tskkidd' AND task_marks_xkul='$usr_id' AND task_marks_teacher='$tchr_id'")or die(mysql_error());
        if ($del_mmks) {
?>
      <script> 
  function rediRect() {     window.close(); }  
  document.getElementById("deltssbd").innerHTML="<span style='color:#03481d;font-weight:bolder;font-size:16px;font-style: oblique;'>Deleted Successfully</span>"; setTimeout('rediRect()', 2000);
      </script>
<?php       }else{
          echo "<b><h3>ERROR C2-a Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }

      }
    }else{
      echo "<b><h3>ERROR C3-a Occured. || Please contact Administrator to solve this issue...</h3></b>";
    }
  }
}
//--------------------------------------------------------------------------------------------------------------------GENERAL TASKS DATEPICKER
if (isset($_GET['dtpp'])) {
  $acal=new AcademicCalendar;
  //echo json_encode($_SESSION);exit;
  $activeCal=json_decode($acal->getActiveCalendar(array("uid"=>$_SESSION['seveeen_tis_usr_id'],"cate"=>"active")),TRUE)[0];
  $pckdate=mysql_real_escape_string(stripslashes($_GET['ourdate']));
  $ourdate=mysql_real_escape_string(stripslashes($_GET['ourdate']));
  $status=mysql_real_escape_string(stripslashes($_GET['status']));
  $statusAddQuery="";
  //setup taks view if teacher show his own otherwise show all for the school
  if(isset($_SESSION['seveeen_tis_teacher_id'])){
    $statusAddQuery.=" AND tis_tasks.task_teacher='".$_SESSION['seveeen_tis_teacher_id']."'";
  }
  if($status!='default'){
    $statusAddQuery.=" AND tis_tasks.task_status='$status'";
  }
  if($ourdate!=''){
    $statusAddQuery.=" AND tis_tasks.task_date LIKE '$ourdate%'";
  }
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
                  <th>Class</th>
                  <th>Teacher</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Overall Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
  </thead>
  <tfoot>
                  <th>Class</th>
                  <th>Teacher</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Overall Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
  </tfoot>
  <tbody>
    <?php
$sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_xkul='$usr_id' AND task_date BETWEEN '".$activeCal['start']."' AND '".$activeCal['close']."' ".$statusAddQuery." order by task_class asc")or die(mysql_error());
$cnt_sel_tsk=mysql_num_rows($sel_tsk);
if ($cnt_sel_tsk>0) {
  while ($ft_sel_tsk=mysql_fetch_assoc($sel_tsk)) {
    $tsk_id=$ft_sel_tsk['task_id'];
    $tsk_tchr=$ft_sel_tsk['task_teacher'];
    $tsk_cls=$ft_sel_tsk['task_class'];
    $tsk_cours=$ft_sel_tsk['task_course'];
    $taskk_id=dt_enc($tsk_id+2018);
    $tsk_tchrrr=dt_enc($tsk_tchr+2018);
    $sel_tchr=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id='$tsk_tchr' AND teacher_school='$usr_id'")or die(mysql_error());
    $cnt_sel_tchr=mysql_num_rows($sel_tchr);
    if ($cnt_sel_tchr==1) {
      $ft_sel_tcr=mysql_fetch_assoc($sel_tchr);
      $ttthr_task=$ft_sel_tcr['teacher_fullname'];
    }else{
      echo "<h7 style='color:red'><center>ERROR: 27 -A Something went wrong... ||  Please contact your administrator</center></h7>";
    }

    $sel_crsr=mysql_query("SELECT * FROM tis_courses WHERE course_id='$tsk_cours' AND course_xkul='$usr_id' AND LEFT(course_date,4)='".date("Y")."'")or die(mysql_error());
    $cccrs_task="";
    $cnt_sel_crsr=mysql_num_rows($sel_crsr);
    if ($cnt_sel_crsr==1) {
      $ft_sel_crss=mysql_fetch_assoc($sel_crsr);
      $cccrs_task=$ft_sel_crss['course_name'];
    }else{
      echo "<h7 style='color:red'><center>ERROR: 28 -A Something went wrong... ||  Please contact your administrator</center></h7>";
    }

    $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$tsk_cls' AND class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."'")or die(mysql_error());
    $cccls_task="";
    $cnt_sel_cls=mysql_num_rows($sel_cls);
    if ($cnt_sel_cls==1) {
      $ft_sel_clss=mysql_fetch_assoc($sel_cls);
      $cccls_task=$ft_sel_clss['class_name'];
    }else{
      echo "<h7 style='color:red'><center>ERROR: 28 -B Something went wrong... ||  Please contact your administrator</center></h7>";
    }
    ?>
<tr>
  <td>
    <?php
    echo $cccls_task;
    ?>
  </td>
  <td>
    <?php
    echo "<span style='font-size:11px;font-weight:bolder'>".$ttthr_task."</span>";
    ?>
  </td>
  <td>
    <?php
    echo $cccrs_task;
    ?>
  </td>
  <td>
    <?php
    echo $ft_sel_tsk['task_title'];
    ?>
  </td>
  <td>
    <?php
    echo $ft_sel_tsk['task_overall'];
    ?>
  </td>
  <td>
    <?php
     if ($ft_sel_tsk['task_type']=="workss") {
      echo $task_ttype="Work";
    }elseif ($ft_sel_tsk['task_type']=="quizess") {
      echo $task_ttype="Quiz";
    }elseif ($ft_sel_tsk['task_type']=="testss") {
      echo $task_ttype="Test";
    }elseif ($ft_sel_tsk['task_type']=="examss") {
      echo $task_ttype="Exam";
    }else{

    }
    ?>
  </td>
  <td>
    <?php
    if ($ft_sel_tsk['task_status']=='Ny') {
      echo "<a href='../actions/task_marks.php?rei=$taskk_id&rrr=$tsk_tchrrr' id='ntyt' target='_blank' >Not Yet</a>";
    }elseif ($ft_sel_tsk['task_status']=='Md') {

      echo "<a href='../actions/task_marks.php?rei=$taskk_id&rrr=$tsk_tchrrr' id='mrkd' target='_blank'>Marked</a>";
    }
    ?>
  </td>
  <td>
     <?php
    echo $ft_sel_tsk['task_date'];
    ?>
  </td>

</tr>
    <?php
  }
}else{
  echo "<center style='color:red'><b><h3>None of Teachers created any task on this day ( <font color='blue'>".$pckdate." </font>) ...</h3></b></center>";
}
    ?>
  </tbody>
</table>
<?php
}
//------------------------------------------------------------------------------------------------------------CLASS TASKS DATEPICKER
if (isset($_GET['cldtpp'])) {
  $clid=mysql_real_escape_string(stripcslashes($_GET['ccllidtsk']));
  $pckdate=mysql_real_escape_string(stripcslashes($_GET['ourdate']));
  $status=mysql_real_escape_string(stripcslashes($_GET['status']));
  $statusAddQuery="";
  if($status!='default'){
    $statusAddQuery.=" AND tis_tasks.task_status='$status'";
  }
  if($pckdate!=''){
    $statusAddQuery.=" AND (task_date LIKE '$pckdate%')";
  }
?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#Count</th>
                  <th>Course</th>
                  <th>Teacher</th>
                  <th>Title</th>
                  <th>Overall</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Count</th>
                  <th>Course</th>
                  <th>Teacher</th>
                  <th>Title</th>
                  <th>Overall</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
<?php
  $sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_class='$clid' AND task_xkul='$usr_id' AND ((task_status='$mdstt') OR (task_status='$ntstt')) ".$statusAddQuery." order by task_date desc")or die(mysql_error());
  $cnt_sel_tsk=mysql_num_rows($sel_tsk);
  if ($cnt_sel_tsk>0) {
    $i=1;
    while ($ft_sel_tsk=mysql_fetch_assoc($sel_tsk)) {
      $tsk_id=$ft_sel_tsk['task_id'];
      $tsk_crs=$ft_sel_tsk['task_course'];
      $tsk_tchr=$ft_sel_tsk['task_teacher'];
$taskk_id=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($tsk_id+2018)))))))));
$tsk_tchrrr=base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($tsk_tchr+2018)))))))));
      $sel_crs=mysql_query("SELECT * FROM tis_courses WHERE course_id='$tsk_crs' AND course_teacher='$tsk_tchr' AND course_xkul='$usr_id'")or die(mysql_error());
      $cnt_sel_crs=mysql_num_rows($sel_crs);
      if ($cnt_sel_crs==1) {
        $ft_sel_crs=mysql_fetch_assoc($sel_crs);
        $crs_nm=$ft_sel_crs['course_name'];
      }else{
        echo "<h7 style='color:red'><center>ERROR: 13 -A Something went wrong... ||  Please contact your administrator</center></h7>";
      }
      $sel_tchr=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id='$tsk_tchr' AND teacher_school='$usr_id'");
      $cnt_sel_tchr=mysql_num_rows($sel_tchr);
      if ($cnt_sel_tchr) {
        $ft_sel_tchr=mysql_fetch_assoc($sel_tchr);
        $tcr_nm=$ft_sel_tchr['teacher_fullname'];
      }else{
        echo "<h7 style='color:red'><center>ERROR: 24 -A Something went wrong... ||  Please contact your administrator</center></h7>";
      }
      ?>
      <tr>
        <td>
          <?php
          echo $i;
          ?>
        </td>
        <td>
          <?php
          echo $crs_nm;
          ?>
        </td>
        <td>
          <?php
          echo "<span id='tbl_tcr_nmm'>".$tcr_nm."</span>";
          ?>
        </td>
        <td>
          <?php
          echo $ft_sel_tsk['task_title'];
          ?>
        </td>
        <td>
          <?php
          echo $ft_sel_tsk['task_overall'];
          ?>
        </td>
        <td>
    <?php
     if ($ft_sel_tsk['task_type']=="workss") {
      echo $task_ttype="Work";
    }elseif ($ft_sel_tsk['task_type']=="quizess") {
      echo $task_ttype="Quiz";
    }elseif ($ft_sel_tsk['task_type']=="testss") {
      echo $task_ttype="Test";
    }elseif ($ft_sel_tsk['task_type']=="examss") {
      echo $task_ttype="Exam";
    }else{

    }
    ?>
        </td>
        <td>
          <?php
    if ($ft_sel_tsk['task_status']=='Ny') {
      echo "<a href='../actions/task_marks.php?rei=$taskk_id&rrr=$tsk_tchrrr' id='ntyt' target='_blank' >Not Yet</a>";
    }elseif ($ft_sel_tsk['task_status']=='Md') {

      echo "<a href='../actions/task_marks.php?rei=$taskk_id&rrr=$tsk_tchrrr' id='mrkd' target='_blank'>Marked</a>";
    }
          ?>
        </td>
        <td>
          <?php
          echo $ft_sel_tsk['task_date'];
          ?>
        </td>
      </tr>
      <?php
      $i++;
    }
  }else{
    ?>
<tr>
  <td colspan="7">
    <?php
    echo "<h1 style='color:red'><center>No Task Available ".($pckdate!=''?"on this day ( <font color='blue'>".$pckdate." </font>)":"")." </center></h1>";
    ?>
  </td>
</tr>
    <?php
  }
?>       
              </tbody>
            </table>
<?php
}
//--------------------------------------------------------------------------------------------------------------------TEACHER TASKS DATEPICKER
if (isset($_GET['tchdtpp'])) {
  $tchriid=mysql_real_escape_string(stripcslashes($_GET['tchrridd']));
  $ourdate=mysql_real_escape_string(stripcslashes($_GET['ourdate']));
  $status=mysql_real_escape_string(stripcslashes($_GET['status']));
  $statusAddQuery="";
  if($status!='default'){
    $statusAddQuery.=" AND tis_tasks.task_status='$status'";
  }
  if($ourdate!=''){
    $statusAddQuery.=" AND (tis_tasks.task_date LIKE '$ourdate%')";
  }
  //echo "SELECT tis_tasks.*,tis_teachers.teacher_fullname,tis_courses.course_name,tis_classes.class_name FROM tis_tasks INNER JOIN tis_teachers ON tis_teachers.teacher_school='$usr_id' INNER JOIN tis_courses ON tis_courses.course_id=tis_tasks.task_course AND tis_courses.course_teacher=tis_teachers.teacher_id INNER JOIN tis_classes ON tis_classes.class_id=tis_tasks.task_class AND tis_courses.course_class=tis_classes.class_id WHERE task_teacher='$tchriid' AND task_xkul='$usr_id' ".$statusAddQuery." order by task_date desc";exit;
$sel_task=mysql_query("SELECT tis_tasks.*,tis_teachers.teacher_fullname,tis_courses.course_name,tis_classes.class_name FROM tis_tasks INNER JOIN tis_teachers ON tis_teachers.teacher_school='$usr_id' INNER JOIN tis_courses ON tis_courses.course_id=tis_tasks.task_course AND tis_courses.course_teacher=tis_teachers.teacher_id INNER JOIN tis_classes ON tis_classes.class_id=tis_tasks.task_class AND tis_courses.course_class=tis_classes.class_id WHERE task_teacher='$tchriid' AND task_xkul='$usr_id' ".$statusAddQuery." order by task_date desc");
$cnt_sel_task=mysql_num_rows($sel_task);
?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Class</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Overall Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Class</th>
                  <th>Course</th>
                  <th>Title</th>
                  <th>Overall Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
                <?php 
                $taskType=array("workss"=>"Work","quizess"=>"Quiz","testss"=>"Test","examss"=>"Exam");
                while ($ft=mysql_fetch_assoc($sel_task)) {
                  echo "<tr><td>".$ft['class_name']."</td><td>".$ft['course_name']."</td><td>".$ft['task_title']."</td><td>".$ft['task_overall']."</td><td>".$taskType[$ft['task_type']]."</td><td>".($ft['task_status']=='Ny'?'Not Yet':($ft['task_status']=='Md'?'Marked':''))."</td><td>".$ft['task_date']."</td>";
                }
                 ?>
             </tbody>
            </table>
<?php
}
//--------------------------------------------------------------------------------------------------------DATEPICKER TEACHER VIEW TASKS
if (isset($_GET['vwdtpck'])) {
$val_stts=mysql_real_escape_string(stripslashes($_GET['tsktp']));
$ourdt=mysql_real_escape_string(stripslashes($_GET['ourdate']));
?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Class</th>
                  <th>Lesson</th>
                  <th>Title</th>
                  <th>Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Class</th>
                  <th>Lesson</th>
                  <th>Title</th>
                  <th>Marks</th>
                  <th>Category</th>
                  <th>Marking status</th>
                  <th>Date</th>
                </tr>
              </tfoot>
              <tbody>
<?php
$ntstt="Ny";
$mdstt="Md";
$sel_tasts=mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tchr_id' AND task_xkul='$usr_id' AND task_type='$val_stts' AND ((task_status='$mdstt') OR (task_status='$ntstt')) AND (task_date LIKE '$ourdt%')");
$cnt_sel_tasts=mysql_num_rows($sel_tasts);
if ($cnt_sel_tasts>0) {
  while ($ft_sel_tasts=mysql_fetch_assoc($sel_tasts)) {
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
    $tsk_dtls=dt_enc($ft_sel_tasts['task_id']+2018);
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
}else{
  echo "<h1 style='color:red'><center>No Task Available on this day ( <font color='blue'>".$ourdt." </font>) </center></h1>";
}
?>              
              </tbody>
            </table>
<?php
}


//--------------------------------------------------------------------------------------------------------------SEE TOTAL TASK
if (isset($_GET['seeTotalTask'])) {
  $task_course=mysql_real_escape_string(stripslashes($_GET['taskResson']));
  $task_teacher=mysql_real_escape_string(stripslashes($_GET['taskTeacher']));
  $task_type=mysql_real_escape_string(stripslashes($_GET['taskType']));
  $task_class=mysql_real_escape_string(stripslashes($_GET['taskClass']));
  $task_iid=mysql_real_escape_string(stripslashes($_GET['taskIdd']));
$seletskk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$task_iid' AND task_xkul='$usr_id'");
if (mysql_num_rows($seletskk)==1) {
  $ft_qq=mysql_fetch_assoc($seletskk);
  $t_cl=$ft_qq['task_class'];//class
  $t_crs=$ft_qq['task_course'];//course
  $t_tp=$ft_qq['task_type'];//type
  $sel_stt=mysql_query("SELECT * FROM tis_students WHERE student_class='$t_cl' AND student_xkul='$usr_id' ORDER BY student_fullname ASC")or die(mysql_error());
    echo "<table><thead><tr><th></th><th></th></tr></thead><tbody><tr><td>";
    echo "<table  class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
    echo "<thead><th>Names</th><th colspan='20'><center>Marks</center></th></thead>";
  if (mysql_num_rows($sel_stt)>0) {
    $e=1;
    while ($fft_sel_stt=mysql_fetch_assoc($sel_stt)) {
      ?>
      <tr id="trtrmmk">
      <?php
      $sst_id=$fft_sel_stt['student_id'];
      echo "<td>".$e.") ".$fft_sel_stt['student_fullname']."</td>";
      $sel_tsk_mrk=mysql_query("SELECT * FROM tis_task_marks WHERE task_mark_student='$sst_id' AND task_marks_xkul='$usr_id'")or die(mysql_error());
      while ($ft_sel_tsk_mrk=mysql_fetch_assoc($sel_tsk_mrk)) {
        $tsk_mmh_id_tsk=$ft_sel_tsk_mrk['task_marks_task'];
        $sel_qmmk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$tsk_mmh_id_tsk' AND task_xkul='$usr_id'")or die(mysql_error());
        $cnt_sel_qmmk=mysql_num_rows($sel_qmmk);
        if ($cnt_sel_qmmk==1) {
          $ft_sel_qmmk=mysql_fetch_assoc($sel_qmmk);
          if ($ft_sel_qmmk['task_course']==$t_crs /*&& $ft_sel_qmmk['task_type']==$t_tp */&& $ft_sel_qmmk['task_class']==$t_cl) {
            echo "<td>".$ft_sel_tsk_mrk['task_marks_marks']."/".$ft_sel_tsk_mrk['task_marks_overall']."</td>";
          }
        }else{
        }
      }
      $e++;
      ?>
      </tr>
      <?php
    }
    echo "</table></td><td style='vertical-align:top'><button id='bcckstt' onclick='return window.location.reload(true);' class='btn btn-link'><span id='crclarback' class='glyphicon glyphicon-circle-arrow-left'></span>&nbsp;&nbsp;Back</button><td><tr></tbody></table>";
  }
}else{
  echo "<b><h3>ERROR E4 J Occured. || Please contact Administrator to solve this issue...</h3></b>";
}







?>       <center>
              <button class="btn btn-info" style=" float: right;" id="prnt_btn_crt" onclick="prntPdfSeeTtl()"><span class="glyphicon glyphicon-print" style="font-size: 20px"></span>&nbsp&nbspPrint PDF</button>
          </center>
<?php
}

//-----------------------------------------------------------------------------------UPDATING MARKS------------------
if (isset($_GET['updNwMk'])) {
$additionalWhere="";$additionalWhere1="";
  $cntt=mysql_real_escape_string(stripslashes($_GET['wCnt']));
$stdnt=mysql_real_escape_string(stripslashes($_GET['sstid']));
$ttsk=mysql_real_escape_string(stripslashes($_GET['tskkid']));
$mmks=mysql_real_escape_string(stripslashes($_GET['mmkksss']));
//calendar based selection
$activeCal=new AcademicCalendar;
  //echo json_encode($_SESSION);exit;
  $acal=json_decode($activeCal->getActiveCalendar(array("uid"=>$_SESSION['seveeen_tis_usr_id'],"cate"=>"active")),TRUE)[0];
if(gettype($acal)=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '".$acal['start']."' AND '".$acal['close']."'";
        $additionalWhere1.=" AND tis_tasks.task_date BETWEEN '".$acal['start']."' AND '".$acal['close']."'";
      }
      //end calendar based selection
$ssemmk=mysql_query("SELECT * FROM tis_task_marks  WHERE task_marks_xkul='$usr_id' AND task_marks_task='$ttsk' AND task_mark_student='$stdnt'")or die(mysql_error());
$tk_st=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$ttsk' AND task_xkul='$usr_id'")or die(mysql_error());
$f_stk_st=mysql_fetch_assoc($tk_st)['task_status'];
$upd_mrk_sst=mysql_query("UPDATE tis_task_marks SET task_marks_marks='$mmks' WHERE task_marks_xkul='$usr_id' AND task_marks_task='$ttsk' AND task_mark_student='$stdnt'")or die(mysql_error());
if ($upd_mrk_sst) {
  $uptssk=mysql_query("UPDATE tis_tasks SET task_status='$mdstt' WHERE task_id='$ttsk' AND task_xkul='$usr_id'")or die(mysql_error());
  if ($uptssk) {
    //Asua-->Code check marked tasks
              $cnt_marked_task=mysql_num_rows(mysql_query("SELECT * FROM tis_tasks WHERE task_teacher='$tchr_id' AND task_xkul='$usr_id' AND task_status='Md'"));
//--------------------SELECT CURRENT TEACHER COUNT
$sl_cr__cnt_tt=mysql_query("SELECT * FROM tis_count_teacher_tasks WHERE count_task_teacher='$tchr_id' AND count_task_xkul='$usr_id' AND count_tt_last_date BETWEEN '$cal_start' AND '$cal_stop'")or die(mysql_error());
$ft_sl_cr_cnt_tt=mysql_fetch_assoc($sl_cr__cnt_tt);
$ft_sl_cr_cnt_tt_id=$ft_sl_cr_cnt_tt['count_tt_id'];  // Teacher's count id
// $sl_cr_cnt_tt_ttl=$ft_sl_cr_cnt_tt['count_tt_count'];
// $sl_cr_cnt_tt_ttl_nw=$sl_cr_cnt_tt_ttl+1;  //  TOTAL INCREMENTED
$sl_cr_cnt_tt_mkd=$ft_sl_cr_cnt_tt['count_tt_marked'];
$sl_cr_cnt_tt_mkd_nw=$sl_cr_cnt_tt_mkd+1; //  MARKED INCREMENTED


    $selt=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$ttsk' AND task_xkul='$usr_id' AND task_date BETWEEN '$cal_start' AND '$cal_stop'")or die(mysql_error());
    if (mysql_num_rows($selt)==1) {
      $ft_selt=mysql_fetch_assoc($selt);
      $tsk_cll=$ft_selt['task_class'];
    $sel_sst=mysql_query("SELECT * FROM tis_students WHERE student_class='$tsk_cll' AND student_xkul='$usr_id'")or die(mysql_error());
    $cnt_sst=mysql_num_rows($sel_sst);
    if ($_GET['wCnt']<$cnt_sst) {
      if ($f_stk_st=='Ny') {
        $up_cnt_tt=mysql_query("UPDATE tis_count_teacher_tasks SET count_tt_marked='$sl_cr_cnt_tt_mkd_nw' WHERE count_tt_id='$ft_sl_cr_cnt_tt_id' AND count_task_teacher='$tchr_id' AND count_task_xkul='$usr_id'")or die(mysql_error());
        if ($up_cnt_tt) {
          echo "Updating,please wait...";
        }else{
          echo "  Error RE 091";
        }
      }else{
        echo "  Updating,please wait...";
      }
    }else if($_GET['wCnt']>$cnt_sst){
      echo "  Error RE 090";
    }else{
      echo "<span id='uppuys' style='font-weightbolder;font-family:Gill Sans Ultra Bold;color:#774004'>Updated</span>.";
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#upd_mrks_btn").removeAttr("disabled");
  });
</script> 
  <?php
      ?>
      <script type="text/javascript">
        function hhidef(){
          $("#uppuys").hide();
        }
      window.setTimeout(hhidef,3000);

        $("#class_level,#class_name,#class_option,#class_option_mmre").val("");
      </script>
      <?php
    }
    }
  }else{
    echo "<b><h3>ERROR JK 56 Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }
}else{
  echo "<b><h3>ERROR AD 13 Occured. || Please contact Administrator to solve this issue...</h3></b>";
}
}
//---------------------------------------------------------------------------------------------------------------------------RANKING ONE TASK
if (isset($_GET['rnkOne'])) {
  $tsk_id=mysql_real_escape_string(stripslashes($_GET['tskId']));
  $tsk_tchr=mysql_real_escape_string(stripslashes($_GET['tskTchr']));
  $tsk_cls=mysql_real_escape_string(stripslashes($_GET['tskClss']));
  $tsk_crs=mysql_real_escape_string(stripslashes($_GET['tskCrs']));
  $sel_ttss_mmk=mysql_query("SELECT * FROM tis_task_marks WHERE task_marks_task='$tsk_id' AND task_marks_teacher='$tsk_tchr' AND task_marks_class='$tsk_cls' AND task_marks_xkul='$usr_id' ORDER BY task_marks_marks DESC")or die(mysql_error());
  if (mysql_num_rows($sel_ttss_mmk)>0) {
    ?>
<table>
  <tr>
    <td>
      <?php

    echo "<table class='table table-bordered' width='100%' cellspacing='0'>";
    echo "<thead><th>Rank</th><th>Names</th><th>Marks / ".mysql_fetch_assoc($sel_ttss_mmk)['task_marks_overall']."</th><th>Percentage</th></thead>";
    $rankk=1;
    while ($ft_sel_ttss_mmk=mysql_fetch_assoc($sel_ttss_mmk)) {
      $perc_mmk=$ft_sel_ttss_mmk['task_marks_marks']*100/$ft_sel_ttss_mmk['task_marks_overall'];
      if ($perc_mmk<50) {
      ?>
<style type="text/css">
  #sddsff<?php echo $rankk;?>{
  background-color: #f1f6f6;font-style: oblique italic;
}
  #perc<?php echo $rankk;?>{
    text-decoration: underline;
  }
</style>
      <?php
      }
      echo "<tr id='sddsff$rankk'>";
      $tsk_sstts=$ft_sel_ttss_mmk['task_mark_student'];
      $selstst=mysql_query("SELECT * FROM tis_students WHERE student_id='$tsk_sstts' AND student_xkul='$usr_id'")or die(mysql_error());
      if (mysql_num_rows($selstst)==1) {
        $ft_selstst=mysql_fetch_assoc($selstst);
        $sttnm=$ft_selstst['student_fullname'];
      }
      echo "<td><b>".$rankk."</b></td>";
      echo "<td>".$sttnm."</td>";
      echo "<td>".$ft_sel_ttss_mmk['task_marks_marks']."</td>";
      echo "<td id='perc$rankk'>".$perc_mmk." %</td>";
      echo "</tr>";
      $rankk++;
    }
    echo "</table>";
      ?>
    </td>
    <td style="vertical-align: top;">
      <button id='bcckstt' onclick='return window.location.reload(true);' class='btn btn-link'><span class='glyphicon glyphicon-circle-arrow-left'></span>&nbsp;&nbsp;Back</button>
    </td>
  </tr>
</table>
    <?php
  }
}



//-----------------------------------------------------------------------------------------------------COMMENTS
if (isset($_GET['cmt'])) {
  
  $cmt_xkll=mysql_real_escape_string(stripslashes($_GET['xklId']));
  $cmt_tchr=mysql_real_escape_string(stripslashes($_GET['thrId']));
  $cmt_status=mysql_real_escape_string(stripslashes($_GET['cmtStt']));
  $cmt_sence=mysql_real_escape_string(stripslashes($_GET['sence']));
  $inscmt=mysql_query("INSERT INTO tis_user_comments VALUES(null,'$cmt_tchr','$cmt_xkll','$cmt_status','$cmt_sence','$reg_date')")or die(mysql_error());
  if ($inscmt) {
    echo "<span id='resp_sp'>Thank you for your participation.</span>";
    ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#yrcmt,#cmt_resp button").hide();
  });
    window.setTimeout(hhidef,5000);
</script>
    <?php
  }
}


//-----------------------------------------------------------------------------COMBINE TASKS--------CHOOSE CLASS
if (isset($_GET['combChsCls'])) {
  $clsid=mysql_real_escape_string(stripslashes($_GET['cls_nm']));
  $sel_crss=mysql_query("SELECT * FROM tis_courses WHERE course_teacher='$tchr_id' AND course_class='$clsid' AND course_xkul='$usr_id' AND LEFT(course_date,4)='".date("Y")."'");
  if (mysql_num_rows($sel_crss)>0) {
    echo "<option value='default'>Select Course</optoin>";
    while ($ft_sel_crss=mysql_fetch_assoc($sel_crss)) {
    $crs_nm=$ft_sel_crss['course_name'];
    $crs_id=$ft_sel_crss['course_id'];
    echo "<option value='".$crs_id."'>".$crs_nm."</optoin>";
    }
  }else{
    echo "<option> ERROR FS 32 occured... Contact administrator.</option>";
  }
}
//-----------------------------------------------------------------------------COMBINE TASKS--------TASKS LIST
if (isset($_GET['combCombTstk'])) {
  $clss=mysql_real_escape_string(stripslashes($_GET['cls']));
  $crsee=mysql_real_escape_string(stripslashes($_GET['crs']));
echo "  <table width='100%' cellspacing='0' style='background-color:#fff'><tr><td><center style='margin-left: 30%;'><h2 align='center' class='list-group-item' id='crt_nw_cl_ttl_cmbb'>Available Tasks in this class</h2></center></td></tr><tr><td><table id='th_cl_ttl_cmbb' width='100%' cellspacing='0' class='table'><thead><tr><td colspan='4' style='color:#214601;font-family:Goudy Old Style;margin-top:-30px'><center><h6 style='font-weight:bolder;font-size:30px;background-color:#bbc2bc;'>Possible for <U>Marked tasks</U> only...</h6></center></td><tr><th>Select</th><th id='sdfe'>Title</th><th>Overall</th><th>Date</th></thead><tbody>";
$comb_seltsk_crs=mysql_query("SELECT * FROM tis_courses WHERE course_id='$crsee' AND course_class='$clss' AND course_xkul='$usr_id' AND course_teacher='$tchr_id' AND LEFT(course_date,4)='".date("Y")."'")or die(mysql_error());
if (mysql_num_rows($comb_seltsk_crs)==1) {
  $comb_sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_course='$crsee' AND task_class='$clss' AND task_teacher='$tchr_id' AND task_xkul='$usr_id' AND task_status='$mdstt' AND LEFT(task_date,4)='".date("Y")."' AND task_date BETWEEN '$cal_start' AND '$cal_stop'")or die(mysql_error());
  if (mysql_num_rows($comb_sel_tsk)>0) {
    while ($ft_comb_sel_tsk=mysql_fetch_assoc($comb_sel_tsk)) {
      echo "<tr>";
      echo "<td><input type='checkbox' name='cmbchxbx' value='".$ft_comb_sel_tsk['task_id']."' id='cmdch".$ft_comb_sel_tsk['task_id']."'></td>";
      echo "<td>".$ft_comb_sel_tsk['task_title']."</td>";
      echo "<td>".$ft_comb_sel_tsk['task_overall']."</td>";
      echo "<td>".$ft_comb_sel_tsk['task_date']."</td>";

      echo "</tr>";
?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#cmdch<?php echo $ft_comb_sel_tsk['task_id']?>").click(function(){
  var comckart=[];
  $("input:checkbox[name=cmbchxbx]:checked").each(function(){
    comckart.push($(this).val());
  });
  if (comckart.length<2) {
    $("#okcmb").hide();
  }else{
    $("#okcmb").show();
  }
    })
  })
</script>
<?php
    }
  }else{
    echo "<tr><td colspan='6'><center><h2><b><span style='color:#f00'><i>No Task Available.</i><span style='color:#435634;font-style:oblique;'>You <u>didn't set</u> any, or you setted them but you <u>didn't mark</u> them.</span></span></b></h2></center></td></tr>";
  }
}else{
  echo "<tr><td colspan='6'><center><h2><b><span style='color:#f00'>Error NT 21 occured... Please contact your administrator for help.</span></b></h2></center></td></tr>";
}

echo "</tbody></table><tbody></tbody></td></tr></table>";
}

//------------------------------------------------COMBINE--------------------------------YES,COMBINE----------------------------
if (isset($_GET['okCmbTsks'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#yscmb").removeAttr("disabled");
    $("#yscmn_ccl,#yscmb").hide();
  });
</script>
  <?php
  $tsk_cls=mysql_real_escape_string(stripslashes($_GET['clls']));//............CLASS
  $tsk_crs=mysql_real_escape_string(stripslashes($_GET['crrs']));//............COURSE
  $tsk_nttl=mysql_real_escape_string(stripslashes($_GET['nTtl']));//............NEW TITLE
  $tsk_nctgry=mysql_real_escape_string(stripslashes($_GET['nCtgy']));//............NEW CATEGORY
  $tsk_novll=mysql_real_escape_string(stripslashes($_GET['nOvll']));//............NEW OVERALL
  $tsk_comb=implode(",", $_GET['comckar']);
  //echo "ttl: ".$tsk_nttl.", cat: ".$tsk_nctgry.", Ovll: ".$tsk_novll;
  $sel_st_cll=mysql_query("SELECT * FROM tis_students WHERE student_class='$tsk_cls' AND student_xkul='$usr_id' AND LEFT(student_date,4)='".date("Y")."'")or die(mysql_error());
  if (mysql_num_rows($sel_st_cll)>0) {
    $ee=1;
      $task_temp=rand(0,9999);
      $inssstk=mysql_query("INSERT INTO tis_tasks VALUES(null,'$tsk_crs','$tsk_cls','$tchr_id','$usr_id','$tsk_novll','$tsk_nttl','$tsk_nctgry','$mdstt','$reg_date','$task_temp')")or die(mysql_error());
      if ($inssstk) {
        $rtt=true;
      }else{
        $rtt=false;
      }
    while ($ft_sel_st_cll=mysql_fetch_assoc($sel_st_cll)) {
      $ststid=$ft_sel_st_cll['student_id'];
    $sel_mks=mysql_query("SELECT * FROM tis_task_marks WHERE task_marks_task IN ($tsk_comb) AND task_mark_student IN ($ststid) AND LEFT(task_marks_date,4)='".date("Y")."' AND task_marks_date BETWEEN '$cal_start' AND '$cal_stop'")or die(mysql_error());
    $ttl_mks=0;$ttl_ovl=0;
    $eedef=0;//-----------------st-id
    $nwmmk=0;//-----------------new marks
    $rtt=true;//------------------to insert once
    $ccst=true;//-------------------to display response once
    if (mysql_num_rows($sel_mks)>0) {
      while ($ft_sel_mks=mysql_fetch_assoc($sel_mks)) {
        $ttl_ttsk=$ft_sel_mks['task_marks_task'];
        $eedef=$ft_sel_mks['task_mark_student'];
        $ttl_mks+=$ft_sel_mks['task_marks_marks'];
        $ttl_ovl+=$ft_sel_mks['task_marks_overall'];
        $nwmmk=round($ttl_mks*$tsk_novll/$ttl_ovl,2);

      }
      if ($rtt==true) {
        $sel_tskk=mysql_query("SELECT * FROM tis_tasks WHERE task_temp='$task_temp' AND task_class='$tsk_cls' AND task_course='$tsk_crs' AND task_xkul='$usr_id' AND task_teacher='$tchr_id' AND LEFT(task_date,4)='".date("Y")."' AND task_date BETWEEN '$cal_start' AND '$cal_stop'");
        if (mysql_num_rows($sel_tskk)==1) {
          $tf_sel_tskk=mysql_fetch_assoc($sel_tskk);
          $tsk_idi=$tf_sel_tskk['task_id'];
          $settt="E";
          $instkmmk=mysql_query("INSERT INTO tis_task_marks VALUES(null,'$eedef','$nwmmk','$tsk_novll','$tsk_idi','$tsk_cls','$tchr_id','$usr_id','$settt','$reg_date')")or die(mysql_error());
          if ($instkmmk) {
            $del_tsk=mysql_query("DELETE FROM tis_tasks WHERE task_id IN ($tsk_comb) AND task_teacher='$tchr_id' AND task_course='$tsk_crs' AND task_class='$tsk_cls' AND task_xkul='$usr_id'");
            if ($del_tsk) {
              $del_tsm_mmmk=mysql_query("DELETE FROM tis_task_marks WHERE task_marks_task IN ($tsk_comb) AND task_marks_class='$tsk_cls' AND task_marks_teacher='$tchr_id' AND task_mark_student='$eedef' AND task_marks_xkul='$usr_id'")or die(mysql_error());
              if ($del_tsm_mmmk) {
                $ccst=true;
              }else{
                echo "<b><h3>ERROR RE 10 Occured. || Please contact Administrator to solve this issue...</h3></b>";
                $ccst=false;
              }
            }else{
              echo "<b><h3>ERROR RE 11 Occured. || Please contact Administrator to solve this issue...</h3></b>";
            }
          }else{
            echo "<b><h3>ERROR RE 12 Occured. || Please contact Administrator to solve this issue...</h3></b>";
          }
        }else{
          echo "<b><h3>ERROR RE 13 Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }
      }
    }else{
      echo "No Marks";
    }
    $ee++;
    }
    if ($ccst==true) {
      echo "<span id='resp_sp'>Combined Successfully</span>";
      ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#combplwt").css("display","none");
    })
      function hhidef(){
        $("#resp_sp").hide();
        window.close();
      }
    window.setTimeout(hhidef,3000);
  </script>
      <?php
    }
  }else{
    echo "<b><h3>ERROR NZ 64 Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }

}

//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================


//------------------------------------------------------------Teacher student evaluation ----see course/class

if (isset($_GET['evTCrs'])) {
  $evclcl=mysql_real_escape_string(stripslashes(dt_dec($_GET['selCls'])));
  $sel_evclcrs=mysql_query("SELECT * FROM tis_courses WHERE course_class='$evclcl' AND course_xkul='$usr_id'")or die(mysql_error());
  if (mysql_num_rows($sel_evclcrs)<1) {
    echo "<option value='default' style='color:red;font-weight:bolder;'>No course available</option>";
  }else{
    while ($ft_sel_evclcrs=mysql_fetch_assoc($sel_evclcrs)) {
      echo "<script type='text/javascript'>  $(document).ready(function(){   $('#stEvCCrs').removeAttr('disabled');});</script>";
      echo "<option value='".dt_enc($ft_sel_evclcrs['course_id'])."'>".$ft_sel_evclcrs['course_name']."</option>";
    }
  }
}
//------------------------------------------------------------Teacher student evaluation ----see teacher/course
if (isset($_GET['seCrsThcr'])) {
  $ev_cls=mysql_real_escape_string(stripslashes(dt_dec($_GET['selCls'])));
  $ev_crs=mysql_real_escape_string(stripslashes(dt_dec($_GET['selCrs'])));
  $ev_prd=mysql_real_escape_string(stripslashes(dt_dec($_GET['selPrd'])));
  //echo $ev_cls."  -  ".$ev_crs;
  $seltchrcrs=mysql_query("SELECT * FROM tis_courses WHERE course_id='$ev_crs' AND course_class='$ev_cls' AND course_xkul='$usr_id'")or die(mysql_error());
  if (mysql_num_rows($seltchrcrs)==1) {
    $ft_seltchrcrs=mysql_fetch_assoc($seltchrcrs);
    $evtchev=$ft_seltchrcrs['course_teacher'];
    $seevtchtch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id='$evtchev' AND teacher_school='$usr_id'")or die(mysql_error());
    if (mysql_num_rows($seevtchtch)==1) {
      $ft_seevtchtch=mysql_fetch_assoc($seevtchtch);
      $tchreci=$ft_seevtchtch['teacher_id'];
      $sel_cnt_evtch=mysql_query("SELECT * FROM tis_st_t_evaluation WHERE st_t_class='$ev_cls' AND st_t_teacher='$tchreci' AND st_t_course='$ev_crs' AND st_t_period='$ev_prd'")or die(mysql_error());
      echo "<span style='color:#0d3304;font-weight:bolder;font-size:12px;'>".$ft_seevtchtch['teacher_fullname']."</span>";
      ?>

      <script type='text/javascript'>
        $(document).ready(function(){
            $('#maiCntEvv').show();
          });
      </script>
        <?php
      if (mysql_num_rows($sel_cnt_evtch)==0) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots0,#evdrmtms").show();
            $("#evdots1,#evdots2,#evdots3,#evdots4,#evdots5,#evdots6").hide();
          });
        </script>
        <?php
      }elseif (mysql_num_rows($sel_cnt_evtch)==1) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots1,#evdrmtms").show();
            $("#evdots0,#evdots2,#evdots3,#evdots4,#evdots5,#evdots6").hide();
          });
        </script>
        <?php
      }elseif (mysql_num_rows($sel_cnt_evtch)==2) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots2,#evdrmtms").show();
            $("#evdots1,#evdots0,#evdots3,#evdots4,#evdots5,#evdots6").hide();
          });
        </script>
        <?php
      }elseif (mysql_num_rows($sel_cnt_evtch)==3) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots3,#evdrmtms").show();
            $("#evdots1,#evdots2,#evdots0,#evdots4,#evdots5,#evdots6").hide();
          });
        </script>
        <?php
      }elseif (mysql_num_rows($sel_cnt_evtch)==4) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots4,#evdrmtms").show();
            $("#evdots1,#evdots2,#evdots3,#evdots0,#evdots5,#evdots6").hide();
          });
        </script>
        <?php
      }elseif (mysql_num_rows($sel_cnt_evtch)==5) {
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots5,#evdrmtms").show();
            $("#evdots1,#evdots2,#evdots3,#evdots4,#evdots0,#evdots6").hide();
          });
        </script>
        <?php
      }else{
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#evdots6,#evdrmtms").show();
            $("#evdots1,#evdots2,#evdots3,#evdots4,#evdots5,#evdots0").hide();
          });
        </script>
        <?php
      }
      //echo "period: ".$ev_prd."<br>";
      //echo "course: ".$ev_crs."<br>";
      //echo "class: ".$ev_cls."<br>";
      //echo "Teacher: ".$ft_seevtchtch['teacher_fullname']."<br>";
      //echo mysql_num_rows($sel_cnt_evtch);
    }else{
      "<center style='color:red;font-weight:bolder;position:relative'><h6>ERROR N-21, contact administrator...</h6></center>";
    }
  }else{
    echo "<center style='color:red;font-weight:bolder;position:relative;'><h6><b>Choose course First ...</b></h6></center>";
  }
}
//-------------------------------------------------------------------------on SUBMIT EV TECHER STUDENT
if (isset($_GET['evTchrStd'])) {
if(count($acal)==0){echo "<font color='red' size='4'>Sorry this Operation can be done only during academic trimester</font>";exit;}
  $evSpStTchrPrd=mysql_real_escape_string(stripslashes($_GET['evSpStTchrPrd']));
  $evSpStTchrCls=mysql_real_escape_string(stripslashes(dt_dec($_GET['evSpStTchrCls'])));
  $evSpStTchrCrs=mysql_real_escape_string(stripslashes(dt_dec($_GET['evSpStTchrCrs'])));
  $rdEvi=mysql_real_escape_string(stripslashes(valid_zero_slash($_GET['rdEvi'])));
  $rdEvj=mysql_real_escape_string(stripslashes(valid_zero_slash($_GET['rdEvj'])));
  $rdEvk=mysql_real_escape_string(stripslashes(valid_zero_slash($_GET['rdEvk'])));
  $rdEvl=mysql_real_escape_string(stripslashes(valid_zero_slash($_GET['rdEvl'])));
  $rdEvm=mysql_real_escape_string(stripslashes(valid_zero_slash($_GET['rdEvm'])));
  $rdEvTtl=$rdEvi+$rdEvj+$rdEvk+$rdEvl+$rdEvm;
  $evtcmt=mysql_real_escape_string(stripslashes($_GET['evtcmt']));

/*
  echo "evSpStTchrPrd: ".$evSpStTchrPrd."<br>";
  echo "evSpStTchrCls: ".$evSpStTchrCls."<br>";
  echo "evSpStTchrCrs: ".$evSpStTchrCrs."<br>";
  echo "rdEvi: ".$rdEvi."<br>";
  echo "rdEvj: ".$rdEvj."<br>";
  echo "rdEvk: ".$rdEvk."<br>";
  echo "rdEvl: ".$rdEvl."<br>";
  echo "rdEvm: ".$rdEvm."<br>";
  echo "evtcmt: ".$evtcmt."<br>";

*/
$sel_crs_ev_tch=mysql_query("SELECT * FROM tis_courses WHERE course_id='$evSpStTchrCrs' AND course_class='$evSpStTchrCls'")or die(mysql_error());
if (mysql_num_rows($sel_crs_ev_tch)==1) {
  $ft_sel_crs_ev_tch=mysql_fetch_assoc($sel_crs_ev_tch);
  $tchr_ev_iid=$ft_sel_crs_ev_tch['course_teacher'];
  //echo $tchr_ev_iid;
  $sel_cnt_ev_t=mysql_query("SELECT * FROM tis_st_t_evaluation WHERE st_t_class='$evSpStTchrCls' AND st_t_course='$evSpStTchrCrs' AND st_t_teacher='$tchr_ev_iid' AND st_t_period='$evSpStTchrPrd' AND st_t_xkul='$usr_id'")or die(mysql_error());
  if (mysql_num_rows($sel_cnt_ev_t)<6) {
    $ins_tchr_ev_std=mysql_query("INSERT INTO tis_st_t_evaluation VALUES(null,'$evSpStTchrCls','$evSpStTchrCrs','$tchr_ev_iid','$evSpStTchrPrd','$rdEvi','$rdEvj','$rdEvk','$rdEvl','$rdEvm','$rdEvTtl','$evtcmt','$usr_id','E','$reg_date')")or die(mysql_error());
    if ($ins_tchr_ev_std) {
      echo "<span id='resp_sp'>Evaluation recorded successfully</span>";
      echo "<script>function rellPg(){window.location.reload(true);}</script>";
      echo "<script>window.setTimeout(rellPg,3000)</script>";
    }else{
      echo "<h4 style='color:red'><center>Submition Failed ... ||  Please contact your administrator</center></h4>";
    }
  }else{
    echo "<h4 style='color:red;font-weight:bolder;font-family:Century;text-transform: initial;'><center>Exceeded number of records on this lesson</center></h4>";
    echo "<script>$('#evtstSub').removeAttr('disabled');</script>";
  }

}else{
  echo "<h4 style='color:red'><center>ERROR: 23 - G Something went wrong... ||  Please contact your administrator</center></h4>";
}
}

//---------------------------------refresh shools table
if (isset($_GET['crt_xkl_refr'])) {
  $sel_cc=mysql_query("SELECT * FROM tis_schools ORDER BY school_full_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.")&nbsp&nbsp";?></td>
  <td><?php echo "<span style='font-size:14px;font-weight:bolder'>".ucwords($ft_sel_cc['school_full_name'])."</span><br>";?></td>
</tr>
      <?php
        $i++;

    }
  }
}


//------------------------------------------------------------------------------------------------REGISTERING NEW SCHOOL
if (isset($_GET['crNwXkl'])) {
  $xkl_nm=strtolower(get_input('xklFllnm'));
  $xkl_abrv =get_input('xklAbrv');
  $xkl_ctgry=get_input('xklCtgr');
  $xkl_chchbsd=get_input('xklChchBsd');
  $xkl_phne=get_input('xklPhn');
  $xkl_usrnm=get_input('xklAbrv')!=''?get_input('xklAbrv'):'';
  $xkl_lctn=get_input('xklLctn');
  $xkl_eml=get_input('xklEml');
  $xkl_brtby=get_input('xklBrgtby');
  $xkl_pass=seveeen_my_fl_nm_enc(gen_pass());

  $sel_xkls=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$xkl_nm' AND school_location='$xkl_lctn'")or die(mysql_error());
  if (mysql_num_rows($sel_xkls)>0) {
    echo "<span style='font-size:13px;text-direction:'>School description already available in the system...|| Schools might have the same (names & location), or is already registered</span>";
  }else{
    $sel_xkl_pne=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$xkl_nm' AND school_location='$xkl_lctn' AND school_phone='$xkl_phne'")or die(mysql_error());
    if (mysql_num_rows($sel_xkl_pne)>0) {
      echo "<span style='font-size:13px;text-direction:'>Entered Phone number already used in the system... || Each school must have its unique phone number</span>";
    }else{
      $instr_xkul=mysql_query("INSERT INTO tis_schools VALUES(null,'$xkl_nm','$xkl_usrnm','$xkl_pass','E','$xkl_abrv','$xkl_ctgry','$xkl_chchbsd','$xkl_phne','$xkl_lctn','$xkl_eml','$xkl_brtby','$reg_date')")or die(mysql_error());
      if ($instr_xkul) {
        echo "<span id='resp_sp'>Registered Successfully</span>";
        ?>
    <script type="text/javascript">
      function pgRload(){
          window.location.reload(true);
        }
      window.setTimeout(pgRload,3000);
    </script>
        <?php
      }
    }
  }

}

//========================================================================================== CALLING PUSH
if (isset($_GET['callAuto1'])) {
  if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
    $tnme = substr($_SESSION['seveeen_tis_teacher_nm'], 0, strpos($_SESSION['seveeen_tis_teacher_nm'], ' '));
    //$tnme = $_SESSION['seveeen_tis_teacher_nm'];
  echo "<script>myPush('$tnme','COMBINE-TASKS is available Now !!!','libs/parts/imgs/tis.png')</script>";

  }
}
if (isset($_GET['callAuto2'])) {
  if (isset($_SESSION['seveeen_tis_teacher_nm'])) {
    $tnme = substr($_SESSION['seveeen_tis_teacher_nm'], 0, strpos($_SESSION['seveeen_tis_teacher_nm'], ' '));
   // $tnme = $_SESSION['seveeen_tis_teacher_nm'];
  echo "<script>myPush('$tnme','COMBINE-TASKS is available Now !!!','../libs/parts/imgs/tis.png')</script>";

  }
}

//======================================================================== AUTO LODAS
//SELECTING CLASSES
if (isset($_GET['celClasses'])) {
  $tchr_id=$_SESSION['seveeen_tis_teacher_id'];
  $sel_cl=mysql_query("SELECT tis_classes.*,tis_courses.* FROM tis_classes,tis_courses WHERE tis_courses.course_teacher='$tchr_id' AND tis_courses.course_class=tis_classes.class_id AND tis_classes.class_xkul='$usr_id' AND LEFT(tis_classes.class_date,4)='".date("Y")."' GROUP BY tis_courses.course_class")or die("<option>".mysql_error()."</option>");
  if (mysql_num_rows($sel_cl)>0) {
    while ($ft_sel_cl=mysql_fetch_assoc($sel_cl)) {
      echo "<option value='".$ft_sel_cl['class_id']."'>".$ft_sel_cl['class_name']."</option>";
    }
  }else{
    echo "<option value=''>Error Occured...</option>";
  }
}
//========================================================================= View Students Attendance
if (isset($_GET['selCourses'])) {
  $c_class = get_input('c_class');
  $sel_crs = mysql_query("SELECT * FROM tis_courses WHERE course_class='$c_class' AND course_xkul='$usr_id'")or die(mysql_error());
  if (mysql_num_rows($sel_crs)>0) {
    while ($ft_c_class = mysql_fetch_assoc($sel_crs)) {
      echo "<option value='".$ft_c_class['course_id']."'>".$ft_c_class['course_name']."</option>";
    }
  }else{
    echo "<option value=''>Error Occured...</option>";
  }
}

//============================================================================= View Attendance 
if (isset($_GET['viewAttendance'])) {
  $at_class = get_input('atClass');
  $at_course = get_input('atCourse');
  echo $at_course." - ".$at_class;
}


//================================================================================================= USER COMMENT
if (isset($_GET['subComment'])) {
  $mesg = get_input('msg');
  $tchr_id = $_SESSION['seveeen_tis_teacher_id'];
  $topic = "Students Attendance";
  $insert_com = mysql_query("INSERT INTO tis_user_comments VALUES(null,'$tchr_id','$usr_id','$mesg','$topic','$reg_date')") or die(mysql_error());
  if ($insert_com) {
    echo '<span id="resp_sp">Thank you for your message.<span>';
    //echo "<script>setCont('respp','".$re."');</script>";
    //echo "<script type='text/javascript'>gtId('com_txt').value=''</script>";
    ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#com_txt").val("");
  </script>
    <?php
  }
}


//================================================================================== RE-ORIENT TEACHER  ,  CLASS
if (isset($_GET['reOrThrCrs'])) {
  $or_cll=mysql_real_escape_string(stripslashes($_GET['orThCls']));
  $ortchr=mysql_real_escape_string(stripslashes($_GET['orThTchr']));
  $stt="E";
  $or_se_crs=mysql_query("SELECT * FROM tis_classes WHERE class_id='$or_cll' AND class_xkul='$usr_id' AND class_status='$stt' AND LEFT(class_date,4)='".date("Y")."'");
  $cnt_or_se_crs=mysql_num_rows($or_se_crs);
  if ($cnt_or_se_crs==1) {
    $ft_or_se_crs=mysql_fetch_assoc($or_se_crs);
    $or_cl_id=$ft_or_se_crs['class_id'];
    $or_selcrs=mysql_query("SELECT * FROM tis_courses WHERE course_class='$or_cl_id' AND course_xkul='$usr_id' AND LEFT(course_date,4)='".date("Y")."'");
    $cnt_or_selcrs=mysql_num_rows($or_selcrs);
    if ($cnt_or_selcrs>0) {
        echo "<option value='choose' selected id='chs_slctd'> Select Course</option>";
      while ($ft_or_selcrs=mysql_fetch_assoc($or_selcrs)) {
        echo "<option value='".$ft_or_selcrs['course_id']."'>".$ft_or_selcrs['course_name']."</option>";
      }
      exit;
    }else{
      echo "<option value='No'>No Courses available</option>";
    }
  }else{
    echo "<option value='choose' selected id='chs_slctd'> Select Course</option>";
  }
}

//==================================================================================== SUBMIT RE-ORIENT TEACHER

if (isset($_GET['reOrTchhFn'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#okset").removeAttr("disabled");
  });
</script>
  <?php
  $orr_tch=mysql_real_escape_string(stripslashes($_GET['ortTchr']));
  $orr_cls=mysql_real_escape_string(stripslashes($_GET['ortCls']));
  $orr_crs=mysql_real_escape_string(stripslashes($_GET['ortCrs']));
  $stt="E";
  $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$orr_cls' AND class_xkul='$usr_id' AND class_status='$stt' AND LEFT(class_date,4)='".date("Y")."'");
  $cnt_sel_cls=mysql_num_rows($sel_cls);
  if ($cnt_sel_cls==1) {
    $ft_sel_cls=mysql_fetch_assoc($sel_cls);
    $or_cls_id=$ft_sel_cls['class_id'];
    $sel_course=mysql_query("SELECT * FROM tis_courses WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
    $cnt_sel_course=mysql_num_rows($sel_course);
    if ($cnt_sel_course==1) {
      $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id = '$orr_tch' AND teacher_school='$usr_id'");
      $cnt_sel_tch=mysql_num_rows($sel_tch);
      if ($cnt_sel_tch==1) {
        $ft_sel_tch=mysql_fetch_assoc($sel_tch);
        $tchr_id=$ft_sel_tch['teacher_id'];
        $Orient_tchr=mysql_query("UPDATE tis_courses SET course_teacher = '$tchr_id' WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
        if ($Orient_tchr) {
          echo "<span id='resp_sp'>Oriented Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#or_tch_tchr,#or_tch_cls,#or_tch_crs").val("");
  </script>
      <?php
        }else{
          echo "<b><h3>Action Failed : ERROR 00 - A1 Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }
      }else{
        echo "<b><h3>Action Failed : ERROR 08 - g Occured. || Please contact Administrator to solve this issue...</h3></b>";
      }
    }else{
      echo "<b><h3>Someting went Wrong | Please check Items correctly</h3></b>";
    }
  }else{
    echo "<b><h3>Action Failed : ERROR 23 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }

}


//============================================================================= REMOVE COURSE TEACHER

if (isset($_GET['removeOrTchhFn'])) {
      ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#okset").removeAttr("disabled");
  });
</script>
  <?php
  $orr_tch=mysql_real_escape_string(stripslashes($_GET['ortTchr']));
  $orr_cls=mysql_real_escape_string(stripslashes($_GET['ortCls']));
  $orr_crs=mysql_real_escape_string(stripslashes($_GET['ortCrs']));
  $stt="E";
  $sel_cls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$orr_cls' AND class_xkul='$usr_id' AND class_status='$stt' AND LEFT(class_date,4)='".date("Y")."'");
  $cnt_sel_cls=mysql_num_rows($sel_cls);
  if ($cnt_sel_cls==1) {
    $ft_sel_cls=mysql_fetch_assoc($sel_cls);
    $or_cls_id=$ft_sel_cls['class_id'];
    $sel_course=mysql_query("SELECT * FROM tis_courses WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
    $cnt_sel_course=mysql_num_rows($sel_course);
    if ($cnt_sel_course==1) {
      $sel_tch=mysql_query("SELECT * FROM tis_teachers WHERE teacher_id = '$orr_tch' AND teacher_school='$usr_id'");
      $cnt_sel_tch=mysql_num_rows($sel_tch);
      if ($cnt_sel_tch==1) {
        $ft_sel_tch=mysql_fetch_assoc($sel_tch);
        $tchr_id=$ft_sel_tch['teacher_id'];
        $Orient_tchr=mysql_query("UPDATE tis_courses SET course_teacher = '0' WHERE course_id='$orr_crs' AND course_class='$or_cls_id' AND course_xkul='$usr_id'");
        if ($Orient_tchr) {
          echo "<span id='resp_sp'>Removed Successfully</span>";
      ?>
  <script type="text/javascript">
      function hhidef(){
        $("#resp_sp").hide();
      }
    window.setTimeout(hhidef,3000);

      $("#or_tch_tchr,#or_tch_cls,#or_tch_crs").val("");
  </script>
      <?php
        }else{
          echo "<b><h3>Action Failed : ERROR 00 - A1 Occured. || Please contact Administrator to solve this issue...</h3></b>";
        }
      }else{
        echo "<b><h3>Action Failed : ERROR 08 - g Occured. || Please contact Administrator to solve this issue...</h3></b>";
      }
    }else{
      echo "<b><h3>Action Failed : ERROR 26 - h Occured. || Please contact Administrator to solve this issue...</h3></b>";
    }
  }else{
    echo "<b><h3>Action Failed : ERROR 23 - n Occured. || Please contact Administrator to solve this issue...</h3></b>";
  }

}























































































































































































































































































































}
?>