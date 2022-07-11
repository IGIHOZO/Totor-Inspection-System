<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Files.php";
$files=new Files("../Cloud");
//echo json_encode($_POST)."=>".json_encode($_FILES);exit;
if(isset($_FILES['fl'])){
		$files->setUploadPath($_POST);
		echo $files->upload($_FILES);
		}
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				$course->save($_POST);
				break;
			case 'create':
		echo $files->create($_POST);
			break;
		case 'rename':
		echo $files->rename($_POST);
			break;
		case 'delete':
		echo $files->delete($_POST);
			break;
		case 'download':
		echo $files->download($_POST);
			break;
			default:
				# code...
				break;
		}
		break;
	case 'GET':
		switch ($_GET['cate']) {
			case 'format':
				echo $files->downloadExcel("student_import");
				break;
			case 'getcontent':
			echo $files->structure($_GET);	
				break;
		case 'download':
		echo $files->download($_GET);
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