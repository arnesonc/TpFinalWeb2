insert into estado_numero(id, descripcion)values
(null, 'borrador'),
(null, 'publicado');


alter table articulo
modify column titulo varchar(100) not null;