<?php
/**
 * 
 */
class AcademicCalendar
{
	
	public function __construct(){
	}
	function save($datas){
		$feed='';
$sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$datas['skl']."' AND ac_acyear='".$datas['acyear']."' AND ac_semester_index='".$datas['index']."'");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc==0){
$sel_ccin=mysql_query("INSERT INTO tis_academic_calendar  VALUES ('','".$datas['skl']."','".$datas['acyear']."','".$datas['index']."','".$datas['start']."','".$datas['end']."','pending','0','',CURRENT_TIMESTAMP,'".$datas['uid']."',CURRENT_TIMESTAMP)") or die(mysql_error());
if($sel_ccin){
	$feed='ok';
}else{
	$feed='fail';
}
  }else{
  	$feed='exist';
  }
	return $feed;
	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$arr['uid']."' AND delete_status='0' ORDER BY ac_sem_start DESC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  while($ft_sel_cc=mysql_fetch_assoc($sel_cc)){
    $data[]=$ft_sel_cc;
    }
	return json_encode($data);
	}
	function findById($datas){
 $sel_cc=mysql_query("SELECT * FROM tis_academic_calendar WHERE ac_school='".$datas['uid']."' AND ac_id='".$datas['id']."' AND delete_status='0' ORDER BY ac_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  while($ft_sel_cc=mysql_fetch_assoc($sel_cc)){
  	$data[]=$ft_sel_cc;
  }
	return json_encode($data);
	}
		function enable($datas){
		$feed='';
$sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' ORDER BY ac_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc>0){
  	//disable all options
$auto=$this->makeAuto($datas);
if($auto=='ok'){
//enable specified options
$sel_upd_png_en=mysql_query("UPDATE tis_academic_calendar  SET status='pending' WHERE ac_school='".$datas['uid']."'") or die(mysql_error());//bkb
$sel_ccin=mysql_query("UPDATE tis_academic_calendar  SET status='active' WHERE ac_school='".$datas['uid']."' AND ac_id='".$datas['id']."'") or die(mysql_error());
}
if($sel_ccin){
	$feed='ok';
}else{
	$feed='fail';
}
  }else{
  	$feed='exist';
  }
	return $feed;
	}
	function makeAuto($datas){
		$sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' ORDER BY ac_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc>0){
  		$sel_upd_png_au=mysql_query("UPDATE tis_academic_calendar  SET status='pending' WHERE ac_school='".$datas['uid']."'") or die(mysql_error());//bkb
		$sel_ccin=mysql_query("UPDATE tis_academic_calendar  SET status='active' WHERE (tis_academic_calendar.ac_sem_start<=CURRENT_DATE AND tis_academic_calendar.ac_sem_end>=CURRENT_DATE) AND ac_school='".$datas['uid']."'") or die(mysql_error());//bkb (--)
		if($sel_ccin){
			$feed='ok';
		}else{
			$feed='fail';
		}
	}else{
		$feed='notexist';
	}
	return $feed;
	}
	function getActiveCalendar($datas){
		$data=array();
		//first check what is enabled
		$sel_cc=mysql_query("SELECT tis_academic_calendar.ac_id,tis_academic_calendar.ac_acyear AS year,tis_academic_calendar.ac_semester_index AS trimester,tis_academic_calendar.ac_sem_start AS start,LEFT(tis_academic_calendar.ac_sem_end,10) AS close FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' AND status='active' AND delete_status='0' ORDER BY ac_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc>0){
$data[]=mysql_fetch_assoc($sel_cc);
  }else{//use automatic detection
		$sel_cc=mysql_query("SELECT tis_academic_calendar.ac_id,tis_academic_calendar.ac_acyear AS year,tis_academic_calendar.ac_semester_index AS trimester,tis_academic_calendar.ac_sem_start AS start,LEFT(tis_academic_calendar.ac_sem_end,10) AS close FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' AND status='pending' AND delete_status='0' AND (tis_academic_calendar.ac_sem_start<=CURRENT_DATE AND tis_academic_calendar.ac_sem_end>=CURRENT_DATE) ORDER BY ac_id ASC");
  $data[]=mysql_fetch_assoc($sel_cc);
  }
  $data['auto']=json_decode($this->getAutomaticActiveCalendar($datas),TRUE);
return json_encode($data);
	}
	function getSelectableAcademicYear($datas){$data=array();
		$sel_cc=mysql_query("SELECT tis_academic_calendar.ac_acyear AS year FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' ORDER BY ac_id ASC");
		if(mysql_num_rows($sel_cc)>0){			
			$data[]=mysql_fetch_assoc($sel_cc);
		}
return json_encode($data);
	}
	function getAutomaticActiveCalendar($datas){
	$data=array();	
		$sel_cc=mysql_query("SELECT tis_academic_calendar.ac_id,tis_academic_calendar.ac_acyear AS year,tis_academic_calendar.ac_semester_index AS trimester,tis_academic_calendar.ac_sem_start AS start,LEFT(tis_academic_calendar.ac_sem_end,10) AS close FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' AND delete_status='0' AND (tis_academic_calendar.ac_sem_start<=CURRENT_DATE AND tis_academic_calendar.ac_sem_end>=CURRENT_DATE) ORDER BY ac_id ASC") or die("Error ".mysql_error());
		if(mysql_num_rows($sel_cc)>0){
  $data[]=mysql_fetch_assoc($sel_cc);
  }
  return json_encode($data);
	}
	function update($datas){
		$feed='';
$sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' AND ac_acyear='".$datas['acyear']."' AND ac_sem_start='".$datas['start']."' AND ac_sem_end='".$datas['end']."' AND ac_id='".$datas['id']."' ORDER BY ac_id ASC");
$cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc==0){
$sel_ccin=mysql_query("UPDATE tis_academic_calendar  SET ac_acyear='".$datas['acyear']."',ac_semester_index='".$datas['index']."', ac_sem_start='".$datas['start']."',ac_sem_end='".$datas['end']."' WHERE ac_id='".$datas['id']."' AND ac_school='".$datas['uid']."'") or die(mysql_error());
if($sel_ccin){
	$feed='ok';
}else{
	$feed='fail';
}
  }else{
  	$feed='exist';
  }
	return $feed;
	}
	function delete($datas){
		$feed='';
$sel_cc=mysql_query("SELECT * FROM tis_academic_calendar  WHERE ac_school='".$datas['uid']."' AND ac_id='".$datas['id']."' ORDER BY ac_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if($cnt_sel_cc==1){
$sel_ccin=mysql_query("UPDATE tis_academic_calendar  SET delete_status='1',delete_reason='".$datas['reason']."',done_by='".$datas['uid']."',delete_date=CURRENT_TIMESTAMP WHERE ac_id='".$datas['id']."' AND ac_school='".$datas['uid']."'") or die(mysql_error());
if($sel_ccin){
	$feed='ok';
}else{
	$feed='fail';
}
  }else{
  	$feed='exist';
  }
	return $feed;
	}
}
?>