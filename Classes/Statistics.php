<?php
include_once"AcademicCalendar.php";
include_once"Students.php";
include_once"Courses.php";
include_once"Schools.php";
/**
 * 
 */
class Statistics
{
  public $calendar,$acal;
	function __construct($arr)
	{
  $this->calendar=new AcademicCalendar($arr);
  $this->acal=json_decode($this->calendar->getActiveCalendar($arr),TRUE);
  if(gettype($this->acal[0])!='array'){
    echo json_encode(array("invalid"=>"nodate"));exit;
  }
	}
	function classPerformance($arr){
		$data=array();
		$additionalWhere="";
		//check whether filtered
		if(isset($arr['task'])){
			$additionalWhere.=" AND tis_tasks.task_type='".$arr['task']."'";
		}

      if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_tasks.task_date BETWEEN '".$this->acal[0]['start']."' AND '".$this->acal[0]['close']."'";
      }
		if(!isset($arr['type'])){//display with their suffix like S1 A S2 B
 $sel_cc=mysql_query("SELECT tis_schools.school_full_name,tis_classes.class_id,LEFT(tis_classes.class_name,2) AS class_name,LEFT((avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)),5) AS avg_task_marks   FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_classes INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' ".$additionalWhere." AND tis_schools.school_id='".$arr['uid']."' GROUP BY LEFT(tis_classes.class_name,2)") or die("Error ".mysql_error());
}elseif(isset($arr['type']) && $arr['type']=='specific'){//General S1,S2
	$sel_cc=mysql_query("SELECT tis_schools.school_full_name,tis_classes.class_id,tis_classes.class_name,LEFT((avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)),5) AS avg_task_marks FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_classes INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' ".$additionalWhere." AND tis_schools.school_id='".$arr['uid']."' GROUP BY tis_classes.class_id") or die("Error ".mysql_error());
}
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  while($ft_sel_cc=mysql_fetch_assoc($sel_cc)){
  	$data[]=$ft_sel_cc;
  }
    return json_encode($data);
	}
	function coursePerformance($arr){
		$data=array();$additionalWhere="";
    if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_tasks.task_date BETWEEN '".$this->acal[0]['start']."' AND '".$this->acal[0]['close']."'";
      }
		if(isset($arr['class'])){//for specific class
 $sel_cc=mysql_query("SELECT tis_schools.school_full_name,tis_classes.class_id,tis_classes.class_name,tis_teachers.teacher_fullname,tis_courses.course_id,tis_courses.course_name,LEFT((avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)),5) AS avg_task_marks FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_courses ON tis_courses.course_id=tis_tasks.task_course INNER JOIN tis_classes ON tis_courses.course_class=tis_classes.class_id INNER JOIN tis_teachers ON tis_teachers.teacher_id=tis_courses.course_teacher AND tis_teachers.teacher_id=tis_tasks.task_teacher INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id AND tis_task_marks.task_marks_teacher=tis_teachers.teacher_id WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' AND tis_schools.school_id='".$arr['school']."' AND tis_classes.class_id='".$arr['class']."' ".$additionalWhere." GROUP BY tis_tasks.task_course");
}else{//general courses whole school by pre-selection during registration 

}
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    while($ft_sel_cc=mysql_fetch_assoc($sel_cc)){
    	$data[]=$ft_sel_cc;
    }
	return json_encode($data);
	}

	function genderStudentsCount($arr){
    $data=array();
    $additionalWhere="";
    if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_classes.class_date LIKE '".$this->acal[0]['year']."%'";
      }
		 $sel_ccOlvl=mysql_query("SELECT tis_students.student_sex,count(tis_students.student_id) AS total_student FROM tis_students INNER JOIN tis_classes ON tis_classes.class_id=tis_students.student_class WHERE tis_students.student_xkul='".$arr['skl']."' AND (tis_classes.class_name LIKE 'S1%' || tis_classes.class_name LIKE 'S2%' || tis_classes.class_name LIKE 'S3%') ".$additionalWhere." GROUP BY tis_students.student_sex ORDER BY tis_students.student_id ASC") or die(mysql_error());

		 $sel_ccAlvl=mysql_query("SELECT tis_students.student_sex,count(tis_students.student_id) AS total_student FROM tis_students INNER JOIN tis_classes ON tis_classes.class_id=tis_students.student_class WHERE tis_students.student_xkul='".$arr['skl']."' AND (tis_classes.class_name LIKE 'S4%' || tis_classes.class_name LIKE 'S5%' || tis_classes.class_name LIKE 'S6%') ".$additionalWhere." GROUP BY tis_students.student_sex ORDER BY tis_students.student_id ASC") or die(mysql_error());
		 $sel_ccWhole=mysql_query("SELECT tis_students.student_sex,count(tis_students.student_id) AS total_student FROM tis_students INNER JOIN tis_classes ON tis_classes.class_id=tis_students.student_class WHERE tis_students.student_xkul='".$arr['skl']."' ".$additionalWhere." GROUP BY tis_students.student_sex ORDER BY tis_students.student_id ASC") or die(mysql_error());
  $cnt_sel_ccOlvl=mysql_num_rows($sel_ccOlvl);
  $cnt_sel_ccAlvl=mysql_num_rows($sel_ccAlvl);
  $cnt_sel_ccWhole=mysql_num_rows($sel_ccWhole);
   $data=array();
    while($ft_sel_ccOlvl=mysql_fetch_assoc($sel_ccOlvl)){
    	$data['olvl'][]=$ft_sel_ccOlvl;
    }
    while($ft_sel_ccsel_ccAlvl=mysql_fetch_assoc($sel_ccAlvl)){
    	$data['alvl'][]=$ft_sel_ccsel_ccAlvl;
    }
    while($ft_sel_ccsel_ccWhole=mysql_fetch_assoc($sel_ccWhole)){
    	$data['whole'][]=$ft_sel_ccsel_ccWhole;
    }
    return json_encode($data);
	}
	function genderBasedPerformance($arr){
		$data=array();$additionalWhere="";
		if(isset($arr['class'])){//for specific class
			$additionalWhere.=" AND tis_students.student_class='".$arr['class']."'";
		}
    if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_tasks.task_date BETWEEN '".$this->acal[0]['start']."%' AND '".$this->acal[0]['close']."%'";
      }
 $sel_ccOlvl=mysql_query("SELECT tis_students.student_sex,(avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)) AS avg_task_marks FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_classes ON tis_classes.class_id=tis_tasks.task_class INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id INNER JOIN tis_students ON tis_students.student_id=tis_task_marks.task_mark_student AND  tis_classes.class_id=tis_students.student_class   WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' AND (tis_classes.class_name LIKE 'S1%' || tis_classes.class_name LIKE 'S2%' || tis_classes.class_name LIKE 'S3%') AND tis_schools.school_id='".$arr['skl']."' ".$additionalWhere." GROUP BY tis_students.student_sex");
  $sel_ccAlvl=mysql_query("SELECT tis_students.student_sex,(avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)) AS avg_task_marks FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_classes ON tis_classes.class_id=tis_tasks.task_class INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id INNER JOIN tis_students ON tis_students.student_id=tis_task_marks.task_mark_student AND  tis_classes.class_id=tis_students.student_class  WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' AND (tis_classes.class_name LIKE 'S4%' || tis_classes.class_name LIKE 'S5%' || tis_classes.class_name LIKE 'S6%') AND tis_schools.school_id='".$arr['skl']."' ".$additionalWhere." GROUP BY tis_students.student_sex");

  $sel_ccWhole=mysql_query("SELECT tis_students.student_sex,(avg((tis_task_marks.task_marks_marks/tis_task_marks.task_marks_overall)*100)) AS avg_task_marks FROM tis_tasks INNER JOIN tis_schools ON tis_tasks.task_xkul=tis_schools.school_id INNER JOIN tis_classes ON tis_classes.class_id=tis_tasks.task_class INNER JOIN tis_task_marks ON tis_tasks.task_id=tis_task_marks.task_marks_task AND tis_task_marks.task_marks_xkul=tis_schools.school_id AND tis_task_marks.task_marks_class=tis_classes.class_id INNER JOIN tis_students ON tis_students.student_id=tis_task_marks.task_mark_student AND  tis_classes.class_id=tis_students.student_class  WHERE tis_tasks.task_status='Md' AND tis_schools.school_status='E' AND tis_schools.school_id='".$arr['skl']."' ".$additionalWhere." GROUP BY tis_students.student_sex");
  $cnt_sel_ccOlvl=mysql_num_rows($sel_ccOlvl);
  $cnt_sel_ccAlvl=mysql_num_rows($sel_ccAlvl);
  $cnt_sel_ccWhole=mysql_num_rows($sel_ccWhole);

     while($ft_sel_ccOlvl=mysql_fetch_assoc($sel_ccOlvl)){
    	$data['olvl'][]=$ft_sel_ccOlvl;
    }
    while($ft_sel_ccsel_ccAlvl=mysql_fetch_assoc($sel_ccAlvl)){
    	$data['alvl'][]=$ft_sel_ccsel_ccAlvl;
    }
    while($ft_sel_ccsel_ccWhole=mysql_fetch_assoc($sel_ccWhole)){
    	$data['whole'][]=$ft_sel_ccsel_ccWhole;
    }
	return json_encode($data);
	}
  function taskAnalysis($arr){
    $data=array();$additionalWhere="";
    if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_count_teacher_tasks.count_tt_last_date BETWEEN '".$this->acal[0]['start']."' AND '".$this->acal[0]['close']."'";
      }
      
    $qy=mysql_query("SELECT tis_teachers.teacher_id,tis_teachers.teacher_fullname,tis_count_teacher_tasks.count_tt_count AS total_task,tis_count_teacher_tasks.count_tt_marked AS total_marked,(tis_count_teacher_tasks.count_tt_count-tis_count_teacher_tasks.count_tt_marked) AS total_notyet,tis_count_teacher_tasks.count_tt_last_date FROM tis_teachers LEFT JOIN tis_count_teacher_tasks ON tis_count_teacher_tasks.count_task_teacher=tis_teachers.teacher_id AND tis_count_teacher_tasks.count_task_xkul=tis_teachers.teacher_school ".$additionalWhere." WHERE tis_teachers.teacher_school='".$arr['uid']."' ORDER BY tis_teachers.teacher_fullname");
    while($ft=mysql_fetch_assoc($qy)){
      $data[]=$ft;
    }
    return json_encode($data);
  }
  function studentReport($arr){
    $data=array();$additionalWhere="";
    if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_tasks.task_date BETWEEN '".$this->acal[0]['start']."%' AND '".$this->acal[0]['close']."%'";
      }
      //getting all required information
      $arr['schoolid']=$arr['uid'];
      $schoolInfo=new Schools;
      $schoolArr=json_decode($schoolInfo->findById($arr['uid']),TRUE)[0];
      $schoolName=$schoolArr['school_full_name'];
      $schoolPhone=$schoolArr['school_phone'];
      $schoolEmail=$schoolArr['school_email'];
      $studObj=new Students;
      $studentInfo=json_decode($studObj->findByClass($arr),TRUE);
      $courseObj=new Courses;
      $courseInfo=json_decode($courseObj->findByClass($arr),TRUE);

      for($i=0;$i<count($studentInfo);$i++){
        $studentInfo[$i]['school_name']=$schoolName;
        $studentInfo[$i]['school_phone']=$schoolPhone;
        $studentInfo[$i]['school_email']=$schoolEmail;
        for($index=0;$index<count($courseInfo);$index++){
          //viewing test informations
          $qy=mysql_query("SELECT sum(tis_task_marks.task_marks_marks) AS test,sum(tis_task_marks.task_marks_overall) AS task_overall FROM tis_tasks INNER JOIN tis_task_marks ON  tis_task_marks.task_marks_task=tis_tasks.task_id AND tis_task_marks.task_marks_class=tis_tasks.task_class WHERE tis_task_marks.task_mark_student='".$studentInfo[$i]['student_id']."' AND tis_task_marks.task_marks_class='".$arr['class']."' AND tis_tasks.task_course='".$courseInfo[$index]['course_id']."' AND tis_tasks.task_type!='examss' GROUP BY tis_tasks.task_course");
          if(mysql_num_rows($qy)>0){
          $qyFetch=mysql_fetch_assoc($qy);
          $testMark=($qyFetch['test']*$courseInfo[$index]['course_marks'])/$qyFetch['task_overall'];
          $studentInfo[$i]['marks'][$courseInfo[$index]['course_name']]['test']=$testMark;
          }else{
          $studentInfo[$i]['marks'][$courseInfo[$index]['course_name']]['test']=0;
          }
          //for exams marks checking
          $qy=mysql_query("SELECT sum(tis_task_marks.task_marks_marks) AS exam,sum(tis_task_marks.task_marks_overall) AS task_overall FROM tis_tasks INNER JOIN tis_task_marks ON  tis_task_marks.task_marks_task=tis_tasks.task_id AND tis_task_marks.task_marks_class=tis_tasks.task_class WHERE tis_task_marks.task_mark_student='".$studentInfo[$i]['student_id']."' AND tis_task_marks.task_marks_class='".$arr['class']."' AND tis_tasks.task_course='".$courseInfo[$index]['course_id']."' AND tis_tasks.task_type='examss'");
          if(mysql_num_rows($qy)>0){
          $qyFetch=mysql_fetch_assoc($qy);
          $studentInfo[$i]['marks'][$courseInfo[$index]['course_name']]['exam']=$qyFetch['exam'];
          }else{
          $studentInfo[$i]['marks'][$courseInfo[$index]['course_name']]['exam']=0;  
          }
          $studentInfo[$i]['marks'][$courseInfo[$index]['course_name']]['overall']=($courseInfo[$index]['course_marks']/2);  
          
        }//end courses loop
      }//end students loop
      return json_encode($studentInfo);
  }
}
?>