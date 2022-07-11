<?php
class Files{
    public $root="../Cloud";public $uploadPath="";
    public function __construct($rootPath){
$this->root=$rootPath;
    }
    public function create($datas){
$fop=fopen($datas['name'],"w");
fclose($fop);
return "ok";
    }
    public function getcontent(){
    }
    public function copy($datas){
    $resp=copy($this->root."/".$datas['old'], $this->root."/".$datas['new']);
    return "ok";    
    }
    public function move($datas){
    $resp=copy($this->root."/".$datas['old'], $this->root."/".$datas['new']);
    rmdir($datas['old']);
    return "ok";    
    }
    public function rename($datas){
    $resp=rename($this->root."/".$datas['old'],$this->root."/".$datas['new']);
    return "ok";
    }
    public function setUploadPath($datas){
        $this->uploadPath=$this->root."/".$datas['name'];
    }
    public function getUploadPath(){
        return $this->uploadPath;;
    }
    public function upload($datas){
        move_uploaded_file($datas['fl']['tmp_name'], $this->getUploadPath()."/".$datas['fl']['name']);
        return "ok";
    }

    public function download($datas){

 header('Content-Description: File Transfer');
    header('Content-Type: '.filetype($this->root."/".$datas['name']));
    header('Content-Disposition: attachment; filename='.basename($this->root."/".$datas['name']));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($this->root."/".$datas['name']));
    ob_clean();
    flush();
    readfile($this->root."/".$datas['name']);
    exit;
    }
    public function delete($datas){
        if(file_exists($this->root."/".$datas['name'])){
        $resp=unlink($this->root."/".$datas['name']);
        }
        return "ok";
    }
public function downladPdf($filename){	
    header('Content-Description: File Transfer');
    header('Content-Type: '.filetype($filename));
    header('Content-Disposition: attachment; filename='.basename($filename.".pdf"));

    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename.".pdf"));
    ob_clean();
    flush();
    readfile($filename.".pdf");
    exit;
    }
  
    public function downloadExcel($filename){
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="../Sysfiles/'.$filename.'".xlsx');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
}

    }
?>