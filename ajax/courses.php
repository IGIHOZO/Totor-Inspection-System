<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Courses.php";
$course=new Courses;
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				$course->save($_POST);
				break;
			case 'mgt':
				$course->save($_POST);
				break;
			case 'update':
				echo $course->update($_POST);
				break;
			
			default:
				# code...
				break;
		}
		break;
	case 'GET':
	header("Content-Type:application/json");
		switch ($_GET['cate']) {
			case 'loadbyclass':
				echo $course->findByClass($_GET);
				break;
			case 'loadbyteacher':
				echo $course->findByTeacher($_GET);
				break;
			case 'loadbyid':
				echo $course->findById($_GET);
				break;
			case 'find':
				echo $course->find($_GET);
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