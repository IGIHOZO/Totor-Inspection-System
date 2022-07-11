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

//upload excel file
if(isset($_POST['attach'])){
if($_FILES['file']['type']=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $_FILES['file']['type']=='application/vnd.ms-excel'){
move_uploaded_file($_FILES['file']['tmp_name'], "../attaches/".$_FILES['file']['name']);
header("location:../libs/excel/excelread.php?fln='".base64_encode($_FILES['file']['name'])."'&cclass='".base64_encode($_POST['selectedclass'])."'");
}else{
  ?>
<script type="text/javascript">
  alert("FILE TYPE NOT ALLOWED,ONLY EXCEL FILE ALLOWED <?php echo $_FILES['file']['type'];?>");
</script>
  <?php
}
}
//upload excel file
if(isset($_POST['btnUploadStudentData'])){
if($_FILES['file']['type']=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
move_uploaded_file($_FILES['file']['tmp_name'], "../attaches/".$_FILES['file']['name']);
header("location:../libs/excel/excel_student_update.php?fln=".base64_encode($_FILES['file']['name'])."&class=".$_POST['selectedclass']."&schoolid=".$all_id);
}else{
  ?>
<script type="text/javascript">
  alert("FILE TYPE NOT ALLOWED,ONLY EXCEL FILE ALLOWED");
</script>
  <?php
}
}
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Orient Student -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Orient Student | Tutor Inspection System</title>
  <style>
.loader01 {
  \margin-top: -20PX;
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 35px;
  height: 35px;
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
</style>
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/web/index.css" rel="stylesheet">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000" style="position: absolute;">
  <!-- Navigation-->
  
  <?php
include"../menus/sheader.php";
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Example DataTables Card-->
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
  <h2 align="center" class="list-group-item" id="crt_nw_cl_ttl_st">Register new Student</h2>
<table id="sel_iin" class="table">
  <tr>
<form>
    <td id="sel_iin_one">
      <span id="sel_iin_one_spn">Attach Excel Students' list</span><input type="radio" name="optradio" id="sel_iin_one_rad" onchange="onlyExcel()" checked>
    </td>
    <td id="sel_iin_two">
      <input type="radio" name="optradio" id="sel_iin_two_rad" onchange="onlyManually()"><span id="sel_iin_two_spn">Insert manually</span>
    </td>
</form>
  </tr>
</table>
  <br><center><span id="hdn_crt_nw_stdnt">&nbsp&nbsp&nbsp&nbsp</span></center>
<span id="for_ins_manually">
  <table class="table table-responsive" id="nw_st_tb">
    <tr>
      <td>
        <label>First name:&nbsp&nbsp </label>
      </td>
      <td>
        <input type="text" class="form-control" placeholder="eg: HABIMANA" id="fname">
      </td>
      <td>
        <label>Last name:&nbsp&nbsp </label>
      </td>
      <td>
        <input type="text" class="form-control" placeholder="eg: Jean Claude" id="lname">
      </td>
    </tr>
    <tr>
      <td>
        <label>Class &nbsp :</label>
      </td>
      <td>
              <?php
              echo "<select class='form-control' id='or_tch_cls'>";
              echo "<option value='choose' selected id='chs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' order by class_name asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['class_id']."'>".$ft_sel_tch['class_name']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select";
              ?> 
      </td>
      <td>
        <label>Sex:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td>
        <select class="form-control" id="sssex">
          <option value="choose" selected>Choose Sex</option>
          <option value="F">Female</option>
          <option value="M">Male</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label>Parent Phone:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
<input type="text" class="form-control" id="parentPhone" placeholder="07X0000000">
      </td>
    </tr><tr>
      <td colspan="4">
        <center>
          <button class="btn btn-lg btn-success" id="add_cls_btn" onclick="return regNewSt()"><span class="glyphicon glyphicon-ok-sign"></span>&nbspRegister</button>

        </center>
      </td>
    </tr>
  </table>

    <span class="list-group-item" id="attnt_grp">
      <label>
        <p><span class="glyphicon glyphicon-eye-open" id="icon_warning_sign"></span>&nbsp&nbsp<span class="icon_eye_open_cont">In case some wrong information while registering new student are found; don't worry about this. Registered student's information can be modified by clicking Modify student button, also student can be deleted by clicking View student button and search for student then click delete button.</span></p><br>
        <p id="scnd_p"><span class="glyphicon glyphicon-warning-sign" id="icon_warning_sign"></span>&nbsp&nbsp<span>Make sure that you want to delete student or any other data; because this action <u>can not be UNDONE</u></span></p>
      </label>
    </span>
    <span class="control-group" id="sdsdd_sps">
      <span>
        <center>
          <button class="btn btn-inverse" id="btn_inf_und_new"><span class="glyphicon glyphicon-file">&nbsp</span>New class</button>
          <button class="btn btn-inverse" id="btn_inf_und_ve"><span class="glyphicon glyphicon-dashboard">&nbsp</span>View classes</button>
          <button class="btn btn-inverse" id="btn_inf_und_mod"><span class="glyphicon glyphicon-edit">&nbsp</span>Modify classes</button>
        </center>
      </span>
    </span>
</span>
<span id="for_ins_attach">
<form  method="POST" enctype="multipart/form-data" novalidate>
    <div class="form-group row">

      <div class="col-lg-3">
              <?php
              echo "<select class='form-control col-7' id='selectedclass' name='selectedclass' required>";
              echo "<option value='' selected id='chs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' order by class_name asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['class_id']."'>".$ft_sel_tch['class_name']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select";
              ?>
        </div>
      </div>
      <div class="col-lg-5">
        <div style="position:relative;">
          <a class='btn btn-primary' href='javascript:;'>
            Upload excel file...
            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file" size="40"  onchange='$("#upload-file-info").html($(this).val());' required>
          </a>
          &nbsp;
          <span class='label label-info' id="upload-file-info"></span>
        </div>
      </div>
      <div class="col-lg-4">
        <input type="submit" name='attach' class="btn btn-success" value="Ok, Attach">
        <input type="submit" name='btnUploadStudentData' class="btn btn-success" value="Update">
        <button  class="btn btn-primary" id="btnPrintClassStudent" style="display: none;" ><i class='fa fa-print'></i> Print</button>
      </div>
      <br><br><div class="row"  >
        <div class="col-lg-6 col-md-6 col-sm-12">
          <a href="../Sysfiles/student_import.xls" class="btn btn-primary" ><i class='fa fa-download'></i>Download Student Registration Format</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12"> 
          <!-- <h6>Download,Modify Class student information then Update it</h6>
           -->
        <button  class="btn btn-info" id="excelUpdateStudent" style="display: none;" type="button" id="downloadStudentData"><i class='fa fa-download'></i> Download Class Information to Edit</button>
      </div>
      </div></div> 
    </form>
      <div class="table-responsive" id="tblteacher">
     <h3>Student Available for the Class</h3>
        <table class="table table"  id="tblviewteacher">      
            <thead>
              <tr><th>#Counts</th><th>Class</th><th>Names</th><th>Parent phone</th><th>Sex</th><th>Reg.Date</th><th class="tblmodifications">Modification</th></tr>
            </thead>
          <tbody id="loadedteachers"><tr>
  <th colspan="7"><center>Select Class to view its students</center></th></tr>
           <?php
  $sel_cc=mysql_query("SELECT tis_students.*,tis_classes.class_name FROM tis_students INNER JOIN tis_classes ON tis_students.student_class=tis_classes.class_id WHERE tis_students.student_xkul='".$_SESSION['seveeen_tis_usr_id']."' AND LEFT(tis_classes.class_date,4)='".date("Y")."' ORDER BY student_fullname ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;$sex=array("Male","Female");/*
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.".&nbsp&nbsp";?></td>
  <td><?php echo "<span style='font-size:14px;'>".$ft_sel_cc['class_name']."</span>"?></td>
  <td><?php echo "<span style='font-size:14px;'>".$ft_sel_cc['student_fullname']."</span>"?></td>
  <td><?php echo ($ft_sel_cc['student_father_phone']==""?"None":$ft_sel_cc['student_father_phone']);?></td>
  <td><?php echo ($ft_sel_cc['student_sex']==""?"None":$ft_sel_cc['student_sex']);?></td>
  <td><?php echo $ft_sel_cc['student_date'];?></td>

  <td><a href="#" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalUpdateStudent" data-id="<?=$ft_sel_cc['student_id'];?>"  data-class="<?=$ft_sel_cc['class_name'];?>" data-name="<?=$ft_sel_cc['student_fullname'];?>" data-sex="<?=$ft_sel_cc['student_sex'];?>" data-phone="<?php echo $ft_sel_cc['student_father_phone'];?>" onclick="setEditStudent(this)">Edit</a>&nbsp;&nbsp;&nbsp;
    <a href="#" class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalDeleteStudent">Delete</a></td>
</tr>
      <?php
      $i++;
    }*/
  }
?> 
          </tbody>
        </table>
        </div>
    </div>
    </div></div></div></div>
  <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateStudent" class="modal fade">
            <div class='modal-dialog' style="">
                <div class="modal-content" style="padding: 20px;width: 150%;margin-left: : -30%;">
                    <div class="modal-header">
                         <h4 class="modal-title">Student Updating form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updStudentResponse"></div>
<input type="hidden" id="editid">       
<label>First name:&nbsp&nbsp </label>
        <input type="text" class="form-control" placeholder="eg: HABIMANA" id="updfname">
        <label>Last name:&nbsp&nbsp </label>
        <input type="text" class="form-control" placeholder="eg: Jean Claude" id="updlname">
        <label>Class &nbsp :</label>
              <?php
              echo "<select class='form-control' id='updor_tch_cls'>";
              echo "<option value='choose' selected id='updchs_slctd'> Select Class</option>";
              $sel_tch=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id'  AND LEFT(class_date,4)='".date("Y")."' order by class_name asc");
              $cnt_sel_tch=mysql_num_rows($sel_tch);
              if ($cnt_sel_tch>0) {
                while ($ft_sel_tch=mysql_fetch_assoc($sel_tch)) {
                  echo "<option value='".$ft_sel_tch['class_id']."'>".$ft_sel_tch['class_name']."</option>";
                }
              }else{
                echo "No Teachers available...";
              }
              echo "</select";
              ?> 
        <label>Sex:&nbsp&nbsp&nbsp&nbsp </label>
        <select class="form-control" id="updsssex">
          <option value="choose" selected>Choose Sex</option>
          <option value="F">Female</option>
          <option value="M">Male</option>
        </select>
        <label>Parent Phone:&nbsp&nbsp&nbsp&nbsp </label>
<input type="text" class="form-control" id="updparentPhone" placeholder="07X0000000">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdStudent" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->

         <!--End Optional-->
      <div id='modalDeleteStudent' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delStudentResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delStudentReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelStudent" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

</form>
</span>
              </div>
            </div>
          </div>
    </div>
    <!-- /.content-wrapper-->
<?php
require("../libs/parts/footer.php");
include"../report.html";
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
    <script src="../js/web/index.js"></script>
    <script src="../Scripts/jqdepend.js"></script>
  </div>
</body>
  <script type="text/javascript">
    function userInfo(){
 var toid=0,cate="";
  switch($("#usercate").val()){
    case'System':toid=$("#sessid").val();break;
    case'Teacher':toid=$("#decteacherid").val();break;
    case'School':toid=$("#decsklid").val();break;
}
return {uid:toid,cate:$("#usercate").val()};
}
    //students checks
    function loadStudentByClass(){
      var uinfo=userInfo();
      $.ajax({url:"../ajax/students.php",data:{cate:'loadbyclass',schoolid:uinfo.uid,class:$("#selectedclass").val()},type:"GET",dataType:"json",success:function(res){
    setLoadedStudent(res);
}
});

    }

  function setLoadedStudent(obj){
     var data="";
  for(var i=0;i<obj.length;i++){      
         data+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ obj[i].class_name +"</td>"
             +"<td>"+ obj[i].student_fullname +"</td>"
             +"<td>"+ (obj[i].student_father_phone!=''?obj[i].student_father_phone:'None')+"</td>"
             +"<td>"+ (obj[i].student_sex!=''?obj[i].student_sex:'None')+"</td>"
              +"<td>"+ obj[i].student_date.substring(0,10)+"</td>"
              +'<td class="tblmodifications"><a href="#" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalUpdateStudent" data-id="'+obj[i].student_id+'" data-class="'+obj[i].class_name+'" data-name="'+obj[i].student_fullname+'" data-sex="'+obj[i].student_sex+'" data-phone="'+obj[i].student_father_phone+'" onclick="setEditStudent(this)">Edit</a>&nbsp;&nbsp;&nbsp;'
    +'<a href="#" class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalDeleteStudent">Delete</a></td>'
            +"</tr>";
     
  }
  $("#loadedteachers").html(data);
  }
function setEditStudent(obj){
  var namesArr=obj.getAttribute('data-name').split(" "),selClass=document.getElementById("updor_tch_cls").getElementsByTagName("option");
  var lnames="";
for(var i=1;i<namesArr.length;i++){
  if(namesArr[i]!=''){
lnames+=" "+namesArr[i];
}
}
$("#editid").val(obj.getAttribute('data-id'));
$("#updfname").val(namesArr[0]);
$("#updlname").val(lnames);
$("#updparentPhone").val(obj.getAttribute('data-phone'));
for(var i=0;i<selClass.length;i++){
  if(selClass[i].innerHTML==obj.getAttribute('data-class')){
selClass[i].setAttribute("selected","selected");    
  }
}
}
function downloadStudentData(){
  var uinfo=userInfo();
  //alert($("#selectedclass").val())
  window.location="../ajax/students.php?cate=loadexcel&schoolid="+uinfo.uid+"&class="+$("#selectedclass").val();
}
  $("#excelUpdateStudent").click(function(){
    downloadStudentData();
  })
function updateStudent(){
  $.ajax({url:"../ajax/students.php",data:{cate:'update',id:$("#editid").val(),name:$("#updfname").val()+" "+$("#updlname").val(),phone:$("#updparentPhone").val(),sex:$("#updsssex").val()},type:"POST",dataType:"text",success:function(res){
    if(res=='ok'){
$("#updStudentResponse").html("<font color='green'>Student updated successfull</font>");
  }else{
$("#updStudentResponse").html("<font color='fail'>Failed to update student</font>");
  }
  clearMsg("#updStudentResponse");
}
});
}

$("#selectedclass").change(function(){
loadStudentByClass();
if($(this).val()!='Select class'){
  $("#excelUpdateStudent").show();
  $("#btnPrintClassStudent").show();
}else{
  $("#excelUpdateStudent").hide();
  $("#btnPrintClassStudent").hide();
}
});
$("#btnUpdStudent").click(function(){
updateStudent();
});
function getSelectedClassVal(value){
  var el=document.getElementById('selectedclass').getElementsByTagName('option');
  for(var i=0;i<el.length;i++){
    if(el[i].getAttribute('value')==value){
      return el[i].innerHTML;
    }
  }
}
$("#btnPrintClassStudent").click(function(){
$(this).hide();
  $("#headingReport").show();
  $(".content-wrapper").hide();
$("#footerlg").hide();
$("#reportBody").html($("#tblteacher").html());
$("#schoolName").html($("#fullname").html());
$("#reportTitle").html("Available student for class "+getSelectedClassVal($("#selectedclass").val()));
$(".tblmodifications").hide();
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
  $("#headingReport").hide();
  $(".content-wrapper").show();
  $("#footerlg").show();
  $(this).show();
$(".tblmodifications").show();
});
//==================================================================
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php
}}
}
?>