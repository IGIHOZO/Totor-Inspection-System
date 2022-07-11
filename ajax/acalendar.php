<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/AcademicCalendar.php";
$acalendar=new AcademicCalendar;
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				echo $acalendar->save($_POST);
				break;
			case 'enable':
				echo $acalendar->enable($_POST);
				break;
			case 'auto':
				echo $acalendar->makeAuto($_POST);
				break;
			case 'update':
				echo $acalendar->update($_POST);
				break;
			case 'delete':
				echo $acalendar->delete($_POST);
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
				echo $acalendar->findAll($_GET);
				break;
			case 'loadbyid':
				echo $acalendar->findById($_GET);
				break;
			case 'active':
				echo $acalendar->getActiveCalendar($_GET);
				break;
			case 'selectable':
				echo $acalendar->getSelectableAcademicYear($_GET);
				break;
			case 'auto':
				echo $acalendar->getAutomaticActiveCalendar($_GET);
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