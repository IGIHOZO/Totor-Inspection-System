<?php
session_start();
require("../parts/didier_igihozo.php");
if ($con && $sel) {
	if (isset($_SESSION['seveeen_tis_usr_id'])) {

/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

/** Include PHPExcel_IOFactory */
require_once'PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
									
//attachments\imported
if (!file_exists("../../Sysfiles/courses_import.xlsx")) {
	exit("Sorry file you re searching for doesn't exist.\n");
}

//echo date('H:i:s') , " Load workbook from Excel5 file" , EOL;
$callStartTime = microtime(true);

$objPHPExcel = PHPExcel_IOFactory::load("../../Sysfiles/courses_import.xlsx");

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

//echo 'Call time to load Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
//echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Save Excel 2007 file
//echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
//printing highest row and lowest columns to test
//echo" & Highest Row=".$highestRow." & Highest Column=".$highestColumn;
$status=0;
function readExcelFiles($rowData,$i){
	$Cols=array("fname","lname","sex",);
global $status;
if(count($rowData[0])==3) {

			}else {
				echo"Sorry data can not be imported because the format is Invalid please dowload the format then add Student do not edit their columns";	exit;
			}//end else for counting cols
$coursename=mysql_real_escape_string(stripcslashes($rowData[$i][1]));
$courseaccr=mysql_real_escape_string(stripcslashes($rowData[$i][2]));
$qy=mysql_query("SELECT * FROM tis_general_courses WHERE course_name='$coursename' AND course_accr='$courseaccr'");
if(mysql_num_rows($qy)==0){
 $usr_idd=$_SESSION['seveeen_tis_usr_id'];
	$in="INSERT INTO tis_general_courses(course_name,course_accr,course_level,regdate) VALUES ('".$coursename."','".$courseaccr."','',CURRENT_DATE)";
      $q=mysql_query($in)or die(mysql_error());
      if($q){
      	$status++;
      	}
}
}//end function

//echo "<table border='1'>";
 		$ltrs=array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>6,'H'=>7,'I'=>8,'J'=>9,'K'=>10,'L'=>11,'M'=>12,'N'=>13,'O'=>14,'P'=>14,'Q'=>16,'R'=>17,'S'=>18,'T'=>19,'U'=>20,'V'=>21,'X'=>22,'Y'=>23,'Z'=>24);

	$Colsindex=$ltrs[$highestColumn];
//  Loop through each row of the worksheet in turn

for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);


									for ($i=0;$i<count($rowData);$i++) {
										//echo json_encode($rowData[$i]);
										readExcelFiles($rowData,$i);
									//readExcelFiles($rowData,$i);
										
									}
								
    //  Insert row data array into your database of choice here
}

echo"<h1><span id='mainloader' style='font-weight:bolder;text-align:center'><font color='green'><u><big><font color='red'>".$status."</font></big></u> Students Registered  </font><span id='loader'></span></span></h1>";

echo "<table border='1'>";
 		$ltrs=array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>6,'H'=>7,'I'=>8,'J'=>9,'K'=>10,'L'=>11,'M'=>12,'N'=>13,'O'=>14,'P'=>15,'Q'=>16,'R'=>17,'S'=>18,'T'=>19,'U'=>20,'V'=>21,'X'=>22,'Y'=>23,'Z'=>24);
	$Colsindex=$ltrs[$highestColumn];
//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
                                  
								for ($i=0;$i<count($rowData);$i++) {
									if($rowData[$i][0]=='') {
										break;
									}else {
									echo "<tr>";
									for ($a=0; $a <$Colsindex; $a++) { 
									echo"<th>".$i;
										if($rowData[$i][$a]==""){
											echo"<br>";
										}else{
								echo substr($rowData[$i][$a],0,strlen($rowData[$i][$a]));
									}
									echo"</th>";
										}
									echo "</tr>";
								}
								}
								
    //  Insert row data array into your database of choice here
}
echo "</table>";
/*echo"<script>setTimeout(function(){window.location='../../reg/reg_orient_student.php'},5000);
for(var i=5;i>=1;i--){
setInterval(function(){
document.getElementById('loader').innerHTML=' Few Seconds to Redirect';
})}</script>";*/
#================STARTING WRITING TO EXCEL FILES=====================
/*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done reading file" , EOL;
echo 'File has been created in ' , getcwd() , EOL;
*/
#================END WRITING TO EXCEL FILES=====================
	}else{
		echo "<h1>SESSION ERROR</h1>";
	}
}else{
	echo "<h1>SERVER CONNECTION PROBLEM---------Please Try Again. || Contact Your Adminstrator...</h1>";
}
?>