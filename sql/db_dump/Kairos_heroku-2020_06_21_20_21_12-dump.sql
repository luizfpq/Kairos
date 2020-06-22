--
-- PostgreSQL database dump
--

-- Dumped from database version 12.3 (Ubuntu 12.3-1.pgdg16.04+1)
-- Dumped by pg_dump version 12.3 (Debian 12.3-1+b1)

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
-- Name: excluir_aluno(integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_aluno(usuario integer) RETURNS void
    LANGUAGE plpgsql
    AS $$ 

BEGIN

DELETE FROM tbl_aluno as u 
WHERE u.id_usuario = usuario ;

END;

$$;


ALTER FUNCTION public.excluir_aluno(usuario integer) OWNER TO zvraimhwsxhxda;

--
-- Name: excluir_aluno_atividade(integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_aluno_atividade(usuario integer) RETURNS void
    LANGUAGE plpgsql
    AS $$ 

BEGIN
DELETE FROM tbl_atividade as a 
WHERE a.id_aluno = usuario ;


END;

$$;


ALTER FUNCTION public.excluir_aluno_atividade(usuario integer) OWNER TO zvraimhwsxhxda;

--
-- Name: excluir_professor(integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.excluir_professor(usuario integer) RETURNS void
    LANGUAGE plpgsql
    AS $$ 

BEGIN

DELETE FROM tbl_professor as u 
WHERE u.id_usuario = usuario ;

END;

$$;


ALTER FUNCTION public.excluir_professor(usuario integer) OWNER TO zvraimhwsxhxda;

--
-- Name: remover_atividade(integer, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.remover_atividade(usuario integer, atividade integer) RETURNS void
    LANGUAGE plpgsql
    AS $$

declare doc integer := 0;
declare regulamento integer := 0;
declare bag varchar :='';
BEGIN
doc:= (select tbl_atividade.id_documento 
	   from tbl_atividade
	   where
	   tbl_atividade.id_atividade = atividade);
	   
regulamento:= (select tbl_atividade.id_regulamento 
	   from tbl_atividade
	   where
	   tbl_atividade.id_atividade = atividade);

delete from tbl_atividade 
where tbl_atividade.id_atividade = atividade;
delete from tbl_documento 
where tbl_documento.id_documento = doc;

 bag:= (select update_ch_regulamento(usuario,regulamento));

END;

$$;


ALTER FUNCTION public.remover_atividade(usuario integer, atividade integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch(integer, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch(usuario integer, reg integer) RETURNS void
    LANGUAGE plpgsql
    AS $$DECLARE cg_hr_select INTEGER := 0;
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


ALTER FUNCTION public.update_ch(usuario integer, reg integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch_percentual(integer, integer, integer, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch_percentual(usuario integer, reg integer, carga_hr_digitada integer, atividade integer) RETURNS void
    LANGUAGE plpgsql
    AS $$DECLARE cg_hr_select INTEGER := 0;
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
atv.id_regulamento = reg);


resultado = ch_apr + ((carga_hr_digitada * ch_fixa)/100);
UPDATE tbl_atividade
SET car_hr_aproveitada = resultado
where tbl_atividade.id_aluno = usuario
AND tbl_atividade.id_regulamento = reg AND
tbl_atividade.id_atividade = atividade;

bag:= (select update_ch_regulamento(usuario,reg));
END;

$$;


ALTER FUNCTION public.update_ch_percentual(usuario integer, reg integer, carga_hr_digitada integer, atividade integer) OWNER TO zvraimhwsxhxda;

--
-- Name: update_ch_regulamento(integer, integer); Type: FUNCTION; Schema: public; Owner: zvraimhwsxhxda
--

CREATE FUNCTION public.update_ch_regulamento(usuario integer, reg integer) RETURNS void
    LANGUAGE plpgsql
    AS $$DECLARE limite INTEGER := 0;
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


ALTER FUNCTION public.update_ch_regulamento(usuario integer, reg integer) OWNER TO zvraimhwsxhxda;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: tbl_aluno; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_aluno (
    id_aluno integer NOT NULL,
    situacao character varying(8),
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
    id_documento integer NOT NULL,
    id_regulamento integer NOT NULL,
    id_atividade integer NOT NULL,
    id_aluno integer
);


ALTER TABLE public.tbl_atividade OWNER TO zvraimhwsxhxda;

--
-- Name: COLUMN tbl_atividade.status; Type: COMMENT; Schema: public; Owner: zvraimhwsxhxda
--

COMMENT ON COLUMN public.tbl_atividade.status IS 'verificado ou não pelo professor';


--
-- Name: tbl_atividades_por_categoria; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_atividades_por_categoria (
    id_atv_cat integer NOT NULL,
    id_aluno integer,
    id_regulamento integer,
    ch_total numeric(5,2)
);


ALTER TABLE public.tbl_atividades_por_categoria OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_documento; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_documento (
    id_documento integer NOT NULL,
    caminho character varying NOT NULL
);


ALTER TABLE public.tbl_documento OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_documento_id_documento_seq; Type: SEQUENCE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE SEQUENCE public.tbl_documento_id_documento_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_documento_id_documento_seq OWNER TO zvraimhwsxhxda;

--
-- Name: tbl_documento_id_documento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: zvraimhwsxhxda
--

ALTER SEQUENCE public.tbl_documento_id_documento_seq OWNED BY public.tbl_documento.id_documento;


--
-- Name: tbl_professor; Type: TABLE; Schema: public; Owner: zvraimhwsxhxda
--

CREATE TABLE public.tbl_professor (
    id_professor integer NOT NULL,
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
    login character varying(56) NOT NULL,
    senha character varying(40) NOT NULL,
    email character varying NOT NULL,
    locale character varying DEFAULT 'pt_BR'::character varying,
    nivel integer DEFAULT 0 NOT NULL
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
-- Name: tbl_documento id_documento; Type: DEFAULT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_documento ALTER COLUMN id_documento SET DEFAULT nextval('public.tbl_documento_id_documento_seq'::regclass);


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

COPY public.tbl_aluno (id_aluno, situacao, id_usuario) FROM stdin;
5835	pendente	5
2484	pendente	6
5573	pendente	7
3348	pendente	8
5078	pendente	9
6519	pendente	10
11	Pendente	11
\.


--
-- Data for Name: tbl_atividade; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_atividade (descricao, carga_hr_total, car_hr_aproveitada, status, id_documento, id_regulamento, id_atividade, id_aluno) FROM stdin;
blabla	15	24	apr	2	1	2	11
Monitoria	20	13	pend	4	6	3	11
Monitoria	15	13	pend	4	6	4	11
\.


--
-- Data for Name: tbl_atividades_por_categoria; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_atividades_por_categoria (id_atv_cat, id_aluno, id_regulamento, ch_total) FROM stdin;
\.


--
-- Data for Name: tbl_documento; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_documento (id_documento, caminho) FROM stdin;
2	hehe
3	teste 2
4	teste 2
\.


--
-- Data for Name: tbl_professor; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_professor (id_professor, id_usuario) FROM stdin;
4401	4
2610	1
5895	2
8564	3
\.


--
-- Data for Name: tbl_regulamento; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_regulamento (id_regulamento, tipo, carga_hr, limite_hr) FROM stdin;
6	Monitoria Extensão e/ou Ensino	15	68
7	Projeto de Extensão / Coordenador	100	68
8	Projeto de Extensão / Colaborador	25	34
9	Projeto de Extensão / Instrutor	100	68
10	Projeto de Extensão / Participante	10	34
11	Projeto de Ensino / Coordenador	100	68
12	Projeto de Ensino / Colaborador	25	34
13	Projeto de Ensino / Instrutor	100	68
14	Projeto de Ensino / Participante	10	34
15	Projeto de Pesquisa / Coordenador	100	999999999
16	Projeto de Pesquisa / Participante	10	34
17	Iniciação Científica	68	68
18	Publicação de Trabalho Científico / Trabalho completo	34	99999999
19	Publicação de Trabalho Científico / Resumo expandido	20	60
20	Publicação de Trabalho Científico / Resumo simples	8	24
21	Estágio não obrigatório	100	68
22	Participação em Órgão Colegiado	1	34
23	Curso pertinente a área / Curso Técnico em Áreas\nAfins - cursos/minicursos em\neventos, projetos de\nextensão/ensino, etc.	25	34
24	Curso pertinente a área / Curso de Língua Estrangeira e/ou Informática 	2	8
25	Curso pertinente a área / Curso de Verão - Realizado\nem Instituição de Ensino\nSuperior	100	68
26	Disciplina cursada como enriquecimento curricular	50	68
27	Participação em Comissão de Estágio do Curso	1	34
28	Programa de Educação Tutorial - PET	34	68
29	Projeto de Intervenção Comunitária	75	17
30	Presença em Defesa de Projeto Final	1	10
31	Visitas Técnicas	3	12
32	Palestra / Ouvinte	1	10
33	Palestra / Palestrante	2	10
34	Serviços a Justiça Eleitoral	200	34
3	Evento científico ou em áreas afins / Apresentação / Oral	12	99999999
4	Evento científico ou em áreas afins / Apresentação / Painel	6	30
2	Evento científico ou em áreas afins / Organização / Colaborador	10	30
5	Evento científico ou em áreas afins / Participação	1	15
1	Evento científico ou em áreas afins / Organização / Coordenador	24	48
\.


--
-- Data for Name: tbl_usuario; Type: TABLE DATA; Schema: public; Owner: zvraimhwsxhxda
--

COPY public.tbl_usuario (id_usuario, nome, login, senha, email, locale, nivel) FROM stdin;
3	Hebia Matedi	Deila	9902	deila@email.com	pt_BR	0
2	Marlede Paludetto	Waneska	4911	waneska@email.com	pt_BR	0
5	Kayna Missau	Duan	8579	duan@email.com	pt_BR	0
4	Tarita Violeta	Fabianni	6549	fabianni@email.com	pt_BR	0
7	Carelia Billig	Kleine	8370	kleine@email.com	pt_BR	0
6	Eduiges Garantizado	Orondina	1163	orondina@email.com	pt_BR	0
9	Ketlle Metzker	Olivardo	1240	olivardo@email.com	pt_BR	0
8	Waltemberg Gilmaria	Charliton	3448	charliton@email.com	pt_BR	0
10	Jodair Steinmetz	Chinayder	4797	chinayder@email.com	pt_BR	0
1	Admin	Administrador	40bd001563085fc35165329ea1ff5c5ecbdbbeef	admin@email.com	pt_BR	0
11	Lucas testerrrr	luquinhas	123	abc@123	pt_BR	0
\.


--
-- Name: tbl_documento_id_documento_seq; Type: SEQUENCE SET; Schema: public; Owner: zvraimhwsxhxda
--

SELECT pg_catalog.setval('public.tbl_documento_id_documento_seq', 1, false);


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

SELECT pg_catalog.setval('public.tbl_usuario_id_usuario_seq', 10, true);


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
-- Name: tbl_atividades_por_categoria tbl_atividades_por_categoria_id_regulamento_key; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT tbl_atividades_por_categoria_id_regulamento_key UNIQUE (id_regulamento);


--
-- Name: tbl_atividades_por_categoria tbl_atividades_por_categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT tbl_atividades_por_categoria_pkey PRIMARY KEY (id_atv_cat);


--
-- Name: tbl_documento tbl_documento_pk; Type: CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_documento
    ADD CONSTRAINT tbl_documento_pk PRIMARY KEY (id_documento);


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
-- Name: tbl_documento_id_documento_uindex; Type: INDEX; Schema: public; Owner: zvraimhwsxhxda
--

CREATE UNIQUE INDEX tbl_documento_id_documento_uindex ON public.tbl_documento USING btree (id_documento);


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
-- Name: tbl_atividade fk_del_doc; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT fk_del_doc FOREIGN KEY (id_documento) REFERENCES public.tbl_documento(id_documento) ON DELETE CASCADE;


--
-- Name: tbl_professor fk_del_prof; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_professor
    ADD CONSTRAINT fk_del_prof FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario) ON DELETE CASCADE;


--
-- Name: tbl_atividades_por_categoria fk_reg_atv; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividades_por_categoria
    ADD CONSTRAINT fk_reg_atv FOREIGN KEY (id_regulamento) REFERENCES public.tbl_regulamento(id_regulamento);


--
-- Name: tbl_atividade pk_del_document; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT pk_del_document FOREIGN KEY (id_documento) REFERENCES public.tbl_documento(id_documento) ON DELETE CASCADE;


--
-- Name: tbl_aluno tbl_aluno_tbl_usuario_id_usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_aluno
    ADD CONSTRAINT tbl_aluno_tbl_usuario_id_usuario_fk FOREIGN KEY (id_usuario) REFERENCES public.tbl_usuario(id_usuario);


--
-- Name: tbl_atividade tbl_atividade_tbl_documento_id_documento_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT tbl_atividade_tbl_documento_id_documento_fk FOREIGN KEY (id_documento) REFERENCES public.tbl_documento(id_documento) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: tbl_atividade tbl_atividade_tbl_regulamento_id_regulamento_fk; Type: FK CONSTRAINT; Schema: public; Owner: zvraimhwsxhxda
--

ALTER TABLE ONLY public.tbl_atividade
    ADD CONSTRAINT tbl_atividade_tbl_regulamento_id_regulamento_fk FOREIGN KEY (id_regulamento) REFERENCES public.tbl_regulamento(id_regulamento);


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

