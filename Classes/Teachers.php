<?php
/**
 * 
 */
class Teachers
{
	
	function __construct()
	{
		# code...
	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT tis_teachers.*,count(tis_courses.course_id) AS total_courses FROM tis_teachers LEFT JOIN tis_courses ON tis_courses.course_teacher=tis_teachers.teacher_id WHERE tis_teachers.teacher_xkul='".$arr['skl']."'  GROUP BY tis_courses.course_teacher ORDER BY tis_teachers.teacher_id ASC") or die(mysql_error());
  $cnt_sel_cc=mysql_num_rows($sel_cc);
   $data=array();
    while( $ft_sel_cc=mysql_fetch_assoc($sel_cc)){
    	$data[]=$ft_sel_cc;
    }
	return json_encode($data);
	}
	function findById($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_teachers  WHERE teacher_xkul_id='".$arr['skl']."' AND  teacher_id='".$arr['teacherid']."' ORDER BY teacher_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc[]=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
function usernameAvailability($arr){
	$data=array();
	 $sel_cc=mysql_query("SELECT * FROM tis_teachers  WHERE teacher_username='".$arr['uname']."'");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc==0){
    $feed=array("cate"=>"ok");
}else{//allready username exist,try to append some numbers
$qyTeacher=mysql_query("SELECT * FROM tis_teachers WHERE teacher_username LIKE '".$arr['uname']."%'");
$countTeacher=mysql_num_rows($qyTeacher);
$username=$arr['uname'].$countTeacher;
    $feed=array("cate"=>"exist","username"=>$username);
}
	return json_encode($feed);
}
	function update($arr){
		$feed='ok';
 $sel_cc=mysql_query("UPDATE tis_teachers  SET teacher_fullname='".$arr['name']."',teacher_badge='".$arr['badge']."' WHERE  teacher_id='".$arr['id']."'") or die("Error ".mysql_error());
if(!$sel_cc){
	$feed='fail';
}
	return $feed;
	}
}
?>