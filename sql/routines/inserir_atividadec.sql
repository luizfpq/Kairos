create function inserir_atividadec(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying, intervalo integer) returns void
    language plpgsql
as
$$
declare bag varchar := '';
declare resultado int := 0;

BEGIN

    if (reg = 5)
    then
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    else
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    end if;

    insert into tbl_atividade(descricao,carga_hr_total, id_regulamento, id_aluno, documento)
            values (desc_digitado, resultado, reg, usuario, documento_url);


if exists (select tbl_atividades_por_categoria.id_aluno
		   from tbl_atividades_por_categoria
		  where tbl_atividades_por_categoria.id_regulamento = reg AND
		  tbl_atividades_por_categoria.id_aluno = usuario)
then
bag := (select update_ch(usuario, reg));
else
insert into tbl_atividades_por_categoria(id_aluno,id_regulamento,ch_total) values (usuario,reg,resultado);
bag := (select update_ch(usuario, reg));
end if;


END;

$$;
