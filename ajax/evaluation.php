<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Evaluation.php";
$evaluation=new Evaluation($_GET);
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				echo $evaluation->save($_POST);
				break;
			
			default:
				echo"invalid";
				break;
		}
		break;
	case 'GET':
	header("Content-Type:application/json");
		switch ($_GET['cate']) {
			case 'load':
				echo $evaluation->findAll($_GET);
				break;
			case 'loadbyid':
				echo $evaluation->findById($_GET);
				break;
			case 'available':
				echo $evaluation->findDistinct($_GET);
				break;
			
			default:
				echo"invalid";
				break;
		}
		break;
	
	default:
		# code...
		break;
}
?>