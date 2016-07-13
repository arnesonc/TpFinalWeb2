<?php
include 'client-header.php';
?>


<!-- header articulo -->
<header class="intro-header" style="background-image: url('https://d13yacurqjgara.cloudfront.net/users/58050/screenshots/2412291/boba-starwars.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Clean Blog</h1>

                    <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- fin header articulo -->

<!-- CONTENIDO -->
<div class="container">
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div class="detalles">
                <p>Escrito por <span id="autor">PEPE</span> | <span id="fecha">12/03/2016</span><p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div id="contenido">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-10">
            <div id="map"></div>
        </div>
    </div>
</div>

<!-- FIN DE CONTENIDO -->

<!-- Footer -->
<footer class="footer-distributed">

    <div class="footer-right">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="https://github.com/germg/TpFinalWeb2"><i class="fa fa-github"></i></a>

    </div>

    <div class="footer-left">

        <p class="footer-links">
            <a href="/index.php">Home</a>
            ·
            <a href="#">About</a>
            ·
            <a href="/admin-login.php">Administrar</a>
        </p>

        <p>EditorialJR &copy; 2016</p>
    </div>

</footer>



<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<!-- Paginacion -->
<script src="js/jquery.bootpag.min.js"></script>

<!-- JS especifico -->
<script src="js/common.js"></script>

<!-- JS especifico -->
<script src="js/index.js"></script>

<!-- jquery redirect-->
<script src="js/jquery.redirect.js" type="text/javascript"></script>

<!-- leer articulo.js-->
<script src="js/LeerArticulo.js"></script>

<!-- obtener variables post-->
<script>
    leerArticulo(14);
</script>

<script type="text/javascript">
    var map;
    function initMap() {

        var myLatlng = {lat: -34.6695067, lng: -58.561731};
        window.lat = myLatlng.lat;
        window.lng = myLatlng.lng;

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatlng
        });

        marcador = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Lugar de los hechos'
        });
    }
</script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8qdt_ZyQL7Ea1dirrshhtQycf1UYGAQQ&callback=initMap" async defer>
</script>

</body>

</html>

