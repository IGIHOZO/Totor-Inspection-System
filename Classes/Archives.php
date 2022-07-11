<?php
class Archives{
	public function __construct(){
    
	}
	function addArchive($datas) {
  $owner=stripslashes($datas['sessid']);
  $ownertype=stripslashes($datas['ucate']);
  $name=stripslashes($datas['name']);
  $type=stripslashes($datas['type']);
  $size=stripslashes($datas['size']);
  $descr=stripslashes($datas['descr']);
  $archname=stripslashes($datas['archname']);
     $date=date("Y-m-d H:i:s");
   $qr=mysql_query("SELECT * FROM tis_archives 
                       WHERE arch_owner='$owner' AND arch_ownertype='$ownertype' AND arch_name='$name' AND arch_size='$size' AND arch_type='$type' AND reset_status='pending' AND  delete_status=0");
//$qr->execute(array("owner"=>$owner,"ownertype"=>$ownertype,"name"=>$name,"size"=>$size,"type"=>$type,"resetstatus"=>'pending',"delstatus"=>0));
$count=mysql_num_rows($qr);
   if($count==0) {
            $qy=mysql_query("INSERT INTO tis_archives VALUES('','$owner','$ownertype','$archname','$name','$type','$size','$descr','private',0,'','$owner',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)") or die(mysql_error());
           // $qy->execute(array("id"=>'',"owner"=>$owner,"ownertype"=>$ownertype,"identifier"=>$archname,"name"=>$name,"type"=>$type,"size"=>$size,"descr"=>$descr,"resetstatus"=>"pending","delstatus"=>0,"delreason"=>'',"doneby"=>$datas['sessid'],"deldate"=>$date,"regdate"=>$date));
   $qr=mysql_query("SELECT * FROM tis_archives 
                       WHERE arch_owner='$owner' AND arch_ownertype='$ownertype' ORDER BY arch_id DESC LIMIT 0,1");
$archid=mysql_fetch_assoc($qr)['arch_id'];
            if($qy){
echo"ok";
}else {
echo"fail";
}
}//end count rows
else{
  echo"exist";
}
}
	function shareArchive($datas) {
		$imgArr=array("png","jpg","jpeg","bmp");
    $status=$datas['cate']=='share'?'shared':'private';
  $owner=stripslashes($datas['sessid']);
  $ownertype=stripslashes($datas['ucate']);
  $id=stripslashes($datas['id']);
            $qy=mysql_query("UPDATE tis_archives SET reset_status='".$status."' WHERE arch_owner='$owner' AND arch_ownertype='$ownertype' AND arch_id='$id'") or die(mysql_error());
            if($qy){
echo"ok";
}else {
echo"fail";
}
}
function getArchive($datas){
	$data=array();$additionalWhere="";
  $owner=stripslashes($datas['uid']);
  $ownertype=stripslashes($datas['ucate']);

  if(!isset($_GET['id'])){
  $qy=mysql_query("SELECT * FROM tis_archives LEFT JOIN tis_teachers ON tis_archives.arch_ownertype='Teacher' AND tis_archives.arch_owner=tis_teachers.teacher_id LEFT JOIN tis_schools ON tis_schools.school_id=tis_archives.arch_owner AND tis_archives.arch_ownertype='School' WHERE  tis_archives.delete_status=0 AND tis_archives.arch_owner='$owner' AND tis_archives.arch_ownertype='$ownertype' ORDER BY tis_archives.arch_id DESC") or die(mysql_error());
  }else{
  $archid=stripslashes($datas['id']);
    $qy=mysql_query("SELECT * FROM tis_archives  LEFT JOIN tis_teachers ON tis_archives.arch_ownertype='Teacher' AND tis_archives.arch_owner=tis_teachers.teacher_id LEFT JOIN tis_schools ON tis_schools.school_id=tis_archives.arch_owner AND tis_archives.arch_ownertype='School' WHERE delete_status=0 AND arch_id='$archid'");
}
while ($ft=mysql_fetch_assoc($qy)) {
  $data[]=$ft;
}
  return json_encode(array("archives"=>$data));
}
function getSharedArchive($datas){
  $data=array();$additionalWhere="";
  $owner=stripslashes($datas['uid']);
  $ownertype=stripslashes($datas['ucate']);

  if($ownertype=='School'){
$qy=mysql_query("SELECT tis_archives.*,tis_teachers.teacher_fullname AS sharedby FROM tis_archives INNER JOIN tis_teachers WHERE tis_archives.delete_status=0 AND tis_archives.reset_status='shared'  AND tis_archives.arch_ownertype='Teacher' AND tis_archives.arch_owner=tis_teachers.teacher_id AND tis_teachers.teacher_school='$owner' ORDER BY tis_archives.arch_id DESC") or die(mysql_error());
}elseif($ownertype=='Teacher'){
$qy=mysql_query("SELECT tis_archives.*,tis_schools.school_full_name AS sharedby FROM tis_archives INNER JOIN tis_schools INNER JOIN tis_teachers WHERE tis_archives.delete_status=0 AND tis_archives.reset_status='shared'  AND tis_archives.arch_ownertype='School' AND tis_schools.school_id=tis_teachers.teacher_school AND tis_teachers.teacher_id='$owner' ORDER BY tis_archives.arch_id DESC") or die(mysql_error());
}

while ($ft=mysql_fetch_assoc($qy)) {
  $data[]=$ft;
}
  return json_encode(array("archives"=>$data));
}
function updateArchive($datas){
	$owner=stripslashes($datas['uid']);
      $ownertype=stripslashes($datas['ucate']);
      $name=stripslashes($datas['name']);
      $type=stripslashes($datas['type']);
      $size=stripslashes($datas['size']);
      $descr=stripslashes($datas['descr']);
      $archname=stripslashes($datas['archname']);
      $date=date("Y-m-d H:i:s");
  $qry=mysql_query("SELECT * FROM tis_archives WHERE arch_id='$archid' AND arch_owner='$owner' AND arch_ownertype='$ownertype'");
  if(mysql_num_rows($qry)>0){
$stmt=mysql_fetch_assoc($qry);
 $qy=mysql_query("UPDATE tis_archives SET arch_owner='$owner',arch_ownertype='$ownertype',arch_name='$name',arch_size='$size',arch_type='$type',arch_description='$descr' WHERE arch_id='$archid'");
            $cnt=mysql_num_rows($qy);
        if($cnt==1){
$feed="ok";
}else {
$feed="fail";
}//end count rows

  }else{
    $feed='notexist';
  }
  return $feed;
}

function deleteArchive($datas){
	$archid=stripslashes($datas['id']);
      $reason=stripslashes($datas['reason']);
      $owner=stripslashes($datas['owner']);
      $ownertype=stripslashes($datas['ownertype']);
if($ownertype!='School'){
$additionalWhere=" AND tis_archives.arch_owner='$owner' AND tis_archives.arch_ownertype='$ownertype'";
}else{
$additionalWhere=" AND tis_teachers.teacher_school='$owner'";

}
  $qry=mysql_query("SELECT * FROM tis_archives INNER JOIN tis_teachers ON tis_archives.arch_ownertype='Teacher' AND tis_archives.arch_owner=tis_teachers.teacher_id WHERE delete_status=0 ".$additionalWhere." AND arch_id='$archid'");
  if(mysql_num_rows($qry)>0){
$stmt=mysql_fetch_assoc($qry);
 //$qy=mysql_query("UPDATE tis_archives SET delete_status='1',delete_reason='$reason',delete_date='".date('Y-m-d H:i:s')."' WHERE arch_owner='$owner' AND arch_ownertype='$ownertype' AND arch_id='$archid'") or die(mysql_error());
 $qy=mysql_query("UPDATE tis_archives SET delete_status='1',delete_reason='$reason',delete_date=CURRENT_TIMESTAMP WHERE arch_id='$archid'") or die(mysql_error());
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows

  }else{
    $feed='notexist';
  }
  return $feed;
}
function getStoragePath(){
$path="";
  switch ($_SESSION['ucate']) {
    case 'System':
      $path='Ad'.$_SESSION['seveeen_tis_seveeen_admin_id'];
      break;
    case 'School':
      $path='Sc'.$_SESSION['seveeen_tis_usr_id'];
      break;
    case 'Teacher':
      $path='Sc'.$_SESSION['seveeen_tis_usr_id'].'/Te'.$_SESSION['seveeen_tis_teacher_id'];
      break;
    
    default:
      break;
  }
  return $path;
}
}
?>