<?php
session_start();
include"../libs/parts/didier_igihozo.php";
include"../Classes/Archives.php";
$archives=new Archives();
		if(isset($_FILES['fl'])){
			if(!file_exists("../Cloud/".$archives->getStoragePath())){
				mkdir("../Cloud/".$archives->getStoragePath());
		}
			move_uploaded_file($_FILES['fl']['tmp_name'],"../Cloud/".$archives->getStoragePath()."/".$_FILES['fl']['name']);
		}
if(isset($_POST['cate'])){
	$fop=fopen("APPRequest.hd", "a");
		fwrite($fop,date("Y-m-d H:i:s")."=>".$_SERVER['REMOTE_ADDR']."=>".$_SERVER['REQUEST_URI']."\n");
		fclose($fop);
		switch($_POST['cate']){
		case 'register':
		$_POST['name']=$archives->getStoragePath()."/".$_POST['name'];
		echo $archives->addArchive($_POST);
		break;
		case 'share':
		echo $archives->shareArchive($_POST);
		break;
		case 'privatize':
		echo $archives->shareArchive($_POST);
		break;
		case 'update':
		echo $archives->updateArchive($_POST);
		break;
        case 'delete':
            echo $archives->deleteArchive($_POST);
            break;
	};
	}
if(isset($_GET['cate'])){
		switch($_GET['cate']){
		case 'load':
		    header('Content-Type: application/json');
		echo $archives->getArchive($_GET);
		break;
		case 'shared':
		    header('Content-Type: application/json');
		echo $archives->getSharedArchive($_GET);
		break;
		case 'loadbyid':
		header('Content-Type: application/json');
		echo $archives->getArchive($_GET);
		break;
		case 'search':
		    header('Content-Category: application/json');
		echo $archives->searchArchive($_GET);
		break;
	}
}
?>