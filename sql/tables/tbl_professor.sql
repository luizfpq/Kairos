create table tbl_professor
(
	id_professor bigint not null
		constraint tbl_professor_pk
			primary key,
	id_usuario integer not null
		constraint fk_del_prof
			references tbl_usuario
				on delete cascade
		constraint tbl_professor_tbl_usuario_id_usuario_fk
			references tbl_usuario
);

comment on column tbl_professor.id_professor is 'id eh o siape, RGB';


create unique index tbl_professor_id_professor_uindex
	on tbl_professor (id_professor);
