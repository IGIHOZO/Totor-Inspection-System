<?php
session_start();
require("libs/parts/didier_igihozo.php");
require("Classes/Archives.php");
$arch=new Archives(); 
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
  <title>Documents | Tutor Inspection System</title>
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
  <div class="content-wrapper" style="width:100%">
    <div class="container-fluid">
    <!-- Breadcrumbs-->
      <ol class="breadcrumb" id="breadcrumb">
        <li class="breadcrumb-item">
          <a href="adhome.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Archives</li>
      </ol>
        <input type="hidden" name="pathSelected" id="pathSelected" value="<?php echo $arch->getStoragePath();?>"/>
        <input type="hidden" name="rootPath" id="rootPath" value="<?php echo $arch->getStoragePath();?>"/>
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalArchive" class="modal fade">
            <div class="modal-dialog">
          <?php include_once"Classes/Issues.php";?>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">New Archive file</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                               <div class="modal-body">
                    <div id="regArchiveResponse"></div>
                    <input type="hidden" name="sharetype" id="sharetype">
                        <div class="form-group">
                            <p>Archives name</p>
                            <input type="text" name="archiveName" id="archiveName" required class="form-control"">
                           </div>
                            <div class="form-group" id="fileUpl">
                              <p>File</p>
                              <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <div class="form-group">
                                <p>Description</p>
                                <textarea type="text" name="descr" id="descr" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnSaveArchive" name="btnSaveArchive" type="button"><i class="fa fa-upload"></i> Upload</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                            </div>
                        </div>
            </div>
        </div><!--end Archive Dialog-->
        
		<div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateArchive" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update Archive form</h4>
                    </div>
                    <div class="row">
                     <div id="updArchiveResponse"></div>
					<form name="archiveupdForm" action="" method="post" novalidate>
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-body">
<input type="hidden" id="archid">                      
					  <div class="form-group">
                            <p>Archives name</p>
                            <input type="text" name="updarchiveName" id="updarchiveName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                            <div class="form-group">
                                <p>File</p>
                                <input type="file" name="updfile" id="updfile" class="form-control">
                            </div>
                            <div class="form-group">
                                <p>Description</p>
                                <textarea type="text" name="upddescr" id="upddescr" class="form-control" ></textarea>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdArchive" type="button"><i class="fa fa-check-square-o"></i> Update Archive</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--end Archive Dialog-->
          <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRegisterShared" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Share Document form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                            <div class="modal-body">                      
                     <div id="sharedArchiveResponse"></div>
                     <div class="form-group">

                            <p>File name</p>
                            <input type="text" name="flName" id="flName" required class="form-control" readonly="readonly">
                           </div>
                           <div class="form-group">
                            <p>Shared name</p>
                            <input type="text" name="sharedName" id="sharedName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                            <div class="form-group">
                                <p>Description</p>
                                <textarea type="text" name="shareddescr" id="shareddescr" class="form-control" ></textarea>
                            </div>
                          </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnSharedArchive" type="button"><i class="fa fa-check-square-o"></i> Share</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                        </div>
            </div>
        </div><!--end Archive Dialog-->
        
		      <div class="col-lg-10" id="archiveviewform" style="padding-left:2%;margin-top: -1%;">
        <span style="color:green"></span>
        <div class="table-responsive">
             <!--button class="btn btn-primary" id="btnBackDir" style="margin-left: 0%;display: none;" onclick="backDir()"><span class="fa fa-arrow-left"></span>Back</button>
                <?php
if(file_exists("Cloud/".$arch->getStoragePath())){
                ?>

                 <button class="btn btn-primary pull-right" id="btnUpload" data-toggle='modal' data-target='#uploadFiles' style="margin-left: 1%;margin-right: 1%" onclick="document.getElementById('pathUpload').value=(document.getElementById('pathSelected').value==getRootPath()?'Root':document.getElementById('pathSelected').value.replace(getRootPath(),'Root'));"><span class="glyphicon glyphicon-upload"></span> Upload</button>
                <button class="btn btn-primary pull-right" id="btnCreateDir" data-toggle='modal' data-target='#modalCreateDir' onclick="document.getElementById('pathDir').value=(document.getElementById('pathSelected').value=='<?php echo $arch->getStoragePath();?>'?'Root':document.getElementById('pathSelected').value.replace(getRootPath(),'Root'))" style="margin-left: 1%"><span class="glyphicon glyphicon-plus"></span>New Directory</button>
              <button class="btn btn-primary pull-right"><span class="glyphicon glyphicon-arrow-right"></span>Move All Current File to Storage</button> >
                <label>Path Selected</label>
      <input type="text" name="" id="pathSel" class="form-control" readonly="readonly">
<?php }
//check whether user storage exists
if(isset($_SESSION['seveeen_tis_seveeen_admin_id'])==true){
  $archPath="Ad".$_SESSION['seveeen_tis_seveeen_admin_id'];
}elseif(isset($_SESSION['seveeen_tis_teacher_id'])==true){
  $archPath="Te".$_SESSION['seveeen_tis_teacher_id'];
}else{
  $archPath="Sc".$_SESSION['seveeen_tis_usr_id'];
  }
  //echo "<script>alert('".$archPath."')</script>";
 if(!file_exists("Cloud/".$archPath)){?>
                <button type="button" class="btn btn-primary" id="btnCreateStorage" style="margin-left: 10%"><span class="glyphicon glyphicon-plus"></span>Create Storage</button>
              <?php } ?>-->
        <table class="table table-bordered" id="tblArchive" style="width: 100%">
          <caption>Registered Archive</caption>
             
          <thead>
            <tr>
              <th>#Count</th>
              <th>Shared By</th>
              <th>Name</th>
              <th>Size </th>
              <th>Description </th>
              <th>Status</th>
              <th>  Reg. Date</th>
              <th colspan="2">  Modifications<!-- <button data-toggle="modal" data-target="#modalArchive" class="btn btn-primary" style="margin-left: 10%"><span class="glyphicon glyphicon-upload"></span>Upload</button> -->
              
              </th>
            </tr>
          </thead>
          <tbody id="loadedarch">
		  
          </tbody>
        </table>
        </div>
       <div id="archivePanel"></div><br><br><br>
      </div><!--end employeeviewform-->


	  <!--End Optional-->
      <div id='viewImg' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="viewImg">Images View <span id="imgName"></span></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <img src="" id="imgviewed" style="border:2px solid black;width: 100%;height: 100%;border-radius: 5%">
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Viewimg Modal-->
   <div id='shareModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <input type="hidden" name="shareid" id="shareid">
          <div class="modal-header">
         <h4 class="modal-title" id="viewImg">Are you sure to share   <span id="shareName"></span></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <div id="shareResponse"></div>
            <h5>Click <b>Approve</b> to approve that your document is gona be shared to your Partners</h5>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-success glyphicon glyphicon-check-square-o" id="btnShareArchive"><i class="fa fa-check-square-o"></i>
           Approve</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Viewimg Modal-->
  <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalCreateDir" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Create new directory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div id="createDirResponse"></div>
                        <div class="form-group">
                                <label>Path</label>
                                <input type="text" name="pathDir" id="pathDir" class='form-control' value="" readonly="readonly"></div>
                              <div class="form-group">
                            <label>Directory name</label>
                            <input type="text" name="driName" id="dirName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                         </form></div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnCreateDir" type="button" onclick="createDirectory()"><i class="fa fa-check-square-o"></i>Create</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                </div>
            </div>
        </div><!--end Create Directory Dialog-->
         <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalCopyFiles" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Copy files</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div id="copyResponse"></div>
                              <div class="form-group">
                                <label>Path</label>
                                <input type="text" name="pathCopy" id="pathCopy"class='form-control' value="" readonly="readonly"></div>
                              <div class="form-group">
                            <label>Destination</label>
                            <input type="text" name="destinationCopy" id="destinationCopy" required class="form-control" >
                           </div>
                         </form>
                       </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnCopyArchive" type="button" onclick="copy()"><i class="fa fa-check-square-o" ></i> Copy</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                </div>
            </div>
        </div><!--end Create Directory Dialog-->
  	    <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalMoveFiles" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Move files</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div id="moveResponse"></div>
                              <div class="form-group">
                                <label>File</label>
                                <input type="text" name="pathMove" id="pathMove"class='form-control' value="" readonly="readonly"></div>
                              <div class="form-group">
                            <label>Destination</label>
                            <input type="text" name="destinationMove" id="destinationMove" required class="form-control" >
                           </div>
                         </form>
                       </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnMoveArchive" type="button" onclick="move()"><i class="fa fa-check-square-o"></i> Move</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Move files Dialog-->
        <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRenameFiles" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <h4 class="modal-title">Rename files and folder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
          <form name="" action="" method="post" novalidate>
                        <div id="renameResponse"></div>
                              <div class="form-group">
                                <label>Old Name</label>
                                <input type="text" name="renameOldName" id="renameOldName"class='form-control' value="" readonly="readonly"></div>
                              <div class="form-group">
                            <label>New Name</label>
                            <input type="text" name="renameNewName" id="renameNewName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                         </form>
                       </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnRenameArchive" type="button" onclick="rename()"><i class="fa fa-check-square-o"></i> Rename</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Move files Dialog-->
         <div id='uploadFiles' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="delFileModalTitle">Upload Multiple files</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <form action="" enctype="multpart/form-data">
                        <div id="uploadResponse"></div>
                              <div class="form-group">
                                <label>Path</label>
                                <input type="text" name="pathUpload" id="pathUpload"class='form-control' value="" readonly="readonly"></div>
            <label>Attachments</label>
            <input type="file"  id="uploadAttaches" name="file" multiple="multiple" class="form-control" readonly="readonly">
</form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUploadMultiFile" class="btn btn-success" onclick="uploadArchive()"><i class="fa fa-upload"></i>
              Upload</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
  <div id='delFileFolderModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="delFileModalTitle">Do you want to delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
                        <div id="delFileFolderResponse"></div>
                        <input type="hidden" name="delFileFolderUrl" id="delFileFolderUrl">
            <input type="text"  id="delFileFolder" class="form-control" style="font-size: 20px;" readonly="readonly">

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelFile" class="btn btn-danger" onclick="deleteFile()"><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
        <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelArchive" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
</div>
</div><!--end container-->						
	<?php
require("libs/parts/footer.php");
?>
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
</html>
<script>
	//function autoloading
$("#tblArchive").dataTable();
function userInfo(){
  switch($("#usercate").val()){
    case'System':toid=$("#sessid").val();break;
    case'Teacher':toid=$("#decteacherid").val();break;
    case'School':toid=$("#decsklid").val();break;
}
return {uid:toid,cate:$("#usercate").val()};
}
function ajax(url,getpars,typ,responseType,responseFunc){
$.ajax({
 url:url,type:typ,data:getpars,dataType:responseType,success:responseFunc,statuscode:{
   404:function(){
     alert('Response not found');
   }
 }
 });
}
function loadSharedArchives(cate,reference){
  var uinfo=userInfo();
  ajax("ajax/archives.php",{"cate":"shared","uid":uinfo.uid,"ucate":uinfo.cate},"GET","json",function(res){
if(res.archives!=null){ 
switch(cate){
  case'setContent':
  setLoadedArchives(res);break;
  default:
  }     
}else{
  $("#loadedarchives").html("");
    }
});
}
//auto call for shared files
loadSharedArchives('setContent',null);
function setLoadedArchives(loadedarchives){
var archive="",uinfo=userInfo();
if(loadedarchives.archives.length!=0){
     for(var i=0;i<loadedarchives.archives.length;i++){  
         archive+="<tr>"
             +"<td>"+ (parseInt(i)+1)+"</td>"
             +"<td>"+ loadedarchives.archives[i].sharedby +"</td>"
             +"<td>"+ loadedarchives.archives[i].arch_identifier +"</td>"
               +"<td>"+ fileSizeConverter(loadedarchives.archives[i].arch_size)+"</td>"
              +"<td>"+ loadedarchives.archives[i].arch_description+"</td>"
              +"<td>"+ loadedarchives.archives[i].reset_status.substring(0,1).toUpperCase()+loadedarchives.archives[i].reset_status.substring(1,loadedarchives.archives[i].reset_status.length)+"</td>"
              +"<td>"+ loadedarchives.archives[i].regdate.substring(0,16)+"</td>"
              +"<td style='text-align:center;'>"+(loadedarchives.archives[i].arch_type.split("/")[0]=='image'?"<a href='#' disabled onclick='loadSharedArchivesById(\"view\",\""+loadedarchives.archives[i].arch_name+"\")'  class='btn btn-success edituser glyphicon glyphicon-eye-open' data-toggle='modal' data-target='#viewImg'>View</a>":"<a href='#'  onclick='loadSharedArchivesById(\"view\",\"Cloud/"+loadedarchives.archives[i].arch_name+"\")'  class='btn btn-success edituser glyphicon glyphicon-eye-open' disabled>View</a>")
              +"&nbsp;&nbsp;&nbsp;"+(loadedarchives.archives[i].arch_owner==new userInfo().uid?("<a href='#' data-toggle='modal' data-target='#shareModal' class='btn btn-primary glyphicon glyphicon-share'"+(loadedarchives.archives[i].reset_status=='private'?" onclick=\"$(\'#shareid\').val("+loadedarchives.archives[i].arch_id+");$(\'shareName\').html('"+loadedarchives.archives[i].name+"')\">Share ":">Private")):'')+"</a>"
             // +"&nbsp;&nbsp;&nbsp;<a href='#' data-toggle='modal' data-target='#modalUpdateArchive'  onclick='loadSharedArchivesById(\"edit\","+loadedarchives.archives[i].arch_id+")'  class='btn btn-warning edituser glyphicon glyphicon-pencil'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;<a href='ajax/files.php?cate=download&name=../Cloud/"+loadedarchives.archives[i].arch_name+"' class='btn btn-info edituser glyphicon glyphicon-download' target='_blank'>Download</a>"
              +"&nbsp;&nbsp;&nbsp;<a href='#' "+(loadedarchives.archives[i].arch_owner!=$("#sessid").val() && loadedarchives.archives[i].reset_status=='shared'?" disabled":"onclick='loadSharedArchivesById(\"delete\","+loadedarchives.archives[i].arch_id+")' data-toggle=\'modal\' data-target=\'#delModal\'")+" class='btn btn-danger glyphicon glyphicon-remove' >Delete</a>"
                +"</a></td>"
            +"</tr>";
      }
    }else{
     archive+="<tr>"
             +"<td colspan='8'><center>No Archive Found</center></td></tr>"
              }
      $("#loadedarch").html(archive);
      $("#tblArchive").dataTable();
  }
function loadSharedArchivesById(cate,id){
  var uinfo=userInfo();
  if(cate!='view' && cate!='download'){
  ajax("ajax/archives.php",{"cate":"loadbyid",sessid:uinfo.uid,uid:uinfo.uid,ucate:uinfo.cate,"id":id},"GET","json",function(res){
  if (cate=='view') {
    $("#archivename").html(res.archives[0].arch_identifier);
    $("#shopname").html(res.archives[0].shop_name);
  }
  if(cate=='edit'){
    setEditArchives(res);
  }
  if(cate=='delete'){
    setDeleteArchives(res);
  }
  });
}else{
  if(cate=='view'){
   // $("#imgName").html(id);
    document.getElementById("imgviewed").src="Cloud/"+id.replace("%20"," ");
  }
  if(cate=='download'){

  }
}
}
function fileSizeConverter(size){
  var data="",GB=1000*1024*1024,MB=1000*1024,KB=1000;
  if(size>GB){
    data=(size/GB).toFixed(2)+" GB";
  }else if(size>MB){
    data=(size/MB).toFixed(2)+" MB";
  }else if(size>KB){
    data=(size/KB).toFixed(2)+" KB";
  }else{
    data=size+" Bytes";
  }
  return data;
}
</script>