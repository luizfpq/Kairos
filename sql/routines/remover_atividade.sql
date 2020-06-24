create function remover_atividade(usuario bigint, atividade integer) returns void
    language plpgsql
as
$$
declare doc integer := 0;
declare regulamento integer := 0;
declare bag varchar :='';
BEGIN

regulamento:= (select tbl_atividade.id_regulamento
	   from tbl_atividade
	   where
	   tbl_atividade.id_atividade = atividade);

delete from tbl_atividade
where tbl_atividade.id_atividade = atividade;

 bag:= (select update_ch_regulamento(usuario,regulamento));

END;

$$;
