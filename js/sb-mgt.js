function redMgt(){
	$.ajax({
	url:'ajax/skl.php',type:'POST',data:{cate:'mgt',name:$("#logsrnm").val(),pwd:$("#logpsswrd").val()},success:function(res){

	}
	});
} 
$('#logbtn').click(function(e){
	e.preventDefault();
	redMgt();
});