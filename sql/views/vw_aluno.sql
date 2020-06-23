create view vw_aluno (id_usuario, nome, login, senha, email, locale, nivel, id_aluno, situacao) as
SELECT usu.id_usuario,
       usu.nome,
       usu.login,
       usu.senha,
       usu.email,
       usu.locale,
       usu.nivel,
       aluno.id_aluno,
       aluno.situacao
FROM tbl_usuario usu,
     tbl_aluno aluno
WHERE usu.id_usuario = aluno.id_usuario;

alter table vw_aluno
    owner to zvraimhwsxhxda;
