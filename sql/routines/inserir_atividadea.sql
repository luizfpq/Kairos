create function inserir_atividadea(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying) returns void
    language plpgsql
as
$$
declare bag varchar := '';
declare atividade bigint := 0;
BEGIN
insert into tbl_atividade(descricao,
						  carga_hr_total,
						  id_regulamento,
						  id_aluno, documento)  values
						  (desc_digitado,carga, reg, usuario, documento_url);
atividade:= (select max(tbl_atividade.id_aluno)
			from tbl_atividade);

if exists (select tbl_atividades_por_categoria.id_aluno
		   from tbl_atividades_por_categoria
		  where tbl_atividades_por_categoria.id_regulamento = reg AND
		  tbl_atividades_por_categoria.id_aluno = usuario)
then
bag := (select update_ch(usuario, reg));
else
insert into tbl_atividades_por_categoria(id_aluno,id_regulamento,ch_total)
values (usuario,reg,0);
end if;
bag := (select update_ch(usuario, reg));
END;

$$;
