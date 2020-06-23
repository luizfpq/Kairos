create function update_ch_percentual(usuario integer, reg integer, carga_hr_digitada integer, atividade integer) returns void
    language plpgsql
as
$$
DECLARE cg_hr_select INTEGER := 0;
DECLARE limite INTEGER := 0;
DECLARE ch_fixa INTEGER := 0;
DECLARE ch_apr INTEGER := 0;
DECLARE resultado INTEGER := 0;
DECLARE bag varchar := '';

BEGIN

ch_fixa := (select tbl_regulamento.carga_hr)
from tbl_regulamento
where tbl_regulamento.id_regulamento = reg;

ch_apr := (select SUM(atv.car_hr_aproveitada)
from tbl_atividade as atv
where atv.id_aluno = usuario AND
atv.id_regulamento = reg AND
atv.id_atividade = atividade);


resultado :=((carga_hr_digitada * ch_fixa)/100);
UPDATE tbl_atividade
SET car_hr_aproveitada = resultado
where tbl_atividade.id_aluno = usuario
AND tbl_atividade.id_regulamento = reg AND
tbl_atividade.id_atividade = atividade;

bag:= (select update_ch_regulamento(usuario,reg));
END;

$$;

alter function update_ch_percentual(integer, integer, integer, integer) owner to zvraimhwsxhxda;


