function ajax(url,getpars,typ,responseType,responseFunc){
$.ajax({
 url:url,type:typ,data:getpars,dataType:responseType,success:responseFunc,statuscode:{
   404:function(){
     alert('Response not found');
   }
 }
 });
}
function userInfo(){
 var toid=0,cate="";
  switch($("#usercate").val()){
    case'System':toid=$("#sessid").val();break;
    case'Teacher':toid=$("#decteacherid").val();break;
    case'School':toid=$("#decsklid").val();break;
}
return {uid:toid,cate:$("#usercate").val()};
}
function registerAcademicCalendar(){
      var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"register","uid":uinfo.uid,"ucate":uinfo.cate,"skl":$("#decsklid").val(),"acyear":$("#acyear").val(),"index":$("#index").val(),"start":$("#start").val(),"end":$("#end").val()},"POST","text",function(res){
  if(res=="ok"){
    loadAcademicCalendar("setContent");
    $("#regAcademicCalendarResponse").html("<font color='green'>Academic Calendar Added Success</font>");
    }else{
    $("#regAcademicCalendarResponse").html("<font color='red'>Failed to Add Academic Calendar</font>");
    }
clearMsg("#regAcademicCalendarResponse");
  });
}
function loadAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"load","uid":uinfo.uid,"ucate":uinfo.cate},"GET","json",function(res){
if(res.length!=0){
  setLoadedAcademicCalendar(res);
  }else{
    $("#loadedacalendar").html("");
  }
  });
}
function loadAcademicCalendarById(cate,id){
    var uinfo=userInfo();
    if(cate=='enable'){$("#acalid").val(id);}else{
  ajax("ajax/acalendar.php",{"cate":"loadbyid",id:id,"uid":uinfo.uid,"ucate":uinfo.cate},"GET","json",function(res){
if(res.length!=0){
  switch(cate){
    case'edit':setEditAcademicCalendar(res);break;
    case'delete':$("#acalid").val(res[0].ac_id);break;
  }
  }
  });
  }
}
function setLoadedAcademicCalendar(obj){
  var data="";
  for(var i=0;i<obj.length;i++){      
         data+="<tr class='"+(obj[i].status=='active'?'alert alert-success':'')+"'>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ obj[i].ac_acyear +"</td>"
             +"<td>"+ obj[i].ac_semester_index+"</td>"
             +"<td>"+ obj[i].ac_sem_start+"</td>"
             +"<td>"+ obj[i].ac_sem_end+"</td>"
             +"<td>"+ (obj[i].status=='pending'?'Disabled':'Active')+"</td>"
              +"<td>"+ obj[i].regdate.substring(0,10)+"</td>"
              +"<td style='text-align:center;position:inherit;' class='cflmore'><a href='#' onclick='loadAcademicCalendarById(\"enable\","+obj[i].ac_id+")' class='btn btn-success view' data-toggle='modal' data-target='#enableModal'><i class='fa fa-fw fa-check-square-o'></i>Enable</a><a href='#' onclick='loadAcademicCalendarById(\"edit\","+obj[i].ac_id+")' class='btn btn-warning view' data-toggle='modal' data-target='#modalUpdateAcademicCalendar'><i class='fa fa-fw fa-sign-out'></i>Edit</a>"
              +"<a href='#' onclick='loadAcademicCalendarById(\"delete\","+obj[i].ac_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a></td>"
            +"</tr>";
     
  }
  $("#loadedacal").html(data);
}
function setEditAcademicCalendar(data){
  $("#acalid").val(data[0].ac_id);
  $("#updacyear").val(data[0].ac_acyear);
  $("#updindex").val(data[0].ac_semester_index);
  $("#updstart").val(data[0].ac_sem_start);
  $("#updend").val(data[0].ac_sem_end);

}
function setDeleteAcademicCalendar(data){
  $("#deleteid").val(data[0].ac_id);
  $("#delarchive").html("&nbsp;&nbsp;"+data[0].ac_name);
}
function searchAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"search","sessid":uinfo.uid,"ucate":uinfo.cate,"key":$("#keyAcademicCalendar").val()},"GET","json",function(res){
if(res.archives!=null){
  setLoadedAcademicCalendar(res);
  }else{
    $("#loadedarchives").html("");
  }
  });
}
function updateAcademicCalendar(){
    var uinfo=userInfo();
     ajax("ajax/acalendar.php",{"cate":"update","id":$("#acalid").val(),uid:uinfo.uid,ucate:uinfo.cate,acyear:$("#updacyear").val(),index:$("#updindex").val(),start:$("#updstart").val(),end:$("#updend").val()},"POST","text",function(res){
    if(res=="ok"){
      loadAcademicCalendar("setContent",null);
      $("#updAcademicCalendarResponse").html("<font color='green'>Academic Calendar Updated Success</font>");
    }else{
    $("#updAcademicCalendarResponse").html("<font color='red'>Failed to Update Academic Calendar</font> ");
    }
    clearMsg("#updAcademicCalendarResponse");
  });
}
function deleteAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"delete","uid":uinfo.uid,"ucate":uinfo.cate,"id":$("#acalid").val(),"reason":$("#delReason").val()},"POST","text",function(res){
  //alert(res);
  if(res=="ok"){
    loadAcademicCalendar("setContent",null);
    $("#delResponse").html("<font color='green'>Academic Calendar Removed Successful</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Academic  Calendar</font>");
    }
clearMsg("#delResponse");
  });
}
function enableAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"enable","uid":uinfo.uid,"ucate":uinfo.cate,"id":$("#acalid").val()},"POST","text",function(res){
  //alert(res);
  if(res=="ok"){
    loadAcademicCalendar("setContent",null);
          function hhidef(){
        window.location.reload(true);
      }
    window.setTimeout(hhidef,1000);
    $("#enableResponse").html("<font color='green'>Academic Calendar Enabled Successful</font>");
    }else{
    $("#enableResponse").html("<font color='red'>Failed to enable Academic  Calendar Option</font>");
    }
clearMsg("#enableResponse");
  });
}

function autoAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"auto","uid":uinfo.uid,"ucate":uinfo.cate,"id":$("#acalid").val()},"POST","text",function(res){
  //alert(res);
  if(res=="ok"){
    loadAcademicCalendar("setContent",null);
          function hhidef(){
        window.location.reload(true);
      }
    window.setTimeout(hhidef,1000);
    $("#autoResponse").html("<font color='green'>Academic Calendar Enabled Success</font>");
    }else{
    $("#autoResponse").html("<font color='red'>Failed to make Automatic Academic  Calendar Option</font>");
    }
clearMsg("#autoResponse");
  });
}
function deleteAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"delete","uid":uinfo.uid,"ucate":uinfo.cate,"id":$("#acalid").val(),"reason":$("#delReason").val()},"POST","text",function(res){
  //alert(res);
  if(res=="ok"){
    loadAcademicCalendar("setContent",null);
    $("#delResponse").html("<font color='green'>Academic Calendar Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Academic  Calendar</font>");
    }
clearMsg("#delResponse");
  });
}
function showAcademicCalendar(){
    var uinfo=userInfo();
  ajax("ajax/acalendar.php",{"cate":"active","uid":uinfo.uid,"ucate":uinfo.cate},"GET","json",function(res){
    setActiveAcademicCalendar(res);
  });
}
function setActiveAcademicCalendar(obj){
$("#year").html(obj[0].year);
$("#tstart").html(obj[0].start);
$("#close").html(obj[0].close);
$("#trimester").html(obj[0].trimester);

if(obj.auto.length>0){
$("#autoyear").html(obj.auto[0].year);
$("#autotstart").html(obj.auto[0].start);
$("#autoclose").html(obj.auto[0].close);
$("#autotrimester").html(obj.auto[0].trimester);
}
}
function loadAutoAcademicCalendar(){
  var uinfo=userInfo();
  ajax("../ajax/acalendar.php",{cate:'auto',uid:uinfo.uid,ucate:uinfo.ucate},'GET','json',function(res){
if(res.length>0){
$("#evChPedr").html("<option value='"+(res[0].year+"-"+res[0].trimester+"-1")+"'>"+res[0].year+"-"+res[0].trimester+"-1</option><option value='"+(res[0].year+"-"+res[0].trimester+"-2")+"'>"+res[0].year+"-"+res[0].trimester+"-2</option>");
  }else{
    $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Active academic calendar to evaluate</h5>");
  }
  });
}
function loadAvailablePeriodFilter(){
  var period="<option value='default'>All Period</option>",uinfo=userInfo(),data={"cate":"available","uid":uinfo.uid,"ucate":uinfo.cate};
    ajax("../ajax/evaluation.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  for(var i=0;i<res.length;i++){
    period+="<option>"+res[i].period+"</option>"
  }
  $("#selPeriod").html(period);
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");    
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Evaluation result available for enabled Academic calendar</h5><br>");          
    }
  }
  });
  
}
 function loadEvaluation(cate,period){
  var uinfo=userInfo(),data={"cate":"load","uid":uinfo.uid,"ucate":uinfo.cate};
  if(period!=null){data.period=period;data.type='periodic'}
  ajax("../ajax/evaluation.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  switch(cate){
    case'setContent':setLoadedEvaluation(res);break;
  }
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");    
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Evaluation result available for enabled Academic calendar</h5><br>");          
    }
  }
  });
 }
 function evaluationPrepare(obj){
  var teachers=[""],
      ability=[0],
      availability=[0],
      model=[0],
      assignments=[0],
      personality=[0],
      avg_eval=[0];
      for(var i=0;i<obj.length;i++){
        teachers[teachers.length]=(obj[i].teacher_fullname==null?"":obj[i].teacher_fullname);
        ability[ability.length]=(obj[i].ability==null?0:obj[i].ability);
        availability[availability.length]=(obj[i].availability==null?0:obj[i].availability);
        model[model.length]=(obj[i].model==null?0:obj[i].model);
        assignments[assignments.length]=(obj[i].assignments==null?0:obj[i].assignments);
        personality[personality.length]=(obj[i].personality==null?0:obj[i].personality);
        avg_eval[avg_eval.length]=(obj[i].average_evaluation==null?0:obj[i].average_evaluation);
      }
      return {teachers:teachers,ability:ability,availability:availability,model:model,assignments:assignments,personality:personality,avg_eval:avg_eval}
 }
 function setLoadedEvaluation(obj){
  var datas=evaluationPrepare(obj);
   var config = {
      type: 'line',
      data: {
        labels: datas.teachers,
        datasets: [{
          label: 'Ability',
          fill: false,
          borderColor: 'red',
          backgroundColor: 'red',
          data: datas.ability
        },
        {
          label: 'Model',
          fill: false,
          borderColor: 'blue',
          backgroundColor: 'blue',
          data:datas.model
          },
          {
            label: 'Availability',
            fill: false,
            borderColor: 'yellow',
            backgroundColor: 'yellow',
            data:datas.availability
          },
          {
            label: 'Assignments',
            fill: false,
            borderColor: 'pink',
            backgroundColor: 'pink',
            data:datas.assignments
          },
          {
            label: 'Personality',
            fill: false,
            borderColor: 'green',
            backgroundColor: 'green',
            data:datas.personality
          },
          {
            label: 'Average',
            fill: false,
            borderColor: 'black',
            backgroundColor: 'black',
            data:datas.avg_eval
          }],
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Teachers Evaluation Performance'
        },

        scales: {
          xAxes: [{
            ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: true
          }]
        }
      }
    };

    //window.onload = function() {
      $("#evaluationResult").html("<canvas id='canvas_tcr_ev'></canvas>");
      var ctx = document.getElementById('canvas_tcr_ev').getContext('2d');
      window.myLine = new Chart(ctx, config);
  //  };
 }
 //Statistics charts
 function loadTaskAnalysis(cate){
  var uinfo=userInfo(),data={"cate":"task","uid":(uinfo.cate!='School'?$("#teacherschoolid").val():uinfo.uid),"ucate":uinfo.cate};
  ajax("ajax/statistics.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  switch(cate){
    case'setContent':setLoadedTaskStatistics(res);break;
  }
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");    
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Evaluation result available for enabled Academic calendar</h5><br>");          
    }
  }
  });
 }
 function taskStatisticsPrepare(obj){
  var teachers=[""],
      marked=[0],
      notyet=[0],
      total=[0];
      for(var i=0;i<obj.length;i++){
        teachers[teachers.length]=(obj[i].teacher_fullname==null?"":obj[i].teacher_fullname);
        total[total.length]=(obj[i].total_task==null?0:obj[i].total_task);
        marked[marked.length]=(obj[i].total_marked==null?0:obj[i].total_marked);
        notyet[notyet.length]=(obj[i].total_notyet==null?0:obj[i].total_notyet);
      }
      return {teachers:teachers,total:total,marked:marked,notyet:notyet}
 }
 function setLoadedTaskStatistics(obj){
  var datas=taskStatisticsPrepare(obj),uinfo=userInfo();
   /*var config = {
      type: 'line',
      data: {
        labels: datas.teachers,
        datasets: [{
          label: 'Not Yet',
          fill: false,
          borderColor: 'red',
          backgroundColor: 'red',
          data: datas.notyet
        },
          {
            label: 'Marked',
            fill: false,
            borderColor: 'green',
            backgroundColor: 'green',
            data:datas.marked
          },
        {
          label: 'Total',
          fill: false,
          borderColor: 'blue',
          backgroundColor: 'blue',
          data:datas.total
          }],
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Teachers Task Performance Graph'
        },

        scales: {
          xAxes: [{
            ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: true
          }]
        }
      }
    };

    window.onload = function() {
      var elem=(uinfo.cate=='School'?'myCharts':'myCharts'),ctx = document.getElementById(elem).getContext('2d');
      window.myLine = new Chart(ctx, config);
    };*/
    var elem=(uinfo.cate=='School'?'myCharts':'myCharts'),ctx = document.getElementById(elem).getContext('2d');
//     myLineChart = new Chart(ctx, {
//      type: 'line',
//       data: {
//         labels: datas.teachers,
//         datasets: [{
//           label: 'Not Yet',
//           fill: false,
//           borderColor: 'red',
//           backgroundColor: 'red',
//           data: datas.notyet
//         },
//           {
//             label: 'Marked',
//             fill: false,
//             borderColor: 'green',
//             backgroundColor: 'green',
//             data:datas.marked
//           },
//         {
//           label: 'Total',
//           fill: false,
//           borderColor: 'blue',
//           backgroundColor: 'blue',
//           data:datas.total
//           }],
//     },
//   options: {
//     scales: {
//       xAxes: [{
//         time: {
//           unit: 'date'
//         },
//         gridLines: {
//           display: true
//         },
//         ticks: {
//           maxTicksLimit: 100,
//             stepSize: 1,
//             autoSkip:false,
//         }
//       }],
//       yAxes: [{
//         ticks: {
//           min: 0,
//          // max: 40000,
//          //max:datas.max,
//           maxTicksLimit: 100
//         },
//         gridLines: {
//           color: "rgba(0, 0, 0, .125)",
//         }
//       }],
//     },
//     legend: {
//       display: false
//     }
//   }
// });



 }
function loadCourseStatistics(cate,period){
  var uinfo=userInfo(),data={"cate":"course","school":uinfo.uid,"uid":uinfo.uid,"ucate":uinfo.cate,class:$("#selclassdash").val()};
  if(period!=null){data.period=period;data.type='periodic'}
  ajax("../ajax/statistics.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  switch(cate){
    case'setContent':setLoadedCourseStatistics(res);break;
  }
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Course statistics available for enabled Academic calendar</h5><br>");          
    }
  }
  });
 }
 function courseStatisticsPrepare(obj){
  var course=[""],
      marks=[0];
      for(var i=0;i<obj.length;i++){
        course[course.length]=(obj[i].course_name==null?"":obj[i].course_name);
        marks[marks.length]=(obj[i].avg_task_marks==null?0:obj[i].avg_task_marks);
        }
      return {course:course,marks:marks}
 }
 function setLoadedCourseStatistics(obj){
  var datas=courseStatisticsPrepare(obj);
   var config = {
      type: 'line',
      data: {
        labels: datas.course,
        datasets: [{
          label: 'Percentage',
          fill: false,
          borderColor: 'brown',
          backgroundColor: 'brown',
          data: datas.marks
        }],
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Course Statistics Performance'
        },

        scales: {
          xAxes: [{
            ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: true
          }]
        }
      }
    };

   // window.onload = function() {
    $("#graphPresent").html("<canvas id='course_statistics'></canvas>");
      var ctx = document.getElementById('course_statistics').getContext('2d');
      window.myLine = new Chart(ctx, config);
 //   };
 }

function loadClassStatistics(cate,type,elem){
  var uinfo=userInfo(),data={"cate":"class","uid":uinfo.uid,"ucate":uinfo.cate};
  if(type=='specific'){data.type=type};
  ajax("../ajax/statistics.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  switch(cate){
    case'setContent':setLoadedClassStatistics(res,elem,(type=='specific'?'blue':'green'));break;
  }
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Class statistics available for enabled Academic calendar</h5><br>");          
    }
  }
  });
 }
 function classStatisticsPrepare(obj){
  var classs=[""],
      marks=[0];
      for(var i=0;i<obj.length;i++){
        classs[classs.length]=(obj[i].class_name==null?"":obj[i].class_name);
        marks[marks.length]=(obj[i].avg_task_marks==null?0:obj[i].avg_task_marks);
        }
      return {class:classs,marks:marks}
 }
 function setLoadedClassStatistics(obj,elem,color){
  var datas=classStatisticsPrepare(obj);
   /*----Old graph represent
   var config = {
      type: 'line',
      data: {
        labels: datas.class,
        datasets: [{
          label: 'Percentage',
          fill: false,
          borderColor: color,
          backgroundColor: color,
          data: datas.marks
        }],
        },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Class Statistics Performance'
        },

        scales: {
          xAxes: [{
            ticks: {
            stepSize: 1,
            min: 0,
            autoSkip: false,
        },
            display: true,

          }],
          yAxes: [{
            display: true,
            beginAtZero: true
          }]
        }
      }
    };

    window.onload = function() {
      var ctx = document.getElementById(elem).getContext('2d');
      window.myLine = new Chart(ctx, config);
    };*/

var ctx = document.getElementById(elem);
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels:datas.class,
    //labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
    datasets: [{
      label: "Percentage",
      lineTension: 0.3,
      //backgroundColor: color,
      borderColor: color,
      pointRadius: 5,
      pointBackgroundColor:color,
      //pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data:datas.marks,
      //data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: true
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 40000,
         max:datas.max,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

 }
 function loadGenderStatistics(cate,elem){
  var uinfo=userInfo(),data={"cate":"gendercount","skl":uinfo.uid,"uid":uinfo.uid,"ucate":uinfo.cate};
  if(cate=='setContentByPerformance'){
    data.cate='gender';
  }
  ajax("../ajax/statistics.php",data,"GET","json",function(res){
if(!res.hasOwnProperty("invalid") && res.length!=0){
  switch(cate){
    case'setContentByCount':setLoadedGenderStatistics(res,elem);break;
    case'setContentByPerformance':setLoadedGenderBarStatistics(res,elem);break;
  }
  }else{
    if(res.hasOwnProperty("invalid")){
      alert("You must enable Academic Calendar to view related Information");
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No Academic calendar enabled</h5><br><h6 style='color:green'>Go to Panel>Calendar>Enable Trimester to view its Data</h6>");    
    }
    if(res.length==0){
      $("#invalidResponse").html("<h5 style='color:red;text-align:center;'>No gender statistics available for enabled Academic calendar</h5><br>");          
    }
  }
  });
 }
 function genderStatisticsPrepare(obj){
  var sex=["None","Female","Male"],
      count=new Array(),
      sexOlvl=["None","Female","Male"],
      countOlvl=[],
      sexAlvl=["None","Female","Male"],
      countAlvl=[];
      //for olvl initialization
        if(obj.hasOwnProperty("olvl")){
          var totOlvl=0;
          for(var i=0;i<obj.olvl.length;i++){
            switch(obj.olvl[i].student_sex){
              case'':
              $("#olvlNoSexStd").html(obj.olvl[i].total_student);
              countOlvl[0]=obj.olvl[i].total_student;
              totOlvl+=parseInt(obj.olvl[i].total_student);break;
              case'F':
              $("#olvlFemaleStd").html(obj.olvl[i].total_student);
              countOlvl[1]=obj.olvl[i].total_student;
              totOlvl+=parseInt(obj.olvl[i].total_student);break;
              case'M':
              $("#olvlMaleStd").html(obj.olvl[i].total_student);
              countOlvl[2]=obj.olvl[i].total_student;
              totOlvl+=parseInt(obj.olvl[i].total_student);break;
            }
          }
          $("#olvlTotStd").html(totOlvl);
        }

        if(obj.hasOwnProperty("alvl")){
          var totAlvl=0;
          for(var i=0;i<obj.alvl.length;i++){
            switch(obj.alvl[i].student_sex){
              case'':
              $("#alvlNoSexStd").html(obj.alvl[i].total_student);
              countAlvl[0]=obj.alvl[i].total_student;
              totAlvl+=parseInt(obj.alvl[i].total_student);break;
              case'F':
              $("#alvlFemaleStd").html(obj.alvl[i].total_student);
              countAlvl[1]=obj.alvl[i].total_student;
              totAlvl+=parseInt(obj.alvl[i].total_student);break;
              case'M':
              $("#alvlMaleStd").html(obj.alvl[i].total_student);
              countAlvl[2]=obj.alvl[i].total_student;
              totAlvl+=parseInt(obj.alvl[i].total_student);break;
            }
          }
          $("#alvlTotStd").html(totAlvl);
        }
        if(obj.hasOwnProperty("whole")){
          var totWhole=0;
          for(var i=0;i<obj.whole.length;i++){
            switch(obj.whole[i].student_sex){
              case'':
              $("#wholeNoSexStd").html(obj.whole[i].total_student);
              count[0]=obj.whole[i].total_student;
              totWhole+=parseInt(obj.whole[i].total_student);break;
              case'F':
              $("#wholeFemaleStd").html(obj.whole[i].total_student);
              count[1]=obj.whole[i].total_student;
              totWhole+=parseInt(obj.whole[i].total_student);break;
              case'M':
              $("#wholeMaleStd").html(obj.whole[i].total_student);
              count[2]=obj.whole[i].total_student;
              totWhole+=parseInt(obj.whole[i].total_student);break;
            }
          }
          $("#wholeTotStd").html(totWhole);
        }
      return {olvl:[{sex:sexOlvl,count:countOlvl,total:totOlvl}],alvl:[{sex:sexAlvl,count:countAlvl,total:totAlvl}],whole:[{sex:sex,count:count,total:totWhole}]}
 }
 function setLoadedGenderStatistics(obj,elem){
    // -- Pie Chart for gender based statistics
    var data=genderStatisticsPrepare(obj);
var colors=new Array("#007bff","#ffc107","#28a745","#567","#ec08fa","#fa9c08","#ad08fa","#9ea18c","#0a0ff5",
                      "#00FFFF","#7FFFD4","#000000","#0000FF","#8A2BE2","#A52A2A","#DEB887","#5F9EA0","#7FFF00",
                      "#D2691E","#FFD700","#FF7F50","#00FFFF","#dc3545","#006400","#556B2F","#8FBC8F","#ADFF2F","#F0E68C","#ADD8E6","#D3D3D3",
                      "#32CD32","#3CB371","#808000","#DA70D6","#EEE8AA","#FFA500","#DDA0DD","#B0E0E6","#FF0000","#BC8F8F");
var useColor=new Array();
for (var i =0;i< colors.length; i++) {
  useColor[i]=colors[i]
}
var ctx = document.getElementById(elem);
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels:data.whole[0].sex,
   // labels: ["Driving License", "Identity Card", "Passport", "Green"],
    datasets: [{
      data:data.whole[0].count,
     // data: [4, 7, 3, 1],
      backgroundColor: useColor,
    //backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
 }
 function genderBarStatisticsPrepare(obj){
 var sex=["None","Female","Male"],
      count=new Array(),
      sexOlvl=["None","Female","Male"],
      countOlvl=[],
      sexAlvl=["None","Female","Male"],
      countAlvl=[];
      //for olvl initialization
        if(obj.hasOwnProperty("olvl")){
          for(var i=0;i<obj.olvl.length;i++){
            switch(obj.olvl[i].student_sex){
              case'':
              countOlvl[0]=obj.olvl[i].avg_task_marks;break;
              case'F':
              countOlvl[1]=obj.olvl[i].avg_task_marks;break;
              case'M':
              countOlvl[2]=obj.olvl[i].avg_task_marks;break;
            }
          }
        }

        if(obj.hasOwnProperty("alvl")){
          for(var i=0;i<obj.alvl.length;i++){
            switch(obj.alvl[i].student_sex){
              case'':
              countAlvl[0]=obj.alvl[i].avg_task_marks;break;
              case'F':
              countAlvl[1]=obj.alvl[i].avg_task_marks;break;
              case'M':
              countAlvl[2]=obj.alvl[i].avg_task_marks;break;
            }
          }
        }
        if(obj.hasOwnProperty("whole")){
          for(var i=0;i<obj.whole.length;i++){
            switch(obj.whole[i].student_sex){
              case'':
              count[0]=obj.whole[i].avg_task_marks;break;
              case'F':
              count[1]=obj.whole[i].avg_task_marks;break;
              case'M':
              count[2]=obj.whole[i].avg_task_marks;break;
            }
          }
        }
      return {olvl:[{sex:sexOlvl,count:countOlvl}],alvl:[{sex:sexAlvl,count:countAlvl}],whole:[{sex:sex,count:count}]}
 
 }
function setLoadedGenderBarStatistics(obj,elem){
  var data=genderBarStatisticsPrepare(obj);
  var barChartData = {
    labels : data.whole[0].sex,
    datasets : [
      {
        fillColor : "rgba(220,220,220,0.5)",
        strokeColor : "rgba(220,220,220,0.8)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
        data : data.olvl[0].count
      },
      {
        fillColor : "rgba(151,187,205,0.5)",
        strokeColor : "rgba(151,187,205,0.8)",
        highlightFill : "rgba(151,187,205,0.75)",
        highlightStroke : "rgba(151,187,205,1)",
        data : data.alvl[0].count
      },
      {
        fillColor : "rgba(151,107,80,0.5)",
        strokeColor : "rgba(151,107,80,0.8)",
        highlightFill : "rgba(151,107,80,0.75)",
        highlightStroke : "rgba(151,107,80,1)",
        data : data.whole[0].count
      }
    ]

  }
  window.onload = function(){
    var ctx = document.getElementById(elem).getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
      responsive : true
    });
  }
  var ctx = document.getElementById(elem);
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    //labels: ["Total Losts", "Taken", "Remain"],
    labels : ["None","Female","Male"],
    //labels: datas.label,
datasets : [
      {
        label:"O'Level",
        backgroundColor:"rgba(220,220,220,0.5)",
        data : data.olvl[0].count
      },
      {
        label:"A'Level",
        backgroundColor:"rgba(151,187,205,0.5)",        
        data : data.alvl[0].count
      },
      {
        label:"Both",
        backgroundColor:"rgba(151,107,80,0.5)",
        data : data.whole[0].count
      }],
       /* datasets: [{
      label: datas.labelmessage,
     // backgroundColor: ["rgba(2,117,216,1)","Green","red"],
      backgroundColor: useColor,
      borderColor: "rgba(2,117,216,1)",
      data: datas.sets,
    }],*/
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 40
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
         // max: 100,
         //max:datas.max,
          maxTicksLimit: 100
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: true
    }
  }
});
 }
 function loadStudentReport(){
  var uinfo=userInfo();
    ajax("ajax/statistics.php",{"cate":"bulletin",uid:uinfo.uid,usercate:uinfo.cate,class:$("#selclassdash").val()},"GET","json",function(res){
 setLoadedStudentReport(res);
 });
 }
 function setLoadedStudentReport(obj){
  var reps="";
  for(var i=0;i<1;i++){
    for(var course in obj[i].marks){
  reps+="<tr><th>"+course+"</th>"
              +"<th>"+(obj[i].marks[course].overall)+"</th>"
              +"<th>"+(obj[i].marks[course].overall)+"</th>"
              +"<th>"+(obj[i].marks[course].overall*2)+"</th>"
              +"<td>"+(obj[i].marks[course].test==null?0:obj[i].marks[course].test)+"</td>"
              +"<td>"+(obj[i].marks[course].exam==null?0:obj[i].marks[course].exam)+"</td>"
              +"<td>"+(parseFloat(obj[i].marks[course].test)+parseFloat(obj[i].marks[course].exam))+ "</td></tr>"
              }
              }
              $("#schoolNameTitle").html(obj[0].school_name);
              $("#schoolPhoneTitle").html(obj[0].school_phone);
              $("#schoolEmailTitle").html(obj[0].school_email);
              $("#studentName").html(obj[0].student_fullname);
              $("#studentClass").html(obj[0].class_name);
       $("#loadedBulletin").html(reps);       
 }
 //end statistics
  function registerIssues(){
    var uinfo=userInfo();
    alert(uinfo.uid+","+uinfo.cate+"issue"+$("#issueTitle").val()+"descr"+$("#txtIssueDescr").val());
    ajax("ajax/issues.php",{"cate":"register",sessid:uinfo.uid,usercate:uinfo.cate,ownerid:uinfo.uid,ownertype:uinfo.cate,"issue":$("#issueTitle").val(),"descr":$("#txtIssueDescr").val()},"GET","text",function(res){
        if(!isNaN(res)){
$("#iscissueid").val(res);
loadIssues('setContent');
            loadIssuesChat("setContent",res);
            setTimeout(function(){$("#closeIssModal").click();},3000);
            $("#issueTitle").val("");$("#txtIssueDescr").val("");
        //$("#regIssueResponse").html("<font color='green'>Item Issue Registered Success</font>");
        }else{
        //$("#regIssueResponse").html("<font color='red'>Failed to Register Item Issue</font> ");
        }
    });
}
function loadIssues(cate){
  var toid="",uinfo=userInfo();
    ajax($("#ajaxPath").val()+"ajax/issues.php",{"cate":"load",ownerid:uinfo.uid,ownertype:uinfo.cate},"GET","json",function(res){
if(res.issues!=null){    
switch(cate){
    case'setContent':
    setLoadedIssues(res);break;
    default:
    }           
}else{
    $("#loadedissue").html("");
        }
})
}
loadIssues('setContent');
function setLoadedIssues(loadedissue){
var issues="",uinfo=userInfo();
         for(var i=0;i<loadedissue.issues.length;i++){    
if(loadedissue.issues[i].iss_id!=null){       
         issues+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedissue.issues[i].iss_owner +"</td>"
             +"<td>"+ loadedissue.issues[i].iss_title+"</td>"
             +"<td>"+ loadedissue.issues[i].iss_status+"</td>"
              +"<td>"+ loadedissue.issues[i].regdate+"</td>"
              +"<td style='text-align:center;position:inherit;' class='cflmore'><li class='dropdown' style='list-style-type:none'><a href='#'id='dropBtn"+i+"' class='btn btn-"+((loadedissue.issues[i].newchat!=0 && loadedissue.issues[i].isc_from_type!=uinfo.cate)?'success':'info')+" glyphicon glyphicon-full-screen dropdown-toggle' data-toggle='dropdown'>Actions <i class='badge'>"+((loadedissue.issues[i].newchat!=0 && loadedissue.issues[i].isc_from_type!=uinfo.cate)?loadedissue.issues[i].newchat:'')+"</i></a>"
               +"</a>"
                 +"<ul id='dropMenus"+i+"' class='dropdown-menu text-white' role='menu' aria-labelledby='dropBtn"+i+"'>"
              +"<li><a href='#' onclick='loadIssuesChat(\"setContent\","+loadedissue.issues[i].iss_id+")' class='btn btn-success view glyphicon' data-toggle='modal' data-target='#issueChatModal'><i class='fa fa-fw fa-sign-out'></i>Reply</a></li>"
              +"<li><a href='#' onclick='loadIssuesById(\"delete\","+loadedissue.issues[i].iss_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a></li>"
              +"</div></ul></li></td>"
            +"</tr>";
            }
            }
            $("#loadedIssues").html(issues);
            $("#tblIssues").dataTable();
    }
function loadIssuesById(cate,id){
    ajax("ajax/issues.php",{"cate":"loadbyid","id":id},"GET","json",function(res){
    if(cate=='reply'){
        setLoadedIssuesChat(res);
    }
    if(cate=='delete'){
        setDeleteIssues(res.issues);
    }
    });
}
function setDeleteIssues(data){
    $("#deleteid").val(data[0].iss_id);
    $("#delModalTitle").html("Do you want to delete "+data[0].docissue+"?");
}
function searchIssues(){
    ajax("ajax/issues.php",{"cate":"search","key":$("#keyIssue").val()},"GET","json",function(res){
if(res.issues!=null){
    setLoadedIssues(res);
    }else{
        $("#loadedissues").html("<tr><td colspan='5'><center>No Item Issues Found</center><td></tr>");
    }
    });
}
function updateIssues(){
 ajax("ajax/issues.php",{"cate":"update","id":$("#issueid").val(),sessid:uinfo.uid,usercate:uinfo.cate,ownerid:uinfo.uid,ownertype:uinfo.cate,"issue":$("#issueTitle").val(),"descr":$("#txtIssueDescr").val()},"GET","text",function(res){
        if(res=="ok"){
            loadIssues("setContent");
            $("#updateIssueResponse").html("<font color='green'>Item Issue Updated Success</font>");
        }else if(res=='exist'){
        $("#updateIssueResponse").html("<font color='blue'>Some Unique Information Exist to Other Document Issue</font>");
        }else{
        $("#updateIssueResponse").html("<font color='red'>Failed to Update Item Issue</font>");
        }
clearMsg("#updateIssueResponse");
    });
}
function deleteIssues(){
    ajax("ajax/issues.php",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
    //  alert(res);
        if(res=="ok"){
        loadIssues("setContent");
        $("#delReason").val("");
        $("#delResponse").html("<font color='green'>Item Issue Removed Success</font>");
        }else{
        $("#delResponse").html("<font color='red'>Failed to Remove Item Issue</font>");
        }
clearMsg("#delResponse");
    });
}   
function registerIssuesChat(){
  var uinfo=userInfo();
     ajax("ajax/issueschat.php",{"cate":"register",sessid:$("#sessid").val(),"issid":$("#iscissueid").val(),"fromid":uinfo.uid,"fromtype":uinfo.cate,"toid":$("#toid").val(),"totype":$("#totype").val(),"message":$("#issueschat").val()},"GET","text",function(res){
        if(res=="ok"){
          $("#issueschat").val("");
            loadIssuesChat("setContent",$("#iscissueid").val());
        }else{
        }
    });
}
function loadIssuesChat(cate,issid){
 var uinfo=userInfo();
  $("#iscissueid").val(issid);
    ajax("ajax/issueschat.php",{"cate":"load","issid":issid},"GET","json",function(res){
if(res.issues_chat.length!=0){    
switch(cate){
    case'setContent':
      var uinfo=userInfo();
    setLoadedIssuesChat(res);
    if(res.issues_chat[(res.issues_chat.length-1)].isc_from_type!=uinfo.cate){
uinfo.cate!='System'?changeIssuesStatus(res.issues_chat[0].isc_issueid,'sent','progress'):'';
changeAllChatStatus(res.issues_chat[0].isc_issueid,'delivered','seen',uinfo.uid,uinfo.cate);
}
    break;
    default:
    }           
}else{
    $("#loadedissue").html("");
        }
})
}
function setLoadedIssuesChat(loadedissue){
  var uinfo=userInfo();
var chatMsg="";
$("#toid").val(loadedissue.issues_chat[0].iss_owner_id);
$("#totype").val(loadedissue.issues_chat[0].iss_owner_type);
if(uinfo.cate=='School'){
$("#toid").val(0);
$("#totype").val("System");
}
$("#issOwner").html(loadedissue.issues_chat[0].iss_owner);
$("#issTitle").html(loadedissue.issues_chat[0].iss_title);

         for(var i=0;i<loadedissue.issues_chat.length;i++){    
chatMsg+="<div class='"+(loadedissue.issues_chat[i].isc_from_type!=uinfo.cate?'iscReceived':'iscSent')+"'>"+loadedissue.issues_chat[i].isc_message+"<br>"
                +"<span class='sentdate'>"+loadedissue.issues_chat[i].regdate.substring(0,16)+"</span><span class='status'>"+(loadedissue.issues_chat[i].isc_from_type==uinfo.cate?loadedissue.issues_chat[i].isc_status:'')+"</span></div>";
            }
$("#chatContainer").html("");
            $("#chatContainer").append(chatMsg);
    }
    function setComboIssuesChat(obj,elem) {
        var selissue="";
        selissue="<option>All IssuesChat</option>";
        for (var i=0;i<obj.issueschat.length;i++) {
selissue+="<option value="+obj.issues_chat[i].isc_id+">"+obj.issues_chat[i].docissue+"</option>";
    }
    $(elem).html(selissue);
}
function loadIssuesChatById(cate,id){
    ajax("ajax/issueschat.php",{"cate":"loadbyid","id":id},"GET","json",function(res){
    if(cate=='edit'){
        setEditIssuesChat(res);
    }
    if(cate=='delete'){
        setDeleteIssuesChat(res.issueschat);
    }
    });
}
function setEditIssuesChat(data){
    $("#issueid").val(data.issues_chat[0].isc_id);
    $("#updIssue").val(data.issues_chat[0].docissue);
    $("#updmaxItem").val(data.issues_chat[0].max_items);
}
function setDeleteIssuesChat(data){
    $("#deleteid").val(data[0].isc_id);
    $("#delModalTitle").html("Do you want to delete "+data[0].docissue+"?");
}
function searchIssuesChat(){
    ajax("ajax/issueschat.php",{"cate":"search","key":$("#keyIssue").val()},"GET","json",function(res){
if(res.issueschat!=null){
    setLoadedIssuesChat(res);
    }else{
        $("#loadedissueschat").html("<tr><td colspan='5'><center>No Item IssuesChat Found</center><td></tr>");
    }
    });
}
function updateIssuesChat(){
    setLoaders({elem:'updateIssueResponse',elemissue:'container',msg:'Updating Data...'});
 ajax("ajax/issueschat.php",{"cate":"update","id":$("#issueid").val(),"docissue":$("#updIssue").val(),"max":$("#updmaxItem").val()},"GET","text",function(res){
        if(res=="ok"){
            loadIssuesChat("setContent");
            $("#updateIssueResponse").html("<font color='green'>Item Issue Chat Updated Success</font>");
        }else if(res=='exist'){
        $("#updateIssueResponse").html("<font color='blue'>Some Unique Information Exist to Other Document Issue</font>");
        }else{
        $("#updateIssueResponse").html("<font color='red'>Failed to Update Item Issue</font>");
        }
clearMsg("#updateIssueResponse");
    });
}
function deleteIssuesChat(){
    ajax("ajax/issueschat.php",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
    //  alert(res);
        if(res=="ok"){
        loadIssuesChat("setContent");
        $("#delReason").val("");
        $("#delResponse").html("<font color='green'>Item Issue Chat Removed Success</font>");
        }else{
        $("#delResponse").html("<font color='red'>Failed to Remove Issue Chat</font>");
        }
clearMsg("#delResponse");
    });
}
//Notifiers for new Issues ....
function loadNewIssues(){
   var uinfo=new userInfo();
   if(uinfo.cate=='System'){
      setInterval(function(){
ajax("ajax/notifiers.php",{"cate":"newissues",currstatus:'sent'},"GET","text",function(res){
//notificationsAlert({cate:'issues',count:res});
if(res!=0){
$("#supportCount").html(res);
  $("#notifierContainer").show();
}else{
  $("#notifierContainer").hide()
}
})
   },loadTimer('chat_interval'));
    }
}
function loadNewIssuesChat(){
 var uinfo=userInfo();
 setInterval(function(){
    ajax("ajax/notifiers.php",{"cate":"newissueschat","toid":uinfo.uid,"totype":uinfo.cate},"GET","text",function(res){
if(res!=0){    
    $("#supportCount").html(res);
      changeAllChatStatus('all','sent','delivered',uinfo.uid,uinfo.cate);
      }else{
    $("#supportCount").html("");
      }
})
  },loadTimer('chat_interval'));
}
function changeIssuesStatus(issid,currstatus,status){
ajax("ajax/notifiers.php",{"cate":"changeissstatus",issid:issid,status:status,currstatus:currstatus},"GET","text",function(res){

})
}
function changeAllIssuesStatus(status,currstatus){
ajax("ajax/notifiers.php",{"cate":"changeissuesstatus",status:status,currstatus:currstatus},"GET","text",function(res){

})
}
function changeAllChatStatus(issid,currstatus,status,toid,totype){
ajax("ajax/notifiers.php",{"cate":"changeiscstatus",issid:issid,status:status,currstatus:currstatus,toid:toid,totype:totype},"GET","text",function(res){

})
}
function notificationsAlert(obj){ 
switch(obj.cate){
  case'issues':
  notificationAlertSend({content:obj.count+" New Issues Raised\n Now "+new Date()});break;
  default:
  } 
}   
//==========================Optional==================================================
function loadTimer(cate){
  feed=0;
  switch(cate){
    case'chat_interval':
    feed=5000;break;
    case'chat_delay':
    feed=100;break;
  }
  return feed;
}

function getDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
function getTime() {
    var d = new Date(),
        hour = d.getHours(),
        min = d.getMinutes(),
        sec = d.getSeconds();

    if (hour.length < 10) hour = '0' + hour;
    if (min.length < 10) min = '0' + min;
    if (sec.length < 10) sec = '0' + sec;

    return [hour, min, sec].join(':');
}
//AutoClear Msg
function clearMsg(elem){
setTimeout(function(){
$(elem).html("");
},5000);
}