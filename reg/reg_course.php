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
  <meta name="description" content="Register Course -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Register Course | Tutor Inspection System</title>
<style>
.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #432445;
  border-right: 5px solid #64782a;
  border-bottom: 5px solid #a28021;
  border-left: 5px solid #cd5609;
  width: 35px;
  height: 35px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.loader01 {
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
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <link href="../css/web/register_class.css" rel="stylesheet">
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
          <div class="form-group" style="display: none;">
            <div class="form-row">
              <div class="col-md-9">
                <h2 align="center" class="list-group-item" id="crt_nw_cl_ttl">Register New Course</h2>
      <span id="hdn_crt_nw_crs">&nbsp&nbsp&nbsp&nbsp</span>
  <table id="new_cls_tbl" class="table table-responsive">
    <tr>
      <td>
        <label>Select Class :&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
<div class="input-group">
          <select class="form-control" id="OavCls">
          <option value="choose">Select Class Here...</option>
<?php
$sel_my_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' AND class_status='E' ORDER BY class_name ASC");
$count_sel_my_clss=mysql_num_rows($sel_my_clss);
if ($count_sel_my_clss>0) {
  while ($ft_sel_my_clss=mysql_fetch_assoc($sel_my_clss)) {
    echo "<option>".$ft_sel_my_clss['class_name']."</option>";
  }
}else{
  echo "<option id='nw_st_n_av_cl' value='No'>NO AVAILABE CLASSES</option>";
}
?>
        </select>
                    <input type="hidden" id="Ohhddcl">
        <span class="input-group-addon" id="Oshw_crss"><span class="glyphicon glyphicon-share-alt" id="shw_icrs"></span></span>
</div>
      </td>
    </tr>
    <tr>
      <td>
        <label>Course Name: &nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td>
      <span id="ssdd"></span>
      <input type="text" class="form-control" id="OcrsNm" placeholder="eg: Mathematics">
      </td>
    </tr>
<tr>
      <td>
        <label>Over-all marks: &nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td>
<div class="input-group">
        <span class="input-group-addon"><label>Overall (Exam+Tests)</label></span>
        <input type="number" class="form-control" id="OovlMks" placeholder="  eg: 120          (60 + 60)">
</div>
      </td>
</tr>
    <tr>
      <td colspan="4">
        <center><button class="btn btn-primary" id="Osub_new_clss" onclick="return addCourse()"><span class="glyphicon glyphicon-plus-sign"></span>&nbspRegister</button>
      </td>
    </tr>
  </table>
              </div>
              <div class="col-md-3">
                <center>
                  <h4 id="crt_nw_cl_ttl"><span id="crt_nw_cl_ttl_av">Class Courses</span></h4>
                </center><br>
<div id="tbl_cntt" style="height: 130%;">
                  <table id="cl_fr_tbl">

                </table>
</div>
              </div>
            </div>
          </div><!--end  old design-->
          <div class="col-md-12 col-lg-12">
                <h2 align="center" class="list-group-item" id="crt_nw_cl_ttl">Register New Course</h2>
      <span id="hdn_crt_nw_cls">&nbsp&nbsp&nbsp&nbsp</span>
      <div class="row">
<div class="col-lg-3 col-md-3 col-sm-12">
       <label>Select Class :&nbsp&nbsp&nbsp&nbsp </label>
        <select class="form-control input-group" id="avCls">
          <option value="choose">Select Class Here...</option>
<?php
$sel_my_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_status='E' AND LEFT(class_date,4)='".date("Y")."' ORDER BY class_name ASC");
$count_sel_my_clss=mysql_num_rows($sel_my_clss);
if ($count_sel_my_clss>0) {
  while ($ft_sel_my_clss=mysql_fetch_assoc($sel_my_clss)) {
    echo "<option value='".$ft_sel_my_clss['class_id']."'>".$ft_sel_my_clss['class_name']."</option>";
  }
}else{
  echo "<option id='nw_st_n_av_cl' value='No'>NO AVAILABE CLASSES</option>";
}
?>
        </select>
                    <input type="hidden" id="hhddcl">
        <span class="input-group-addon" id="shw_crss" style="display: none;"><span class="glyphicon glyphicon-share-alt" id="shw_icrs"></span></span>
</div>
<div class="col-lg-3 col-md-3 col-sm-12">

    <label>Course Name: &nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" class="form-control" id="crsNm" placeholder="eg: Mathematics">
     <div id="coursesSelect"></div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
  
          <label>Over-all marks (Exam+Tests) </label>
        <input type="number" class="form-control" id="ovlMks" placeholder="   eg: 120         (60 + 60)">
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
  <button class="btn btn-primary" id="sub_new_clss" onclick="return addCourse()"><span class="glyphicon glyphicon-plus-sign"></span>&nbspRegister</button>
  
      </div>
      </div>
      </div>
              <div class="col-lg-12 col-md-12">
                <center>
                  <h4 id="crt_nw_cl_ttl"><span class="glyphicon glyphicon-refresh" id="refree_cl"></span>&nbsp&nbsp<span id="crt_nw_cl_ttl_av">Available Courses</span>
                    <span><button type="button" id="btnPrintCourse" class="btn btn-primary pull-right"><i class="fa fa-print"></i>Print</button></span></h4>
                </center><br>
<div id="tbl_cntts">
                  <table id="cl_fr_tbl" class="table table-bordered" border="1">
                    <thead><tr><th>#Counts</th><th>Class</th><th>Teacher</th><th>Name</th><th>Marks</th><th class="tblmodifications">Modifications</th></tr></thead>
                    <tbody id="loadedCourses">
<?php
 /* $sel_cc=mysql_query("SELECT tis_courses.*,tis_teachers.teacher_fullname,tis_classes.class_name FROM tis_courses INNER JOIN tis_classes ON tis_classes.class_id=tis_courses.course_class INNER JOIN tis_teachers ON tis_teachers.teacher_id=tis_courses.course_teacher WHERE class_xkul='$usr_id' ORDER BY class_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $ft_sel_cc['class_name']?></td>
  <td><?php echo $ft_sel_cc['teacher_fullname']?></td>
  <td><?php echo $ft_sel_cc['course_name']?></td>
  <td><?php echo $ft_sel_cc['course_marks']?></td>s
  <td><!--button class="btn btn-success glyphicon glyphicon-eye-open" data-toggle='modal' data-target='#viewCourseModal'>View</button--><button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle='modal' data-target='#modalUpdateCourse'>Edit</button>
    <button class="btn btn-danger glyphicon glyphicon-remove" data-toggle='modal' data-target='#modalDeleteCourse'>Delete</button></td>
</tr>
      <?php
      $i++;
    }
  }
  */
?> 
</tbody>
                </table>
</div>
              </div>
            </div>
          </div>
    </div>
    <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateCourse" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                         <h4 class="modal-title">Update Course form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updCourseResponse"></div>
<input type="hidden" id="editid">
<div class="form-group">       
<label>Select Class :&nbsp&nbsp&nbsp&nbsp </label>
        <select class="form-control" id="updavCls">
          <option value="choose">Select Class Here...</option>
<?php
$sel_my_clss=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND class_status='E' AND LEFT(class_date,4)='".date("Y")."' ORDER BY class_name ASC");
$count_sel_my_clss=mysql_num_rows($sel_my_clss);
if ($count_sel_my_clss>0) {
  while ($ft_sel_my_clss=mysql_fetch_assoc($sel_my_clss)) {
    echo "<option value='".$ft_sel_my_clss['class_id']."'>".$ft_sel_my_clss['class_name']."</option>";
  }
}else{
  echo "<option id='nw_st_n_av_cl' value='No'>NO AVAILABE CLASSES</option>";
}
?>
        </select>
        <input type="hidden" id="hhddcl">
        <span class="input-group-addon" id="shw_crss"><span class="glyphicon glyphicon-share-alt" id="shw_icrs"></span></span>
</div>
<div class="form-group">

    <label>Course Name: &nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" class="form-control" id="updcrsNm" placeholder="eg: Mathematics">
</div>
<div class="form-group">
  
          <label>Over-all marks: &nbsp&nbsp&nbsp&nbsp </label>
      <span class="input-group-addon"><label>Overall (Exam+Tests)</label></span>
        <input type="number" class="form-control" id="updovlMks" placeholder="eg: 120                                                   (60 + 60)">
</div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdCourse" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>

        </div><!--end Course Dialog-->
         <!--End Optional-->
      <div id='modalDeleteCourse' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delCourseResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delCourseReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelCourse" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

   <div id="viewCourseModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="invoiceidentViewModalTilt"> Course for the Class <span id="studClass"></span></h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
          <div class="modal-body">
          <div class="table-responsive">
            <p style="color:green;font-size:14px;">  </p>
            <table class="table table-bordered" id="tblInvDt">
           <thead>
            <tr>
              <th>#Counts</th>
              <th>Name  </th>
                <th>Marks</th>
                <th>Modifications</th>
              <th> Date</th>
            </tr>
          </thead>
          <tbody>
          
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
  </div>
    <!-- /.container-fluid-->

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
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
$("#avCls").change(function(e){
$.ajax({
  url:'../ajax/courses.php',data:{cate:'loadbyclass',class:$("#avCls").val()},type:'GET',dataType:'json',success:function(res){
    var dat="";
    if(res.length>0){
      for(var i=0;i<res.length;i++){
        dat+="<tr><td>"+(i+1)+"</td>"
            +"<td>"+res[i].class_name+"</td>"
            +"<td>"+(res[i].teacher_fullname==null?"None":res[i].teacher_fullname)+"</td>"
            +"<td>"+res[i].course_name+"</td>"
            +"<td>"+res[i].course_marks+"</td>"
            +"<td class='tblmodifications'><button class='btn btn-warning glyphicon glyphicon-pencil' data-toggle='modal' data-id="+res[i].course_id+" data-name='"+res[i].course_name+"' data-marks="+res[i].course_marks+" data-classid="+res[i].course_class+"  data-class='"+res[i].class_name+"' data-target='#modalUpdateCourse' onclick='setEditCourse(this)'>Edit</button>"
    +"<button class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#modalDeleteCourse' onclick='loadClassById(\"delete\","+res[i].course_id+")'>Delete</button></td>"
            +"</tr>";
      }
      $("#loadedCourses").html(dat);
    }
  }
})
});
function loadClassById(cate,id){
  $.ajax({
  url:'../ajax/courses.php',data:{cate:'loadbyid',id:id},type:'GET',dataType:'json',success:function(res){
    switch(cate){
      case'edit':setEditCourse(res);break;
      case'delete':setDeleteCourse(res);break;
    }
  }
});
}
function setEditCourse(obj){
  $("#editid").val(obj.getAttribute("data-id"));
$("#updcrsNm").val(obj.getAttribute("data-name"));
$("#updovlMks").val(obj.getAttribute("data-marks"));
$("#updavCls").html("<option value='"+obj.getAttribute("data-classid")+"'>"+obj.getAttribute("data-class")+"</option>");
}
function setDeleteCourse(obj){
$("#editid").val(obj[0].getAttribute("data-id"));
}
function findCourse(){
  var uinfo=userInfo();
ajax("../ajax/courses.php",{cate:'find',key:$("#crsNm").val(),uid:uinfo.uid,usercate:uinfo.ucate},"GET","json",function(res){
if(res.length!=0){
  setLoadedCourseSelection(res);
}else{
  $("#coursesSelect").html(res);
}
});
}
function setLoadedCourseSelection(obj){
  var selCourse="";
  for(var i=0;i<obj.length;i++){
    selCourse+="<br><span onclick='$(\"#crsNm\").val(\""+obj[i].course_name+"\");$(\"#coursesSelect\").html(\"\")' onmouseover='this.style.backgroundColor=\"lightgray\"' onmouseout='this.style.backgroundColor=\"\"'>"+obj[i].course_name+"</span>"
  }
  $("#coursesSelect").html(selCourse);
}
function updateCourse(){
 $.ajax({
  url:'../ajax/courses.php',data:{cate:'update',id:$("#editid").val(),name:$("#updcrsNm").val(),marks:$("#updovlMks").val()},type:'POST',dataType:'text',success:function(res){
    if(res=='ok'){
      $("#updCourseResponse").html("<font color='green'>Course updated successfull</font>");
    }else{
      $("#updCourseResponse").html("<font color='red'>Failed to update Course</font>");
    }
    clearMsg("#updCourseResponse");
    }
}); 
}
//AutoClear Msg
function clearMsg(elem){
setTimeout(function(){
$(elem).html("");
},5000);
}
//typing in course name
$("#crsNm").keyup(function(){
  if($(this).val()!=""){
    findCourse();
  }
})

$("#btnUpdCourse").click(function(){
  updateCourse();
});
function getSelectedHtml(elem){
  var el=document.getElementById(elem).getElementsByTagName("option");
for(var i=0;i<el.length;i++){
  if(el[i].value==$("#hhddcl").val()){
    return el[i].innerHTML;
  }
}
}
$("#btnPrintCourse").click(function(){
  $("#headingReport").show();$(".content-wrapper").hide();
$(".tblmodifications").hide();$("#footerlg").hide();
$("#reportBody").html($("#tbl_cntts").html());
$("#schoolName").html($("#fullname").html());
$("#reportTitle").html("Available Course for Class "+getSelectedHtml("avCls"));
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
$(".tblmodifications").show();
  $("#headingReport").hide();$(".content-wrapper").show();
  $("#footerlg").show();

});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php
}}
}
?>