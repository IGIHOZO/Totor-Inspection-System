<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Students.php";
$student=new Students;
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				$student->save($_POST);
				break;
			case 'update':
				echo $student->update($_POST);
				break;
			case 'excelupd':
				echo $student->excelImportUpdate($_POST);
				break;
			
			default:
				# code...
				break;
		}
		break;
	case 'GET':
	header("Content-Type:application/json");
		switch ($_GET['cate']) {
			case 'load':
				echo $student->findAll($_GET);
				break;
			case 'loadbyid':
				echo $student->findById($_GET);
				break;
			case 'loadbyclass':
				echo $student->findByClass($_GET);
				break;
			case 'loadexcel':
				echo $student->excelExport($_GET);
				break;
			
			default:
				# code...
				break;
		}
		break;
	
	default:
		# code...
		break;
}
?>