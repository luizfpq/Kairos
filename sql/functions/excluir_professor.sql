create or replace function excluir_professor(usuario integer) returns void
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



alter function excluir_professor(integer) owner to zvraimhwsxhxda;


