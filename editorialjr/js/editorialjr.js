$(document).ready(function (){

	$("#btnTest").click(function(){
		$.ajax({
	        url  : 'common/AjaxHelper.php',
	        data : { datos: 'La hora es: ' },
	        type : 'POST' ,
	        success : function( output ) {
	                    $("#spnTestAjax").html(output);
	                  },
	        error : function(error) {
	        	alert(error);
	        } 
		});	
	});
	
});
