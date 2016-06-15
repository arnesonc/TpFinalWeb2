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


				// validar email
				if ( (isset(email)) && (email != NULL) ){
					var sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
					if(preg_match(sintaxis,email)){
						// msj "El email es válido";
						return true;					
						} 
						else {
						// msj "El email no es válido";
						return false;					
						}
					} 
				else {
					// msj "No completo su email";
					return false;
				}


				// validar pass
				if ( (isset(pass)) && (pass != NULL) ){
					if (strlen(pass)>30) {
						// msj "El pass tiene mas de 30 caracteres";
						return false;
						}
						else {
						// msj "El pass tiene menos de 30 caracteres";
						return true;
						}
					} 
					else {
					// msj "No completo su apellido";
					return false;
					}


				// validar nombre
				if ( (isset(nombre)) && (nombre != NULL) ){
					if (strlen(nombre)>30) {
						// msj "El nombre tiene mas de 30 caracteres";
						return false;
						}
						else {
						// msj "El nombre tiene menos de 30 caracteres";

						if (ctype_alpha(nombre)) {
				       		// msj "El nombre contiene solo letras.";
				       		return true;
				   		}
				   		else {
							// msj "El nombre debe contener solo letras";
							return false;
				   			}
						}
					} 
					else {
					// msj "No completo su nombre";
					return false;
					}


				// validar apellido
				if ( (isset(apellido)) && (apellido != NULL) ){
					if (strlen(apellido)>30) {
						// msj "El apellido tiene mas de 30 caracteres";
						return false;
						} else {
						// msj "El apellido tiene menos de 30 caracteres";
						if (ctype_alpha(apellido)) {
				       		// msj "El apellido contiene solo letras.";
				       		return true;
				   		} else {
							// msj "El apellido debe contener solo letras";
							return false;
				   			}
						}
					} else {
					// msj "No completo su apellido";
					return false;
					}


				// validar calle
				if ( (isset(calle)) && (calle != NULL) ){
					if (strlen(calle)>30) {
						// msj "El calle tiene mas de 30 caracteres";
						return false;
						} else {
						// msj "El calle tiene menos de 30 caracteres";
						return true;
						}
					} else {
					// msj "No completo su calle";
					return false;
					}


				// validar numero_calle
				if ( (isset(numero_calle)) && (numero_calle != NULL) ){
					if (strlen(numero_calle)>30) {
						// msj "El numero_calle tiene mas de 30 caracteres";
						return false;
						} else {
						// sj "El numero_calle tiene menos de 30 caracteres";
						return true;
						}
					} else {
					// msj "No completo su numero_calle";
					return false;
					}


				// validar codigo_postal
				if( isNaN(codigo_postal) ){
					// msj "solo numeros";
					return false;
				}
				if( !codigo_postal ){
					// msj "requerido";
					return false;
				}
				if( !isNaN(codigo_postal) ){
					// msj "ok";
					return true;
				}


				/*
				DUDA: 
				como hacemos para el caso de que no sen obligatorios?
				los siguientes 3 campos no lo son
				*/
				
				/*
				if (strlen(piso)>5) {
					var msj = "El piso diferente de 30 caracteres";
					return false;
					} else {
					var msj = "El piso tiene 30 caracteres";
					return true;
				}
				*/


				/*
				if (strlen(departamento)>5) {
					var msj = "El departamento tiene mas de 5 caracteres";
					return false;
					} else {
					var msj = "El departamento tiene menos de 5 caracteres";
					return true;
				}
				*/


				/*
				if (strlen(detalle_direccion)>150) {
					var msj = "El detalle_direccion tiene mas de 150 caracteres";
					return false;
					} else {
					var msj = "El detalle_direccion tiene menos de 150 caracteres";
					return true;
				}
				*/	



				return true;
			}
		});