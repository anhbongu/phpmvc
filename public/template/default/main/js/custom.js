// function getUrlVar(key){
// 	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
// 	return result && unescape(result[1]) || ""; 
// }
//submit form: publish unpublish 1 hoặc nhiều phần tử
function submitForm(url){

      $('#adminForm').attr('action', url);
      $('#adminForm').submit();  
}


$(document).ready(function(){



	$("a.tab1").click(function() {
		$("div#tab1").css('display', 'block');
		$("div#tab2").css('display', 'none');
		$("a.tab2").removeClass('active');
		$("a.tab1").addClass('active');
		return false;

	});
	$("a.tab2").click(function() {
		$("div#tab1").css('display', 'none');
		$("div#tab2").css('display', 'block');
		$("a.tab1").removeClass('active');
		$("a.tab2").addClass('active');
		return false;

	});


});