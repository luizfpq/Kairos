create function excluir_aluno(usuario bigint) returns void
    language plpgsql
as
$$
declare id bigint := 0;

BEGIN
id := (select id_aluno from tbl_aluno where id_usuario = usuario);

DELETE FROM tbl_atividades_por_categoria as a
WHERE a.id_aluno = id ;

DELETE FROM tbl_atividade as a
WHERE a.id_aluno = id ;

DELETE FROM tbl_aluno as u
WHERE u.id_usuario = usuario ;

DELETE FROM tbl_usuario AS u
    WHERE u.id_usuario = usuario;

END;

$$;
