<?php
include_once"AcademicCalendar.php";
/**
 * 
 */
class Evaluation
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
	function findAll($arr){//evaluation by certain period
		#check @schoolid,@evaluation_period
		$additionalWhere="";$data=array();
		if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_st_t_evaluation.st_t_date BETWEEN '".$this->acal[0]['start']."' AND '".$this->acal[0]['close']."'";
      }
		if(isset($arr['type']) && $arr['type']=='periodic'){
 $sel_cc=mysql_query("SELECT tis_teachers.*,LEFT(tis_st_t_evaluation.st_t_period,8) AS period,tis_st_t_evaluation.st_t_date,AVG(tis_st_t_evaluation.st_t_mark_1) AS ability,AVG(tis_st_t_evaluation.st_t_mark_2) AS availability,AVG(tis_st_t_evaluation.st_t_mark_3) AS model,AVG(tis_st_t_evaluation.st_t_mark_4) AS assignments,AVG(tis_st_t_evaluation.st_t_mark_5) AS personality,(AVG(tis_st_t_evaluation.st_t_mark_1+tis_st_t_evaluation.st_t_mark_2+tis_st_t_evaluation.st_t_mark_3+tis_st_t_evaluation.st_t_mark_4+tis_st_t_evaluation.st_t_mark_5))/5 AS average_evaluation FROM tis_teachers LEFT JOIN tis_st_t_evaluation ON tis_st_t_evaluation.st_t_teacher=tis_teachers.teacher_id WHERE tis_teachers.teacher_school='".$arr['uid']."' AND tis_st_t_evaluation.st_t_period='".$arr['period']."'".$additionalWhere." GROUP BY tis_st_t_evaluation.st_t_teacher,LEFT(tis_st_t_evaluation.st_t_period,6)");
}else{//overall evaluation by term
	 $sel_cc=mysql_query("SELECT tis_teachers.*,LEFT(tis_st_t_evaluation.st_t_period,6) AS period,tis_st_t_evaluation.st_t_date,AVG(tis_st_t_evaluation.st_t_mark_1) AS ability,AVG(tis_st_t_evaluation.st_t_mark_2) AS availability,AVG(tis_st_t_evaluation.st_t_mark_3) AS model,AVG(tis_st_t_evaluation.st_t_mark_4) AS assignments,AVG(tis_st_t_evaluation.st_t_mark_5) AS personality,(AVG(tis_st_t_evaluation.st_t_mark_1+tis_st_t_evaluation.st_t_mark_2+tis_st_t_evaluation.st_t_mark_3+tis_st_t_evaluation.st_t_mark_4+tis_st_t_evaluation.st_t_mark_5))/5 AS average_evaluation FROM tis_teachers LEFT JOIN tis_st_t_evaluation ON tis_st_t_evaluation.st_t_teacher=tis_teachers.teacher_id WHERE tis_teachers.teacher_school='".$arr['uid']."' ".$additionalWhere." GROUP BY tis_st_t_evaluation.st_t_teacher,LEFT(tis_st_t_evaluation.st_t_period,6)");
}
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    while($ft_sel_cc=mysql_fetch_assoc($sel_cc)){
    	$data[]=$ft_sel_cc;
    };
	return json_encode($data);
	}
	function findDistinct($arr){
		$data=array();$additionalWhere="";
		if(gettype($this->acal[0])=='array'){//setup view by selected terms
        $additionalWhere.=" AND tis_st_t_evaluation.st_t_date BETWEEN '".$this->acal[0]['start']."' AND '".$this->acal[0]['close']."'";
      }
		$qy=mysql_query("SELECT DISTINCT(st_t_period) AS period FROM tis_st_t_evaluation WHERE st_t_xkul='".$arr['uid']."'".$additionalWhere);
		if(mysql_num_rows($qy)>0){
		while ($ft=mysql_fetch_assoc($qy)) {
			$data[]=$ft;
		}
		}
		return json_encode($data);
	}
	function findById($sid){
 $sel_cc=mysql_query("SELECT * FROM tis_schools WHERE school_id='$sid' ORDER BY school_full_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
}
?>