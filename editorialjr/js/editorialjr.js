$(document).ready(function (){  

	$("#btnTest").click(function(){
		$.ajax({
	        url  : 'helpers/AjaxHelper.php',
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
	        url  : 'helpers/UsuarioAjaxHelper.php',
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
	        url  : 'helpers/CiudadAjaxHelper.php',
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
	                $("#resultadoCiudades").html(html);
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	});
	
	
	$("#btnGetAllPais").click(function(){
		$.ajax({
	        url  : 'helpers/PaisAjaxHelper.php',
	        data : { metodo: "getAllPais"},
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {

	        		/* Arma el html de resultado iterando en los items */
	                var html = "<select>";

	        		/* Itera el resultado (igual que en PHP, hay un array que se llama result y una variable para el indice y otra para el valor)
					*  Para usar un objeto json basta con objeto.atributo. Ej: ciudad.descripcion
	        		*/
	        		$.each(result, function(index,pais) {        
					    
					    html += "<option value='" + pais.id + "'>" + pais.descripcion + "</option>";
					});

					html += "</select>";

					/* Aca se renderiza el resultado obtenido */
	                $("#resultadoPaises").html(html);
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	});
	
	$("#btnObtenerRegiones").click(function(){
		$.ajax({
	        url  : 'helpers/RegionAjaxHelper.php',
	        data : { metodo: "getRegionesByIdPais", idPais: 1 },
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {

	        		/* Arma el html de resultado iterando en los items */
	                var html = "<select>";

	        		/* Itera el resultado (igual que en PHP, hay un array que se llama result y una variable para el indice y otra para el valor)
					*  Para usar un objeto json basta con objeto.atributo. Ej: ciudad.descripcion
	        		*/
	        		$.each(result, function(index,region) {        
					    
					    html += "<option value='" + region.id + "'>" + region.descripcion + "</option>";
					});

					html += "</select>";

					/* Aca se renderiza el resultado obtenido */
	                $("#resultadoRegiones").append(html);
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	});
	
	
/****************************************************************************/
	$("#btnTest").click(function(){
		$.ajax({
	        url  : 'helpers/AjaxHelper.php',
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
