<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Mgt.php";
$school=new Mgt;
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'mgt':
				$school->redirect($_POST);
				break;
			
			default:
				# code...
				break;
		}
		break;
	case 'GET':
	header("Content-Type:application/json");
		switch ($_GET['cate']) {
			case 'loadbyid':
				echo $school->findById($_GET);
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