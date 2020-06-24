create view vw_atividade(descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, tipo, id_atividade, id_aluno, id_usuario, nome, login, senha, email, locale, nivel, situacao) as
SELECT atv.descricao,
       atv.carga_hr_total,
       atv.car_hr_aproveitada,
       atv.status,
       atv.documento,
       atv.id_regulamento,
       reg.tipo,
       atv.id_atividade,
       aluno.id_aluno,
       aluno.id_usuario,
       aluno.nome,
       aluno.login,
       aluno.senha,
       aluno.email,
       aluno.locale,
       aluno.nivel,
       aluno.situacao
FROM tbl_atividade atv,
     vw_aluno aluno,
     tbl_regulamento reg
WHERE atv.id_aluno = aluno.id_aluno
  AND reg.id_regulamento = atv.id_regulamento;

comment on column vw_atividade.status is 'verificado ou não pelo professor';
