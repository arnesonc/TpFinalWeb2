use editorialjr;

-- Elimino datos inconsistentes
delete from numero
where
    id in (select
        id
    from
        (select
            n.id
        from
            numero n
        left join publicacion p ON n.id_publicacion = p.id

        where
            p.id is null) ids);

-- Agrego la ForeignKey
alter table numero
add constraint fk_numero_publicacion
foreign key (id_publicacion)
references publicacion(id);
