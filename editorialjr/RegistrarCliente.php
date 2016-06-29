<?php

require_once(__DIR__."/service/PaisService.php");

$paisService = new PaisService;

$arrayPaises = $paisService->getAllPais();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registración</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
	<script src="../js/jquery-1.12.4.min.js" type="text/javascript"></script>
	<script src="../js/common.js" type="text/javascript"></script>
	<script src="../js/RegistrarCliente.js" type="text/javascript"></script>
</head>
<body>
	<br>
	<form name="frmFormulario" class="form-horizontal">
		<fieldset>
			<legend> Editorial Jr - Registración</legend>
			<div class="form-group">
				<label class="col-md-4 control-label" for="txtEmail">Email</label>
				<div class="col-md-3">
					<input id="txtEmail" type="text" name="txtEmail" class="form-control input-md" maxlength="50" placeholder="Email" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtPass">Contraseña</label>
				<div class="col-md-3">
					<input id="txtPass" type="password" placeholder="Contraseña" class="form-control input-md" name="txtPass" maxlength="30" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtNombre">Nombre</label>
				<div class="col-md-3">
					<input id="txtNombre" type="text" name="txtNombre" class="form-control input-md" maxlength="30" placeholder="Nombre" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtApellido">Apellido</label>
				<div class="col-md-3">
					<input id="txtApellido" type="text" name="txtApellido" class="form-control input-md" maxlength="30" placeholder="Apellido" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="ddlPais">Pais</label>
				<div id="divContenidoPaises" class="col-md-3">
					<select id="ddlPaises" class="form-control">
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

			<div id="divRegion" class="form-group">
				<label class="col-md-4 control-label" for="ddlRegiones">Región</label>
				<div class="col-md-3">
					<div id="divContenidoRegiones" class="campo">
					</div>
				</div>
			</div>

			<div id="divRegion" class="form-group">
				<label class="col-md-4 control-label" for="ddlCiudades">Ciudad</label>
				<div class="col-md-3">
					<div id="divContenidoCiudades" class="campo">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtCalle">Calle</label>
				<div class="col-md-3">
					<input id="txtCalle" type="text" name="txtCalle" class="form-control input-md" maxlength="30" placeholder="Calle" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtNroCalle">Número</label>
				<div class="col-md-3">
					<input id="txtNroCalle" type="text" name="txtNroCalle" class="form-control input-md" maxlength="30" placeholder="Número de calle" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtCodigoPostal">Código postal</label>
				<div class="col-md-3">
					<input id="txtCodigoPostal" type="text" name="txtCodigoPostal" class="form-control input-md" maxlength="11" placeholder="Código postal" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtCodigoPostal">Piso</label>
				<div class="col-md-3">
					<input id="txtPiso" type="text" name="txtPiso" class="form-control input-md" maxlength="5" placeholder="Piso" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtDepartamento">Departamento</label>
				<div class="col-md-3">
					<input id="txtDepartamento" type="text" name="txtDepartamento" class="form-control input-md" maxlength="5" placeholder="Departamento" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="txtDetalleDireccion">Detalle</label>
				<div class="col-md-3">
					<textarea id="txtDetalleDireccion" rows="3" class="form-control input-md" cols="20" maxlength="150" placeholder="Detalle de la dirección"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="send"></label>
				<div class="col-md-4">
					<div id="divMensajeError" class="col-md-9 alert alert-danger fade in oculto">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="send"></label>
				<div class="col-md-4">
					<input id="btnAceptar" type="button" class="btn btn-primary" name="aceptar" value="Aceptar" />
					<input type="reset" name="cancelar" class="btn btn-default" value="Cancelar" />
				</div>
			</div>
		</fieldset>
	</form>
</body>
</html>
