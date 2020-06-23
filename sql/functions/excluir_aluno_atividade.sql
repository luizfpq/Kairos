create function excluir_aluno_atividade(usuario integer) returns void
    language plpgsql
as
$$
BEGIN
DELETE FROM tbl_atividade as a 
WHERE a.id_aluno = usuario ;


END;

$$;

alter function excluir_aluno_atividade(integer) owner to zvraimhwsxhxda;


