use editorialjr;

-- Agrego la columna id_numero
ALTER TABLE articulo 
ADD COLUMN id_numero int not null;

-- Agrego la FK entre articulo y numero
alter table articulo
add constraint fk_articulo_numero 
foreign key (id_numero) 
references numero(id); 
