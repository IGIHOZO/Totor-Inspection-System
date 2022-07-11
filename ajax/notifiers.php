<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Issues.php";
$issues=new Issues();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'newissues':
			echo $issues->getNewIssues($_GET);
		break;
		case 'newissueschat':
			echo $issues->getNewIssuesChat($_GET);
		break;
		case 'iscsent':
		echo $issues->getIssuesChatSent($_GET);
		break;
		case 'changeissuesstatus':
		case 'changeissstatus':
		echo $issues->changeIssuesStatus($_GET);
		break;
		case 'changeiscstatus':
		echo $issues->changeAllChatStatus($_GET);
		break;
		default:		echo "Invalid Request";
}	
}
?>