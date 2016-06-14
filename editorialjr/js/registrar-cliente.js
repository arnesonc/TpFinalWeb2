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
				// IMPORTANTE: SE DEBEN COLOCAR LAS RUTAS ABSOLUTAS.
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
							alert("Ups, ocurrio un error! " + error);
						}
					});
				}
			}

			function limpiarFormulario() {
				// TODO: implementar
			}

			function clienteValido(email, pass, nombre, apellido, calle,
					numero_calle, codigo_postal, piso, departamento,
					detalle_direccion) {
				// TODO: implementar validaciones

				return true;
			}
		});