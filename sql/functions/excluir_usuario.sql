create function excluir_usuario(id_usuario_digitado integer) returns void
    language plpgsql
as
$$
declare bag varchar := '';
BEGIN
if exists( select * from tbl_aluno where id_usuario = id_usuario_digitado)
then
bag := (select excluir_aluno(id_usuario_digitado));
end if;
if exists( select * from tbl_professor where id_usuario = id_usuario_digitado)
then
bag := (select excluir_professor(id_usuario_digitado));
end if;

END;

$$;

alter function excluir_usuario(integer) owner to zvraimhwsxhxda;

