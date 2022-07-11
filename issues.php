<?php
session_start();
require("libs/parts/didier_igihozo.php");
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */

if (!$sel || !$con) {
  print_r("<center><h2><font color='red'>PROBLEM OF SERVER CONNECTION...</font></h2></center>");
}else{
if (@!$_SESSION['seveeen_tis_usrnm']) {
?>
<script type="text/javascript">
//  window.location="login.php";
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
}
}
}
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Register Teacher -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Helpchat | Tutor Inspection System</title>
<style>
.loader {
  margin: 50%;
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 55px;
  height: 55px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
.loader01 {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 30px;
  height: 30px;
  -webkit-animation: spinn 2s linear infinite;
  animation: spinn 2s linear infinite;
}
@-webkit-keyframes spinn {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spinn {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  
  <?php
  if(isset($_SESSION['seveeen_tis_seveeen_admin_id'])){
include"menus/aheader.php";
  }elseif(isset($_SESSION['seveeen_tis_usr_id']) || isset($_SESSION['seveeen_tis_taecher_id'])){
include"menus/sheader.php";
}
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">
<style type="text/css">
  .Issues{background-color:orange;}
  .iscReceived{
    background:rgba(60,120,140,0.4);
    width: 80%;
    float: left;
    border-radius: 5%; 
    padding: 1%;
    margin-top: 3%; 
  }
  .iscSent{
    background:rgba(60,170,140,0.4);
    width: 80%;
    float: right;
    border-radius: 5%; 
    padding: 1%;
    margin-top: 3%;
  }
  .sentdate{
    float: left;
    margin-top: 1%;
    color: gray;
  }
  .status{
    float: right;
    margin-top: 1%;
    color: gray;
  }
  #chatContainer{
    overflow-y: auto;
    font-size: 14px;
    height: 50%;
    ::-webkit-scrollbar{
      width: 15px;
    }
    ::-webkit-scrollbar-track{
  background: #f1f1f1;
  }
    ::-webkit-scrollbar-thumb{
  background: green;
  }
    ::-webkit-scrollbar-thumb:hover{
  background: red;
  }
    }
  .notifierContainer{display: none;}
</style>
<button id="btnAddIssue" data-toggle="modal" data-target="#addIssueModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%"><span class="glyphicon glyphicon-plus" ></span> New Issue</button><br>

       	    <div id="issueChatModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <h4 class="modal-title"><span id='issOwner'></span>  Issue Chat</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="iscissueid" id="iscissueid">
            <input type="hidden" name="toid" id="toid">
            <input type="hidden" name="totype" id="totype">
            <p id="issTitle" style="background-color: green; color:white;text-align: center;">citizens Registration support  </p>
            <div class="" id="chatContainer">
              <div class="iscReceived">Commissioner is not able to register Citizens as expected please your support<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscSent">we are dealing with it<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              
            </div>
          <div class="input-group">
      <textarea id="issueschat" class="form-control" style="width: 85%;border-radius: 3%;height: 40px;resize: none;"></textarea>
            <span><button type="button" class="btn btn-success btn-xs pull-right" id="btnSaveIssueChat" style="margin-top: -7.2%;height: 40px;text-align: center;">
              <span class="glyphicon glyphicon-ok"></span></button></span>
      </div>
          </div>
          <div class="modal-footer">
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="addIssueModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title">New Issue </h4>
            <button type="button" class="close" data-dismiss="modal" id="closeIssModal">&times;</button>
          </div>
          <div class="modal-body">
		  <p id="updateIssueResponse"></p>
		  <input type="hidden" id="Issueid">
         <div class="form-group"> 
		  <label>Issue Title:</label>
			<input type="text" id="issueTitle" class="form-control">
      <label>Description:</label>
      <textarea id="txtIssueDescr" class="form-control"></textarea>
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSaveIssue" onclick="registerIssues()" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span> Send</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
     <div id="updateIssueModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Issue </h4>
          </div>
          <div class="modal-body">
      <p id="updateIssueResponse"></p>
      <input type="hidden" id="Issueid">
         <div class="form-group"> 
      <label>Issue Name:</label>
      <input type="text" id="updIssue" class="form-control">
      <label>Max Item:</label>
      <input type="text" id="updmaxItem" class="form-control">
      </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdIssue" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
		      <div class="row" id="Issueviewform">
        <span style="color:green"></span>
        <div class="table-responsive"><br>
        <table class="table table-bordered" id="tblIssues" style="width: 100%">
          <thead>
            <tr>
            <th># Count  </th>
              <th>Issue Owner  </th>
              <th>Title</th>
              <th>Status</th>
              <th>  Registration Date</th>
              <th class="loadedIssuemodif" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedIssues">
          
          </tbody>
        </table>
      </div>
      </div><!--end invoiceviewform-->
<!--End Optional-->
	    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelIssue" class="btn btn-danger" >
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
  <!--Logout-->
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
            <a class="btn btn-primary" href="<?php echo $indexPath.'libs/parts/logout.php';?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
 </div>
  </div><!--end Invoice Details View Modal-->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/web/index.js"></script>
    <script src="Scripts/jqdepend.js"></script>
  </div>
</body>
<script type="text/javascript">

//Ajax Commons func request
loadNewIssuesChat();



//Issues Events
//Issues and Issues Chat to Help Users
$("#btnSaveIssueChat").click(function(){
if($("#issueschat").val()!=''){
  registerIssuesChat();
}
});
</script>