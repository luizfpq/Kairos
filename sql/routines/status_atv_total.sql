create function status_atv_total(status integer) returns integer
    language plpgsql
as
$$
declare resultado integer := 0;

BEGIN
    if status = 1 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.status = 'pendente');
    end if;
    if status = 2 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.status = 'aprovada');
    end if;
    if status = 3 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.status = 'reprovada');
    end if;

    return resultado;

END;

$$;
