<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
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
require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';


function readOsaFiles($filename){

if (!file_exists("../../../../../attachments/imported/".$filename) ){
	//exit("Please run 14excel5.php first.\n");
	exit("Please Upload file first first.\n");
}

//echo date('H:i:s') , " Load workbook from Excel5 file" , EOL;
$callStartTime = microtime(true);

$objPHPExcel = PHPExcel_IOFactory::load("../../../../../attachments/imported/".$filename);

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


									$olvlCols=array("candidates name","code","sex","father","mother","phone","academic","current school","level","province","district","sector","School Choices");
$alvlCols=array("candidates name","code","sex","father","mother","phone","academic","current school","level","province","district","sector","School Choices","combination");
																if($i==0){
										if(count($rowData[0])==13 || count($rowData[0])==14) {
										if($olvlCols[0][8]=='level') {
											if($rowData[1][8]=='Ordinary Level') {//Running queries for olvl
												if(count($rowData[0])!=13) {//checking cols
												echo"Sorry data can not be imported because the format is Invalid please dowload the format for O'level then add candidates do not edit their columns";
												}else {
															for($i=0;$i<13;$i++) {
														if($rowData[0][$i]!=$olvlCols[$i]) {
														echo"Sorry this columns is Invalid <b>".$rowData[0][$i]>"</b> It Must Be <b>".$alvlCols[$i]."</b> Please modify you excel files to correct format";
													$returnStatus=array('level'=>'olvl','status'=>'false');
													break;}else {
														//help to run Insert QUERY
														$returnStatus=array('level'=>'olvl','status'=>'true');
													}
												}//end loop 
												}//end else for counting cols
											}elseif($rowData[1][8]=='Advanced Level') {//Running queries for alvl
													if(count($rowData[0])!=14) {
												echo"Sorry data can not be imported because the format is Invalid please dowload the format for A'level then add candidates do not edit their columns";
												}else {//checking the columns name
													for($i=0;$i<14;$i++) {
														if($rowData[0][$i]!=$alvlCols[$i]) {
														echo"Sorry this columns is Invalid <b>".$rowData[0][$i]>"</b> It Must Be <b>".$alvlCols[$i]."</b> Please modify you excel files to correct format";
													$returnStatus=array('level'=>'alvl','status'=>'false');	
														break;}else {
														//run Insert Query
														$returnStatus=array('level'=>'alvl','status'=>'true');
													}
												}//end loop 
												}//end if for counting cols
											}//end if for advanced level
									}//end if to check level
									}//end olvl or alvl
								}//end $i checking
								if(isset($returnStatus['level']) && isset($returnStatus['status']) && $returnStatus['status']=='true' ) {
									//alvl insert
									if($returnStatus['level']=='olvl') {
	$sl="SELECT * FROM candidates WHERE cdt_name='".$rowData[$i][0]."' AND cdt_code='".$rowData[$i][1]."'";
                             $qrying=mysql_query($sl);
                             $count=mysql_num_rows($qrying);
                             if($count==0){ 
	$in="INSERT INTO candidates VALUES ('','".$rowData[$i][0]."','".$rowData[$i][1]."','".$rowData[$i][2]."','".$rowData[$i][3]."','".$rowData[$i][4]."','".$rowData[$i][5]."','".$rowData[$i][6]."','".$rowData[$i][7]."','".$rowData[$i][8]."','".$rowData[$i][9]."','".$rowData[$i][10]."','".$rowData[$i][11]."','','non')";
      $q=mysql_query($in);
      if($q){
      	$choices=explode(',',$rowData[$i][12]);
      	$sklchoice1=$choices[0];
      	$sklchoice2=$choices[1];
      	$sl="SELECT * FROM candidates WHERE cdt_name='".$rowData[$i][0]."' AND cdt_code='".$rowData[$i][1]."' AND ac_year='".$rowData[$i][6]."'";
                             $qrying=mysql_query($sl);
                             while($f=mysql_fetch_assoc($qrying)) {
                             	$id=$f['id'];
      	$in="INSERT INTO choiceol VALUES ('','$id','$sklchoice1','$sklchoice2','".$rowData[$i][6]."')";
      	$qry=mysql_query($in);
                  if($qry){echo"<font color='green'>student ".$rowData[$i][0]." registered for National exam ".$rowData[$i][6]."</font>";}
							
else{echo"ERROR".mysql_error();}}}}else{echo"<font color='blue'>Index allready exist</font>".mysql_error();}}
	if($returnStatus['level']=='alvl') {
	$sl="SELECT * FROM candidates WHERE cdt_name='".$rowData[$i][0]."' AND cdt_code='".$rowData[$i][1]."'";
                             $qrying=mysql_query($sl);
                             $count=mysql_num_rows($qrying);
                             if($count==0){ 
	$in="INSERT INTO candidates VALUES ('','".$rowData[$i][0]."','".$rowData[$i][1]."','".$rowData[$i][2]."','".$rowData[$i][3]."','".$rowData[$i][4]."','".$rowData[$i][5]."','".$rowData[$i][6]."','".$rowData[$i][7]."','".$rowData[$i][8]."','".$rowData[$i][9]."','".$rowData[$i][10]."','".$rowData[$i][11]."','','non')";
      $q=mysql_query($in);
      if($q){
      	$choices=explode(',',$rowData[$i][12]);
      	$cmbchoice=explode(',',$rowData[$i][13]);
      	   	$sklchoice1=$choices[0];
      			$sklchoice2=$choices[1];
      			   	$cmbchoice1=$choices[0];
      			$cmbchoice2=$choices[1];
      		$sl="SELECT * FROM candidates WHERE cdt_name='".$rowData[$i][0]."' AND cdt_code='".$rowData[$i][1]."' AND ac_year='".$rowData[$i][6]."'";
                             $qrying=mysql_query($sl);
                             while($f=mysql_fetch_assoc($qrying)) {
                             	$id=$f['id'];
      	$in="INSERT INTO choiceal VALUES ('','$id','$cmbchoice1','$cmbchoice2','$sklchoice1','$sklchoice2','".$rowData[$i][6]."')";
      	$qry=mysql_query($in);
                  if($qry){echo"<font color='green'>student ".$rowData[$i][0]." registered for National exam ".$rowData[$i][6]."</font>";}
							
else{echo"ERROR".mysql_error();}}}else{echo"<font color='blue'>Index allready exist</font>".mysql_error();}}
}
}
}//end function
/*
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
								echo $rowData[$i][$a];
									}
									echo"</th>";
										}
									echo "</tr>";
								}
								}
								
    //  Insert row data array into your database of choice here
}
echo "</table>";
*/
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