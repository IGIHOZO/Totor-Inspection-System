<?php
include"../libs/parts/didier_igihozo.php";
include"../Classes/Archives.php";
$archives=new Archives();
if(isset($_GET)){
  $data=null;
switch ($_GET['cate']) {
  case 'archives':
    $data=json_decode($archives->getArchive($_GET),TRUE);
    $dt=json_encode($data);
  $name="../Cloud/".$data['archives'][0]['arch_name'];
  $typ=$data['archives'][0]['arch_type'];
    break;
 }
 header('Content-Description: File Transfer');
    header('Content-Type: '.$type);
    header('Content-Disposition: attachment; filename='.basename($name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile($name);
    exit;
  }
?>