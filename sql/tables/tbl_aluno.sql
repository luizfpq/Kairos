create table tbl_aluno
(
	id_aluno bigint not null
		constraint tbl_aluno_pk
			primary key,
	situacao varchar default 'pendente'::character varying,
	id_usuario integer
		constraint fk_del_aluno
			references tbl_usuario
				on delete cascade
		constraint tbl_aluno_tbl_usuario_id_usuario_fk
			references tbl_usuario
);

comment on column tbl_aluno.id_aluno is 'id_aluno - RGA';


create unique index tbl_aluno_id_aluno_uindex
	on tbl_aluno (id_aluno);
