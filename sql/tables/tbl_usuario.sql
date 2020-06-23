create table tbl_usuario
(
    id_usuario serial       not null
        constraint tbl_usuario_pk
            primary key,
    nome       varchar(256) not null,
    login      varchar(56),
    senha      varchar(40)  not null,
    email      varchar      not null,
    locale     varchar default 'pt_BR'::character varying,
    nivel      integer default 0
);

alter table tbl_usuario
    owner to zvraimhwsxhxda;

create unique index tbl_usuario_id_usuario_uindex
    on tbl_usuario (id_usuario);

create unique index tbl_usuario_email_uindex
    on tbl_usuario (email);


