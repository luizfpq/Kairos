create table tbl_atividades_por_categoria
(
	id_atv_cat serial not null
		constraint tbl_atividades_por_categoria_pkey
			primary key,
	id_aluno bigint
		constraint fk_atv_aluno_cat
			references tbl_aluno,
	id_regulamento integer
		constraint tbl_atividades_por_categoria_tbl_regulamento_id_regulamento_fk
			references tbl_regulamento,
	ch_total numeric(5,2)
);
