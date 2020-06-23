create function inserir_atividadec(desc_digitado character varying, carga integer, usuario integer, reg integer, carga_hr_digitada integer, data1 date, data2 date) returns void
    language plpgsql
as
$$
declare bag varchar := '';
declare atividade int := 0;
declare intervalo int := 0;
declare resultado int := 0;
BEGIN

    if (reg = 5)
    then
        intervalo := (date_part('day',data1,data2));
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    else
        intervalo := (date_part('year',data1,data2));
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    end if;

    insert into tbl_atividade(descricao,carga_hr_total, id_regulamento, id_aluno)
            values (desc_digitado, resultado, reg, id_aluno);

    bag := (update_ch_regulamento(usuario, reg));

END;

$$;

alter function inserir_atividadec(varchar, integer, integer, integer, integer, date, date) owner to zvraimhwsxhxda;

