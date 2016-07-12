<?php
include 'client-header.php';
?>

<div class="row">
<div id="wrapper">
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- title -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Numeros</h3>
                    </div>
                </div>
                <div class="row">
                    <div id="divTablaNumeros" class="col-lg-12"></div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /#page-content-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /row -->

<!-- Jquery-->
<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<!-- Js Funciones comunes a los demas js-->
<script src="js/common.js" type="text/javascript"></script>

<!-- Js listar numero-->
<script src="js/ClientListarNumeros.js" type="text/javascript"></script>

<!-- js datatables-->
<script src="js/datatables.min.js" type="text/javascript"></script>

<!-- js maskmoney-->
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

<!-- Negrada -->
<script>listarNumeros(
<?php if (isset($_GET["idpub"])) {
		echo $_GET["idpub"];
	}else{
		echo $_POST['idPublicacion'];
	}
?>
)</script>
<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

</body>

</html>
