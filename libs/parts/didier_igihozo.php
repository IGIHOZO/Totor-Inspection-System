<?php
@$con=mysql_connect("localhost","root","");
@$sel=mysql_select_db("seveeen_spl") or die("Error ".mysql_error());

date_default_timezone_set("Africa/Kigali");
$reg_date=date("Y-m-d H:i:s.00000");
//BASE_64 ENCODE
function dt_enc($dt_enc_tda){
	return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($dt_enc_tda)))))))));
}

//BASE_64 DECODE
function dt_dec($dt_dec_tda){
	return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($dt_dec_tda)))))))));
}
//REPLACING (-) WITH (0)
function valid_zero_slash($radio){
	if ($radio=="-") {
		$radio=0;
	}
	return $radio;
}
//ADMINISTRATOR GRANTING
function seveeen_my_grant($inpt){
	return md5(dt_enc($inpt));
}
//ADMINISTRATOR FULL NAME DECODE
function seveeen_my_fl_nm_enc($inpt){
	return base64_encode(base64_encode(base64_encode($inpt)));
}
//ADMINISTRATOR FULL NAME DECODE
function seveeen_my_fl_nm_dec($inpt){
	return base64_decode(base64_decode(base64_decode($inpt)));
}
//GETTING SAFE INPUT VARIABLES
function get_input($inpt){
	return mysql_real_escape_string(stripslashes($_GET[$inpt]));
}
//GENERATE AUTOMATIC PASSWORD
function gen_pass(){
  return str_replace("=", "", base64_encode(rand(1, 2018)));
}


//-------------------------- SELECTING ACTIVATED ACADEMIC CALENDER
@$all_flnm=$_SESSION['seveeen_tis_usrnm'];
$se_all_id=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
// echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['school_id'];

 $sel_activ_cal=mysql_query("SELECT * FROM tis_academic_calendar WHERE status='active' AND ac_school='$all_id'")or die(mysql_error());
 if (mysql_num_rows($sel_activ_cal)==0) {
 	echo("<h1 style='color:red;font-weight:bolder;font-size:13px'><center>Please enable Academic Calender ......</center></h1>");
 }elseif (mysql_num_rows($sel_activ_cal)!=1) {
 	echo("<h1 style='color:red;font-weight:bolder;font-size:13px'><center>Error EFE 009, No Academic Calender enabled ......</center></h1>");
 }else{
 	$ft_sel_activ_cal=mysql_fetch_assoc($sel_activ_cal);
 	$cal_start=$ft_sel_activ_cal['ac_sem_start'];
 	$cal_stop=$ft_sel_activ_cal['ac_sem_end'];
 }
}
?>