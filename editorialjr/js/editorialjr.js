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

	$("#btnObtenerCiudadesBsAs").click(function(){
		$.ajax({
	        url  : 'common/CiudadAjaxHelper.php',
	        data : { metodo: "getCiudadesByIdRegion", idRegion: 2 },
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {

	        		/* Arma el html de resultado iterando en los items */
	                var html = "<select>";

	        		/* Itera el resultado (igual que en PHP, hay un array que se llama result y una variable para el indice y otra para el valor)
					*  Para usar un objeto json basta con objeto.atributo. Ej: ciudad.descripcion
	        		*/
	        		$.each(result, function(index,ciudad) {        
					    
					    html += "<option value='" + ciudad.id + "'>" + ciudad.descripcion + "</option>";
					});

					html += "</select>";

					/* Aca se renderiza el resultado obtenido */
	                $("#resultadoCiudades").append(html);;
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	});
/****************************************************************************/
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
	
});
