<?php
session_start();
require("libs/parts/didier_igihozo.php");
if (!$sel || !$con) {
  print_r("<center><h2><font color='red'>PROBLEM OF SERVER CONNECTION...</font></h2></center>");
}else{
if (@!$_SESSION['seveeen_tis_nwe_nw_teacher_nm'] AND @!$$_SESSION['seveeen_tis_nw_usrnm'] AND @!$_SESSION['seveeen_tis_nw_usr_id']) {
?>
<script type="text/javascript">
  window.location="login.php";
</script>
<?php
}else{

  ?>
<!--
/*!
Programmer: IGIHOZO Didier All codes reserved
    __________________________________
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="New Teacher -- Tutor Inspection System by SEVEEEN Ltd " />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <title>New Teacher | Tutor Inspection System</title>
<link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/web/new_teacher.css" rel="stylesheet">
  <link href="css/web/index.css" rel="stylesheet">
  <link href="css/bootstrap/glyphicon/css/bootstrap.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(#354a46,#c6f9f0)">
  <div class="container"> 
    <div class="card card-register mx-auto mt-5" style="background-color: #c9d6d8">
          <center><div class="brand brand-lg">
      <h3><b><strong>Tutor Inspection System</strong></b></h3>
  </div></center>
<center>
  <?php
  echo "<span id='allnw_usrname'>Welcome <span id='nw_usrname'>".$_SESSION['seveeen_tis_nwe_nw_teacher_nm']."</span> !</span>";
  ?>
</center>
      <div class="card-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
<p id="nw_frp"><b>Your acount is not sucured <u>(Your PASSWORD is known)</u></b>, to secure your acount so that nobody will access your acount; <i>you have to <u><big><b>change your password</big></u></b> so that no one knows it.</i></p>
              </div>
            </div>
          </div>
          <div class="form-group">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <center><span id="resp_nwps">&nbsp&nbsp&nbsp&nbsp</span></center>
              </div>
              <div class="col-md-4">
                <label for="proUnPrice"> <b>Password</b></label>
                <input class="form-control" id="nw_pss" type="password" placeholder=" Password">
              </div>
              <div class="col-md-4">
                <label for="proUnPrice"><b>New Password</b></label>
                <input class="form-control" id="nw_nwpss" type="password" placeholder="New Password">
              </div>
              <div class="col-md-4">
                <label for="proUnPrice"><b>Confirm Password</b></label>
                <input class="form-control" id="nw_cmfpss" type="password" placeholder="Confirm Password">
              </div>
              <div class="col-md-12">
                <center><button id="nw_chng_pssw" class="btn btn-primary mt-2" onclick="return nw_t_chps()"><span class="glyphicon glyphicon-ok"></span> Change</button><a href="login.php"><center><button id="nw_chng_pssw" class="btn btn-link mt-2"><span class="glyphicon glyphicon-user"></span> Login...</button></center></a></center>

              </div>
            </div>
          </div>
      </div>
    </div><br>
<?php
require("libs/parts/footer.php");
?>
  </div>
    <script src="vendor/jquery/jquery.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/web/index.js"></script>

  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>

  <?php
}
}
?>





































