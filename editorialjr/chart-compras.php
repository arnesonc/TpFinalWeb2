<?php
	include 'header.php';
	include 'side-bar.php';
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      // Set a callback to run when the Google Visualization API is loaded.


      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.



      function drawChart() {


        $.ajax({
            url: '/helpers/ChartHelper.php',
            data: {
                metodo: "getAllComprasUnitariasPorPeriodo",
                dateStart : '2016-07-11' ,
                dateEnd : '2016-07-13' ,
            },
            type: 'POST',
            dataType: "json",
            async: false,
            success: function (result) {

              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'nombre');
              data.addColumn('number', 'cantidad');

              $.each(result, function (index, resultado) {
                data.addRow([resultado.nombre, Number(resultado.cantidad)]);
              });

              // Set chart options
              var options = {'title':'Productos vendidos',
                             'width':1200,
                             'height':800};

              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
              chart.draw(data, options);

            },
            error: function (error) {
              console.log("error");
              //mostrarMensaje("divError", "Ups, ocurrio un error!", true);
            }
        });


      }
    </script>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <!-- title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Listado de numeros vendidos por publicación</h3>
            </div>
        </div>
        <div id="chart_div"></div>
      </div>
    </div>
    <!--Div that will hold the pie chart-->
  </body>
</html>
