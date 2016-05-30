$(document).ready(function (){

	$("#btnTest").click(function(){
		$.ajax({
	        url  : 'common/AjaxHelper.php',
	        data : { datos: 'ger' },
	        type : 'POST' ,
	        success : function( output ) {
	                    alert(output);
	                  },
	        error : function(error) {
	        	alert(error);
	        } 
		});	
	});
	
});
