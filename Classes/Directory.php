<?php
class Directories{
	public $root="../Cloud";
	public function __construct($rootPath){
$this->root=$rootPath;
	}
	public function create($datas){
		if(!file_exists($this->root."/".$datas['name'])){
		$resp=mkdir($this->root."/".$datas['name']);
		$feed='ok';
		}else{
			$feed='exist';
		}
	}
	public function structure($datas){
	$feed=array();
$dirContent=scandir($this->root."/".$datas['name']);
	//echo is_dir($datas['name']."/".$dirContent[5]);exit;
for($i=2;$i<count($dirContent);$i++) {
	if(is_dir($this->root."/".$datas['name']."/".$dirContent[$i])==1){
		$feed[]=array("cate"=>"folder","name"=>$dirContent[$i]);
		}elseif(is_file($this->root."/".$datas['name']."/".$dirContent[$i])){
			$feed[]=array("cate"=>"file","name"=>$dirContent[$i]);
		}else{
			$feed[]=array("cate"=>"unknown","name"=>$dirContent[$i]);
		}
}
return json_encode($feed);
	}
	public function copy($datas){
	$resp=copy($this->root."/".$datas['old'], $this->root."/".$datas['new']);
	return "ok";	
	}
	public function move($datas){
	$resp=copy($this->root."/".$datas['old'], $this->root."/".$datas['new']);
	if(is_dir($this->root."/".$datas['old'])){
	rmdir($this->root."/".$datas['old']);
	}elseif(is_file($this->root."/".$datas['old'])){
		unlink($this->root."/".$datas['old']);
	}
	return "ok";	
	}
	public function rename($datas){
	if(file_exists($this->root."/".$datas['old']) && !file_exists($this->root."/".$datas['new'])){
	$resp=rename($this->root."/".$datas['old'], $this->root."/".$datas['new']);
}
	return "ok";
	}
	public function delete($datas){
		if(file_exists($this->root."/".$datas['name'])){
		$resp=rmdir($this->root."/".$datas['name']);
	}
		return "ok";
	}
}
?>