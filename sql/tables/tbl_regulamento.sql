create table tbl_regulamento
(
    id_regulamento serial  not null
        constraint tbl_regulamento_pk
            primary key,
    tipo           varchar not null,
    carga_hr       integer not null,
    limite_hr      serial  not null
);

alter table tbl_regulamento
    owner to zvraimhwsxhxda;

create unique index tbl_regulamento_id_regulamento_uindex
    on tbl_regulamento (id_regulamento);


