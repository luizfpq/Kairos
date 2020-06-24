--
-- PostgreSQL database dump
--

-- Dumped from database version 12.3 (Ubuntu 12.3-1.pgdg16.04+1)
-- Dumped by pg_dump version 12.3 (Debian 12.3-1.pgdg110+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: deg42btap8des9; Type: DATABASE; Schema: -; Owner: zvraimhwsxhxda
--

CREATE DATABASE deg42btap8des9 WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';


ALTER DATABASE deg42btap8des9 OWNER TO zvraimhwsxhxda;

\connect deg42btap8des9

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: aprova_aluno(bigint); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.aprova_aluno(aluno bigint) RETURNS void
    LANGUAGE plpgsql
    AS $$

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


ALTER FUNCTION public.aprova_aluno(aluno bigint) OWNER TO zvraimhwsxhxda;

--
-- Name: excluir_aluno(bigint); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_aluno(usuario bigint) RETURNS void
    LANGUAGE plpgsql
    AS $$
declare id bigint := 0; 
    
BEGIN
id := (select id_aluno from tbl_aluno where id_usuario = usuario);

DELETE FROM tbl_atividades_por_categoria as a
WHERE a.id_aluno = id ;

DELETE FROM tbl_atividade as a
WHERE a.id_aluno = id ;

DELETE FROM tbl_aluno as u
WHERE u.id_usuario = usuario ;

DELETE FROM tbl_usuario AS u
    WHERE u.id_usuario = usuario;

END;

$$;


ALTER FUNCTION public.excluir_aluno(usuario bigint) OWNER TO zvraimhwsxhxda;

--
-- Name: excluir_professor(bigint); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_professor(usuario bigint) RETURNS void
    LANGUAGE plpgsql
    AS $$
BEGIN

DELETE FROM tbl_professor as u 
WHERE u.id_usuario = usuario ;

Delete from tbl_usuario as u 
    where u.id_usuario = usuario;

END;

$$;


ALTER FUNCTION public.excluir_professor(usuario bigint) OWNER TO zvraimhwsxhxda;

--
-- Name: excluir_usuario(bigint); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_usuario(id_usuario_digitado bigint) RETURNS void
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.excluir_usuario(id_usuario_digitado bigint) OWNER TO zvraimhwsxhxda;

--
-- Name: inserir_atividadea(character varying, integer, bigint, integer, character varying); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.inserir_atividadea(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying) RETURNS void
    LANGUAGE plpgsql
    AS $$
declare bag varchar := '';
declare atividade bigint := 0;
BEGIN
insert into tbl_atividade(descricao,
						  carga_hr_total,
						  id_regulamento,
						  id_aluno, documento)  values
						  (desc_digitado,carga, reg, usuario, documento_url);
atividade:= (select max(tbl_atividade.id_aluno)
			from tbl_atividade);

if exists (select tbl_atividades_por_categoria.id_aluno 
		   from tbl_atividades_por_categoria
		  where tbl_atividades_por_categoria.id_regulamento = reg AND
		  tbl_atividades_por_categoria.id_aluno = usuario)
then
bag := (select update_ch(usuario, reg));
else
insert into tbl_atividades_por_categoria(id_aluno,id_regulamento,ch_total) 
values (usuario,reg,0);
end if;
bag := (select update_ch(usuario, reg));
END;

$$;


ALTER FUNCTION public.inserir_atividadea(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying) OWNER TO zvraimhwsxhxda;

--
-- Name: inserir_atividadeb(character varying, integer, bigint, integer, character varying); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.inserir_atividadeb(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying) RETURNS void
    LANGUAGE plpgsql
    AS $$
declare bag varchar := ''; 
declare atv int := 0;
BEGIN
insert into tbl_atividade(descricao,
						  carga_hr_total,
						  id_regulamento,
						  id_aluno, documento)  values
						  (desc_digitado,carga, reg, usuario, documento_url);
atv:= (select MAX(tbl_atividade.id_atividade)
from tbl_atividade);

if exists (select tbl_atividades_por_categoria.id_aluno 
		   from tbl_atividades_por_categoria
		  where tbl_atividades_por_categoria.id_regulamento = reg AND
		  tbl_atividades_por_categoria.id_aluno = usuario)
then
bag := (select update_ch_percentual(usuario, reg, carga, atv));
else
insert into tbl_atividades_por_categoria(id_aluno,id_regulamento,ch_total)
values (usuario,reg,0);
end if;
bag := (select update_ch_percentual(usuario, reg, carga, atv));


END;

$$;


ALTER FUNCTION public.inserir_atividadeb(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying) OWNER TO zvraimhwsxhxda;

--
-- Name: inserir_atividadec(character varying, integer, bigint, integer, character varying, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.inserir_atividadec(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying, intervalo integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
declare bag varchar := '';
declare resultado int := 0;
    
BEGIN

    if (reg = 5)
    then
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    else
        resultado := ((
            select tbl_regulamento.carga_hr
                from tbl_regulamento
                where tbl_regulamento.id_regulamento = reg
            ) * intervalo);
    end if;

    insert into tbl_atividade(descricao,carga_hr_total, id_regulamento, id_aluno, documento)
            values (desc_digitado, resultado, reg, usuario, documento_url);


if exists (select tbl_atividades_por_categoria.id_aluno 
		   from tbl_atividades_por_categoria
		  where tbl_atividades_por_categoria.id_regulamento = reg AND
		  tbl_atividades_por_categoria.id_aluno = usuario)
then
bag := (select update_ch(usuario, reg));
else
insert into tbl_atividades_por_categoria(id_aluno,id_regulamento,ch_total) values (usuario,reg,resultado);
bag := (select update_ch(usuario, reg));
end if;


END;

$$;


ALTER FUNCTION public.inserir_atividadec(desc_digitado character varying, carga integer, usuario bigint, reg integer, documento_url character varying, intervalo integer) OWNER TO zvraimhwsxhxda;

--
-- Name: inserir_usuario(character varying, character varying, character varying, character varying, character varying, integer, bigint); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.inserir_usuario(nome_digitado character varying, login_digitado character varying, senha_digitado character varying, email_digitado character varying, tipo_digitado character varying, nivel_digitado integer, identificador bigint) RETURNS void
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.inserir_usuario(nome_digitado character varying, login_digitado character varying, senha_digitado character varying, email_digitado character varying, tipo_digitado character varying, nivel_digitado integer, identificador bigint) OWNER TO zvraimhwsxhxda;

--
-- Name: remover_atividade(bigint, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.remover_atividade(usuario bigint, atividade integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
declare doc integer := 0;
declare regulamento integer := 0;
declare bag varchar :='';
BEGIN
  
regulamento:= (select tbl_atividade.id_regulamento 
	   from tbl_atividade
	   where
	   tbl_atividade.id_atividade = atividade);

delete from tbl_atividade 
where tbl_atividade.id_atividade = atividade;

 bag:= (select update_ch_regulamento(usuario,regulamento));

END;

$$;


ALTER FUNCTION public.remover_atividade(usuario bigint, atividade integer) OWNER TO zvraimhwsxhxda;

--
-- Name: status_atv(bigint, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.status_atv(usuario bigint, status integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare resultado integer := 0;

BEGIN
    if status = 1 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.id_aluno = usuario AND tbl_atividade.status = 'pendente');
    end if;
    if status = 2 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.id_aluno = usuario AND tbl_atividade.status = 'aprovada');
    end if;
    if status = 3 then
        resultado:= (select SUM(tbl_atividade.car_hr_aproveitada) from tbl_atividade where tbl_atividade.id_aluno = usuario AND tbl_atividade.status = 'reprovada');
    end if;

    return resultado;

END;

$$;


ALTER FUNCTION public.status_atv(usuario bigint, status integer) OWNER TO zvraimhwsxhxda;

--
-- Name: status_atv_total(integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.status_atv_total(status integer) RETURNS integer
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.status_atv_total(status integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch(bigint, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch(usuario bigint, reg integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.update_ch(usuario bigint, reg integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch_percentual(bigint, integer, integer, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch_percentual(usuario bigint, reg integer, carga_hr_digitada integer, atividade integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.update_ch_percentual(usuario bigint, reg integer, carga_hr_digitada integer, atividade integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch_regulamento(bigint, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch_regulamento(usuario bigint, reg integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
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


ALTER FUNCTION public.update_ch_regulamento(usuario bigint, reg integer) OWNER TO zvraimhwsxhxda;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: tbl_aluno; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_aluno (
    id_aluno bigint NOT NULL,
    situacao character varying DEFAULT 'pendente'::character varying,
    id_usuario integer
);


ALTER TABLE public.tbl_aluno OWNER TO zvraimhwsxhxda;

--
-- Name: COLUMN tbl_aluno.id_aluno; Type: COMMENT; Schema: public; Owner: zvraimhwsxhxda
--

COMMENT ON COLUMN public.tbl_aluno.id_aluno IS 'id_aluno - RGA';


--
-- Name: tbl_atividade; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_atividade (
    descricao character varying NOT NULL,
    carga_hr_total integer NOT NULL,
    car_hr_aproveitada integer DEFAULT 0,
    status character varying DEFAULT 'pendente'::character varying,
    documento character varying,
    id_regulamento integer NOT NULL,
    id_atividade integer NOT NULL,
    id_aluno bigint
);


ALTER TABLE public.tbl_atividade OWNER TO zvraimhwsxhxda;

--
-- Name: COLUMN tbl_atividade.status; Type: COMMENT; Schema: public; Owner: zvraimhwsxhxda
--

COMMENT ON COLUMN public.tbl_atividade.status IS 'verificado ou não pelo professor';


--
-- Name: tbl_atividade_id_atividade_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_atividade_id_atividade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_atividade_id_atividade_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_atividade_id_atividade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_atividade_id_atividade_seq OWNED BY public.tbl_atividade.id_atividade;


--
-- Name: tbl_atividades_por_categoria; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_atividades_por_categoria (
    id_atv_cat integer NOT NULL,
    id_aluno bigint,
    id_regulamento integer,
    ch_total numeric(5,2)
);


ALTER TABLE public.tbl_atividades_por_categoria OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_atividades_por_categoria_id_atv_cat_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_atividades_por_categoria_id_atv_cat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_atividades_por_categoria_id_atv_cat_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_atividades_por_categoria_id_atv_cat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_atividades_por_categoria_id_atv_cat_seq OWNED BY public.tbl_atividades_por_categoria.id_atv_cat;


--
-- Name: tbl_professor; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_professor (
    id_professor bigint NOT NULL,
    id_usuario integer NOT NULL
);


ALTER TABLE public.tbl_professor OWNER TO zvraimhwsxhxda;

--
-- Name: COLUMN tbl_professor.id_professor; Type: COMMENT; Schema: public; Owner: zvraimhwsxhxda
--

COMMENT ON COLUMN public.tbl_professor.id_professor IS 'id eh o siape, RGB';


--
-- Name: tbl_regulamento; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_regulamento (
    id_regulamento integer NOT NULL,
    tipo character varying NOT NULL,
    carga_hr integer NOT NULL,
    limite_hr integer NOT NULL
);


ALTER TABLE public.tbl_regulamento OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_regulamento_id_regulamento_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_regulamento_id_regulamento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_regulamento_id_regulamento_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_regulamento_id_regulamento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_regulamento_id_regulamento_seq OWNED BY public.tbl_regulamento.id_regulamento;


--
-- Name: tbl_regulamento_limite_hr_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_regulamento_limite_hr_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_regulamento_limite_hr_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_regulamento_limite_hr_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_regulamento_limite_hr_seq OWNED BY public.tbl_regulamento.limite_hr;


--
-- Name: tbl_usuario; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_usuario (
    id_usuario integer NOT NULL,
    nome character varying(256) NOT NULL,
    login character varying(56),
    senha character varying(40) NOT NULL,
    email character varying NOT NULL,
    locale character varying DEFAULT 'pt_BR'::character varying,
    nivel integer DEFAULT 0
);


ALTER TABLE public.tbl_usuario OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_usuario_id_usuario_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_usuario_id_usuario_seq OWNED BY public.tbl_usuario.id_usuario;


--
-- Name: vw_aluno; Type: VIEW; Schema: public; Owner: zvraimhwsxhxda
--

CREATE VIEW public.vw_aluno AS
 SELECT usu.id_usuario,
    usu.nome,
    usu.login,
    usu.senha,
    usu.email,
    usu.locale,
    usu.nivel,
    aluno.id_aluno,
    aluno.situacao
   FROM public.tbl_usuario usu,
    public.tbl_aluno aluno
  WHERE (usu.id_usuario = aluno.id_usuario);


ALTER TABLE public.vw_aluno OWNER TO zvraimhwsxhxda;

--
-- Name: vw_atividade; Type: VIEW; Schema: public; Owner: zvraimhwsxhxda
--

CREATE VIEW public.vw_atividade AS
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
   FROM public.tbl_atividade atv,
    public.vw_aluno aluno,
    public.tbl_regulamento reg
  WHERE ((atv.id_aluno = aluno.id_aluno) AND (reg.id_regulamento = atv.id_regulamento));


ALTER TABLE public.vw_atividade OWNER TO zvraimhwsxhxda;

--
-- Name: COLUMN vw_atividade.status; Type: COMMENT; Schema: public; Owner: zvraimhwsxhxda
--

COMMENT ON COLUMN public.vw_atividade.status IS 'verificado ou não pelo professor';


--
-- Name: tbl_atividade id_atividade; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade ALTER COLUMN id_atividade SET DEFAULT nextval('public.tbl_atividade_id_atividade_seq'::regclass);


--
-- Name: tbl_atividades_por_categoria id_atv_cat; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria ALTER COLUMN id_atv_cat SET DEFAULT nextval('public.tbl_atividades_por_categoria_id_atv_cat_seq'::regclass);


--
-- Name: tbl_regulamento id_regulamento; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_regulamento ALTER COLUMN id_regulamento SET DEFAULT nextval('public.tbl_regulamento_id_regulamento_seq'::regclass);


--
-- Name: tbl_regulamento limite_hr; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_regulamento ALTER COLUMN limite_hr SET DEFAULT nextval('public.tbl_regulamento_limite_hr_seq'::regclass);


--
-- Name: tbl_usuario id_usuario; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.tbl_usuario_id_usuario_seq'::regclass);


--
-- Data for Name: tbl_aluno; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_aluno (id_aluno, situacao, id_usuario) VALUES (201607430001, 'Pendente', 32);
INSERT INTO public.tbl_aluno (id_aluno, situacao, id_usuario) VALUES (201604370037, 'pendente', 31);


--
-- Data for Name: tbl_atividade; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TesteQuirino', 60, 139, 'pendente', '_d4bdb452ab360adaedcca26fa2d0a943_sample.pdf', 3, 114, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TesteQuirino2', 12, 151, 'pendente', '_9954d478462838de3c943bb29ae99bf8_sample (3).pdf', 9, 108, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TesteTipoA', 20, 127, 'pendente', '_ebafe708914ccecd9dc6e2245891c920_sample.pdf', 1, 115, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TesteEvento', 366, 103, 'pendente', '_71e70f54f3cc06ff65a9c3df9e7f050e_sample.pdf', 5, 117, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TestePET2', 68, 34, 'pendente', '_f7aff8a04c4f3eb17de6ef11e5c71ccf_sample.pdf', 28, 118, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('PetQuirino', 68, 103, 'pendente', '_cfedfb268234f4bcc464956c493a6edb_sample.pdf', 28, 116, 201604370037);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TestePadilha', 123, 52, 'pendente', '_186d4c69b69ab9866c9578004dd967d0_sample.pdf', 6, 106, 201607430001);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TestePadilhaPet', 68, 34, 'pendente', '_a00598a7b567ea4ebcdd5bfa0e07ed0a_sample.pdf', 28, 120, 201607430001);
INSERT INTO public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, documento, id_regulamento, id_atividade, id_aluno) VALUES ('TestePadilha3', 20, 37, 'aprovada', '_4a421e38ef75d0539e1c411febad7857_sample (4).pdf', 6, 110, 201607430001);


--
-- Data for Name: tbl_atividades_por_categoria; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (23, 201604370037, 13, 28.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (24, 201604370037, 6, 9.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (26, 201604370037, 9, 12.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (27, 201604370037, 3, 12.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (28, 201604370037, 1, 24.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (30, 201604370037, 5, 1.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (29, 201604370037, 28, 68.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (25, 201607430001, 6, 21.00);
INSERT INTO public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) VALUES (32, 201607430001, 28, 34.00);


--
-- Data for Name: tbl_professor; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_professor (id_professor, id_usuario) VALUES (2610, 1);
INSERT INTO public.tbl_professor (id_professor, id_usuario) VALUES (200098761234, 34);


--
-- Data for Name: tbl_regulamento; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (6, 'Monitoria Extensão e/ou Ensino', 15, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (7, 'Projeto de Extensão / Coordenador', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (8, 'Projeto de Extensão / Colaborador', 25, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (9, 'Projeto de Extensão / Instrutor', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (10, 'Projeto de Extensão / Participante', 10, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (11, 'Projeto de Ensino / Coordenador', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (12, 'Projeto de Ensino / Colaborador', 25, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (13, 'Projeto de Ensino / Instrutor', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (14, 'Projeto de Ensino / Participante', 10, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (15, 'Projeto de Pesquisa / Coordenador', 100, 999999999);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (16, 'Projeto de Pesquisa / Participante', 10, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (17, 'Iniciação Científica', 68, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (18, 'Publicação de Trabalho Científico / Trabalho completo', 34, 99999999);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (19, 'Publicação de Trabalho Científico / Resumo expandido', 20, 60);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (20, 'Publicação de Trabalho Científico / Resumo simples', 8, 24);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (21, 'Estágio não obrigatório', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (22, 'Participação em Órgão Colegiado', 1, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (23, 'Curso pertinente a área / Curso Técnico em Áreas
Afins - cursos/minicursos em
eventos, projetos de
extensão/ensino, etc.', 25, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (24, 'Curso pertinente a área / Curso de Língua Estrangeira e/ou Informática ', 2, 8);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (25, 'Curso pertinente a área / Curso de Verão - Realizado
em Instituição de Ensino
Superior', 100, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (26, 'Disciplina cursada como enriquecimento curricular', 50, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (27, 'Participação em Comissão de Estágio do Curso', 1, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (28, 'Programa de Educação Tutorial - PET', 34, 68);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (29, 'Projeto de Intervenção Comunitária', 75, 17);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (30, 'Presença em Defesa de Projeto Final', 1, 10);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (31, 'Visitas Técnicas', 3, 12);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (32, 'Palestra / Ouvinte', 1, 10);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (33, 'Palestra / Palestrante', 2, 10);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (34, 'Serviços a Justiça Eleitoral', 200, 34);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (3, 'Evento científico ou em áreas afins / Apresentação / Oral', 12, 99999999);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (4, 'Evento científico ou em áreas afins / Apresentação / Painel', 6, 30);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (2, 'Evento científico ou em áreas afins / Organização / Colaborador', 10, 30);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (5, 'Evento científico ou em áreas afins / Participação', 1, 15);
INSERT INTO public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) VALUES (1, 'Evento científico ou em áreas afins / Organização / Coordenador', 24, 48);


--
-- Data for Name: tbl_usuario; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

INSERT INTO public.tbl_usuario (id_usuario, nome, login, senha, email, locale, nivel) VALUES (1, 'Admin', 'Administrador', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin@email.com', 'pt_BR', 2);
INSERT INTO public.tbl_usuario (id_usuario, nome, login, senha, email, locale, nivel) VALUES (31, 'Luiz Fernando Postingel Quirino', 'Quirino', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'luizfpq@gmail.com', 'pt_BR', 0);
INSERT INTO public.tbl_usuario (id_usuario, nome, login, senha, email, locale, nivel) VALUES (32, 'Lucas Padilha', 'Padilha', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'padilha@email.com', 'pt_BR', 0);
INSERT INTO public.tbl_usuario (id_usuario, nome, login, senha, email, locale, nivel) VALUES (34, 'Ivone Penque Matsuno', 'Ivone', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ivone.matsuno@ufms.br', 'pt_BR', 1);


--
-- Name: tbl_atividade_id_atividade_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_atividade_id_atividade_seq', 121, true);


--
-- Name: tbl_atividades_por_categoria_id_atv_cat_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_atividades_por_categoria_id_atv_cat_seq', 33, true);


--
-- Name: tbl_regulamento_id_regulamento_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_regulamento_id_regulamento_seq', 34, true);


--
-- Name: tbl_regulamento_limite_hr_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_regulamento_limite_hr_seq', 1, false);


--
-- Name: tbl_usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_usuario_id_usuario_seq', 37, true);


--
-- Name: tbl_aluno tbl_aluno_pk; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_aluno
    ADD CONSTRAINT tbl_aluno_pk PRIMARY KEY (id_aluno);


--
-- Name: tbl_atividade tbl_atividade_pkey; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT tbl_atividade_pkey PRIMARY KEY (id_atividade);


--
-- Name: tbl_atividades_por_categoria tbl_atividades_por_categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT tbl_atividades_por_categoria_pkey PRIMARY KEY (id_atv_cat);


--
-- Name: tbl_professor tbl_professor_pk; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_professor
    ADD CONSTRAINT tbl_professor_pk PRIMARY KEY (id_professor);


--
-- Name: tbl_regulamento tbl_regulamento_pk; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_regulamento
    ADD CONSTRAINT tbl_regulamento_pk PRIMARY KEY (id_regulamento);


--
-- Name: tbl_usuario tbl_usuario_pk; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_usuario
    ADD CONSTRAINT tbl_usuario_pk PRIMARY KEY (id_usuario);


--
-- Name: tbl_aluno_id_aluno_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_aluno_id_aluno_uindex ON public.tbl_aluno USING btree (id_aluno);


--
-- Name: tbl_professor_id_professor_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_professor_id_professor_uindex ON public.tbl_professor USING btree (id_professor);


--
-- Name: tbl_regulamento_id_regulamento_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_regulamento_id_regulamento_uindex ON public.tbl_regulamento USING btree (id_regulamento);


--
-- Name: tbl_usuario_email_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_usuario_email_uindex ON public.tbl_usuario USING btree (email);


--
-- Name: tbl_usuario_id_usuario_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_usuario_id_usuario_uindex ON public.tbl_usuario USING btree (id_usuario);


--
-- Name: tbl_atividades_por_categoria fk_atv_aluno_cat; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT fk_atv_aluno_cat FOREIGN KEY (id_aluno) REFERENCES public.tbl_aluno(id_aluno);


--
-- Name: tbl_aluno fk_del_aluno; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_aluno
    ADD CONSTRAINT fk_del_aluno FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario) ON DELETE CASCADE;


--
-- Name: tbl_professor fk_del_prof; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_professor
    ADD CONSTRAINT fk_del_prof FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario) ON DELETE CASCADE;


--
-- Name: tbl_aluno tbl_aluno_tbl_usuario_id_usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_aluno
    ADD CONSTRAINT tbl_aluno_tbl_usuario_id_usuario_fk FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario);


--
-- Name: tbl_atividade tbl_atividade_tbl_regulamento_id_regulamento_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT tbl_atividade_tbl_regulamento_id_regulamento_fk FOREIGN KEY (id_regulamento) REFERENCES public.tbl_regulamento(id_regulamento);


--
-- Name: tbl_atividades_por_categoria tbl_atividades_por_categoria_tbl_regulamento_id_regulamento_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT tbl_atividades_por_categoria_tbl_regulamento_id_regulamento_fk FOREIGN KEY (id_regulamento) REFERENCES public.tbl_regulamento(id_regulamento);


--
-- Name: tbl_professor tbl_professor_tbl_usuario_id_usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_professor
    ADD CONSTRAINT tbl_professor_tbl_usuario_id_usuario_fk FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario);


--
-- Name: DATABASE deg42btap8des9; Type: ACL; Schema: -; Owner: zvraimhwsxhxda
--

REVOKE CONNECT,TEMPORARY ON DATABASE deg42btap8des9 FROM PUBLIC;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: zvraimhwsxhxda
--

REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO zvraimhwsxhxda;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO zvraimhwsxhxda;


--
-- PostgreSQL database dump complete
--

