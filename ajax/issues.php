<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Issues.php";
$issues=new Issues();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo $issues->addIssue($_GET);
		break;
		case 'load':
		header("Content-Type:application/json");
		echo $issues->getIssue($_GET);
		break;
		case 'loadbyid':
		header("Content-Type:application/json");
		echo $issues->getIssue($_GET);
		break;
		case 'search':
		header("Content-Type:application/json");
		echo $issues->searchIssue($_GET['key']);
		break;
		case 'update':
		echo $issues->updateIssue($_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"issues","tablecol"=>"iss_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>