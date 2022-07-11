<?php

class Classes
{
	
	function __construct(argument)
	{
		# code...
	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_classes  WHERE class_xkul='".$arr['skl']."' AND LEFT(class_date,4)='".date("Y")."' ORDER BY class_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
	function findById($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$sid' AND class_id='".$arr['skl']."'  ORDER BY class_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
}
?>