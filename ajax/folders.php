<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Directory.php";
$fop=fopen("APPRequest.hd", "a");
		fwrite($fop,date("Y-m-d H:i:s")."=>".$_SERVER['REMOTE_ADDR']."=>".$_SERVER['REQUEST_URI']."\n");
		fclose($fop);
$dir=new Directories("../Cloud");
switch($_SERVER['REQUEST_METHOD']){
	case 'POST':
	switch ($_POST['cate']) {
		case 'create':
		//$_POST['name']=substr($_POST['name'],0,2).decodeGetParams(substr($_POST['name'],2));
		echo $dir->create($_POST);
			break;
		case 'rename':
		//$_POST['old']=substr($_POST['old'],0,2).substr($_POST['old'],2));
		//$_POST['new']=substr($_POST['new'],0,2).decodeGetParams(substr($_POST['new'],2));
		echo $dir->rename($_POST);
			break;
		case 'copy':
		//$_POST['old']=substr($_POST['old'],0,2).substr($_POST['old'],2));
		//$_POST['new']=substr($_POST['new'],0,2).decodeGetParams(substr($_POST['new'],2));
		echo $dir->copy($_POST);
			break;
		case 'move':
		//$_POST['old']=substr($_POST['old'],0,2).substr($_POST['old'],2));
		//$_POST['new']=substr($_POST['new'],0,2).decodeGetParams(substr($_POST['new'],2));
		echo $dir->move($_POST);
			break;
		case 'delete':
		//$_POST['name']=substr($_POST['name'],0,2).decodeGetParams(substr($_POST['name'],2));
		echo $dir->delete($_POST);
			break;
		default:

			break;
	}
		break;
	case 'GET':
		switch ($_GET['cate']) {
			case 'structure':
		//	$_GET['name']=substr($_GET['name'],0,2).decodeGetParams(substr($_GET['name'],2));
		echo $dir->structure($_GET);	
				break;
			default:
				
				break;
		}
		break;
}
?>