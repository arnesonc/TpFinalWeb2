$(document).ready(
	function() {
		$("#divRegion").hide();
		$("#divCiudad").hide();
		cargarComboRegiones();
		// cargarComboCiudades();

		$("#ddlPaises").change(cargarComboRegiones);
		$("#btnAceptar").click(function(event) {
			event.stopPropagation();
			guardarCliente();
		});

		function cargarComboRegiones() {

			var idPais = $("#ddlPaises option:selected").val();

			$.ajax({
				url : '/helpers/RegionAjaxHelper.php',
				data : {
					metodo : "getRegionesByIdPais",
					idPais : idPais
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {

					/* Arma el html de resultado iterando en los items */
					var html = "<select id='ddlRegiones'>";

					/*
					* Itera el resultado (igual que en PHP, hay un array
					* que se llama result y una variable para el indice y
					* otra para el valor) Para usar un objeto json basta
					* con objeto.atributo. Ej: ciudad.descripcion
					*/
					$.each(result, function(index, region) {

						html += "<option value='" + region.id + "'>"
						+ region.descripcion + "</option>";
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

		function cargarComboCiudades() {

			var idRegion = $("#ddlRegiones option:selected").val();

			$.ajax({
				url : '/helpers/CiudadAjaxHelper.php',
				data : {
					metodo : "getCiudadesByIdRegion",
					idRegion : idRegion
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {

					/* Arma el html de resultado iterando en los items */
					var html = "<select id='ddlCiudades'>";

					/*
					* Itera el resultado (igual que en PHP, hay un array
					* que se llama result y una variable para el indice y
					* otra para el valor) Para usar un objeto json basta
					* con objeto.atributo. Ej: ciudad.descripcion
					*/
					$.each(result, function(index, ciudad) {
						html += "<option value='" + ciudad.id + "'>"
						+ ciudad.descripcion + "</option>";
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

		function guardarCliente() {

			var email = $("#txtEmail").val().trim();
			var pass = $("#txtPass").val().trim();
			var nombre = $("#txtNombre").val().trim();
			var apellido = $("#txtApellido").val().trim();
			var id_ciudad = $("#ddlCiudades option:selected").val();
			var calle = $("#txtCalle").val().trim();
			var numero_calle = $("#txtNroCalle").val().trim();
			var codigo_postal = $("#txtCodigoPostal").val().trim();
			var piso = $("#txtPiso").val().trim();
			var departamento = $("#txtDepartamento").val().trim();
			var detalle_direccion = $("#txtDetalleDireccion").val().trim();

			if (clienteValido(email, pass, nombre, apellido, calle,
				numero_calle, codigo_postal, piso, departamento,
				detalle_direccion)) {
					$.ajax({
						url : '/helpers/ClienteAjaxHelper.php',
						data : {
							metodo : "createCliente",
							email : email,
							pass : pass,
							nombre : nombre,
							apellido : apellido,
							id_ciudad : id_ciudad,
							calle : calle,
							numero_calle : numero_calle,
							codigo_postal : codigo_postal,
							piso : piso,
							departamento : departamento,
							detalle_direccion : detalle_direccion
						},
						type : 'POST',
						dataType : "json",
						success : function(result) {
							if (result === true) {
								limpiarFormulario();
								alert("Registracion exitosa.");
							} else {
								alert(result);
							}
						},
						error : function(error) {
							alert("Ups, ocurrio un error! ");
						}
					});
				}
			}

			function limpiarFormulario() {
				$("#txtEmail").val("");
				$("#txtPass").val("");
				$("#txtNombre").val("");
				$("#txtApellido").val("");
				$("#ddlPaises").val(1);
				$("#ddlPaises").change();
				$("#txtCalle").val("");
				$("#txtNroCalle").val("");
				$("#txtCodigoPostal").val("");
				$("#txtPiso").val("");
				$("#txtDepartamento").val("");
				$("#txtDetalleDireccion").val("");
			}

			function clienteValido(email, pass, nombre, apellido, calle,
				numero_calle, codigo_postal, piso, departamento,
				detalle_direccion) {

					if($.trim(email) == "" || $.trim(email).length < 1 || $.trim(email).length > 50){
						alert("El email no es válido. Debe poseer como máximo 50 caracteres.");
						return false;
					}

					if(!isEmail(email)){
						alert("El email ingresado no tiene un formato correcto.");
						return false;
					}

					if($.trim(pass) == "" || $.trim(pass).length < 1 || $.trim(pass).length > 30){
						alert("La contraseña no es válida. Debe poseer como máximo 30 caracteres.");
						return false;
					}

					if($.trim(nombre) == "" || $.trim(nombre).length < 1 || $.trim(nombre).length > 30){
						alert("El nombre no es válido. Debe poseer como máximo 30 caracteres.");
						return false;
					}

					if($.trim(apellido) == "" || $.trim(apellido).length < 1 || $.trim(apellido).length > 30){
						alert("El apellido no es válido. Debe poseer como máximo 30 caracteres.");
						return false;
					}

					if($.trim(calle) == "" || $.trim(calle).length < 1 || $.trim(calle).length > 30){
						alert("La calle no es válida. Debe poseer como máximo 30 caracteres.");
						return false;
					}

					if($.trim(numero_calle) == "" || $.trim(numero_calle).length < 1 || $.trim(numero_calle).length > 30){
						alert("El número de la calle no es válido. Debe poseer como máximo 30 caracteres.");
						return false;
					}

					if($.trim(codigo_postal) == "" || $.trim(codigo_postal).length < 1 || $.trim(codigo_postal).length > 11){
						alert("El código postal no es válido. Debe poseer como máximo 11 caracteres.");
						return false;
					}

					if($.trim(piso) != "" && ($.trim(piso).length < 1 || $.trim(piso).length > 5)){
						alert("1El piso no es válido. Debe poseer como máximo 5 caracteres.");
						return false;
					}

					if($.trim(departamento) != "" && ($.trim(departamento).length < 1 || $.trim(departamento).length > 5)){
						alert("El departamento no es válido. Debe poseer como máximo 5 caracteres.");
						return false;
					}

					if($.trim(detalle_direccion) != "" && ($.trim(detalle_direccion).length < 1 || $.trim(detalle_direccion).length > 5)){
						alert("El detalle de la dirección no es válido. Debe poseer como máximo 150 caracteres.");
						return false;
					}

					return true;
				}

				function isEmail(email) {
					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return regex.test(email);
				}
			});
