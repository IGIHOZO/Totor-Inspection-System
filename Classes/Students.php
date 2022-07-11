<?php
/**
 * 
 */
class Students
{
	
	function __construct()
	{
		# code...
	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT tis_students.*,tis_classes.class_name FROM tis_students INNER JOIN tis_classes ON tis_classes.class_id=tis_students.student_class  WHERE tis_students.student_xkul='".$arr['skl']."' AND tis_students.student_class='".$arr['class']."' ORDER BY tis_students.student_id ASC") or die(mysql_error());
  $cnt_sel_cc=mysql_num_rows($sel_cc);
   $data=array();
    while( $ft_sel_cc=mysql_fetch_assoc($sel_cc)){
    	$data[]=$ft_sel_cc;
    }
	return json_encode($data);
	}
	function findById($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_students  WHERE student_xkul_id='".$arr['skl']."' AND student_class='".$arr['class']."' AND student_id='".$arr['studid']."' ORDER BY student_id ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc[]=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
	function findByClass($arr){
	$data=array();	
		$sel_cc=mysql_query("SELECT tis_students.*,tis_classes.class_name FROM tis_students INNER JOIN tis_classes ON tis_students.student_class=tis_classes.class_id WHERE tis_students.student_xkul='".$arr['schoolid']."' AND tis_students.student_class='".$arr['class']."' ORDER BY student_fullname ASC") or die("Error :".mysql_error());
		$cnt_sel_cc=mysql_num_rows($sel_cc);
    $i=1;$sex=array("Male","Female");
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
    	$data[]=$ft_sel_cc;
    }
    return json_encode($data);
	}
	function excelExport($arr){
		include"../libs/excel/excelwrite.php";
		$studInfo=array();
		$stud=json_decode($this->findByClass($arr),TRUE);
		$fields=array("NO","CLASS","NAMES","SEX","FATHER","MOTHER","GUARDIAN","RELATION","PHONE");
		for($i=0;$i<count($stud);$i++){
			$studInfo[]=array(($i+1),$stud[$i]['class_name'],$stud[$i]['student_fullname'],$stud[$i]['student_sex'],$stud[$i]['student_father'],$stud[$i]['student_mother'],$stud[$i]['student_guardian'],$stud[$i]['student_guardian_relation'],$stud[$i]['student_father_phone']);
		}
		//echo json_encode(array("fieldData"=>$studInfo));exit;
		to_excel(array("filename"=>$stud[0]['class_name']."_Student form","fields"=>$fields,"fieldData"=>$studInfo));
	}

	function excelImportUpdate($arr){
		header("location:../libs/excel/excel_student_update.php?schoolid=".$arr['schoolid']."&class=".$arr['class']."&file=".$arr['fln']);
	}
	function update($arr){
		$feed='ok';
 $sel_cc=mysql_query("UPDATE tis_students  SET student_fullname='".$arr['name']."',student_sex='".$arr['sex']."' WHERE  student_id='".$arr['id']."'") or die("Error ".mysql_error());
if(!$sel_cc){
	$feed='fail';
}
	return $feed;
	}
}
?>