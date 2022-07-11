// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// -- Area Chart Example
/*
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
    }],
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
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 40000,
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
*/
// -- Bar Chart Example
function barChart(datas){
  var arrData=new Array();
  /*var arr=datas.split(",");
  for (var i =0;i< arr.length; i++) {
    arrData[i]=arr[i];
  }*/
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Total Losts", "Taken", "Remain"],
    datasets: [{
      label: "Losts",
      backgroundColor: ["rgba(2,117,216,1)","Green","red"],
      borderColor: "rgba(2,117,216,1)",
      data: datas[1],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'Losts'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 3
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
//Fill Items
document.getElementById("totlostnum").innerHTML=datas[0][0]+" Item";
document.getElementById("takenlostnum").innerHTML=datas[0][1]+" Item";
document.getElementById("remlostnum").innerHTML=datas[0][2]+" Item";
}
function pieChart(data){

// -- Pie Chart Example
var colors=new Array("#007bff","#28a745","#dc3545","#ffc107","#567","#ec08fa","#fa9c08","#ad08fa","#9ea18c","#0a0ff5",
                      "#00FFFF","#7FFFD4","#000000","#0000FF","#8A2BE2","#A52A2A","#DEB887","#5F9EA0","#7FFF00",
                      "#D2691E","#FFD700","#FF7F50","#00FFFF","#006400","#556B2F","#8FBC8F","#ADFF2F","#F0E68C","#ADD8E6","#D3D3D3",
                      "#32CD32","#3CB371","#808000","#DA70D6","#EEE8AA","#FFA500","#DDA0DD","#B0E0E6","#FF0000","#BC8F8F");
var useColor=new Array();
for (var i =0;i< colors.length; i++) {
  useColor[i]=colors[i]
}
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels:data.typeName,
   // labels: ["Driving License", "Identity Card", "Passport", "Green"],
    datasets: [{
      data:data.typeNum,
     // data: [4, 7, 3, 1],
      backgroundColor: useColor,
    //backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
}
