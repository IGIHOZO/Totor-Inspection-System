	<?php
function pathSet($cate){
	$feed="";
$actualPath=dirname($_SERVER['REQUEST_URI']);
$actualPathArr=explode("/",$actualPath);
$d=array_reverse($actualPathArr);
array_pop($d);
array_pop($d);
$actualPathArr=array_reverse($d);
switch($cate){
case'admin':
switch ($actualPathArr[count($actualPathArr)-1]) {
	case 'admin':
	$feed="";
		break;
	case 'actions':
	$feed="";
		break;
	
	default:
		$actualPathArr[count($actualPathArr)]="actions";
		$actualPathArr[count($actualPathArr)]="admin";
		break;
}
break;
case'school':
switch ($actualPathArr[count($actualPathArr)-1]) {
	case 'reg':
	$feed="";
		break;
	case 'actions':
	$feed="";
		break;
	
	default:
		$actualPathArr[count($actualPathArr)]="reg";
		break;
}
break;
default:
$feed="invalid";
}
return (is_array($feed)==true?implode("/",$actualPathArr):$feed);
}
echo pathSet("admin");
?>