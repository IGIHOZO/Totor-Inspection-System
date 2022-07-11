<?php
include"PHPExcel-1.8/PHPExcel-1.8/Classes/PHPExcel.php";
function to_excel($datas){//creating a function
	$filename=$datas['filename']." ".date("d_m_Y_H_i_s");
	$coldIndex=array(1=>'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$rowIndex=count($datas['fieldData']); 
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

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Tutor inspection system")
							 ->setLastModifiedBy("Tutor inspection system")
							 ->setTitle("Tutor inspection system written data")
							 ->setSubject("TIS-")
							 ->setDescription("Tutor inspection system Data modification via excel")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
			*/
		
			//RUTGER CODESEC EDITING
	
for($i=0;$i<count($datas['fields']);$i++){//fill colums title data
			// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($coldIndex[($i+1)]."1",$datas['fields'][$i]);
		}	
		
		
			for($row=1;$row<=$rowIndex;$row++){// adding data to rows loop all rows
		for($col=1;$col<=count($datas['fields']);$col++){// adding data to rows loop cols to fill all

			// Add some data
           $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($coldIndex[$col].($row+1),
			$datas['fieldData'][($row-1)][($col-1)]);
		}//end cols looping	
		}//end rows looping
			//END
	
			
/*	
// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');
*/
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'".xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}//end EXCEL
//to_excel(array("filename"=>'testexcel',"fields"=>array("ID","Names","Age"),"fieldData"=>array(array("12","Roger","AN12"),array("Count","Haswa","Dloop"))));
?>