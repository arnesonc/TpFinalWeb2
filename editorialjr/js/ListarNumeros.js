$(document).ready(function(){
	//MASK MONEY JQUERY
			$("#precio").maskMoney({prefix:'AR$ ', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
});

function listarNumeros(id_publicacion) {
			var idPublicacion = id_publicacion;

			$.ajax({
				url : '/helpers/NumeroAjaxHelper.php',
				data : {
					metodo : "getAllNumeros",
					idPublicacion : idPublicacion
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaNumeros(result);
				},
				error : function(error) {
					alert("Ups, ocurrio un error! " + error);
				}
		});
}

function armarTablaNumeros(listaNumeros){
		/*TODO: si se necesita mas de un admin esta logica de negocio debe cambiar*/
		var userAdmin;
		if(JSON.parse(obtenerSessionID()) == "1"){
			userAdmin = true;
		}else{
			userAdmin = false;
		}

	  var tabla = "";
	  $("#bodyNumeros").html("");

	  tabla = "<table id='tblNumeros' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
	  tabla +="<thead><tr><th>Numero</th><th>Precio</th><th>fecha publicado</th>";
	  tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaNumeros, function(index, numero) {
		fecha=(numero.fecha_publicado == null) ? '<strong>DRAFT</strong>' : numero.fecha_publicado;
		tabla += "<tr><td>" + numero.numero_revista + "</td>";
	    tabla += "<td>AR$ " + numero.precio + "</td>";
	    tabla += "<td>" + fecha + "</td>";
		tabla += "<td><button onclick='RedirectArticulos("+ numero.id +","+ numero.id_estado_numero +");' id='btnListarArticulos' name='" + numero.id + "' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> Ver Articulos</button>  ";
		//Si esta en draft, coloca publicar u editar, sino coloca fe de erratas.
			if(numero.id_estado_numero == 1){
				tabla += "<button id='btnEditarNumero' name='"+ numero.id +"' class='btn btn-primary' onclick='editarNumero(this);'><span class='glyphicon glyphicon-edit'></span> Editar</button>  ";
				if(userAdmin == true){
					tabla += "<button onclick='publicar("+ numero.id +");' id='btnPublicar' name='" + numero.id + "' class='btn btn-success'><span class='glyphicon glyphicon-share'></span> Publicar</button> </td></tr> ";
					}
			} else {
				if(numero.fe_erratas == null){
					tabla += "<button onclick='editarFeErratas(this,"+numero.id_publicacion+");' id='btnFeErratas' name='" + numero.id + "' class='btn btn-warning'><span class='glyphicon glyphicon-edit'></span> Nueva Fe de Erratas</button> </td></tr> ";
				} else {
					tabla += "<button onclick='editarFeErratas(this,"+numero.id_publicacion+");' id='btnFeErratas' name='" + numero.id + "' class='btn btn-danger'><span class='glyphicon glyphicon-edit'></span> Cambiar Fe de Erratas</button> </td></tr> ";
				}
			}
		});


	  tabla += "</td></tr></tbody></table>";

	  var tblNumeros = $("#tblNumeros");

	  if(tblNumeros){
		  tblNumeros.dataTable().fnDestroy();
	  }

	  $("#divTablaNumeros").html(tabla);

	  $("#tblNumeros").dataTable({
	      "language": {
	          "url": "../js/datatables.spanish.lang"
	      }
	  });
	}
/*
//escondemos el formulario que solo se activara cuando hagamos click en editar.
$("#formularioDeEdicion").hide();
//Cuando queremos editar un numero, el formulario debe conocer el id del numero contra el cual hacer los cambios
//Pasaremos el id en el mismo formulario, tomandolo desde el parametro de la funcion.
function editarNumeroFormulario(id_numero){
	var id = id_numero;
	$("#formularioDeEdicion").show();
	$("#idNumero").val(id_numero);
}
*/
function editarNumero(button){
	$("#idNumero").val(button.name);
	$("#divMensajeError").hide();
	$("#modalNumero").modal('show');
	$.ajax({
		url : '/helpers/NumeroAjaxHelper.php',
		data : {
			metodo : "getNumeroById",
			idNumero : $("#idNumero").val()
		},
		type : 'POST',
		dataType : "json",
		success : function(result) {
			$("#precio").val(result.precio);
		},
		error : function(error) {
			alert("Ups, ocurrio un error! " + error);
		}});

}

function editarFeErratas(button,idPublicacion){
	var idNumero = button.name;
	//Se coloca el id de publicacion para que tras la edicion de la FeErratas haga un redirect.
	$.redirect('admin-fe-erratas.php', {'idNumero': idNumero, 'idPublicacion': idPublicacion});
}

function publicar(id_numero){
	var idNumero = id_numero;

		$.ajax({
			url : '/helpers/NumeroAjaxHelper.php',
			data : {
				metodo : "cambiarEstadoAPublicado",
				idNumero : idNumero
			},
			type : 'POST',
			dataType : "json",
			success : function(result) {
				alert("Estado publicar: "+result);
				location.reload();
				//TODO: se puede hacer un reload solo de listar numeros, trayendo en el result el id de la publicacion.
			},
			error : function(error) {
				alert("Ups, ocurrio un error! " + error);
			}
	});
}

function RedirectArticulos(idNumero,estadoNumero){
	$.redirect('admin-listar-articulos.php', {'idNumero': idNumero, 'estadoNumero': estadoNumero});
}
