<?php
session_start();
require("../../libs/parts/didier_igihozo.php");
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
if (@!$_SESSION['seveeen_tis_seveeen_admin_name']) {
?>
<script type="text/javascript">
  window.location="../../login.php";
</script>
<?php
}else{
@$usr_id=$_SESSION['seveeen_tis_seveeen_admin_id'];
$all_flnm=$_SESSION['seveeen_tis_seveeen_admin_name'];
$dc_all_flnm=seveeen_my_fl_nm_enc($all_flnm);
$ntstt="Ny";
$mdstt="Md";
$se_all_id=mysql_query("SELECT * FROM tis_seveeen_ltd WHERE seveeen_ltd_id='$usr_id' AND seveeen_ltd_name='$dc_all_flnm'");
$cnt_se_all_id=mysql_num_rows($se_all_id);
if ($cnt_se_all_id!=1) {
 echo "<h1 style='color:red'><center>Something went wrong... ||  Please contact your administrator</center></h1>";
}else{
  $ft_cnt_se_all_id=mysql_fetch_assoc($se_all_id);
  $all_id=$ft_cnt_se_all_id['seveeen_ltd_id'];

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Register School -- Tutor Inspection System by SEVEEEN Ltd." />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Register School | Tutor Inspection System</title>
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
  <link rel="shortcut icon" href="../../libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="../../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link href="../../css/web/index.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" style="background-color: #000">
 <!-- Navigation-->
    <?php
include"../../menus/aheader.php";
  ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
         </div>
    <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalRegSchool" class="modal fade">

<div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;width:150%;">
                    <div class="modal-header">
                         <h4 class="modal-title">Register New school form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="regSchoolResponse"></div>
                     <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
       <label class="xkrtf_tdlb"> <b>Full Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
      <input style="width: 70%;" type="text" id="xkl_fllnm" class="form-control" placeholder="eg: Groupe Scolaire saint Marie des anges Ndela">
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"><b>Abreviation</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="xkl_abrnm" class="form-control" placeholder="eg: G.M.A.N">
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"> <b>Category</b>:&nbsp&nbsp&nbsp&nbsp </label><br>
        <input value="PR" type="radio" name="xkl_categ" checked="checked">
        <label>Private</label>
        <input value="PU" type="radio" name="xkl_categ">
        <label>Public</label>
        <input value="GA" type="radio" name="xkl_categ">
        <label>Government-Aided </label>
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"><b>Church-based</b> </label>
      
        <input type="checkbox" id="xkl_chbsd">
        <select id="selChrVl" class="form-control" disabled>
          <option value="default">Select</option>
          <option value="ADV">Adventists</option>
          <option value="ANG">Anglicans</option>
          <option value="BAP">Baptists</option>\
          <option value="CAT">Catholic</option>
          <option value="ISL">Islamic</option>
        </select>
        <script type="text/javascript">
          var chChr=document.getElementById("xkl_chbsd");
          var selChrVl=document.getElementById("selChrVl");
          var chVl=false;
          chChr.addEventListener("click", enDisSel);
          function enDisSel(){
            if (chChr.checked==true) {
              selChrVl.removeAttribute("disabled");
            }else{
              selChrVl.setAttribute("disabled",true);
            }
          }


        </script>
      </div>
                    </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    
      <div class="form-group">
        <label class="xkrtf_tdlb"> <b>Phone</b>:&nbsp&nbsp&nbsp&nbsp </label>
      
<div  style="margin-left: 0px" class="input-group">
      <span class="input-group-addon"><span style="width: 6px">+</span></span>
        <input type="number" id="xkl_phone" class="form-control" maxlength="13" placeholder="eg: +250784424020" value="+250">
                    <input type="hidden" id="hhddcl">
</div>
     
                      </div>
                      <div class="form-group">
        <label class="xkrtf_tdlb" style="margin-left: -3px"><b>Location</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <select id="xkl_loct" class="form-control" maxlength="13">
          <option value="default" selected>Select</option><option>Bugesera</option>  <option>Burera</option>  <option>Gakenke</option>  <option>Gasabo</option>  <option>Gatsibo</option>  <option>Gicumbi</option>  <option>Gisagara</option><option>Huye</option>  <option>Kamomyi</option>  <option>Karongi</option>  <option>Kayonza</option>  <option>Kicukiro</option>  <option>Kirehe</option>  <option>Muhanga</option><option>Musanze</option>  <option>Ngoma</option>  <option>Ngororero</option>  <option>Nyabihu</option>  <option>Nyagatare</option>  <option>Nyamagabe</option>  <option>Nyamasheke</option><option>Nyanza</option>  <option>Nyarugenge</option>  <option>Nyaruguru</option>  <option>Rubavu</option>  <option>Ruhango</option>  <option>Rulindo</option>  <option>Rusizi</option><option>Rutsiro</option>  <option>Rwamagana</option>
        </select>
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb">school <b>E-mail</b>:&nbsp&nbsp&nbsp&nbsp </label>
      <input type="text" id="xkl_email" class="form-control" placeholder="eg: seveeen1@gmail.com">
</div>
        <div class="form-group">
        <label class="xkrtf_tdlb"><b>Brought by</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <select id="xkl_br_by" class="form-control">
          <option value="default" selected>Select</option>
          <option value="SVN">Seveeen Ltd</option>
          <option value="BFG">BFG Ltd</option>
          <option value="TPT">Third-party</option>
        </select>
        </div>
     
                      </div>
                     </div>
                        </form>
                      </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnRegSchool" type="button" onclick="addNwXkl()"><i class="fa fa-check-square-o"></i> Save</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
 <div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdSchool" class="modal fade">

<div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;width:150%;">
                    <div class="modal-header">
                         <h4 class="modal-title">Update school form</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         </div>
                <div class="modal-body">
          <form>
                     <div id="updSchoolResponse"></div>
                     <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="form-group">
       <label class="xkrtf_tdlb"> <b>Full Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
      <input style="width: 70%;" type="text" id="updxkl_fllnm" class="form-control" placeholder="eg: Groupe Scolaire saint Marie des anges Ndela">
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"><b>Abreviation</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <input type="text" id="updxkl_abrnm" class="form-control" placeholder="eg: G.M.A.N">
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"> <b>Category</b>:&nbsp&nbsp&nbsp&nbsp </label><br>
        <input value="PR" type="radio" name="updxkl_categ" checked="checked">
        <label>Private</label>
        <input value="PU" type="radio" name="updxkl_categ">
        <label>Public</label>
        <input value="GA" type="radio" name="updxkl_categ">
        <label>Government-Aided </label>
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb"><b>Church-based</b> </label>
      
        <input type="checkbox" id="updxkl_chbsd">
        <select id="updselChrVl" class="form-control" disabled>
          <option value="default">Select</option>
          <option value="ADV">Adventists</option>
          <option value="ANG">Anglicans</option>
          <option value="BAP">Baptists</option>\
          <option value="CAT">Catholic</option>
          <option value="ISL">Islamic</option>
        </select>
        <script type="text/javascript">
          var chChr=document.getElementById("xkl_chbsd");
          var selChrVl=document.getElementById("selChrVl");
          var chVl=false;
          chChr.addEventListener("click", enDisSel);
          function enDisSel(){
            if (chChr.checked==true) {
              selChrVl.removeAttribute("disabled");
            }else{
              selChrVl.setAttribute("disabled",true);
            }
          }


        </script>
      </div>
                    </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    
      <div class="form-group">
        <label class="xkrtf_tdlb"> <b>Phone</b>:&nbsp&nbsp&nbsp&nbsp </label>
      
<div  style="margin-left: 0px" class="input-group">
      <span class="input-group-addon"><span style="width: 6px">+</span></span>
        <input type="number" id="updxkl_phone" class="form-control" maxlength="13" placeholder="eg: +250784424020" value="+250">
                    <input type="hidden" id="hhddcl">
</div>
     
                      </div>
                      <div class="form-group">
        <label class="xkrtf_tdlb" style="margin-left: -3px"><b>Location</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <select id="updxkl_loct" class="form-control" maxlength="13">
          <option value="default" selected>Select</option><option>Bugesera</option>  <option>Burera</option>  <option>Gakenke</option>  <option>Gasabo</option>  <option>Gatsibo</option>  <option>Gicumbi</option>  <option>Gisagara</option><option>Huye</option>  <option>Kamomyi</option>  <option>Karongi</option>  <option>Kayonza</option>  <option>Kicukiro</option>  <option>Kirehe</option>  <option>Muhanga</option><option>Musanze</option>  <option>Ngoma</option>  <option>Ngororero</option>  <option>Nyabihu</option>  <option>Nyagatare</option>  <option>Nyamagabe</option>  <option>Nyamasheke</option><option>Nyanza</option>  <option>Nyarugenge</option>  <option>Nyaruguru</option>  <option>Rubavu</option>  <option>Ruhango</option>  <option>Rulindo</option>  <option>Rusizi</option><option>Rutsiro</option>  <option>Rwamagana</option>
        </select>
      </div>
      <div class="form-group">
        <label class="xkrtf_tdlb">school <b>E-mail</b>:&nbsp&nbsp&nbsp&nbsp </label>
      <input type="text" id="updxkl_email" class="form-control" placeholder="eg: seveeen1@gmail.com">
</div>
        <div class="form-group">
        <label class="xkrtf_tdlb"><b>Brought by</b>:&nbsp&nbsp&nbsp&nbsp </label>
        <select id="updxkl_br_by" class="form-control">
          <option value="default" selected>Select</option>
          <option value="SVN">Seveeen Ltd</option>
          <option value="BFG">BFG Ltd</option>
          <option value="TPT">Third-party</option>
        </select>
        </div>
     
                      </div>
                     </div>
                        </form>
                      </div>

                        <div class="modal-footer">
                            <button class="btn btn-success" id="btnUpdSchool" type="button" onclick="updateXkl()"><i class="fa fa-check-square-o"></i> Update</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-remove"></i>Cancel</button>
                        </div>
                    </div>
                </div>
        </div><!--end Product Dialog-->
         <!--  <div class="form-group">
            <div class="form-row">
<div class="col-9" style="position: relative;">
                <h5 align="center" class="list-group-item" id="crt_nw_cl_ttl">Register New School</h5>
      <center><span id="hdn_crt_nw_cls">&nbsp&nbsp&nbsp&nbsp</span></center>
  <table class="table table-responsive" id="xklRegTbl">
    <thead>
      <tr>
        <td></td>
      </tr>
    </thead>
    <tr>
      <td style="font-size: 13px">
        <label class="xkrtf_tdlb">School's <b>Full Name</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input style="width: 70%;" type="text" id="xkl_fllnm" class="form-control" placeholder="eg: Groupe Scolaire saint Marie des anges Ndela">
      </td>
    </tr>
    <tr>
      <td style="font-size: 13px">
        <label class="xkrtf_tdlb">School <b>Abreviation</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input style="width: 47%;" type="text" id="xkl_abrnm" class="form-control" placeholder="eg: G.M.A.N">
      </td>
    </tr>
    <tr>
      <td style="font-size: 13px">
        <label class="xkrtf_tdlb">School <b>Category</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="">
        <input value="PR" type="radio" name="xkl_categ">
        <label>Private</label>
      </td>
      <td colspan="">
        <input value="PU" type="radio" name="xkl_categ">
        <label>Public</label>
      </td>
      <td colspan="">
        <input value="GA" type="radio" name="xkl_categ">
        <label>Government-Aided </label>
      </td>
    </tr>
    <tr style="background-color: #f7f6f6;">
      <td>
        <label class="xkrtf_tdlb"><b>Church-based</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input type="checkbox" id="xkl_chbsd">
        <select id="selChrVl" class="form-control" style="margin-right:130px;width: 34%;float: right;margin-left: 15px;position: absolute;margin-top: -30px" disabled>
          <option value="default">Select</option>
          <option value="ADV">Adventists</option>
          <option value="ANG">Anglicans</option>
          <option value="BAP">Baptists</option>\
          <option value="CAT">Catholic</option>
          <option value="ISL">Islamic</option>
        </select>
        <script type="text/javascript">
          var chChr=document.getElementById("xkl_chbsd");
          var selChrVl=document.getElementById("selChrVl");
          var chVl=false;
          chChr.addEventListener("click", enDisSel);
          function enDisSel(){
            if (chChr.checked==true) {
              selChrVl.removeAttribute("disabled");
            }else{
              selChrVl.setAttribute("disabled",true);
            }
          }


        </script>
      </td>
    </tr>
    <tr>
      <td>
        <label class="xkrtf_tdlb">school <b>Phone</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td >
<div  style="margin-left: 0px" class="input-group">
      <span class="input-group-addon"><span style="width: 6px">+</span></span>
        <input type="number" id="xkl_phone" class="form-control" style="width: 86%;" maxlength="13" placeholder="eg: +250784424020" value="+250">
                    <input type="hidden" id="hhddcl">
</div>

      </td>
      <td>
        <label class="xkrtf_tdlb" style="margin-left: -3px"><b>Location</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td >
        <select id="xkl_loct" class="form-control" maxlength="13">
          <option value="default" selected>Select</option><option>Bugesera</option>  <option>Burera</option>  <option>Gakenke</option>  <option>Gasabo</option>  <option>Gatsibo</option>  <option>Gicumbi</option>  <option>Gisagara</option><option>Huye</option>  <option>Kamomyi</option>  <option>Karongi</option>  <option>Kayonza</option>  <option>Kicukiro</option>  <option>Kirehe</option>  <option>Muhanga</option><option>Musanze</option>  <option>Ngoma</option>  <option>Ngororero</option>  <option>Nyabihu</option>  <option>Nyagatare</option>  <option>Nyamagabe</option>  <option>Nyamasheke</option><option>Nyanza</option>  <option>Nyarugenge</option>  <option>Nyaruguru</option>  <option>Rubavu</option>  <option>Ruhango</option>  <option>Rulindo</option>  <option>Rusizi</option><option>Rutsiro</option>  <option>Rwamagana</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        <label class="xkrtf_tdlb">school <b>E-mail</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <input type="text" id="xkl_email" class="form-control" style="width: 48%;" placeholder="eg: seveeen1@gmail.com">
      </td>
    </tr>
    <tr style="background-color: #f7f6f6;">
      <td>
        <label class="xkrtf_tdlb"><b>Brought by</b>:&nbsp&nbsp&nbsp&nbsp </label>
      </td>
      <td colspan="3">
        <select id="xkl_br_by" class="form-control" style="width: 50%;" >
          <option value="default" selected>Select</option>
          <option value="SVN">Seveeen Ltd</option>
          <option value="BFG">BFG Ltd</option>
          <option value="TPT">Third-party</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <center><button class="btn btn-primary" id="sub_new_tchr" onclick="return addNwXkl()"><span class="glyphicon glyphicon-plus-sign"></span>Add School</button>
      </td>
    </tr>
  </table>
</div> -->
<div class="viewSchoolForm">
<!--Asua ->Codes for available school-->
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Available Schools</div>
        <div class="card-body">
<button type="button" id="btnAddSchool" class="btn btn-primary pull-right" data-toggle='modal' data-target='#modalRegSchool'><i class='fa fa-plus'></i>Add School</button>
          <div>
<div id="bbdtsktbbl" class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Category</th>
                  <th>Church</th>
                  <th>Brought by:</th>
                  <th>Date</th>
                  <th>Modification</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Category</th>
                  <th>Church</th>
                  <th>Brought by:</th>
                  <th>Date</th>
                  <th>Modification</th>
                </tr>
              </tfoot>
              <tbody>
<?php
$sel_xkl_av=mysql_query("SELECT * FROM tis_schools");
if (mysql_num_rows($sel_xkl_av)>0) {
  $cnt=1;
  while ($ft_sel_xkl_av=mysql_fetch_assoc($sel_xkl_av)) {
    echo "<tr>";
    echo "<td>".$cnt.". </td>";
    echo "<td>".ucwords($ft_sel_xkl_av['school_full_name'])."</td>";
    echo "<td>".ucwords($ft_sel_xkl_av['school_phone'])."</td>";
    echo "<td>".ucwords($ft_sel_xkl_av['school_email'])."</td>";
    //echo "<td>".ucwords($ft_sel_xkl_av['school_abbreviation'])."</td>";
    echo "<td>".$ft_sel_xkl_av['school_category']."</td>";
    //----Church-based
    switch ($ft_sel_xkl_av['church_based']) {
      case 'CAT':
        echo "<td>Catholic</td>";
        break;
      case 'ADV':
        echo "<td>Adventists</td>";
        break;
      case 'ANG':
        echo "<td>Anglicans</td>";
        break;
      case 'BAP':
        echo "<td>Baptists</td>";
        break;
      case 'ISL':
        echo "<td>Islamic</td>";
        break;
      default:
        echo "<td><center>-</center></td>";
        break;
    }
    //----Church-based
    switch ($ft_sel_xkl_av['school_brt_by']) {
      case 'SVN':
        echo "<td>Seveeen Ltd</td>";
        break;
      case 'BFG':
        echo "<td>BFG Ltd</td>";
        break;
      default:
        echo "<td><span style='font-weight:bolder;'># </span>".$ft_sel_xkl_av['school_brt_by']."</td>";
        break;
    }
echo "<td>".$ft_sel_xkl_av['school_date']."</td>";
echo "<td><button type='button' class='btn btn-warning' data-id='".$ft_sel_xkl_av['school_id']."' data-toggle='modal' data-target='#modalUpdSchool'><i class='fa fa-pencil'></i></button><button class='btn btn-danger' type='button' data-id='".$ft_sel_xkl_av['school_id']."' data-toggle='modal' data-target='#modalDeleteSchool'><i class='fa fa-remove'></i></button></td>";
    echo "</tr>";
    $cnt++;
  }
}
?>
              </tbody>
            </table>
  </div>
         </div>
        </div>
<?php 
//------------------------------------------------------Total Schools
$sel_llst=mysql_query("SELECT * FROM tis_schools");
$cnt_sel_llst=mysql_num_rows($sel_llst);
if ($cnt_sel_llst>=1) {
?>
<div class="card-footer small text-muted"><?php echo"<span id='tl_tsk'>".$cnt_sel_llst ."</span> Available total Schools."?> </div>
<?php
}
?>
      </div>
  </div>
<!-- <div class="col-3">
  <center>
     <h5 id="crt_nw_cl_ttl"><span class="glyphicon glyphicon-refresh" id="refree_xkl" onclick="return refrAvXkls()"></span>&nbsp&nbsp<span id="crt_nw_cl_ttl_av">Available School</span></h5>
  </center><br>
<div id="tbl_cntt" style="width:100%;height:85%;overflow:auto;">
                  <table id="cl_fr_tbl">
<?php
  $sel_cc=mysql_query("SELECT * FROM tis_schools")or die(mysql_error());
  $cnt_sel_cc=mysql_num_rows($sel_cc);
  if ($cnt_sel_cc>0) {
    $i=1;
    while ($ft_sel_cc=mysql_fetch_assoc($sel_cc)) {
      ?>
<tr>
  <td><?php echo $i.".&nbsp&nbsp";?></td>
  <td><?php echo "<span style='font-size:14px;font-weight:bolder'>".ucwords($ft_sel_cc['school_full_name'])."</span>"?></td>
</tr>
      <?php
      $i++;
    }
  }
?> 
                </table>
</div>
</div> -->
            </div>
          </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
<?php
require("../../libs/parts/footer.php");
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
            <a class="btn btn-primary" href="../../libs/parts/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
     <div id='modalDeleteSchool' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delSchoolResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delSchoolReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelSchool" class="btn btn-danger" ><i class="fa fa-check-square-o"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/popper/popper.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.min.js"></script>
    <script src="../../js/web/index.js"></script>
  </div>
</body>
  <script type="text/javascript">
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