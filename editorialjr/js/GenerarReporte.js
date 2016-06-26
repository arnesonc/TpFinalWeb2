$(document).ready(function(){

  $("#btnReporteContenidistas").click(function(){

    generarReporteContenidistas();
  });

});

function generarReporteContenidistas(){

  $.ajax({
      url : '/helpers/ReporteAjaxHelper.php',
      data : {
        metodo : "generarReporteContenidistas",
      },
      type : 'POST',
      dataType : "json",
      success : function(result) {
        console.log("success");
        $.redirect('/helpers/GetPDF.php', {'contentPDF': result, 'namePDF': 'contenidistas'});
      },
      error : function(error) {
        console.log("error");
      }
  });
}
