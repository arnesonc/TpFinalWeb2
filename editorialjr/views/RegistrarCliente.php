<?php 

require_once(__DIR__."/../service/PaisService.php");

$paisService = new PaisService;

$arrayPaises = $paisService->getAllPais();

?>

<!DOCTYPE html>
<html>
<head>
<title>Registrar cliente</title>
	<link rel="stylesheet" type="text/css" href="../css/editorialjr.css" />
	<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="../js/RegistrarCliente.js" type="text/javascript"></script>
</head>
<body>
	<br>
	<div class="contenido">
		<form name="frmFormulario">
			<div class="fila">
				<div class="label">
					<label for="txtEmail">Email:</label>
				</div>
				<div class="campo">
					<input id="txtEmail" type="text" name="txtEmail" maxlength="50" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtPass">Contraseña:</label>
				</div>
				<div class="campo">
					<input id="txtPass" type="password" name="txtPass" maxlength="30" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtNombre">Nombre:</label>
				</div>
				<div class="campo">
					<input id="txtNombre" type="text" name="txtNombre" maxlength="30" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtApellido">Apellido:</label>
				</div>
				<div class="campo">
					<input id="txtApellido" type="text" name="txtApellido" maxlength="30" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label>Pais:</label>
				</div>
				<div id="divContenidoPaises" class="campo">
					<select id="ddlPaises">
					<?php 
						foreach ($arrayPaises as $key=>$pais) {
					?>
						<option  value="<?php echo $pais->id;  ?>"><?php echo $pais->descripcion; ?></option>
					<?php	
						}
					?>
					</select>	
				</div>
			</div>
			<div id="divRegion" class="fila">
				<div class="label">
					<label>Region:</label>
				</div>
				<div id="divContenidoRegiones" class="campo">
				</div>
			</div>
			<div id="divCiudad" class="fila">
				<div class="label">
					<label>Ciudad:</label>
				</div>
				<div id="divContenidoCiudades" class="campo">
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtCalle">Calle:</label>
				</div>
				<div class="campo">
					<input id="txtCalle" type="text" name="txtCalle" maxlength="30" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtNroCalle">Número de calle:</label>
				</div>
				<div class="campo">
					<input id="txtNroCalle" type="text" name="txtNroCalle" maxlength="30" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtCodigoPostal">Codigo postal:</label>
				</div>
				<div class="campo">
					<input id="txtCodigoPostal" type="text" name="txtCodigoPostal" maxlength="11" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtPiso">Piso:</label>
				</div>
				<div class="campo">
					<input id="txtPiso" type="text" name="txtPiso" maxlength="5" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtDepartamento">Departamento:</label>
				</div>
				<div class="campo">
					<input id="txtDepartamento" type="text" name="txtDepartamento" maxlength="5" />
				</div>
			</div>
			<div class="fila">
				<div class="label">
					<label for="txtDetalleDireccion">Detalle:</label>
				</div>
				<div class="campo">
					<textarea id="txtDetalleDireccion" rows="3" cols="20" maxlength="150"></textarea>
				</div>
			</div>
			<div class="fila" align="center">
				<div class="botones">
					<input id="btnAceptar" type="button" name="aceptar" value="Aceptar" />
					<input type="reset" name="cancelar" value="Cancelar" />
				</div>	
			</div>
		</form>
	</div>
</body>
</html>