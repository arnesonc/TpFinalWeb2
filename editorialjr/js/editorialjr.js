$(document).ready(function (){  

	$("#btnTest").click(function(){
		$.ajax({
	        url  : 'common/AjaxHelper.php',
	        data : { metodo: "getAlgo", datos: 'La hora es: ' },
	        type : 'POST' ,
	        success : function( output ) {
	        	
	                    $("#spnTestAjax").html(output);
	                  },
	        error : function(error) {
	        	alert(error);
	        } 
		});
	});
	
	$("#btnObtenerUsuarioAdmin").click(function(){
		$.ajax({
	        url  : 'common/UsuarioAjaxHelper.php',
	        data : { metodo: "getUsuarioByEmail", emailUsuario: 'admin@editorialjr.com' },
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {
	                    $("#spnUsuarioAdmin").html(result.nombre);
	                  },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	});
	
});
