drop database if exists editorialjr;
create database editorialjr;

use editorialjr;

create table estado_cliente(
id int primary key auto_increment not null,
descripcion varchar(50) not null
);

create table cliente(
id int primary key auto_increment not null,
email varchar(50) not null,
pass varchar(30) not null,
nombre varchar(30) not null,
apellido varchar(30) not null,
id_ciudad int not null,
calle varchar(30) not null,
numero_calle varchar(30) not null,
codigo_postal int not null,
piso varchar(5) null,
departamento varchar(5) null,
detalle_direccion varchar(150) null,
id_estado_cliente int not null,
foreign key fk_cliente_estado_cliente (id_estado_cliente) references estado_cliente(id)
);

create table pais(
id int primary key auto_increment not null,
descripcion varchar(50) not null
);

create table region(
id int primary key auto_increment not null,
id_pais int not null,
descripcion varchar(50) not null,
foreign key kf_region_pais (id_pais) references pais(id)
);

create table ciudad(
id int primary key auto_increment not null,
id_region int not null,
descripcion varchar(50) not null,
foreign key fk_ciudad_region (id_region) references region(id)
);

create table estado_numero(
id int primary key auto_increment not null,
descripcion varchar(50) not null
);

create table numero(
id int primary key auto_increment not null,
id_publicacion int not null,
id_estado_numero int not null,
url_portada varchar(100) null,
fe_erratas varchar(500) null,
precio decimal(15,3) not null,
fecha_publicado date null,
foreign key fk_numero_estado_numero (id_estado_numero) references estado_numero(id)
);

create table compra_unitaria(
id_cliente int not null,
id_numero int not null,
fecha date not null,
constraint pk_compra_unitaria primary key(id_cliente,id_numero),
foreign key fk_compra_unitaria_cliente (id_cliente) references cliente(id),
foreign key fk_compra_unitaria_numero (id_numero) references numero(id)
);

create table seccion(
id int primary key auto_increment not null,
id_numero int not null,
nombre varchar(50) not null,
foreign key fk_seccion_numero (id_numero) references numero(id)
);

create table estado_articulo(
id int primary key auto_increment not null,
descripcion varchar(50) not null
);

create table estado_usuario(
id int primary key auto_increment not null,
descripcion varchar(50) not null 
);

create table rol(
id int primary key auto_increment not null,
descripcion varchar(50) not null
);

create table usuario(
id int primary key auto_increment not null,
id_estado_usuario int null,
id_rol int not null,
email varchar(50) not null,
pass varchar(50) not null,
nombre varchar(50) not null,
apellido varchar(50) not null,
foreign key fk_usuario_estado_usuario (id_estado_usuario) references estado_usuario(id),
foreign key fk_usuario_rol (id_rol) references rol(id)
);

create table articulo(
id int primary key auto_increment not null,
id_seccion int not null,
id_usuario int not null,
id_estado_articulo int not null,
titulo varchar(100),
latitud varchar(100),
longitud varchar(100),
fecha_cierre date null,
copete varchar(200) null,
url_contenido varchar(100) null,
contenido_adicional varchar(1000) null,
foreign key fk_articulo_estado_articulo (id_estado_articulo) references estado_articulo(id),
foreign key fk_articulo_seccion (id_seccion) references seccion(id),
foreign key fk_articulo_usuario (id_usuario) references usuario(id)
);

create table imagen(
id int auto_increment not null,
id_articulo int not null,
url varchar(200) not null,
constraint pk_imagen primary key(id, id_articulo),
foreign key fk_imagen_articulo (id_articulo) references articulo(id)
);

create table lectura_articulos(
id int primary key auto_increment not null,
id_articulo int not null,
id_cliente int not null,
foreign key fk_lectura_articulos_articulo (id_articulo) references articulo(id),
foreign key fk_lectura_articulos_cliente (id_cliente) references cliente(id)
);

create table descargas(
id int primary key auto_increment not null,
id_numero int not null,
id_cliente int not null,
fecha date not null,
foreign key fk_descargas_numero (id_numero) references numero(id),
foreign key fk_descargas_cliente (id_cliente) references cliente(id)
);

create table publicacion(
id int primary key auto_increment not null,
id_usuario int not null,
nombre varchar(50) not null,
fecha_utlimo_numero date null,
url_ultima_portada varchar(200) null,
destacado bool not null,
foreign key fk_publicacion_usuario (id_usuario) references usuario(id)
);

create table tipo_suscripcion(
id int primary key auto_increment not null,
cantidad_meses int not null
);

create table suscripcion(
id int primary key auto_increment not null,
id_cliente int not null,
id_publicacion int not null,
id_tipo_suscripcion int not null,
precio decimal(15,3) not null,
fecha date not null,
foreign key fk_suscripcion_tipo_suscripcion (id_tipo_suscripcion) references tipo_suscripcion(id),
foreign key fk_suscripcion_cliente (id_cliente) references cliente(id),
foreign key fk_suscripcion_publicacion (id_publicacion) references publicacion(id)
);


-- Datos parametricos

insert into estado_cliente(id,descripcion)values
(null, 'activo'),
(null, 'inactivo');


insert into estado_articulo(id, descripcion)values
(null, 'borrador'),
(null, 'en uso'),
(null, 'revision'),
(null, 'aprobado'),
(null, 'rechazado'),
(null, 'publicado');

insert into estado_usuario(id, descripcion)values
(null, 'activo'),
(null, 'inactivo');

insert into rol(id, descripcion)values
(null, 'administrador'),
(null, 'redactor');

insert into pais(id,descripcion)values
(null, 'Argentina');

insert into region(id,id_pais,descripcion)values
(null, 1, 'Capital federal'),
(null, 1, 'Buenos aires'),
(null, 1, 'Cordoba');

insert into ciudad(id, id_region, descripcion)values
(null, 1, 'Capital federal'),
(null, 2, 'San justo'),
(null, 2, 'Villa luzuriaga');

-- Creacion del usuario

DROP USER usuarioeditorial@localhost;

CREATE USER 'usuarioeditorial'@'localhost' IDENTIFIED BY 'usuarioeditorial';

GRANT ALL ON editorialjr.* TO 'usuarioeditorial'@'localhost';

-- Creacion de usuario admin

INSERT INTO usuario (`id_estado_usuario`, `id_rol`, `email`, `pass`, `nombre`, `apellido`) VALUES ('1', '1', 'admin@editorialjr.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Admin');

