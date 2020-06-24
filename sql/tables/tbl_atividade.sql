create table tbl_atividade
(
	descricao varchar not null,
	carga_hr_total integer not null,
	car_hr_aproveitada integer default 0,
	status varchar default 'pendente'::character varying,
	documento varchar,
	id_regulamento integer not null
		constraint tbl_atividade_tbl_regulamento_id_regulamento_fk
			references tbl_regulamento,
	id_atividade serial not null
		constraint tbl_atividade_pkey
			primary key,
	id_aluno bigint
);

comment on column tbl_atividade.status is 'verificado ou não pelo professor';
