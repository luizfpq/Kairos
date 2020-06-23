create function excluir_aluno(usuario integer) returns void
    language plpgsql
as
$$
BEGIN
DELETE FROM tbl_atividades_por_categoria as a
WHERE a.id_aluno = usuario ;

DELETE FROM tbl_atividade as a
WHERE a.id_aluno = usuario ;

DELETE FROM tbl_aluno as u
WHERE u.id_usuario = usuario ;

DELETE FROM tbl_usuario AS u
    WHERE u.id_usuario = usuario;

END;

$$;

alter function excluir_aluno(integer) owner to zvraimhwsxhxda;
