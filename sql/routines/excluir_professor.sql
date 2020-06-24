create function excluir_professor(usuario bigint) returns void
    language plpgsql
as
$$
BEGIN

DELETE FROM tbl_professor as u
WHERE u.id_usuario = usuario ;

Delete from tbl_usuario as u
    where u.id_usuario = usuario;

END;

$$;
