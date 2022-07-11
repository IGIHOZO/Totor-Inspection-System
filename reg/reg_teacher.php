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
  <title>Register Teacher | Tutor Inspection System</title>
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
  <link rel="shortcut icon" href="../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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


          <div class="row" id="teachersviewform" style="padding:2%;">
             <span style="color:green"></span>
        <div class="table-responsive" id="tblTeacher">
        <style type="text/css">
  
        </style>
           <h3>Teachers available</h3>
        <table class="table table"  id="tblviewteacher" style="width: 100%">
           
            <thead>
              <tr><th>#Counts</th><th>Names</th><th>Username</th><th>Badge</th><th>Courses</th><th class="tblmodifications">Modification<br>
                <button class="btn btn-primary btn-sm pull-right" id="btnPrintTeacher"> <i class='fa fa-print'></i>Print</button>
                <button class="btn btn-info glyphicon glyphicon-plus-sign pull-right" data-toggle='modal' data-target='#modalRegisterTeacher'> New</button></th></tr>
            </thead>
          <tbody id="loadedteachers">
           <?php
  $sel_cc=mysql_query("SELECT tis_teachers.*,count(tis_courses.course_id) AS total_courses FROM tis_teachers LEFT JOIN tis_courses ON tis_courses.course_teacher=tis_teachers.teacher_id AND LEFT(tis_courses.course_date,4)='".date("Y")."' WHERE teacher_school='$usr_id' GROUP BY tis_teachers.teacher_id ORDER BY teacher_fullname ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.".&nbsp&nbsp";?></td>
  <td><?php echo "<span style='font-size:14px;'>".$ft_sel_cc['teacher_fullname']."</span>"?></td>
  <td><?php echo "<span style='font-size:14px;'>".$ft_sel_cc['teacher_username']."</span>"?></td>
  <td><?php echo "<span style='font-size:14px;'>".($ft_sel_cc['teacher_badge']==null?'None':$ft_sel_cc['teacher_badge'])."</span>";?></td>
<td><?php echo "<span style='font-size:14px;'>".$ft_sel_cc['total_courses']."</span>";?></td>

  <td  class="tblmodifications"><a href="#" onclick="loadCourseByTeacher(<?php echo $ft_sel_cc['teacher_id'];?>)" class="btn btn-success glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#viewTeacherCourseModal">Course</a>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalUpdateTeacher" data-id="<?=$ft_sel_cc['teacher_id'];?>" data-name="<?=$ft_sel_cc['teacher_fullname'];?>" data-uname="<?=$ft_sel_cc['teacher_username'];?>" data-badge="<?=$ft_sel_cc['teacher_badge'];?>" onclick="setEditTeacher(this)">Edit</a>&nbsp;&nbsp;&nbsp;
    <a href="#" class="btn btn-danger glyphicon glyphicon-remove" data-toggle="modal" data-target="#modalDeleteTeacher">Delete</a></td>
</tr>
      <?php
      $i++;
    }
  }
?> 
          </tbody>
        </table>
        </div>
      </div><!--end invoiceviewform-->
      <!-- Example DataTables Card-->
          <div class="form-group" style="display: none">
            <div class="form-row">
<div class="col-9" style="position: relative;">
                <h5 align="center" class="list-group-item" id="Ocrt_nw_cl_ttl">Register New Teacher</h5>
      <span id="Ohdn_crt_nw_cls">&nbsp&nbsp&nbsp&nbsp</span>
  <table class="table table-responsive">
    <thead>
      <tr>
        <td></td>
      </tr>
    </thead>
    <tr>
      <td>
        <label>Teacher's <b>First Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input type="text" id="Otechfnm" class="form-control" placeholder="eg: HABIMANA">
      </td>
    </tr>
    <tr>
      <td>
        <label>Teacher's <b>Last Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input type="text" id="Otechlnm" class="form-control" placeholder="eg: Jean Claude">
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <div class="input-group">
          <span class="input-group-addon col-2"><span class="glyphicon glyphicon-eye-open" id="Ogllyyd" style="font-size: 30px;font-weight: bolder"></span></span>
          <span class="input-group-addon col-10" id="Occ_tsh">Teacher's informations to be showed in order to acces his/her acount.</span>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <label>&nbsp&nbsp&nbsp<b>Username</b>: &nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
      <span id="Ossdd"></span>
        <input type="text" id="Otchusrnm" class="form-control" disabled="">
      </td>
    </tr>
    <tr>
      <td>
        <label>&nbsp&nbsp&nbsp<b>Password</b>: &nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
      <span id="ssdd"></span>
        <input type="text" id="Otchpsswd" value="<?php echo $all_flnm."123"?>" class="form-control" disabled="">
      </td>
    </tr>
<tr>
      <td colspan="4">
        <div class="input-group">
          <span class="input-group-addon" style="width: 100%">
           <p style="font-size: 15px;">Teacher will be given the above <b>Username</b> and <b>Password</b>, then after they are obliged to <u><b>change<br> password at first time</b> for having full control</u>.Administrtion are not allowed to access teacher's acount<br> without teacher's permission.</p>
          </span>
        </div>
      </td>
</tr>
    <tr>
      <td colspan="4">
        <center><button class="btn btn-primary" id="sub_new_tchr" style="margin-top: -30px" onclick="return addNwTchr()"><span class="glyphicon glyphicon-plus-sign"></span>Add Teacher</button>
      </td>
    </tr>
  </table>
</div>
<div class="col-3">
  <center>
     <h5 id="crt_nw_cl_ttl"><span class="glyphicon glyphicon-refresh" id="refree_tch"></span>&nbsp&nbsp<span id="crt_nw_cl_ttl_av">Available Teacher</span></h5>
  </center><br>
<div id="tbl_cntt" style="width:100%;height:85%;overflow:auto;">
                  <table id="cl_fr_tbl">
<?php
  $sel_cc=mysql_query("SELECT * FROM tis_teachers WHERE teacher_school='$usr_id' ORDER BY teacher_fullname ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.".&nbsp&nbsp";?></td>
  <td><?php echo "<span style='font-size:12px;font-weight:bold;font-style:italic'>".$ft_sel_cc['teacher_fullname']."</span>"?></td>
</tr>
      <?php
      $i++;
    }
  }
?> 
                </table>
</div>
</div>
            </div>
          </div>
    </div></div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
        <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateTeacher" class="modal fade">
            <div class='modal-dialog' style="">
                <div class="modal-content" style="padding: 20px;width: 150%;margin-left: : -30%;">
                    <div class="modal-header">
                         <h4 class="modal-title">Teacher Updating form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updTeacherResponse"></div>
<input type="hidden" id="editid">       
<label>Teacher's <b>First Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="updtechfnm" class="form-control" placeholder="eg: HABIMANA">
        <label>Teacher's <b>Last Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="updtechlnm" class="form-control" placeholder="eg: Jean Claude">
        <label>&nbsp&nbsp&nbsp<b>Badge</b>: &nbsp&nbsp&nbsp&nbsp </label>
      <span id="badgevalid"></span>
        <input type="text" id="updtchbadge" class="form-control">
        <div class="input-group">
          <span class="input-group-addon col-2"><span class="glyphicon glyphicon-eye-open" id="updgllyyd" style="font-size: 30px;font-weight: bolder"></span></span>
          <span class="input-group-addon col-10" id="updcc_tsh">Teacher's informations to be showed in order to acces his/her acount.</span>
        </div>
        <label>&nbsp&nbsp&nbsp<b>Username</b>: &nbsp&nbsp&nbsp&nbsp </label>
      <span id="ssdd"></span>
        <input type="text" id="updtchusrnm" class="form-control" disabled=""></form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdTeacher" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
                <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRegisterTeacher" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;width: 150%">
                    <div class="modal-header">
                         <h4 class="modal-title">Teacher Registration form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="regTeacherResponse"></div>
<input type="hidden" id="editid">       
  <label>Teacher's <b>First Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="techfnm" class="form-control" placeholder="eg: HABIMANA">
        <label>Teacher's <b>Last Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="techlnm" class="form-control" placeholder="eg: Jean Claude">
          <label><b>Badge</b>: </label>
       <input type="text" id="tchrBadge" class="form-control" placeholder="eg: JS011">
        <div class="input-group">
          <span class="input-group-addon col-2"><span class="glyphicon glyphicon-eye-open" id="gllyyd" style="font-size: 30px;font-weight: bolder"></span></span>
          <span class="input-group-addon col-10" id="cc_tsh">Teacher's informations to be showed in order to acces his/her acount.</span>
        </div>
        <label>&nbsp&nbsp&nbsp<b>Username</b>: &nbsp&nbsp&nbsp&nbsp </label>
      <span id="ssdd"></span>
        <input type="text" id="tchusrnm" class="form-control" disabled="">
        <label>&nbsp&nbsp&nbsp<b>Password</b>: &nbsp&nbsp&nbsp&nbsp </label>
      <span id="ssdd"></span>
        <input type="text" id="tchpsswd" value="<?php echo $all_flnm."123"?>" class="form-control" disabled="">
        <div class="input-group">
          <span class="input-group-addon" style="width: 100%">
           <p style="font-size: 15px;">Teacher will be given the above <b>Username</b> and <b>Password</b>, then after they are obliged to <u><b>change<br> password at first time</b> for having full control</u>.Administrtion are not allowed to access teacher's acount<br> without teacher's permission.</p>
          </span>
        </div>
        </form>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-primary" id="sub_new_tchr" style="" onclick="return addNwTchr()"><span class="glyphicon glyphicon-plus-sign"></span>Add Teacher</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
        <div id='modalDeleteTeacher' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delTeacherResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delTeacherReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelTeacher" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
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
    <div id="viewTeacherCourseModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="invoiceidentViewModalTilt"> Courses for the Teacher <span id="courseTeacher"></span>
              <button type="button" id="btnPrintTeacherCourse" class="btn btn-primary pull-right"><i class="fa fa-print"></i>Print</button></h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
          <div class="modal-body">
          <div class="table-responsive" id="divTblInvDt">
            <p style="color:green;font-size:14px;">  </p>
            <table class="table table-bordered" id="tblInvDt">
           <thead>
            <tr>
              <th>#Counts</th>
              <th>Class  </th>
                <th>Course</th>
              <th>Marks</th>
              <th> Date</th>
            </tr>
          </thead>
          <tbody id="loadedStudents">
          
          </tbody>
        </table>
        </div>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
      </div>

    </div>
  </div><!--end Invoice Details View Modal-->
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
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
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
function loadCourseByTeacher(id){
$.ajax({
  url:'../ajax/courses.php',data:{cate:'loadbyteacher',teacher:id,skl:$("#decsklid").val()},type:'GET',dataType:'json',success:function(res){
    var dat="";
    if(res.length>0){
      $("#courseTeacher").html("<br><font size='3'>"+res[0].teacher_fullname+"</font>");
      for(var i=0;i<res.length;i++){
        dat+="<tr><td>"+(i+1)+"</td>"
            +"<td>"+res[i].class_name+"</td>"
            +"<td>"+res[i].course_name+"</td>"
            +"<td>"+res[i].course_marks+"</td>"
            +"<td>"+res[i].course_date.substring(0,10)+"</td>"
            //+"<td><button class='btn btn-warning glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modalUpdateStudent' data-dismiss='modal' onclick='loadClassById(\"edit\","+res[i].student_id+")'></button>"
//    +"<button class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#modalDeleteStudent'  data-dismiss='modal' onclick='loadClassById(\"delete\","+res[i].student_id+")'></button></td>"
            +"</tr>";
      }
      $("#loadedStudents").html(dat);
    }else{
      $("#loadedStudents").html("<tr><th colspan='6'><center><h3>No Student Available</h3></center></th></tr>");
    }
  }
})
};
function loadTeachersById(cate,id){
  $.ajax({
  url:'../ajax/teachers.php',data:{cate:'loadby',id:id},type:'GET',dataType:'json',success:function(res){
    switch(cate){
      case'edit':setEditTeacher(res);break;
      case'delete':setDeleteTeacher(res);break;
    }
  }
});
}
function setEditTeacher(obj){
  var namesArr=obj.getAttribute("data-name").split(" ");
  var lname="";
  for(i=1;i<namesArr.length;i++){
    lname+=" "+namesArr[i];
  }
  $("#editid").val(obj.getAttribute('data-id'));
$("#updtechfnm").val(namesArr[0]);
$("#updtechlnm").val(lname);
$("#updtchusrnm").val(obj.getAttribute("data-uname"));
$("#updtchbadge").val(obj.getAttribute("data-badge"));
}
function setDeleteTeacher(obj){
$("#editid").val(obj.getAttribute('data-id'));
}
function updateTeacher(){
ajax("../ajax/teacher.php",{cate:'update',id:$("#editid").val(),name:$("#updtechfnm").val()+" "+$("#updtechlnm").val(),badge:$("#updtchbadge").val()},"POST","text",function(res){
if(res=='ok'){
$("#updTeacherResponse").html("<font color='green'>Teacher updated success</font>");
}else{
$("#updTeacherResponse").html("<font color='red'>Failed to update Teacher</font>");
}
clearMsg("#updTeacherResponse");
})
}
function deleteTeacher(){
 ajax("../ajax/teacher.php",{cate:'delete',id:$("#editid").val(),reason:$("#delTeacherReason").val()},"POST","text",function(res){
if(res=='ok'){
$("#delTeacherResponse").html("<font color='green'>Teacher deleted success</font>");
}else{
$("#delTeacherResponse").html("<font color='green'>Failed to delete Teacher</font>");
}
clearMsg("#delTeacherResponse");
}) 
}
function setDeleteCourse(obj){
$("#editid").val(obj[0].teacher_id)
}
$("#btnUpdTeacher").click(function(e){
updateTeacher();
});
$("#btnPrintTeacherCourse").click(function(){
  $(this).hide();
  $("#headingReport").show();$(".content-wrapper").hide();
$("#footerlg").hide();
$("#reportBody").html($("#divTblInvDt").html());
$("#schoolName").html($("#fullname").html());
$("#reportTitle").html("Available Course for Teacher "+$("#courseTeacher").html());
  $("#viewTeacherCourseModal").hide();
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
  $("#headingReport").hide();
  $(".content-wrapper").show();
  $("#footerlg").show();
  $("#viewTeacherCourseModal").show();
  $(this).show();
});
$("#btnPrintTeacher").click(function(){
$(this).hide();
  $("#headingReport").show();$(".content-wrapper").hide();
$("#footerlg").hide();
$("#reportBody").html($("#tblTeacher").html());
$("#schoolName").html($("#fullname").html());
//$("#reportTitle").html("Available Course for Teacher "+$("#courseTeacher").html());
$(".tblmodifications").hide();
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
  $("#headingReport").hide();
  $(".content-wrapper").show();
  $("#footerlg").show();
  $(this).show();
$(".tblmodifications").show();
})
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php
}}
}
?>