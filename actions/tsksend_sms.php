<?php
session_start();
require("../libs/parts/didier_igihozo.php");
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */

@$tchr_id=$_SESSION['seveeen_tis_teacher_id'];
if (!$sel || !$con) {
  print_r("<center><h2><font color='red'>PROBLEM OF SERVER CONNECTION...</font></h2></center>");
}else{
if (@!$_SESSION['seveeen_tis_usrnm']) {
?>
<script type="text/javascript">
  window.location="../login.php";
</script>
<?php
}else{
@$usr_id=$_SESSION['seveeen_tis_usr_id'];
$all_flnm=$_SESSION['seveeen_tis_usrnm'];
$se_all_id=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['school_id'];
if (isset($_GET['rreidtsk']) && isset($_GET['rreidcls'])) {
$ttmtsk=dt_dec($_GET['rreidtsk'])-2018;
$ttmcls=dt_dec($_GET['rreidcls'])-2018;
$sel_tsk=mysql_query("SELECT * FROM tis_tasks WHERE task_id='$ttmtsk' AND task_xkul='$usr_id'")or die(mysql_error());
$ft_sel_tscls=mysql_fetch_assoc($sel_tsk);//----------out course
$tsk_crs=$ft_sel_tscls['task_course'];
$cnt_sel_tsk=mysql_num_rows($sel_tsk);
if ($cnt_sel_tsk==1) {
  $sel_clcls=mysql_query("SELECT * FROM tis_classes WHERE class_id='$ttmcls' AND class_xkul='$usr_id'")or die(mysql_error());
  if (mysql_num_rows($sel_clcls)==1) {
    $ft_sel_tscls=mysql_fetch_assoc($sel_clcls);//----------out class

    $clnnm=$ft_sel_tscls['class_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="SMS-Marks -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>SMS-Marks | Tutor Inspection System</title>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <link href="../css/web/index.css" rel="stylesheet">

<style>
#chgexampleModal button:hover,#delexampleModal button:hover,#ssdbtnn button:hover,#bcckstt:hover,ssdbtnn button:hover{
  cursor: pointer;
  color: #40063a;
}
#dyrrldel{
  font-size:30px;
  color: red;
  font-weight: bolder;
}
#gen_fter{
      position: relative;margin-left: 10%
    }
.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 15px solid #432445;
  border-right:1 5px solid #6478aa;
  border-bottom: 15px solid #a24021;
  border-left: 15px solid #cd5679;
  width: 70px;
  height: 70px;
float: right;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
#btncmdtsk {
  -webkit-animation: cmbstk 2s linear infinite;
  animation: cmbstk 2s linear infinite;
}
#btncmdtsk:hover {
  -webkit-animation: cmbstk 4s linear infinite;
  animation-play-state: paused;
}
#lldd{
  width: 20px;
  height: 20px;
  border-top: #444212 dashed 5px;
  border-bottom: #444212 dashed 5px;
  border-radius: 50%;
  -webkit-animation: spin 4s linear infinite;
  animation: spin 4s linear infinite;
  margin-left:155px;
  margin-top: 10px;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@-webkit-keyframes cmbstk {
  0% { background-color: #0bb97e;padding: 15px}
  250% { background-color: #b9b30b;padding: 10px}
  50% { background-color: #5d1b0d;}
  75% { background-color: #b90b34;padding: 10px}
  100% { background-color: #b96d0b;padding: 15px}
}

@keyframes cmbstk {
  0% { background-color: #0bb97e;padding: 15px}
  250% { background-color: #b9b30b;padding: 10px}
  50% { background-color: #5d1b0d;}
  75% { background-color: #b90b34;padding: 10px}
  100% { background-color: #b96d0b;padding: 15px}
}
</style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <input type="hidden" value="<?php echo $clnnm;?>" id="ttsk_cls_nm"><?php/*---------------------CLASS NAME---------------*/?>
  <div class="container-fluid">
    
  </div>
  <div class="card-body" id="sdsdsd">
    <div class="text-center" id="hhdder_crdpymt">
    <a  href="../index.php" style="float: left;color: white" id="ttrinsttl"><span"><label>Tutor Inspection System</label></span></a>
<br>
     <a href="../index.php" id="hme_lgo"><span id="home_glyph"><label for="gyl_home">&nbsp&nbspHome</label><span class="glyphicon glyphicon-home" id="gyl_home"></span></span></a>
   
</div>
     <div class="table-responsive">
       <div id="mnny">



  <div class="col-sx-8 col-sm-8 col-md-8 col-lg-8">
    <label id="cmps_nw_msg"><h3>Send student-marks through SMS</h3></label><br>
  <form class="bs-example bs-example-form" role="form" id="cmps_nw_msg_frm"> 

      <div class="input-group"> 
         <textarea class="form-control" rows="4" placeholder="Write your message here..." id="write_mess" readonly disabled></textarea>
      </div>
  <table width=100% id="cpmsg_tbl" style="display: none;">
    <tr> 
      <td width="18%"><label style="text-decoration:underline">Receiver: </label>&nbsp&nbsp&nbsp&nbsp</td>
      <td>
        <span class="input-group"><span class="input-group-addon">+250</span><input type="text" class="form-control" placeholder="eg:722077175"  id="smsrcvr" maxlength="9"></span>
      </td>
    </tr>
  </table>    
      <div>
        <center><button type="button" onclick="return revMsgs()" class="btn btn-lg btn-primary" id="send_mmsg_btn"> <span class="glyphicon glyphicon-list-alt"></span>  Review</button></center>
      </div>
      <div class="list-item-group">
        <h4>
        <label><u>Message details</u></label>
        </h4>  
        <table class="table" id="mmes_dtls_snt">
          <tr>
            <td id="mmes_dtls_snt_ftd">Message: </td>
            <td>
              <textarea readonly class="form-control" id="mmes_rdnly"></textarea>
            </td>
          </tr>
          <tr>
            <td id="mmes_dtls_snt_ftd">SMSs / Message: </td>
            <td>
              <textarea readonly class="form-control" id="smss_mess" style="font-weight:bolder"></textarea>
            </td>
          </tr>
            <tr>
            <td id="mmes_dtls_snt_ftd">Total Receivers: </td>
            <td>
              <textarea readonly class="form-control" id="tot_recei" style="font-weight:bolder"></textarea>
            </td>
          </tr>
          <tr>
            <td id="mmes_dtls_snt_ftd">Total SMSs: </td>
            <td>
              <textarea readonly class="form-control" id="tot_smss" style="font-weight:bolder"></textarea>
            </td>
          </tr>

        </table>   
              <div class="btn-group">
                <button type="button" class="btn btn-lg btn-success" style="float:center" data-toggle="modal" datatarget="#myModal" onclick="sendCustMessage()" id="sndmsg_btn" disabled> <span class="glyphicon glyphicon-saved"></span>  Send</button>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog"  
   aria-labelledby="myModalLabel" aria-hidden="true"> 
   <div class="modal-dialog"> 
      <div class="modal-content"> 
         <div class="modal-header"> <span id="snd_respp"></span>
            <button type="button" class="close" data-dismiss="modal"  
               aria-hidden="true">× 
            </button> 
            <h2 class="modal-title" id="myModalLabel"> 
               Confirm to send this message.
            </h2> 
         </div> 
         <div class="modal-body" id="ar_y_sr"> 
            Are you sure you want to send this message to <span id='x_prnts'><span id="cnt_nnmbr"></span> ?</span>
         </div> 
         <div class="modal-footer" id="snd_msg_btns_dv"> 
            <button type="button" class="btn btn-default"  
               data-dismiss="modal">Cancel 
            </button> 
            <button type="button" class="btn btn-primary" id="ys_snd_it" onclick="sendMsg()"> 
               Yes send it 
            </button> 
         </div> 
      </div><!-- /.modal-content --> 
   </div><!-- /.modal-dialog --> 
   </div><!-- /.modal --> 
 
              </div>  
      </div>
  </form>
  </div>





     </div>  
<?php
require("../libs/parts/footer.php");
?>      
    </div>
  </div>
  </div>

</body>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../css/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="../js/web/index.js"></script>
    <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

<?php
  }else{
    echo "<h1 style='color:red'><center>ERROR: 13 -h Something went wrong... ||  Please contact your administrator</center></h1>";
  }
}else{
   echo "<h1 style='color:red'><center>This task have been deleted or combined with another... Please reload task-list</center></h1>";
}
}else{
    echo "<h1 style='color:red'><center>ERROR: 35 -h Something went wrong... ||  Please contact your administrator</center></h1>";
 
}
}}
}
?>