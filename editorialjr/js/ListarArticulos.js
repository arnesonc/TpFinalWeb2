function listarArticulos(id_numero) {
	var id_user = obtenerSessionID();
	window.idNumero = id_numero;

	$.ajax({
				url : '/helpers/ArticuloAjaxHelper.php',
				data : {
					metodo : "getAllArticulosFromNumByUser",
					id_numero : id_numero,
					id_user : id_user,
				},
				type : 'POST',
				dataType : "json",
				success : function(result) {
					armarTablaArticulos(result);
				},
				error : function(error) {
					alert("Upa, ocurrio un error! " + error);
				}
		});
}

function armarTablaArticulos(listaArticulos){

	  var tabla = "";
	  $("#bodyArticulos").html("");

	  tabla = "<table id='tblArticulos' class='table table-striped table-bordered table-responsive' cellspacing='0'>";
	  tabla +="<thead><tr><th>Titulo</th><th>fecha cierre</th>";
	  tabla +="<th>Acciones</th></tr></thead><tbody>";

	  $.each(listaArticulos, function(index, articulo) {
		fecha=(articulo.fecha_publicado == null)?'<strong>DRAFT</strong>':articulo.fecha_publicado;
		tabla += "<tr><td>" + articulo.titulo + "</td>";
	    tabla += "<td>" + fecha + "</td>";

		//aca hay q hacer un if y preguntar si el articulo esta publicado, de estarlo se muestra el boton leer, si no el boton editar.
		if(articulo.id_estado_articulo != 6 && articulo.id_estado_articulo != 4) {
			tabla += "<td><button onclick='aEditarArticulo("+ articulo.id +");' id='btnEditarArticulo' name='" + articulo.id + "' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Editar</button>";
			tabla += "<button onclick='cerrarArticulo("+ articulo.id +");' id='btnCerrarArticulo' name='" + articulo.id + "' class='btn btn-warning'><span class='glyphicon glyphicon-saved'></span> Cerrar articulo</button> </td></tr>";
		}
		else {
			tabla += "<td><button onclick='aLeerArticulo("+ articulo.id +");' id='btnLeerArticulo' name='" + articulo.id + "' class='btn btn-info'><span class='glyphicon glyphicon-eye-open'></span> Leer Articulo</button> </td></tr> ";
		}

		});


	  tabla += "</td></tr></tbody></table>";

	  var tblArticulos = $("#tblArticulos");

	  if(tblArticulos){
		  tblArticulos.dataTable().fnDestroy();
	  }

	  $("#divTablaArticulos").html(tabla);

	  $("#tblArticulos").dataTable({
	      "language": {
	          "url": "../js/datatables.spanish.lang"
	      }
	  });
	}

	function cerrarArticulo(idArticulo) {
		$.ajax({
					url : '/helpers/ArticuloAjaxHelper.php',
					data : {
						metodo : "cerrarArticulo",
						idArticulo : idArticulo,
					},
					type : 'POST',
					dataType : "json",
					success : function(result) {
						alert("Articulo cerrado satisfactoriamente.");
						listarArticulos(result);
					},
					error : function(error) {
						alert("Upa, ocurrio un error! " + error);
					}
			});
	}


function aLeerArticulo(idArticulo){
	$.redirect('admin-leer-articulos.php', {'idNumero': idArticulo});
}

function aEditarArticulo(idArticulo){
	$.redirect('admin-editar-articulos.php', {'idArticulo': idArticulo});
}

$("#btnNuevoArticulo").click(function(){
	var idUser = obtenerSessionID();

	nuevoArticulo(window.idNumero,'false',idUser);
});

function nuevoArticulo(id_numero,id_articulo,id_user){
	$.redirect('admin-editar-articulo.php', {'idNumero': id_numero, 'idArticulo': id_articulo, 'idUser': id_user});
}
