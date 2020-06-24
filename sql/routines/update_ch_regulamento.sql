create function update_ch_regulamento(usuario bigint, reg integer) returns void
    language plpgsql
as
$$
DECLARE limite INTEGER := 0;
DECLARE ch_apr INTEGER := 0;


BEGIN

limite := (select tbl_regulamento.limite_hr)
from tbl_regulamento
where tbl_regulamento.id_regulamento = reg;

ch_apr := (select SUM(atv.car_hr_aproveitada)
from tbl_atividade as atv
where atv.id_aluno = usuario AND
atv.id_regulamento = reg);

IF ch_apr >= limite
THEN
UPDATE tbl_atividades_por_categoria
SET ch_total = limite
where tbl_atividades_por_categoria.id_aluno = usuario AND
tbl_atividades_por_categoria.id_regulamento = reg;
return;
END IF;

IF ch_apr < limite
THEN
UPDATE tbl_atividades_por_categoria
SET ch_total = ch_apr
where tbl_atividades_por_categoria.id_aluno = usuario
AND tbl_atividades_por_categoria.id_regulamento = reg;
END IF;

IF ch_apr IS NULL
THEN
DELETE FROM tbl_atividades_por_categoria
WHERE tbl_atividades_por_categoria.id_regulamento = reg AND
tbl_atividades_por_categoria.id_aluno = usuario;
END IF;
END;

$$;
