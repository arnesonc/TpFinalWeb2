
use editorialjr;

/* completo los tipos de suscripcion */
INSERT INTO tipo_suscripcion (id,cantidad_meses)
VALUES 
(null,'1'),
(null,'3'),
(null,'6'),
(null,'12');

/* borro y vuelvo a crear la tabla seccion / completo secciones base */
SET foreign_key_checks = 0;
DROP TABLE seccion;
SET foreign_key_checks = 1;

create table seccion(
id int primary key auto_increment not null,
nombre varchar(50) not null
);

INSERT INTO seccion (id,nombre)
VALUES 
(null, 'Información general'),
(null, 'Carta de lectores'),
(null, 'Celebridades'),
(null, 'Ciencia'),
(null, 'Cultura'),
(null, 'Deporte'),
(null, 'Economía'),
(null, 'Editorial'),
(null, 'Educación'),
(null, 'Empresa'),
(null, 'Especiales'),
(null, 'Espectáculo'),
(null, 'Internacionales'),
(null, 'Moda'),
(null, 'Música'),
(null, 'Opinión'),
(null, 'Policiales'),
(null, 'Política'),
(null, 'Religión'),
(null, 'Reportajes'),
(null, 'Rural'),
(null, 'Salud'),
(null, 'Servicios'),
(null, 'Sociedad'),
(null, 'Tecnología'),
(null, 'Televisión'),
(null, 'Turismo');
