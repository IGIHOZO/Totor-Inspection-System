<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Issues.php";
$issues=new Issues();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		if(!isset($_GET['fromid'])){
			$_GET['fromid']=(isset($_GET['sessid']) && !is_numeric($_GET['sessid'])?decodeGetparams($_GET['sessid']):$_GET['sessid']);
		}
		echo $issues->addIssueChat($_GET);
		break;
		case 'load':
		header("Content-Type:application/json");
		echo $issues->getIssueChat($_GET);
		break;
		case 'loadbyid':
		header("Content-Type:application/json");
		echo $issues->getIssueChat($_GET);
		break;
		case 'search':
		header("Content-Type:application/json");
		echo $issues->searchIssueChat($_GET['key']);
		break;
		case 'seen':
		header("Content-Type:application/json");
		echo $issues->makeAllSeenIssueChat($_GET);
		break;
		case 'update':
		echo $issues->updateIssueChat($_GET['id'],array("nid"=>$_GET["nid"],"type"=>$_GET["type"],"identifier"=>$_GET["identifier"],"notifreceive"=>"sms","address"=>'',"regdate"=>null));
		break;
		case 'delete':
		echo delete(array("table"=>"issues_chat","tablecol"=>"isc_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>