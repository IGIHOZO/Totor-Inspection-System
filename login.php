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
  <meta name="description" content="Dashboard -- Tutor Inspection System by SEVEEEN Ltd " />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta property="fb:pages" content="171343222113" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tutor Inspection System | Login</title>
  <link rel="shortcut icon" href="libs/parts/imgs/tis.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<link href="css/bootstrap/css/glyphicon.css" rel="stylesheet">
  <link href="css/web/index.css" rel="stylesheet">
<style>
.loader {
  margin-top: -10px;
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
</style>
</head>

<body style="background: linear-gradient(#354a46,#c6f9f0)">
  <div class="container"> 
    <div class="card card-register mx-auto mt-5" style="background-color: #c9d6d8">
    	  	<center><div class="brand brand-lg">
    	  	    <div class= 'langue' id="google_translate_element" style="float:right"></div>
      <h3><b><strong>Tutor Inspection System</strong></b></h3>
  </div></center>
      <div class="card-header"><span id="hd_reg">Login Here </span><span id="resp_reg"></span></div>
      <div class="card-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="protName">User Name</label>
                <input class="form-control" id="logsrnm" type="text" aria-describedby="nameHelp" placeholder="User Name" focused>
              </div>
            </div>
          </div>
          <div class="form-group">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="proUnPrice">Password</label>
                <input class="form-control" id="logpsswrd" type="password" placeholder="Password">
              </div>
            </div>
          </div>
          <center><button class="btn btn-mlnl btn-success btn-md"  id="logbtn" onclick="return regNwPr()"><span class="glyphicon glyphicon-user"></span>&nbsp&nbsp Login</button><br><a href="help.php" target="_blank">Help & Forgot password</a></center>
      </div>
    </div><br>
    <center><footer><h6>SEVEEEN Ltd &#169; 2018.</h6></footer></center>
  </div>
    <script src="vendor/jquery/jquery.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/web/index.js"></script>

  <script src="vendor/popper/popper.min.js"></script>
  <script src="js/sb-mgt.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
  <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>