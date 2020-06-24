create function inserir_usuario(nome_digitado character varying, login_digitado character varying, senha_digitado character varying, email_digitado character varying, tipo_digitado character varying, nivel_digitado integer, identificador bigint) returns void
    language plpgsql
as
$$
declare last_user int := 0;
BEGIN
insert into tbl_usuario(nome, login, senha, email, nivel)
			values (nome_digitado, login_digitado, senha_digitado, email_digitado, nivel_digitado);

last_user:= (select MAX(tbl_usuario.id_usuario)
from tbl_usuario);

if ( tipo_digitado = 'aluno' )
then
insert into tbl_aluno (id_aluno, id_usuario) values (identificador, last_user);
end if;
if ( tipo_digitado = 'professor' )
then
insert into tbl_professor (id_professor, id_usuario) values (identificador, last_user);
end if;
END;

$$;
