<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Teachers.php";
$teacher=new Teachers;
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				$teacher->save($_POST);
				break;
			case 'update':
				echo $teacher->update($_POST);
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
				echo $teacher->findAll($_GET);
				break;
			case 'loadbyid':
				echo $teacher->findById($_GET);
				break;
			case 'username':
				echo $teacher->usernameAvailability($_GET);
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