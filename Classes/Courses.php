<?php
/**
 * 
 */
class Courses
{
	
	function __construct()
	{
		# code...
	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT tis_courses.*,tis_classes.class_name FROM tis_courses INNER JOIN tis_classes ON tis_classes.class_id=tis_courses.course_class  WHERE tis_courses.class_xkul='".$arr['skl']."' ORDER BY tis_courses.course_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
	function findById($arr){
 $sel_cc=mysql_query("SELECT tis_courses.*,tis_classes.class_name FROM tis_courses INNER JOIN tis_classes ON tis_classes.class_id=tis_courses.course_class  WHERE tis_courses.course_id='".$arr['id']."' AND tis_courses.course_id='".$arr['id']."'  ORDER BY tis_courses.course_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc[]=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
	function find($arr){
		$data=array();
 $sel_cc=mysql_query("SELECT * FROM tis_general_courses  WHERE course_name LIKE '".$arr['key']."%' ORDER BY course_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
    		$data[]=$ft_sel_cc;
    }
    return json_encode($data);
}
	function findByClass($arr){
		$data=array();
 $sel_cc=mysql_query("SELECT tis_courses.*,tis_classes.class_name,tis_teachers.teacher_fullname FROM tis_courses INNER JOIN tis_classes ON tis_classes.class_id=tis_courses.course_class LEFT JOIN tis_teachers ON tis_teachers.teacher_id=tis_courses.course_teacher  WHERE tis_courses.course_class='".$arr['class']."' ORDER BY tis_courses.course_name ASC") or die("Error ".mysql_error());
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
    		$data[]=$ft_sel_cc;
    }
    return json_encode($data);
}
	function findByTeacher($arr){$data=array();
 $sel_cc=mysql_query("SELECT tis_courses.*,tis_classes.class_name,tis_teachers.teacher_fullname FROM tis_courses INNER JOIN tis_classes ON tis_classes.class_id=tis_courses.course_class INNER JOIN tis_teachers ON tis_teachers.teacher_id=tis_courses.course_teacher  WHERE tis_courses.course_teacher='".$arr['teacher']."' AND LEFT(tis_courses.course_date,4)='".date("Y")."' ORDER BY tis_courses.course_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
    		$data[]=$ft_sel_cc;
    }
	return json_encode($data);
	}
	function synchCourses($arr){
		$prevYear=date("Y")-1;//previous year check class
		$sel_cc=mysql_query("SELECT tis_classes.*,tis_courses.* FROM tis_classes INNER JOIN tis_courses ON tis_courses.course_class=tis_classes.class_id AND tis_courses.course_status='E' WHERE tis_classes.class_xkul='".$arr['xkul']."' AND  tis_classes.class_name='".$arr['clname']."' AND LEFT(tis_classes.class_date,4)='".$prevYear."' AND tis_classes.class_status='E' ORDER BY tis_classes.class_date") or die("Error: ".mysql_error());
		$data=array();
		while($ft=mysql_fetch_assoc($sel_cc)){
			$data[]=$ft;
		}
		//echo json_encode($data);exit;
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc>0){
    foreach($data as $ft_sel_cc) {
    	$sel_cc=mysql_query("INSERT INTO tis_courses SET course_class='".$arr['classid']."',course_name='".$ft_sel_cc['course_name']."',course_teacher='".$ft_sel_cc['course_teacher']."',course_marks='".$ft_sel_cc['course_marks']."',course_xkul='".$ft_sel_cc['course_xkul']."',course_status='".$ft_sel_cc['course_status']."',course_date='".date("Y-m-d H:i:s")."'");

    }
    }
	}
	function update($arr){
		$feed='ok';
		$qy=mysql_query("UPDATE tis_courses SET course_name='".$arr['name']."',course_marks='".$arr['marks']."' WHERE course_id='".$arr['id']."'") or die("Error ".mysql_error());
		if(!$qy){
			$feed='fail';
		}
		return $feed;
	}
}
?>