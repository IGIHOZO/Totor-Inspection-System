<?php
/**
 * 
 */
class Schools
{
	
	function __construct()
	{

	}
	function findAll($arr){
 $sel_cc=mysql_query("SELECT * FROM tis_schools ORDER BY school_full_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
	function findById($sid){
 $sel_cc=mysql_query("SELECT * FROM tis_schools WHERE school_id='$sid' ORDER BY school_full_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
    $ft_sel_cc[]=mysql_fetch_assoc($sel_cc);
	return json_encode($ft_sel_cc);
	}
}
?>