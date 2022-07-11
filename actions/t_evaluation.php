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
$ntstt="Ny";
$mdstt="Md";
$se_all_id=mysql_query("SELECT * FROM tis_schools WHERE school_full_name='$all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['school_id'];
if (isset($_GET['evcat'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="View Tasks -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>View Tasks | Tutor Inspection System</title>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
    <link href="../css/web/index.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../libs/datepiker/plugs/css/bootstrap-datepicker.min.css" rel="stylesheet">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000">
  <input type="hidden" value="<?php echo @$val_stts;?>" id="hhdntsktt">
  <!-- Navigation-->
 <?php
include"../menus/sheader.php";
 ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <?php
  if (dt_dec($_GET['evcat'])=="Student") {
//===============================================================================================Student
?>
<div class="form-group">
  <div class="form-row">
    <div class="col-md-12">
      <h2 align="center" id="crt_nw_cl_ttl" style="margin-top: -17px">Teachers' Evaluation - Student records  </h2>
    </div>
  </div>
</div>
<div id="invalidResponse"></div>
          <div class="form-group">
            <div class="form-row">
              <label id="evdrmtms" style="display: none;">Remaining</label>
              <div class="col-md-2">
                <span id="evdots0" style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;">......</span>
                <span id="evdots1"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #12f958">.</span>.....</span>
                <span id="evdots2"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #12f958">..</span>....</span>
                <span id="evdots3"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #12f958">...</span>...</span>
                <span id="evdots4"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #12f958">....</span>..</span>
                <span id="evdots5"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #12f958">.....</span>.</span>
                <span id="evdots6"style="color:#023512;font-size: 70px;font-weight: bolder;float: left;margin-top: -30px;display: none;margin-left: -80px;"><span style="color: #cb0606;font-weight: bolder;">......</span></span>

              </div>
          <div class="col-md-2">
                <label for="protType">Choose Period</label>
                <div class="input-group">
                  <select class="form-control" id="evChPedr" style="background-color: #c0ddc6;font-weight: bold">
                    <!-- <option value="<?php echo dt_enc('2018-1-1')?>">Third 1-1</option>
                    <option value="<?php echo dt_enc('2018-1-2')?>">Third 1-2</option>
                    <option value="<?php echo dt_enc('2018-2-1')?>">Third 2-1</option>
                    <option value="<?php echo dt_enc('2018-2-2')?>">Third 2-2</option>
                    <option value="<?php echo dt_enc('2018-3-1')?>" selected>Third 3-1</option>
                    <option value="<?php echo dt_enc('2018-3-2')?>">Third 3-2</option>
 -->
                </select>
                </div>
          </div>
              <div class="col-md-2">
                <label for="protType">Select class</label>
                <div class="input-group">
                  <select class="form-control" id="stEvClss" onclick="return evTCrs()"> 
<?php
$sel_stev_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' order by class_name asc")or die(mysql_error());
if (mysql_num_rows($sel_stev_clss)<1) {
  echo "<option value='".dt_enc("default")."'>No class available</option>";
}else{
  while ($ft_sel_stev_clss=mysql_fetch_assoc($sel_stev_clss)) {
    echo "<option value='".dt_enc($ft_sel_stev_clss['class_id'])."'>".$ft_sel_stev_clss['class_name']."</option>";
  }
}
?>
                </select>
                </div>
              </div>
          <div class="col-md-2">
                <label for="protType">Select Course</label>
                <div class="input-group">
                  <select class="form-control" id="stEvCCrs" onclick="return stEvCCrs()" disabled>
                </select>
                <span class="input-group-addon" id="shw_crss" onclick="return evRmndTms()"><span class="glyphicon glyphicon-share-alt" id="glSwCls"></span></span> 
                </div>
          </div>
              <div class="col-md-3">
                <label for="protType">#####</label>
                <div class="input-group">
                  <span id="spevcrsTcher"></span> 
                  <span id="shw_crss"><span style="height: 20px;" id="glSwCls"></span></span>
                </div>
              </div>
              </div>
            </div>
    <div style="display: none;background-color: #98cba9" id="maiCntEvv" class="card mx-auto col-12">
     <!-- <div class="card-header"><span id="hd_reg">Login Here </span><span id="resp_reg"></span></div>-->
      <div class="card-body">
        <div class="form-group">
          <div class="form-row">
            <div class="col-12">
              <center style="margin-top: -15px;color: red;font-weight: bolder;text-align: center;text-transform: capitalize;"><span id="evsttch_resp"></span></center>
              <table id="evblT" class="table table-bordered table-responsive table-hover">
                <tr id="td_evts_1">
                  <td id="td_evts_tl1" style=""><span >Ability</span></td>
                  <td>Excellent <input type="radio" name="steev1" value="100"></td>
                  <td>Very Good <input type="radio" name="steev1" value="90"></td>
                  <td>Good <input type="radio" name="steev1" value="65"></td>
                  <td>Not Bad <input type="radio" name="steev1" value="50"></td>
                  <td>Need to improve <input type="radio" name="steev1" value="40"></td>
                  <td>Bad <input type="radio" name="steev1" value="20"></td>
                  <td>Not Tolerable <input type="radio" name="steev1" value="-"></td>
                </tr>
                <tr id="td_evts_2">
                  <td  id="td_evts_tl2" style=""><span >Availability</span></td>
                  <td>Excellent <input type="radio" name="steev2" value="100"></td>
                  <td>Very Good <input type="radio" name="steev2" value="90"></td>
                  <td>Good <input type="radio" name="steev2" value="65"></td>
                  <td>Not Bad <input type="radio" name="steev2" value="50"></td>
                  <td>Need to improve <input type="radio" name="steev2" value="40"></td>
                  <td>Bad <input type="radio" name="steev2" value="20"></td>
                  <td>Not Tolerable <input type="radio" name="steev2" value="-"></td>
                </tr>
                <tr id="td_evts_3">
                  <td  id="td_evts_tl3" style=""><span style="margin-left: -3px">Teaching model</span></td>
                  <td>Excellent <input type="radio" name="steev3" value="100"></td>
                  <td>Very Good <input type="radio" name="steev3" value="90"></td>
                  <td>Good <input type="radio" name="steev3" value="65"></td>
                  <td>Not Bad <input type="radio" name="steev3" value="50"></td>
                  <td>Need to improve <input type="radio" name="steev3" value="40"></td>
                  <td>Bad <input type="radio" name="steev3" value="20"></td>
                  <td>Not Tolerable <input type="radio" name="steev3" value="-"></td>
                </tr>
                <tr id="td_evts_4">
                  <td  id="td_evts_tl4" style=""><span >Assignments</span></td>
                  <td>Excellent <input type="radio" name="steev4" value="100"></td>
                  <td>Very Good <input type="radio" name="steev4" value="90"></td>
                  <td>Good <input type="radio" name="steev4" value="65"></td>
                  <td>Not Bad <input type="radio" name="steev4" value="50"></td>
                  <td>Need to improve <input type="radio" name="steev4" value="40"></td>
                  <td>Bad <input type="radio" name="steev4" value="20"></td>
                  <td>Not Tolerable <input type="radio" name="steev4" value="-"></td>
                </tr>
                <tr id="td_evts_5">
                  <td  id="td_evts_tl5" style=""><span >Personality</span></td>
                  <td>Excellent <input type="radio" name="steev5" value="100"></td>
                  <td>Very Good <input type="radio" name="steev5" value="90"></td>
                  <td>Good <input type="radio" name="steev5" value="65"></td>
                  <td>Not Bad <input type="radio" name="steev5" value="50"></td>
                  <td>Need to improve <input type="radio" name="steev5" value="40"></td>
                  <td>Bad <input  type="radio" name="steev5" value="20"></td>
                  <td>Not Tolerable <input type="radio" name="steev5" value="-"></td>
                </tr>
                <tr id="td_evts_6">
                  <td  id="td_evts_tl6" style=""><span >Comment</span></td>
                  <td colspan="7">
                  <div class="input-group">
                    <span class="input-group-addon"><span style="position: relative;width: 80px;max-width: 80px;font-size: 15px;font-weight: bold;margin-left: -10px" id="glSwCls">25 - 120 <br> Characters<br><span id="nnmn" style="color: #789033"></span> </span></span>
                    <textarea onkeypress="return cntLngCmt()" class="form-control" maxlength="<?php echo 120;?>" id="evtcmt" ></textarea> 
                  </div> 
                  </td>
                </tr>
                <tr>
                  <td colspan="8">
<center><button class="btn btn-mlnl btn-success btn-md"  id="evtstSub" onclick="return subStTchrCmt()"><span class="glyphicon glyphicon-ok"></span>&nbsp&nbsp Submit</button></center>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
          <script type="text/javascript">
//------------Validating on submit
var rdEvi=false;
//---------------------steev1

    var radiosi = document.getElementsByName('steev1');
    console.log(radiosi);
    for(var i = 0; i < radiosi.length; i++){
        radiosi[i].onclick = function(){
          rdEvi=this.value;//----------first creteria
        }
    }


//---------------------steev2
var rdEvj=false;
    var radiosj = document.getElementsByName('steev2');
    console.log(radiosj);
    for(var j = 0; j < radiosj.length; j++){
        radiosj[j].onclick = function(){
          rdEvj=this.value;//----------second creteria
        }
    }

//---------------------steev3
var rdEvk=false;
    var radiosk = document.getElementsByName('steev3');
    console.log(radiosk);
    for(var k = 0; k < radiosk.length; k++){
        radiosk[k].onclick = function(){
          rdEvk=this.value;//----------third creteria
        }
    }


//---------------------steev4
var rdEvl=false;
    var radiosl = document.getElementsByName('steev4');
    console.log(radiosl);
    for(var l = 0; l < radiosl.length; l++){
        radiosl[l].onclick = function(){
          rdEvl=this.value;//----------fourth creteria
        }
    }

//---------------------steev4
var rdEvm=false;
    var radiosm = document.getElementsByName('steev5');
    console.log(radiosm);
    for(var m = 0; m < radiosm.length; m++){
        radiosm[m].onclick = function(){
          rdEvm=this.value;//----------fith creteria
        }
    }
//----------------------------SUBMIT BUTTON----------------------
function subStTchrCmt(){
  var evtcmt = document.getElementById("evtcmt").value;//----------comment
  var evtcmtLngt=evtcmt.length;
  if (rdEvi==false || rdEvj==false || rdEvk==false || rdEvl==false || rdEvm==false) {
    document.getElementById("evsttch_resp").innerText="Check all Creterias ...";
  }else{
    if (evtcmtLngt==0) {
      document.getElementById("evsttch_resp").innerText="Please fill your Comment ...";
    }else if(evtcmtLngt<25){
      document.getElementById("evsttch_resp").innerText="Comment must contain more than 25 characters ...";
    }else{
//------------------ON CLICK SUBMIT BUTTON
  var evSpStTchrPrd=document.getElementById("evChPedr").value;//----------period
  var evSpStTchrCls=document.getElementById("stEvClss").value;//----------class
  var evSpStTchrCrs=document.getElementById("stEvCCrs").value;//----------course
  var evTchrStd=true;
  $('#evtstSub').attr("disabled","disabled");
   //$('#evtstSub:mouseover').css("cursor","disabled");
    $.ajax({url:"../js/ajax/index.php",
    type:"GET",data:{evTchrStd:evTchrStd,evSpStTchrPrd:evSpStTchrPrd,evSpStTchrCls:evSpStTchrCls,evSpStTchrCrs:evSpStTchrCrs,rdEvi:rdEvi,rdEvj:rdEvj,rdEvk:rdEvk,rdEvl:rdEvl,rdEvm:rdEvm,evtcmt:evtcmt},cache:false,success:function(res){$("#evsttch_resp").html(res);}
    });
    }
  }
}
          </script>
      </div>
    </div><br>
          </div>
<?php    
  //echo dt_dec($_GET['evcat']);  
  }else if (dt_dec($_GET['evcat'])=="School") {
//================================================================================================School
?>



<?php
//echo dt_dec($_GET['evcat']);
  }else{
    echo "<center style='color:red;font-weight:bolder;margin-top:20%;'><h2>ERROR F-37 Found,Try again or contact administrator....</h2></center>";
  }
      ?>
      
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../libs/parts/footer.php");
?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to get out of your acount.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
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
    <script src="../Scripts/jqdepend.js"></script>
  <script src="../js/push.js-master/bin/push.js" type="text/javascript"></script>
  </div>
</body>
  <script type="text/javascript">
    loadAutoAcademicCalendar();
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>
<?php
}else{
  echo"<script type='text/javascript'>window.location='../libs/parts/logout.php';</script>";
}
}}
}
?>