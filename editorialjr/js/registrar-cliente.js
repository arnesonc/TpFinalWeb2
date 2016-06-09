$(document).ready(function (){  
	$("#divRegion").hide();
	$("#divCiudad").hide();
	cargarComboRegiones();
	//cargarComboCiudades();
	
	$("#ddlPaises").change(cargarComboRegiones);
	$("#btnAceptar").onclick(guardarCliente);
	
	function cargarComboRegiones(){
		
		var idPais = $("#ddlPaises option:selected").val();
		
		$.ajax({
	        url  : '/helpers/RegionAjaxHelper.php',
	        data : { metodo: "getRegionesByIdPais", idPais: idPais},
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {

	        		/* Arma el html de resultado iterando en los items */
	                var html = "<select id='ddlRegiones'>";

	        		/* Itera el resultado (igual que en PHP, hay un array que se llama result y una variable para el indice y otra para el valor)
					*  Para usar un objeto json basta con objeto.atributo. Ej: ciudad.descripcion
	        		*/
	        		$.each(result, function(index,region) {        
					    
					    html += "<option value='" + region.id + "'>" + region.descripcion + "</option>";
					});

					html += "</select>";

					/* Aca se renderiza el resultado obtenido */
	                $("#divContenidoRegiones").html(html);
	                $("#divRegion").show();
	                $("#ddlRegiones").change(cargarComboCiudades);
	                cargarComboCiudades();
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
		
	}	
	
function cargarComboCiudades(){
		
		var idRegion = $("#ddlRegiones option:selected").val();
		
		$.ajax({
	        url  : '/helpers/CiudadAjaxHelper.php',
	        data : { metodo: "getCiudadesByIdRegion", idRegion: idRegion},
	        type : 'POST',
	        dataType : "json",
	        success : function(result) {
	        		
	        		/* Arma el html de resultado iterando en los items */
	                var html = "<select id='ddlCiudades'>";

	        		/* Itera el resultado (igual que en PHP, hay un array que se llama result y una variable para el indice y otra para el valor)
					*  Para usar un objeto json basta con objeto.atributo. Ej: ciudad.descripcion
	        		*/
	        		$.each(result, function(index,ciudad) {        
					    html += "<option value='" + ciudad.id + "'>" + ciudad.descripcion + "</option>";
					});

					html += "</select>";

					/* Aca se renderiza el resultado obtenido */
	                $("#divContenidoCiudades").html(html);
	                $("#divCiudad").show();
	            },
	        error : function(error) {
	        	alert("Ups, ocurrio un error! " + error);
	        } 
		});
	}	

	function guardarCliente(){
		
		var email = $("#txtEmail").val();
		var pass = $("#txtPass").val();
		var nombre = $("#txtNombre").val();
		var apellido = $("#Apellido").val();
		var idPais = $("#ddlPaises option:selected").val();
		var idRegion = $("#ddlRegiones option:selected").val();
		var idCiudad = $("#ddlCiudades option:selected").val();
		var calle = $("#txtCalle").val();
		var nroCalle = $("#txtNroCalle").val();
		var codigoPostal = $("#txtCodigoPostal").val();
		var piso = $("#txtPiso").val();
		var departamento = $("#txtDepartamento").val();
		var detalle = $("#txtDetalle").val();
		
		if(clienteValido(email, pass, nombre, apellido, calle, nroCalle, codigoPostal)){
			$.ajax({
		        url  : '/helpers/ClienteAjaxHelper.php',
		        data : { metodo: "getRegionesByIdPais", idPais: idPais},
		        type : 'POST',
		        dataType : "json",
		        success : function(result) {

		        	
		            },
		        error : function(error) {
		        	alert("Ups, ocurrio un error! " + error);
		        } 
			});
		}
	}
	
	function clienteValido(email, pass, nombre, apellido, calle, nroCalle, codigoPostal){
		return true;
	}
});