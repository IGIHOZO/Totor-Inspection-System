/*!
IGIHOZO Didier All right reserved
    -------------------
Tel : +250722077175 , 250784424020
email : didierigihozo07@gmail.com
facebook : Didier Igihozo
Instagram : Kabaka_official_1

 */

 //------------------------------------------MY FUNCTIONS
 //---document.getElementById
 function gtId(id){
 	return document.getElementById(id);
 }
 //---document.getElementById.value
  function gtIdVal(id){
 	return document.getElementById(id).value;
 }
//---getting Private,Public and Gov-Aided radios---ON ADD SCHOOL PAGE
 	 var xklCtgr=null;
    var radiosl = document.getElementsByName('xkl_categ');
    	for(var l = 0; l < radiosl.length; l++){
        	radiosl[l].onclick = function(){
          	xklCtgr=this.value;//----------fourth creteria
        	}
    	}
//=================================== AUTOLOADS
function callAuto(){
	var callAuto = true;
	$.ajax({url:"js/ajax/index.php",
		type:"GET",data:{callAuto1:callAuto},cache:false,success:function(res){$("script").html(res);}
		});
	$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{callAuto2:callAuto},cache:false,success:function(res){$("script").html(res);}
		});
}
callAuto();

//----------------------------------------------------------------------------------------ADDING CLASS
$(document).ready(function(){
//-----------------------------------------------------------------------------------ANNOUNCEMENTS--------------------
//---------------------Closing theachers announcements dialogs
$("#x_ancmts_cls,#ancmts_cls").click(function(){
	$("#anncEexampleModal").hide();
})
//---------------------------------------------------------------------------------------------SET TASK
$("#tsskclss option,#tsskclss").click(function(){
	var lsnNm=document.getElementById("tsskclss").value;
	var tskvlstt=document.getElementById("tskhddn").value;
	var lsnClss=document.getElementById("tsskclss").value;
	var tocrs=1;
	if (lsnNm!="choose") {
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{tocrs:tocrs,lsnClss:lsnClss,tskvlstt:tskvlstt},cache:false,success:function(res){$("#tsklssn").html(res);}
		});
	}else{
		document.getElementById("tsklssn").innerHTML="";
	}
})
	$("#class_level").change(function(){
				var llv=$("#class_level").val();
				if (llv=='N') {
				document.getElementById("class_name").innerHTML="<option>N1</option><option>N2</option><option>N3</option>";
				}else if (llv=='P') {
				document.getElementById("class_name").innerHTML="<option>P1</option><option>P2</option><option>P3</option><option>P4</option><option>P5</option><option>P6</option>";
				}else if (llv=='O') {
				document.getElementById("class_name").innerHTML="<option>S1</option><option>S2</option><option>S3</option>";
				}else if (llv=='A') {
				document.getElementById("class_name").innerHTML="<option>S4</option><option>S5</option><option>S6</option>";
				}else{
				document.getElementById("class_name").innerHTML="";
				}
				if (llv!='A'){
				$("#class_option").attr("disabled","disabled");
							}else{
				$("#class_option").removeAttr("disabled");
			}
	})
})
//.........................................................isEmpty().......................................
function isEmpty(vval){
	if (vval=="") {
		return true;
	}else{
		return false;
	}
}
//--------------------------------------------------------------------------------login
$("#logsrnm,#logpsswrd").keypress(function(event){
	if ( event.which==13) {
		$("#logbtn").click();
		event.preventDefault();
	}
})
function regNwPr(){
	$("#resp_reg").html("<center><div class='loader'></div></center>");
	var usrnm=document.getElementById("logsrnm").value;
	var psswrd=document.getElementById("logpsswrd").value;
	var tisLg=1;
	if (usrnm=="" || psswrd=="") {
		document.getElementById("resp_reg").innerHTML="Fill in all the Forms...";
	}else{
		$.ajax({url:"js/ajax/index.php",
		type:"GET",data:{tisLg:tisLg,usrnm:usrnm,psswrd:psswrd},cache:false,success:function(res){$("#resp_reg").html(res);}
		});		
	}
}

function addClasss(){
	$("#hdn_crt_nw_cls").html("<center><div class='loader01'></div></center>");
	var clLevel=document.getElementById("class_level").value;
	var clName=document.getElementById("class_name").value;
	var clOption=document.getElementById("class_option").value;
	var clOptionMore=document.getElementById("class_option_mmre").value;

		if (clLevel=="A") {
		    if (clLevel=="choose" ||clLevel=="" || clName=="" || clOption=="") {
		    	document.getElementById("hdn_crt_nw_cls").innerHTML="Fill in all the Forms...";
		    }else{
		clName=clName+" "+clOption+" "+clOptionMore;
		$("#sub_new_clss").attr("disabled","disabled");
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{clName:clName},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
		});	
		    }
		}else{
			if (clLevel=="choose" || clLevel=="" || clName=="") {
			document.getElementById("hdn_crt_nw_cls").innerHTML="Fill in all the Forms...";				

			}else{
		clName=clName+" "+clOptionMore;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{clName:clName},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
		});		
			}
	}
}

$("#refree_cl").click(function(){ 	//---refresh classes
	$("#cl_fr_tbl").html("<center><div class='loader'></div></center>");
			var crt_cl_refr=1;
			$.ajax({url:"../js/ajax/index.php",
			type:"GET",data:{crt_cl_refr:crt_cl_refr},cache:false,success:function(res){$("#cl_fr_tbl").html(res);}
			});
})


//--------------------------------------------------------------------------------REGISTER COURSE
function addCourse(){
	$("#hdn_crt_nw_crs").html("<center><div class='loader'></div></center>");
	var crCl=document.getElementById("avCls").value;
	var crNm=document.getElementById("crsNm").value;
	var crOvllMk=document.getElementById("ovlMks").value;
	if (crCl=="No") {
		document.getElementById("hdn_crt_nw_crs").innerHTML="There are no classes available. || Register classes first then, create courses after.";
	}else{
		if (crCl=="" || crCl=="choose" || crNm=="" || crOvllMk =="") {
			document.getElementById("hdn_crt_nw_crs").innerHTML="Fill in all the Forms...";
		}else{
			var regCrs=1;
			$("#sub_new_clss").attr("disabled","disabled");
			$.ajax({url:"../js/ajax/index.php",
			type:"GET",data:{regCrs:regCrs,crCl:crCl,crNm:crNm,crOvllMk:crOvllMk},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
			});
		}
	}
}
$("#avCls option,#avCls").click(function(){
	var nn=document.getElementById("avCls").value;
	document.getElementById("hhddcl").value=nn;
})
$("#shw_crss").click(function(){
	$("#cl_fr_tbl").html("<center><div class='loader01'></div></center>");
	var contcrcl=document.getElementById('avCls').value;
if (contcrcl=="choose") {
	document.getElementById('cl_fr_tbl').innerHTML="<span id='spcrcl'>Select Class First...</span>";
}else{
	var crsclnm=document.getElementById('hhddcl').value;
	var refrcrs=1;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{refrcrs:refrcrs,crsclnm:crsclnm},cache:false,success:function(res){$("#cl_fr_tbl").html(res);}
	});
}
})
function checkUsernameAvailability(){
	var uname=$("#techfnm").val().replace(" ","").toLowerCase()+"."+$("#techlnm").val().replace(" ","").toLowerCase();
$.ajax({
	url:'../ajax/teacher.php',data:{cate:'username',uname:uname},type:'GET',dataType:'json',success:function(res){
		if(res.cate=='exist'){
			$("#tchusrnm").val(res.username);
		}
	}
})
}
//---------------------------------------------------------------------------------------------REGISTER NEW TEACHER
$("#techfnm,#techlnm").keyup(function(){
	var tchfnmusr=document.getElementById("techfnm").value;
	var tchlnmusr=document.getElementById("techlnm").value;
	document.getElementById("tchusrnm").value=tchfnmusr.split(" ").join("").toLowerCase()+'.'+tchlnmusr.split(" ").join("").toLowerCase();
if(tchlnmusr!='' && tchfnmusr!=''){
checkUsernameAvailability();
}

})

$("#techfnm,#techlnm").keypress(function(event){
	if ( event.which==13) {
		$("#sub_new_tchr").click();
		event.preventDefault();
	}
})
function addNwTchr(){
	$("#hdn_crt_nw_cls").html("<center><div class='loader01'></div></center>");
	var tfNm=document.getElementById("techfnm").value;
	var tlNm=document.getElementById("techlnm").value;
	var tchrBadge=document.getElementById("tchrBadge").value;
	var crNwtch=1;
	if (tfNm=="" || tlNm=="") {
		document.getElementById('hdn_crt_nw_cls').innerHTML="<span id='spcrcl'>Fill in all the Forms...</span>";
	}else{
		$("#sub_new_tchr").attr("disabled","disabled");
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{crNwtch:crNwtch,tfNm:tfNm,tlNm:tlNm,badge:tchrBadge,uname:$("#tchusrnm").val()},cache:false,success:function(res){$("#regTeacherResponse").html(res);}
		});	
	}
}

$("#refree_tch").click(function(){ 	//---refresh teachers
	$("#cl_fr_tbl").html("<center><div class='loader'></div></center>");
		var crt_thr_refr=1;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{crt_thr_refr:crt_thr_refr},cache:false,success:function(res){$("#cl_fr_tbl").html(res);}
		});
})

//---------------------------------------------------------------------------------------------ORIENT TEACHER
$("#or_tch_crs").click(function(){
	var orThTchr=document.getElementById("or_tch_tchr").value;
	var orThCrs=document.getElementById("or_tch_cls").value;
	if (orThTchr=="choose") {
		document.getElementById("hdn_crt_nw_cls").innerHTML="Select Teacher First...";
	}else{
		if (orThCrs=="choose") {
			document.getElementById("hdn_crt_nw_cls").innerHTML="Select Class First...";
		}/*else{
			alert('dddddddddd');
		}*/
	}

})
$("#or_tch_cls option,#or_tch_cls").click(function(){
	var orThCls=document.getElementById("or_tch_cls").value;
	var orThTchr=document.getElementById("or_tch_tchr").value;
	orThrCrs=1;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{orThrCrs:orThrCrs,orThCls:orThCls,orThTchr:orThTchr},cache:false,success:function(res){$("#or_tch_crs").html(res);}
		});
})
function orientTchr(){
	$("#hdn_crt_nw_cls").html("<center><div class='loader01'></div></center>");
	var ortTchr=document.getElementById("or_tch_tchr").value;
	var ortCls=document.getElementById("or_tch_cls").value;
	var ortCrs=document.getElementById("or_tch_crs").value;
	if (ortTchr == "choose" || ortTchr=="" || ortCls == "choose" || ortCls == "" || ortCrs == "choose" || ortCrs == "") {
		document.getElementById("hdn_crt_nw_cls").innerHTML="Fill in all the Forms...";
	}else{
		if (ortCrs == "No") {
			document.getElementById("hdn_crt_nw_cls").innerHTML="No courses are available || Please set course first.";
		}else{
			var orTchhFn=1;
			$("#okset").attr("disabled","disabled");
			$.ajax({url:"../js/ajax/index.php",
			type:"GET",data:{orTchhFn:orTchhFn,ortTchr:ortTchr,ortCls:ortCls,ortCrs:ortCrs},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
			});
		}
	}
}

//-----------------------------------------------------------------------------------------------------------------REGISTER NEW STUDENT
function regNewSt(){
	$("#hdn_crt_nw_stdnt").html("<center><div class='loader01'></div></center>");
	var stFnm=document.getElementById("fname").value;
	var stLnm=document.getElementById("lname").value;
	var stClss=document.getElementById("or_tch_cls").value;
	var stSx=document.getElementById("sssex").value;
	var stparentPhone=document.getElementById("parentPhone").value;
	if (stFnm == "" || stLnm == "" || stClss == "choose" || stSx =="choose" || stparentPhone =="") {
		document.getElementById("hdn_crt_nw_stdnt").innerHTML="Fill all Forms first...";
	}else{
		var regStt=1;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{regStt:regStt,stFnm:stFnm,stLnm:stLnm,stClss:stClss,stSx:stSx,stParentPhone:stparentPhone},cache:false,success:function(res){$("#hdn_crt_nw_stdnt").html(res);}
		});	
	}
}

//-------------------------------------------------------------------------------------------------New teacher change password
$("#nw_pss,#nw_nwpss,#nw_cmfpss").keypress(function(event){
	if ( event.which==13) {
		$("#nw_chng_pssw").click();
		event.preventDefault();
	}
})
function nw_t_chps(){	
	var crPss=document.getElementById("nw_pss").value;
	var nwPss=document.getElementById("nw_nwpss").value;
	var cmfPss=document.getElementById("nw_cmfpss").value;
	var nwCngpss=1;
	var lngPss=nwPss.length;
	if (crPss=="" || nwPss=="" ||cmfPss=="") {
		document.getElementById("resp_nwps").innerHTML="Fill in all the Forms... ...";
	}else{
if (nwPss==cmfPss) {
				if (lngPss>7) {
				if (lngPss<37) {
					$.ajax({url:"js/ajax/index.php",
					type:"GET",data:{nwCngpss:nwCngpss,crPss:crPss,nwPss:nwPss},cache:false,success:function(res){$("#resp_nwps").html(res);}
					});	
				}else{
					document.getElementById("resp_nwps").innerHTML="Too long | Password range : <b> 8-36</b> characters.";
				}
			}else{
				document.getElementById("resp_nwps").innerHTML="Too short | Password range : <b> 8-36</b> characters.";
			}
}else{
		document.getElementById("resp_nwps").innerHTML="Passwords don't match ...";	
}
	}

}


function setTsk(){
	var lsnNm=document.getElementById("tsskclss").value;
	var tskTtl=document.getElementById("tsklssn").value;
	var tskChp=document.getElementById("tskttl").value;
	var tskOvmks=document.getElementById("tskovll").value;
	var tskvlstt=document.getElementById("tskhddn").value;
	var rskk=1;
	if (lsnNm=="choose" || lsnNm=="No" || lsnNm=="" || tskTtl =="choose" || tskTtl =="No" || tskTtl =="" || tskChp=="" || tskOvmks=="" || tskvlstt=="") {
		document.getElementById("hdn_crt_nw_cls").innerHTML="Fill in all the Forms... ...";
	}else{
		$("#sttsk").attr("disabled","disabled");
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{rskk:rskk,lsnNm:lsnNm,tskTtl:tskTtl,tskChp:tskChp,tskOvmks:tskOvmks,tskvlstt:tskvlstt},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
		});	
	}
}

//-----------------------------------------------------CHANGE PASSWORD
function chgPss(){
	$("#resp_chg_pss").html("<center><div class='loader01'></div></center>");
	var crPss=document.getElementById("curr_pass").value;
	var nwPss=document.getElementById("new_pass").value;
	var cmfPss=document.getElementById("conf_pass").value;
	var cngpss=1;
	if (crPss=="" || nwPss=="" ||cmfPss=="") {
		document.getElementById("resp_chg_pss").innerHTML="<span style='text-align:right;float:right;color:red;font-weight:bolder'>Fill in all the Forms... ...</span>";
	}else{
if (nwPss==cmfPss) {
	$.ajax({url:"js/ajax/index.php",
	type:"GET",data:{cngpss:cngpss,crPss:crPss,nwPss:nwPss,cmfPss:cmfPss},cache:false,success:function(res){$("#resp_chg_pss").html(res);}
	});	
}else{
		document.getElementById("resp_chg_pss").innerHTML="<span style='text-align:right;float:right;color:red;font-weight:bolder'>Passwords don't match ...</span>";	
}
	}

}  
function okAttach(){
	var okatt=1;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{okatt:okatt},cache:false,success:function(res){$("#hdn_crt_nw_stdnt").html(res);}
		});	
}

//-------------------------------------------------------------------------------------ABOUT CHOSING TO ATTACH EXCEL OR TO INSERT MANUALLY
//--------------------excle
function onlyExcel(){
	$("#for_ins_manually").hide();
	$("#for_ins_attach").show();
}
function onlyManually(){
	$("#for_ins_attach").hide();
	$("#for_ins_manually").show();
}

//-------------------------------------------------------------------------------------------------SEE TOTAL TASKS
function seeTotlTsks(){
	$(document).ready(function(){
		$("#prnt_btn_crt").hide();
	});
	var taskResson=document.getElementById("task_resson").value;
	var taskTeacher=document.getElementById("tsk_tchrr").value;
	var taskType=document.getElementById("tsk_ttypp").value;
	var taskClass=document.getElementById("tsk_cclass").value;
	var taskIdd=document.getElementById("tsk_iidd").value;
	var seeTotalTask=true;
$("#st_task_lis_marks").html("<center><div class='loader'></div></center>");
	//alert(" Reason "+taskResson+" teacher: "+taskTeacher+" type: "+taskType+" id: "+taskIdd);
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{seeTotalTask:seeTotalTask,taskResson:taskResson,taskTeacher:taskTeacher,taskType:taskType,taskClass:taskClass,taskIdd:taskIdd},cache:false,success:function(res){$("#st_task_lis_marks").html(res);}
	});	
}
//------------------------------------------------------------------------------------------------------------------------CHANGE OVERALL TASK MARKS 
$("#ttsk_new_iidt").keypress(function(event){
	if ( event.which==13) {
		$("#ssddd").click();
		event.preventDefault();
	}
})
function cngOvrllMks(){
	var taskid=document.getElementById("ttsk_iidt").value;
	var taskNewId=document.getElementById("ttsk_new_iidt").value;
	var sstNwOvvl=true;
	if (taskNewId!="") {
		if (taskNewId!=0) {
			$("#cngOvrllMks").attr("disabled","disabled");
			$.ajax({url:"../js/ajax/index.php",
			type:"GET",data:{sstNwOvvl:sstNwOvvl,taskid:taskid,taskNewId:taskNewId},cache:false,success:function(res){$("#newovlresp").html(res);}
			});
		}else{
	document.getElementById("newovlresp").innerHTML="must be greater than zero...";
	}
	}else{
		document.getElementById("newovlresp").innerHTML="enter new value...";
	}
}
//----------------------------------------------------------------------------------------------------------------------------------------------DELETE TASK
function deltTskk(){
	var taskid=document.getElementById("ttsk_iidt").value;
	var deltTtsk=true;
	$('#deltsshd,#deltssft').hide();
	$("#deltTskk").attr("disabled","disabled");
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{deltTtsk:deltTtsk,taskid:taskid},cache:false,success:function(res){$("#deltssbd").html(res);}
	});
}
//----------------------------------------------------------------------------------------------GENERAL DATEPICKERS ON REPORTS------------------------------------------------------

$(function() {
    $( "#lblefrom" ).datepicker({
    });
  });

//----------------------------------------------------------------------------------------------TASKS DATEPICKER--------------------------------------------------------

function gnTskDatPckr(){
	var ourdate=document.getElementById("lblefrom").value;
	var taskStatus=document.getElementById("taskStatus").value;
	var dtpp=true;
	//if (ourdate!="") {
			$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{dtpp:dtpp,ourdate:ourdate,status:taskStatus},cache:false,success:function(res){$("#bbdtsktbbl").html(res);}
	});
	/*}else{
		alert("Empy Form !   |  CHOOSE ANY DAY PLEASE ...");
	}*/
}
//----------------------------------------------------------------------------------------------CLASS TASKS DATEPICKER--------------------------------------------------------

function clTskDatPckr(){
	var ourdate=document.getElementById("lblefrom").value;
	var ccllidtsk=document.getElementById("classId").value;
	var taskStatus=document.getElementById("taskStatus").value;
	//var ccllidtsk=document.getElementById("hidcllid").value;
	var cldtpp=true;
	//if (ourdate!="") {
			$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{cldtpp:cldtpp,ourdate:ourdate,ccllidtsk:ccllidtsk,status:taskStatus},cache:false,success:function(res){$("#bbdtsktbbl").html(res);}
	});
//	}else{
	//	alert("Empy Form !   |  CHOOSE ANY DAY PLEASE ...");
	//}
}

//----------------------------------------------------------------------------------------------TEACHER TASKS DATEPICKER--------------------------------------------------------
function tchrTskDatPckr(){
	var ourdate=document.getElementById("lblefrom").value;
	//var tchrridd=document.getElementById("hidcllid").value;
	var tchrridd=document.getElementById("teacherId").value;
	var taskStatus=document.getElementById("taskStatus").value;
	var tchdtpp=true;
	//if (ourdate!="") {
			$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{tchdtpp:tchdtpp,ourdate:ourdate,tchrridd:tchrridd,status:taskStatus},cache:false,success:function(res){$("#bbdtsktbbl").html(res);}
	});
	/*}else{
		alert("Empy Form !   |  CHOOSE ANY DAY PLEASE ...");
	}*/
}
//---------------------------------------------------------------------------------------------------------------------------VIEW TASKS DATEPICKER
function vywrTskDatPckr(){
	var ourdate=document.getElementById("lblefrom").value;
	var tsktp=document.getElementById("hhdntsktt").value;
	var vwdtpck=true;
	if (ourdate!="") {
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{vwdtpck:vwdtpck,ourdate:ourdate,tsktp:tsktp},cache:false,success:function(res){$("#bbdtsktbbl").html(res);}
	});
	}else{
		alert("Empy Form !   |  CHOOSE ANY DAY PLEASE ...");
	}
}
//-------------------------------------------------------------------------------------------------------------------------COUNTING TASK_CHARACTERS
function countTskTtlChrs(){
	var chrtxt=document.getElementById("tskttl").value;
	var chrlen=chrtxt.length;
	document.getElementById("cnt_chr_resp").innerHTML=chrlen;
}

//---------------------------------------------------------------------------------------------------------------------------RANKING ONE TASK
function rnkStndt(){
	var tskId=document.getElementById("tsk_iidd").value;
	var tskTchr=document.getElementById("tsk_tchrr").value;
	var tskClss=document.getElementById("tsk_cclass").value;
	var tskCrs=document.getElementById("task_resson").value;
	var rnkOne=true;
	$("#st_task_lis_marks").html("<center><div class='loader'></div></center>");
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{rnkOne:rnkOne,tskId:tskId,tskTchr:tskTchr,tskClss:tskClss,tskCrs:tskCrs},cache:false,success:function(res){$("#st_task_lis_marks").html(res);}
	});
}
//--------------------------------------------------------------------------------------------------------------------------USER COMMENT
function cmtHlpf(){
	var thrId=document.getElementById("cnnttchriid").value;
	var xklId=document.getElementById("cnnttxkliid").value;
	var cmtStt="GOOD";
	var sence="Combine Tasks";
	var cmt=true;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{cmt:cmt,sence:sence,cmtStt:cmtStt,thrId:thrId,xklId:xklId},cache:false,success:function(res){$("#cmt_resp").html(res);}
	});

}
function cmtUsls(){
	var thrId=document.getElementById("cnnttchriid").value;
	var xklId=document.getElementById("cnnttxkliid").value;
	var cmtStt="BAD";
	var sence="Combine Tasks";
	var cmt=true;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{cmt:cmt,sence:sence,cmtStt:cmtStt,thrId:thrId,xklId:xklId},cache:false,success:function(res){$("#cmt_resp").html(res);}
	});
}

//-----------------------------------------------------------------------------COMBINE TASKS--------CHOOSE CLASS
function cmbTskChsCls(){
	var cls_nm=document.getElementById("crssel").value;
	if (cls_nm!="default") {
	var combChsCls=true;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{combChsCls:combChsCls,cls_nm:cls_nm},cache:false,success:function(res){$("#chsclsel").html(res);}
	});
	}else{
		document.getElementById("chsclsel").innerHTML="<option><option>";
	}
}

//---------------------------------------------------------------COMBINE TASKS---------------FETCHING TASKS--------------TAKE BTN

function tkCmbDtls(){
	$(document).ready(function(){
		$("#okcmb").hide();
	});
	var cls=document.getElementById("crssel").value;
	var crs=document.getElementById("chsclsel").value;
	var combCombTstk=true;
	if (isNaN(cls)) {
		document.getElementById("resp_cmbtk").innerHTML="<span id='resp_no'>Select class first...</span>";
		document.getElementById("comb_newresp").innerHTML="<span></span>";
	}else if (isNaN(crs)){
		document.getElementById("resp_cmbtk").innerHTML="<span id='resp_no'>Select course first...</span>";
		document.getElementById("comb_newresp").innerHTML="<span></span>";
	}else{
		document.getElementById("hdn_cmb").innerHTML="<input type='hidden' value='"+cls+"' id='hdn_cls_cmb'>  <input type='hidden' value='"+crs+"' id='hdn_crs_cmb'> ";
		document.getElementById("resp_cmbtk").innerHTML="<span></span>";
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{combCombTstk:combCombTstk,cls:cls,crs:crs},cache:false,success:function(res){$("#ssasa").html(res);}
		});
	}
}
//----------------------------------------------------------COMBINE---------------------CHECK IF CLICKED-----------------
$(document).ready(function(){
$("#yscmb").click(function(){
	var comckar=[];
	$("input:checkbox[name=cmbchxbx]:checked").each(function(){
		comckar.push($(this).val());
	});
	if (comckar.length<1) {
		alert("Empty");
	}else{
		var nTtl=document.getElementById("tskttl").value;
		var nCtgy=document.getElementById("tskctgr").value;
		var nOvll=document.getElementById("tskovll").value;
		var okCmbTsks=true;
		var clls=document.getElementById("hdn_cls_cmb").value;
		var crrs=document.getElementById("hdn_crs_cmb").value;
		if (isEmpty(nTtl) || isEmpty(nCtgy) || isEmpty(nOvll) || nCtgy=="default") {
			document.getElementById("yscmb_resp").innerHTML="Please fill all forms...";
		}else if(okCmbTsks==false || isEmpty(clls) || isEmpty(crrs)){
			document.getElementById("yscmb_resp").innerHTML="<b><h3>ERROR TK 43 Occured. || Please contact Administrator to solve this issue...</h3></b>";
		}else{
			if (nTtl.length<5) {
			document.getElementById("yscmb_resp").innerHTML="Task title must have at least 5 characters...";
			}else{
				$("#combplwt").css("display","block");
				$("#yscmb").attr("disabled","disabled");
				$.ajax({url:"../js/ajax/index.php",
				type:"GET",data:{okCmbTsks:okCmbTsks,comckar:comckar,clls:clls,crrs:crrs,nTtl:nTtl,nCtgy:nCtgy,nOvll:nOvll},cache:false,success:function(res){$("#dsfasfsdf").html(res);}
				});
			}
		}


		//alert("Ttl: "+nTtl+", Ctgr: "+nCtgy+", Ovll: "+nOvll);
	}
});
		$("#cmdch").click(function(){
		var comckart=[];
		$("input:checkbox[name=cmbchxbx]:checked").each(function(){
			comckart.push($(this).val());
		});
		if (comckart.length<2) {
			$("#okcmb").hide();
		}else{
			$("#okcmb").show();
		}
			})
})
//--------------------------------------------------------------COMBINE------------------------------COUNTING TASK_CHARACTERS
function combCountTskTtlChrs(){
	var cmbchrtxt=document.getElementById("tskttl").value;
	var cmbchrlen=cmbchrtxt.length;
	var remlnt=25-cmbchrlen;
	document.getElementById("cmb_cnt_chr_resp_cmb").innerHTML=remlnt;
}
//---------------------------------------------------------------------------------------------------PRINT------------------------------------
//----------------------------------------PRINT---------------------ONE TASK
function prntPdfCrtTskMks(){
	$(document).ready(function(){
		$("#nnnavv,#hme_lgo,#upd_mrks_btn,#prnt_btn_crt,#ttrinsttl,#rereprnt").hide();
		$("#sdsdsd").css("margin-top","-110px");
		$("#st_task_lis_marks,#ssdbtnn").css("margin-top","0px");
		$("#trtrmmk").css("margin-top","-30px");
		$("#st_task_lis_marks td,#iinmk input").css("font-size","10px");
		$("#st_task_lis_marks td,#iinmk input").css("font-weight","bold");
		$("#iinmk input").css("height","30px");
		$("#iinmk input").css("border","0px");
		//$("#iinmk input").css("font-weight","bold");
		window.print();
		function sdRdf(){
			$("#nnnavv,#hme_lgo,#upd_mrks_btn,#prnt_btn_crt,#rereprnt").show();
			}
	window.setTimeout(sdRdf,1000);
	})
}
//---------------------------------------------------PRINT---------------SEE TOTAL
function prntPdfSeeTtl(){
	$(document).ready(function(){
		$("#nnnavv,#hme_lgo,#upd_mrks_btn,#prnt_btn_crt,#ttrinsttl,#rereprnt,#bcckstt").hide();
		$("#sdsdsd").css("margin-top","-110px");
		$("#dataTable,#ssdbtnn").css("margin-top","0px");
		//$("#trtrmmk").css("margin-top","-30px");
		$("#dataTable td,#iinmk input").css("font-size","10px");
		$("#dataTable td,#iinmk input").css("font-weight","bold");
		$("#trtrmmk").css("height","20px");
		$("#iinmk input").css("height","30px");
		$("#iinmk input").css("border","0px");
		//$("#iinmk input").css("font-weight","bold");
		window.print();
		function sdRdf(){
			$("#nnnavv,#hme_lgo,#upd_mrks_btn,#prnt_btn_crt,#rereprnt").show();
			}
	window.setTimeout(sdRdf,1000);
	})
}
//-------------------------------------------------------------------------------SEND MESSAGE MARKS-----------------------
//----------------------------------------------------------SETTING TEXTBOX VALUE
/*

var clsNm=document.getElementById("ttsk_cls_nm").value;
document.getElementById("write_mess").value="Mubyeyi wa (Student_Name) wiga "+clsNm+" Turabamenyesha ko yagize amanota (Student_Marks) muri (Course)";


*/
//----------------------------------------------REVIEWING MESSAGE
function revMsgs(){
	var msg=document.getElementById("write_mess").value;
	var llng=msg.length;
	if (llng>10) {
		$("#sndmsg_btn").removeAttr("disabled");
	}else{
			$("#sndmsg_btn").attr("disabled","disabled");
		}
}


//--------------------------------------OK ATTACH ---------------------
function okAtchh(){
	var atCnt=document.getElementById("chs_slctd").value;
	if (atCnt!="") {
		$("#okAtchh").attr("disabled","disabled");
	}
}

























//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================
//===============================================================================================








//------------------------------------------------------------Teacher student evaluation ----see course/class

function evTCrs(){
	var selCls=document.getElementById("stEvClss").value;
	var evTCrs=true;
	var evTTchr=true;
	//---course
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{evTCrs:evTCrs,selCls:selCls},cache:false,success:function(res){$("#stEvCCrs").html(res);}
	});

}
	//---remaining times
function evRmndTms(){
	var selCls=document.getElementById("stEvClss").value;
	var selCrs=document.getElementById("stEvCCrs").value;
	var selPrd=document.getElementById("evChPedr").value;
	var seCrsThcr=true;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{selPrd:selPrd,seCrsThcr:seCrsThcr,selCls:selCls,selCrs:selCrs},cache:false,success:function(res){$("#spevcrsTcher").html(res);}
	});
}
//---------------comment length
function cntLngCmt(){
	var cmtCntt=document.getElementById("evtcmt").value;
	var cmtLngt=cmtCntt.length;
	document.getElementById("nnmn").innerText = cmtLngt+"/"+120;
}

//----------------hiding evaluation table while chosing class / course
//Asua__check page before parsing events
var pageArr=document.URL.split("/"),page=pageArr[pageArr.length-1];
//alert(page.search('t_evaluation.php'))
if(page.search('t_evaluation.php')!==-1){
var seCls=gtId("stEvClss");
var seCrs=gtId("stEvCCrs");
var maiCntEvv=gtId("maiCntEvv");
seCls.addEventListener("click", function(){
	gtId("maiCntEvv").style.display="none";
})
seCrs.addEventListener("click", function(){
    gtId("maiCntEvv").style.display="none";
})
}
//----------------------------------------------------------------------------------------------------REGISTER NEW SCHOOL
//---REFRESH SCHOOOLS

function refrAvXkls(){
  $("#cl_fr_tbl").html("<center><div class='loader'></div></center>");
  var crt_xkl_refr=true;
  $.ajax({url:"../../js/ajax/index.php",
  type:"GET",data:{crt_xkl_refr:crt_xkl_refr},cache:false,success:function(res){$("#cl_fr_tbl").html(res);}
  });
}
function addNwXkl(){
	$("#hdn_crt_nw_cls").html("<center><div class='loader01'></div></center>");
	var xklFllnm=gtIdVal("xkl_fllnm");
	var xklAbrv=gtIdVal("xkl_abrnm");

	var xklChchBsd=gtIdVal("selChrVl");
	var xklPhn=gtIdVal("xkl_phone");
	var xklLctn=gtIdVal("xkl_loct");
	var xklEml=gtIdVal("xkl_email");
	var xklBrgtby=gtIdVal("xkl_br_by");
	var crNwXkl=true;
	if (xklFllnm=="" || xklAbrv==""|| xklCtgr==null || xklPhn=="" || xklLctn=="" || xklLctn=="default" || xklEml=="" || xklBrgtby=="" || xklBrgtby=="default") {
		document.getElementById("regSchoolResponse").innerHTML="Fill all Forms first...";
		//document.getElementById('hdn_crt_nw_cls').innerHTML=xklFllnm+" / "+xklAbrv+" / "+xklCtgr+" / "+xklChchBsd+" / "+xklPhn+" / "+xklLctn+" / "+xklEml+" / "+xklBrgtby+" / ";
	}else{
		if (gtId("xkl_chbsd").checked==true) {
			if (xklChchBsd=="" || xklChchBsd=="default") {
				document.getElementById("regSchoolResponse").innerHTML="Fill all Forms first...";
			}else{
				xklChchBsd=gtIdVal("selChrVl");
			}

		}else{
			var xklChchBsd="-";
		}
			if (xklChchBsd=="" || xklChchBsd=="default") {
				document.getElementById("regSchoolResponse").innerHTML="Fill all Forms first...";
			}else{
				xklChchBsd=gtIdVal("selChrVl");
		$(document).ready(function(){
		$("#sub_new_tchr").attr("disabled","disabled");
	$.ajax({url:"../../js/ajax/index.php",
	type:"GET",data:{crNwXkl:crNwXkl,xklFllnm:xklFllnm,xklAbrv:xklAbrv,xklCtgr:xklCtgr,xklChchBsd:xklChchBsd,xklPhn:xklPhn,xklLctn:xklLctn,xklEml:xklEml,xklBrgtby:xklBrgtby,},cache:false,success:function(res){$("#regSchoolResponse").html(res);}
	});
		})
			}
	//document.getElementById('hdn_crt_nw_cls').innerHTML=xklFllnm+" / "+xklAbrv+" / "+xklCtgr+" / "+xklChchBsd+" / "+xklPhn+" / "+xklLctn+" / "+xklEml+" / "+xklBrgtby+" / ";	
	}
}
//--------------------------------- PUSH NOTIFICATION
function myPush(title,body,icon,){
    // ===  load push for the first
    Push.create('Hello '+title+' !',{
      body:body,
      icon:icon,
      timeout:40000,
      onclick:function(){
        window.focus();
        this.close();
      }
    });
    // ===   load push periodically
  function autLoadPuch(){
    Push.create('Hello '+title+' !',{
      body:body,
      icon:icon,
      timeout:40000,
      onclick:function(){
        window.focus();
        this.close();
      }
    });
  }
  //  === autLoadPuch();
  setInterval(autLoadPuch,40000);
}

//================================================================================ SELECT COURSE ON Change Class

function selCourses(c_class){
	var selCourses = true;
	$.ajax({url:"../js/ajax/index.php",
	type:"GET",data:{selCourses:selCourses,c_class:c_class},cache:false,success:function(res){$("#att_course").html(res);}
	});
}
//================================================================================== VIEW ATTENDANCES
function viewAttendance(){
	var atClass = gtIdVal('att_class');
	var atCourse = gtIdVal('att_course');
	if (isEmpty(atClass) || isEmpty(atCourse)) {
		setCont("resp",atClass+" - "+atCourse);
	}else{
		var viewAttendance = true;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{viewAttendance:viewAttendance,atClass:atClass,atCourse:atCourse},cache:false,success:function(res){$("#dataTable").html(res);}
		});
	}
}

//================================================================================== RE-ORIENT TEACHER  ,  CLASS
$("#re_or_tch_cls option,#re_or_tch_cls").click(function(){
	var orThCls=document.getElementById("re_or_tch_cls").value;
	var orThTchr=document.getElementById("re_or_tch_tchr").value;
	var reOrThrCrs=1;
		$.ajax({url:"../js/ajax/index.php",
		type:"GET",data:{reOrThrCrs:reOrThrCrs,orThCls:orThCls,orThTchr:orThTchr},cache:false,success:function(res){$("#or_tch_crs").html(res);}
		});
})

//==================================================================================== SUBMIT RE-ORIENT TEACHER

function reOrientTchr(){
	$("#hdn_crt_nw_cls").html("<center><div class='loader01'></div></center>");
	var ortTchr=document.getElementById("re_or_tch_tchr").value;
	var ortCls=document.getElementById("re_or_tch_cls").value;
	var ortCrs=document.getElementById("or_tch_crs").value;
	if (ortTchr == "choose" || ortTchr=="" || ortCls == "choose" || ortCls == "" || ortCrs == "choose" || ortCrs == "") {
		document.getElementById("hdn_crt_nw_cls").innerHTML="Fill in all the Forms...";
	}else{
		if (ortCrs == "No") {
			document.getElementById("hdn_crt_nw_cls").innerHTML="No courses are available || Please set course first.";
		}else{
			var reOrTchhFn=1;
			$("#okset").attr("disabled","disabled");
			$.ajax({url:"../js/ajax/index.php",
			type:"GET",data:{reOrTchhFn:reOrTchhFn,ortTchr:ortTchr,ortCls:ortCls,ortCrs:ortCrs},cache:false,success:function(res){$("#hdn_crt_nw_cls").html(res);}
			});
		}
	}
}