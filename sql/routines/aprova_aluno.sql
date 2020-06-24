create function aprova_aluno(aluno bigint) returns void
    language plpgsql
as
$$
declare contador integer := 0;
declare pendencia integer := 0;
declare hr integer := 0;

	BEGIN
	contador := (select count(distinct tbl_atividade.id_regulamento)
				from tbl_atividade
				where tbl_atividade.id_aluno = aluno and
				tbl_atividade.status = 'aprovada');

	pendencia:=  (select count(tbl_atividade.id_regulamento)
				from tbl_atividade
				where tbl_atividade.id_aluno = aluno and
				tbl_atividade.status = 'pendente');

	hr:= (select SUM(tbl_atividade.car_hr_aproveitada )
				from tbl_atividade
				where tbl_atividade.id_aluno = aluno and
				tbl_atividade.status = 'aprovada');


	if pendencia = 0 and contador < 3
	then
	update tbl_aluno
	set situacao = 'reprovado' where tbl_aluno.id_aluno = aluno;
	end if;


	if contador >= 3 and hr >= 102
	then
	update tbl_aluno
	set situacao = 'aprovado' where tbl_aluno.id_aluno = aluno;
	end if;


	END;
$$;
