<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Statistics.php";
$statistic=new Statistics($_GET);
switch ($_SERVER['REQUEST_METHOD']) {
	case 'POST':
		switch ($_POST['cate']) {
			case 'register':
				echo $statistic->save($_POST);
				break;
			
			default:
				echo"invalid";
				break;
		}
		break;
	case 'GET':
	header("Content-Type:application/json");
		switch ($_GET['cate']) {
			case 'course':
				echo $statistic->coursePerformance($_GET);
				break;
			case 'class':
				echo $statistic->classPerformance($_GET);
				break;
			case 'gendercount':
				echo $statistic->genderStudentsCount($_GET);
				break;
			case 'gender':
				echo $statistic->genderBasedPerformance($_GET);
				break;
			case 'task':
				echo $statistic->taskAnalysis($_GET);
				break;
			case 'bulletin':
				echo $statistic->studentReport($_GET);
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