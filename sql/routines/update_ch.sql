create function update_ch(usuario bigint, reg integer) returns void
    language plpgsql
as
$$
DECLARE cg_hr_select INTEGER := 0;
DECLARE ch_fixa INTEGER := 0;
DECLARE bag varchar := '';

BEGIN
cg_hr_select := (select SUM(atv.carga_hr_total)
from tbl_atividade as atv
where atv.id_aluno = usuario AND
atv.id_regulamento = reg);

ch_fixa := (select tbl_regulamento.carga_hr)
from tbl_regulamento
where tbl_regulamento.id_regulamento = reg;

UPDATE tbl_atividade
SET car_hr_aproveitada = (car_hr_aproveitada + ch_fixa)
where tbl_atividade.id_aluno = usuario;

bag:= (select update_ch_regulamento(usuario,reg));

END;

$$;
