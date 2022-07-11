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
  <meta name="description" content="Register Class -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Register Class | Tutor Inspection System</title>
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
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12 col-lg-12">
                <h2 align="center" class="list-group-item" id="crt_nw_cl_ttl">Create New Class</h2>
      <span id="hdn_crt_nw_cls">&nbsp&nbsp&nbsp&nbsp</span>
      <div class="row">
<div class="col-lg-3 col-md-3 col-sm-12">
        <label>Level:&nbsp&nbsp&nbsp&nbsp </label>
        <select class="form-control" name="class_level" id="class_level">
          <option value="choose">Class level</option>
          <option value="N">Nursery </option>
          <option value="P">Primary</option>
          <option value="O">O'Level</option>
          <option value="A">A'Level</option>
        </select>
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
  
        <label>Name: &nbsp&nbsp&nbsp&nbsp </label>
      <span id="ssdd"></span>
        <select type="text" class="form-control" name="class_level" id="class_name" placeholder="eg: P1,S2,S5,...">
          <option></option>
        </select>
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
  
        <label>&nbsp&nbsp&nbsp&nbspOption: &nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" class="form-control" name="class_level" id="class_option" placeholder="eg: MCB,CSC,EFK,..." disabled="disabled">
</div>
<div class="col-lg-3 col-md-3 col-sm-12">
  <label>&nbsp&nbsp&nbsp&nbsp Addition: &nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" class="form-control" name="class_level" id="class_option_mmre" placeholder="eg: A,B,C,...">
  
      </div>
      </div>
      </div>
              <div class="col-lg-12 col-md-12">
                <center>
                  <h4 id="crt_nw_cl_ttl"><span id="crt_nw_cl_ttl_av">Available Classes</span><center><button class="btn btn-primary pull-right" id="sub_new_clss" onclick="return addClasss()"><span class="glyphicon glyphicon-plus-sign"></span>Add class</button></center></h4>
                </center><br>
<div id="tbl_cntts">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead><tr><th>#Counts</th><th>Class Name</th><th>Number of Student</th><th>Modifications</th></tr></thead>
                    <tbody>
                      <input type="hidden" id="cls_id">
<?php
  $sel_cc=mysql_query("SELECT * FROM tis_classes WHERE class_xkul='$usr_id' AND LEFT(class_date,4)='".date("Y")."' ORDER BY class_name ASC");
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i;?></td>
  <td><?php echo $ft_sel_cc['class_name']?></td>
  <td><?php
  $clss_id=$ft_sel_cc['class_id'];
$sel_stcl_num=mysql_num_rows(mysql_query("SELECT * FROM tis_students WHERE student_class='$clss_id' AND student_xkul='$usr_id' order by 'class_teacherr' desc"));
   echo $sel_stcl_num; ?></td>
  <td>
    <button onclick="return loadStudentByClass(<?php echo $clss_id;?>)" class="btn btn-success" data-toggle='modal' data-target='#viewStudentModal'><span class="glyphicon glyphicon-eye-open"></span>&nbsp;View</button>&nbsp;
<script type="text/javascript">
  function viewDetClss(){
    document.getElementById("cls_id").value="<?php echo $clss_id?>";
  }
  function editDetClss(){
    var kjk=document.getElementById("cls_id").value;
    alert(kjk);
  }
</script>


    <button onclick="return editDetClss()" class="btn btn-warning glyphicon glyphicon-pencil" data-toggle='modal' data-target='#modalUpdateClasses'>Edit</button>
    <button class="btn btn-danger glyphicon glyphicon-remove" data-toggle='modal' data-target='#modalDeleteClasses'>Delete</button>
  </td>
</tr>
      <?php
      $i++;
    }
  }
?> 
</tbody>
                </table>
</div>
              </div>
            </div>
          </div>
    </div></div>
    <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateClasses" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                         <h4 class="modal-title">Update Class form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updProductResponse"></div>
<input type="hidden" id="editid">       
<div class="form-group">
        <label>Level:&nbsp;&nbsp;&nbsp;&nbsp; </label>
        <select class="form-control" name="class_level" id="class_level">
          <option value="choose">Class level</option>
          <option value="N">Nursery </option>
          <option value="P">Primary</option>
          <option value="O">O'Level</option>
          <option value="A">A'Level</option>
        </select>
</div>
<div class="form-group">
  
        <label>Name: &nbsp;&nbsp;&nbsp;&nbsp; </label>
      <span id="ssdd"></span>
        <select type="text" class="form-control" name="class_level" id="class_name" placeholder="eg: P1,S2,S5,..."><option>N1</option><option>N2</option><option>N3</option></select>
</div>
<div class="form-group">
  
        <label>&nbsp;&nbsp;&nbsp;&nbsp;Option: &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="text" class="form-control" name="class_level" id="class_option" placeholder="eg: MCB,CSC,EFK,..." disabled="disabled">
</div>
<div class="form-group">
  <label>&nbsp;&nbsp;&nbsp;&nbsp; Addition: &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="text" class="form-control" name="class_level" id="class_option_mmre" placeholder="eg: A,B,C,...">
  
      </div></form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdClass" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
         <!--End Optional-->
      <div id='modalDeleteClasses' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delClassResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delClassReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelClass" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

    <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdateStudent" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                         <h4 class="modal-title">Update Student form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updStudentResponse"></div>
<input type="hidden" id="editid">       
<div class="form-group">
        <label>Level:&nbsp;&nbsp;&nbsp;&nbsp; </label>
        <select class="form-control" name="class_level" id="class_level1">
          <option value="choose">Class level</option>
          <option value="N">Nursery </option>
          <option value="P">Primary</option>
          <option value="O">O'Level</option>
          <option value="A">A'Level</option>
        </select>
</div>
<div class="form-group">
  
        <label>Name: &nbsp;&nbsp;&nbsp;&nbsp; </label>
      <span id="ssdd"></span>
        <select type="text" class="form-control" name="class_level" id="class_name" placeholder="eg: P1,S2,S5,..."><option>N1</option><option>N2</option><option>N3</option></select>
</div>
<div class="form-group">
  
        <label>&nbsp;&nbsp;&nbsp;&nbsp;Option: &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="text" class="form-control" name="class_level" id="class_option" placeholder="eg: MCB,CSC,EFK,..." disabled="disabled">
</div>
<div class="form-group">
  <label>&nbsp;&nbsp;&nbsp;&nbsp; Addition: &nbsp;&nbsp;&nbsp;&nbsp; </label>
        <input type="text" class="form-control" name="class_level" id="class_option_mmre" placeholder="eg: A,B,C,...">
  
      </div></form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdClass" type="button"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
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

   <div id="viewStudentModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <!-- Modal content-->
      <div class="modal-content" style="width: 150%">
          <div class="modal-header">
            <h4 class="modal-title" id="invoiceidentViewModalTilt"> Student for the Class <span id="studClass"></span></h4>
           <button type="button" class="btn btn-primary" id="btnPrintClassStudent"><i class="fa fa-print"></i>Print</button>
           <button type="button" class="close" data-dismiss="modal">&times;</button> 
           </div>
          <div class="modal-body">
          <div class="table-responsive" id="divTblInvDt">
            <p style="color:green;font-size:14px;">  </p>
            <table class="table table-bordered" id="tblInvDt">
           <thead>
            <tr>
              <th>#Counts</th>
              <th>Name  </th>
                <th>Phone</th>
              <th>Sex </th>
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
  </div>
</body>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
function loadStudentByClass(id){
$.ajax({
  url:'../ajax/students.php',data:{cate:'load',class:id,skl:$("#decsklid").val()},type:'GET',dataType:'json',success:function(res){
    var dat="";
    if(res.length>0){
      $("#studClass").html(res[0].class_name);
      for(var i=0;i<res.length;i++){
        dat+="<tr><td>"+(i+1)+"</td>"
            +"<td>"+res[i].student_fullname+"</td>"
            +"<td>"+(res[i].student_father_phone==""?"None":res[i].student_father_phone)+"</td>"
            +"<td>"+res[i].student_sex+"</td>"
            +"<td>"+res[i].student_date.substring(0,10)+"</td>"
            //+"<td><button class='btn btn-warning glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modalUpdateStudent' data-dismiss='modal' onclick='loadClassById(\"edit\","+res[i].student_id+")'></button>"
    //+"<button class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#modalDeleteStudent'  data-dismiss='modal' onclick='loadClassById(\"delete\","+res[i].student_id+")'></button></td>"
            +"</tr>";
      }
      $("#loadedStudents").html(dat);
    }else{
      $("#loadedStudents").html("<tr><th colspan='6'><center><h3>No Student Available</h3></center></th></tr>");
    }
  }
})
};
function loadStudentsById(cate,id){
  $.ajax({
  url:'../ajax/student.php',data:{cate:'loadbyid',id:id},type:'GET',dataType:'json',success:function(res){
    switch(cate){
      case'edit':setEditStudent(res);break;
      case'delete':setDeleteStudent(res);break;
    }
  }
});
}
function setEditCourse(obj){
  $("#editid").val(obj[0].course_id);
$("#updcrsNm").val(obj[0].course_name);
$("#updovlMks").val(obj[0].course_marks);
$("#updavCls").html("<option value='"+obj[0].course_class+"'>"+obj[0].class_name+"</option>");
}
function setDeleteCourse(obj){
$("#editid").val(obj[0].course_id)
}
$("#btnPrintClassStudent").click(function(){
  $(this).hide();
  $("#headingReport").show();$(".content-wrapper").hide();
$("#footerlg").hide();
$("#reportBody").html($("#divTblInvDt").html());
$("#schoolName").html($("#fullname").html());
$("#reportTitle").html("Available Student for Class "+$("#studClass").html());
window.print();
$("#reportBody").html("");
$("#reportTitle").html("");
  $("#headingReport").hide();
  $(".content-wrapper").show();
  $("#footerlg").show();
  $(this).show();

});
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>

  <?php
}}
}
?>