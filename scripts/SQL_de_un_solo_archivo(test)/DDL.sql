
-- Base de datos: `editorialjr`
DROP DATABASE `editorialjr`;
CREATE DATABASE `editorialjr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `editorialjr`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_seccion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado_articulo` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `copete` varchar(200) DEFAULT NULL,
  `url_contenido` varchar(4000) DEFAULT NULL,
  `contenido_adicional` varchar(1000) DEFAULT NULL,
  `id_numero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articulo_estado_articulo` (`id_estado_articulo`),
  KEY `fk_articulo_seccion` (`id_seccion`),
  KEY `fk_articulo_usuario` (`id_usuario`),
  KEY `fk_articulo_numero` (`id_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_region` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciudad_region` (`id_region`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27858 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `numero_calle` varchar(30) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `piso` varchar(5) DEFAULT NULL,
  `departamento` varchar(5) DEFAULT NULL,
  `detalle_direccion` varchar(150) DEFAULT NULL,
  `id_estado_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `fk_cliente_estado_cliente` (`id_estado_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_unitaria`
--

CREATE TABLE IF NOT EXISTS `compra_unitaria` (
  `id_cliente` int(11) NOT NULL,
  `id_numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`,`id_numero`),
  KEY `fk_compra_unitaria_numero` (`id_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descargas`
--

CREATE TABLE IF NOT EXISTS `descargas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_numero` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_descargas_numero` (`id_numero`),
  KEY `fk_descargas_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_articulo`
--

CREATE TABLE IF NOT EXISTS `estado_articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cliente`
--

CREATE TABLE IF NOT EXISTS `estado_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_numero`
--

CREATE TABLE IF NOT EXISTS `estado_numero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

CREATE TABLE IF NOT EXISTS `estado_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`,`id_articulo`),
  KEY `fk_imagen_articulo` (`id_articulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lectura_articulos`
--

CREATE TABLE IF NOT EXISTS `lectura_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lectura_articulos_articulo` (`id_articulo`),
  KEY `fk_lectura_articulos_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numero`
--

CREATE TABLE IF NOT EXISTS `numero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacion` int(11) NOT NULL,
  `id_estado_numero` int(11) NOT NULL,
  `url_portada` varchar(100) DEFAULT NULL,
  `fe_erratas` varchar(500) DEFAULT NULL,
  `precio` decimal(15,3) NOT NULL,
  `fecha_publicado` date DEFAULT NULL,
  `numero_revista` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_numero_estado_numero` (`id_estado_numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_utlimo_numero` date DEFAULT NULL,
  `url_ultima_portada` varchar(200) DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`nombre`),
  KEY `fk_publicacion_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kf_region_pais` (`id_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE IF NOT EXISTS `suscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_tipo_suscripcion` int(11) NOT NULL,
  `precio` decimal(15,3) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_suscripcion_tipo_suscripcion` (`id_tipo_suscripcion`),
  KEY `fk_suscripcion_cliente` (`id_cliente`),
  KEY `fk_suscripcion_publicacion` (`id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_suscripcion`
--

CREATE TABLE IF NOT EXISTS `tipo_suscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad_meses` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `fk_usuario_estado_usuario` (`id_estado_usuario`),
  KEY `fk_usuario_rol` (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`id_estado_articulo`) REFERENCES `estado_articulo` (`id`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`),
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_articulo_numero` FOREIGN KEY (`id_numero`) REFERENCES `numero` (`id`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_estado_cliente`) REFERENCES `estado_cliente` (`id`);

--
-- Filtros para la tabla `compra_unitaria`
--
ALTER TABLE `compra_unitaria`
  ADD CONSTRAINT `compra_unitaria_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `compra_unitaria_ibfk_2` FOREIGN KEY (`id_numero`) REFERENCES `numero` (`id`);

--
-- Filtros para la tabla `descargas`
--
ALTER TABLE `descargas`
  ADD CONSTRAINT `descargas_ibfk_1` FOREIGN KEY (`id_numero`) REFERENCES `numero` (`id`),
  ADD CONSTRAINT `descargas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id`);

--
-- Filtros para la tabla `lectura_articulos`
--
ALTER TABLE `lectura_articulos`
  ADD CONSTRAINT `lectura_articulos_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id`),
  ADD CONSTRAINT `lectura_articulos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `numero`
--
ALTER TABLE `numero`
  ADD CONSTRAINT `numero_ibfk_1` FOREIGN KEY (`id_estado_numero`) REFERENCES `estado_numero` (`id`),
  ADD CONSTRAINT `fk_numero_publicacion` FOREIGN key (`id_publicacion`) REFERENCES `publicacion` (`id`);
--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`);

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`id_tipo_suscripcion`) REFERENCES `tipo_suscripcion` (`id`),
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `suscripcion_ibfk_3` FOREIGN KEY (`id_publicacion`) REFERENCES `publicacion` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estado_usuario` (`id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);

  --

