--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- Name: seq_agen; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE seq_agen
    START WITH 0
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 200
    CACHE 1;


ALTER TABLE public.seq_agen OWNER TO kepler;

--
-- Name: seq_agen; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('seq_agen', 6, true);


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: agendamento; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE agendamento (
    id_agen integer DEFAULT nextval('seq_agen'::regclass) NOT NULL,
    data_agen character varying,
    hora_agen integer,
    id_astro integer,
    tipo_astro character varying,
    login character varying
);


ALTER TABLE public.agendamento OWNER TO kepler;

--
-- Name: seq_anuncios; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE seq_anuncios
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_anuncios OWNER TO kepler;

--
-- Name: seq_anuncios; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('seq_anuncios', 1, true);


--
-- Name: anuncios; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE anuncios (
    id_anuncio integer DEFAULT nextval('seq_anuncios'::regclass) NOT NULL,
    data character varying DEFAULT '00/00/00 00:00'::character varying NOT NULL,
    login character varying NOT NULL,
    titulo character varying(32) NOT NULL,
    descr character varying(1000) NOT NULL
);


ALTER TABLE public.anuncios OWNER TO kepler;

--
-- Name: TABLE anuncios; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE anuncios IS 'Anúncios que aparecem na página inicial e são publicados pelos administradores (Notícias, Atualizações, ...)';


--
-- Name: COLUMN anuncios.data; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN anuncios.data IS 'Data em que o anúncio foi publicado.';


--
-- Name: COLUMN anuncios.login; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN anuncios.login IS 'Login do usuário administrador que publicou o anúncio.';


--
-- Name: COLUMN anuncios.titulo; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN anuncios.titulo IS 'Título do anúncio.';


--
-- Name: COLUMN anuncios.descr; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN anuncios.descr IS 'Conteúdo do anúncio.';


--
-- Name: astros; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE astros (
    id_astro integer NOT NULL,
    nome character varying(120),
    descr character varying(1000),
    img character varying(500) DEFAULT 'imagens/404.png'::character varying,
    num_agen integer,
    raio bigint DEFAULT 0 NOT NULL,
    fonte character varying(500),
    tipo character varying(10),
    excluido character(1) DEFAULT 'n'::bpchar
);


ALTER TABLE public.astros OWNER TO kepler;

--
-- Name: astros_id_astro_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE astros_id_astro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.astros_id_astro_seq OWNER TO kepler;

--
-- Name: astros_id_astro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kepler
--

ALTER SEQUENCE astros_id_astro_seq OWNED BY astros.id_astro;


--
-- Name: astros_id_astro_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('astros_id_astro_seq', 46, true);


--
-- Name: codigo_email; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE codigo_email (
    id integer NOT NULL,
    codigo character varying(50) NOT NULL,
    data timestamp(6) with time zone,
    confirma_cadastro character varying(10),
    excluido character varying(10) NOT NULL
);


ALTER TABLE public.codigo_email OWNER TO kepler;

--
-- Name: codigo_email_id_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE codigo_email_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.codigo_email_id_seq OWNER TO kepler;

--
-- Name: codigo_email_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kepler
--

ALTER SEQUENCE codigo_email_id_seq OWNED BY codigo_email.id;


--
-- Name: codigo_email_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('codigo_email_id_seq', 110, true);


--
-- Name: denuncias; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE denuncias (
    id_den integer NOT NULL,
    login_den character varying(64) NOT NULL,
    motivo_den character varying(32) NOT NULL,
    descr_den character varying(200),
    id_denunciado character varying(64) NOT NULL,
    tipo_denunciado character varying(1) NOT NULL,
    data_den character varying DEFAULT '00/00/0000'::character varying NOT NULL
);


ALTER TABLE public.denuncias OWNER TO kepler;

--
-- Name: COLUMN denuncias.id_den; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.id_den IS 'Sequence.';


--
-- Name: COLUMN denuncias.login_den; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.login_den IS 'Login de quem realizou a denúncia.';


--
-- Name: COLUMN denuncias.motivo_den; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.motivo_den IS 'Motivo selecionado no radio button.';


--
-- Name: COLUMN denuncias.descr_den; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.descr_den IS 'Descrição Opcional.';


--
-- Name: COLUMN denuncias.id_denunciado; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.id_denunciado IS 'ID/Login do usuário que foi denunciado.';


--
-- Name: COLUMN denuncias.tipo_denunciado; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN denuncias.tipo_denunciado IS 'Instituição (i) ou Usuário (u).';


--
-- Name: denuncias_id_den_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE denuncias_id_den_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.denuncias_id_den_seq OWNER TO kepler;

--
-- Name: denuncias_id_den_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kepler
--

ALTER SEQUENCE denuncias_id_den_seq OWNED BY denuncias.id_den;


--
-- Name: denuncias_id_den_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('denuncias_id_den_seq', 112, true);


--
-- Name: diretor_instituicao_id_diretor_instituicao_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE diretor_instituicao_id_diretor_instituicao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diretor_instituicao_id_diretor_instituicao_seq OWNER TO kepler;

--
-- Name: diretor_instituicao_id_diretor_instituicao_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('diretor_instituicao_id_diretor_instituicao_seq', 55, true);


--
-- Name: inst_convites; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE inst_convites (
    de_login character varying NOT NULL,
    para_login character varying NOT NULL,
    id_inst integer NOT NULL
);


ALTER TABLE public.inst_convites OWNER TO kepler;

--
-- Name: TABLE inst_convites; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE inst_convites IS 'Convites enviados para usuários para entrarem em uma instituição.';


--
-- Name: instituicao_id_inst_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE instituicao_id_inst_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.instituicao_id_inst_seq OWNER TO kepler;

--
-- Name: instituicao_id_inst_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('instituicao_id_inst_seq', 134, true);


--
-- Name: instituicao; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE instituicao (
    id_inst integer DEFAULT nextval('instituicao_id_inst_seq'::regclass) NOT NULL,
    nome_inst character varying(100) NOT NULL,
    avatar_inst character varying(255) DEFAULT 'imagens/perfil-default.png'::character varying NOT NULL,
    sobre_inst character varying(255) DEFAULT 'Nada informado.'::character varying,
    endereco_inst character varying(110),
    bairro_inst character varying(50),
    cidade_inst character varying(100),
    estado_inst character varying(100),
    telefone_inst character varying(15) NOT NULL,
    email_inst character varying(50) NOT NULL,
    excluido character(1) DEFAULT 'n'::bpchar NOT NULL,
    banner character varying(100) DEFAULT 'imagens/banner_default.png'::character varying NOT NULL,
    link_inst character varying(200),
    tempo_ban character varying,
    justificativa_exc text
);


ALTER TABLE public.instituicao OWNER TO kepler;

--
-- Name: COLUMN instituicao.excluido; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN instituicao.excluido IS 'a = Aguardando aprovação; e= Solicitação de Cadastro Não Aprovada';


--
-- Name: COLUMN instituicao.link_inst; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN instituicao.link_inst IS 'Website da Instituição';


--
-- Name: COLUMN instituicao.tempo_ban; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN instituicao.tempo_ban IS 'Essa coluna só tem valor se o usuário tiver o campo excluido igual a ''s''.';


--
-- Name: livestream; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE livestream (
    stream_ytlink character varying,
    privado character varying DEFAULT 'n'::character varying NOT NULL
);


ALTER TABLE public.livestream OWNER TO kepler;

--
-- Name: TABLE livestream; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE livestream IS 'Tabela que guarda configurações básicas da Stream.';


--
-- Name: paginas; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE paginas (
    videos character varying DEFAULT 'n'::character varying NOT NULL,
    sobre character varying DEFAULT 'n'::character varying NOT NULL,
    instituicoes character varying DEFAULT 'n'::character varying NOT NULL,
    instituicao character varying DEFAULT 'n'::character varying NOT NULL,
    perfil character varying DEFAULT 'n'::character varying NOT NULL
);


ALTER TABLE public.paginas OWNER TO kepler;

--
-- Name: TABLE paginas; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE paginas IS 'Páginas do sistema e configurações para deixá-las privadas ou públicas para manutenção.';


--
-- Name: planeta_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE planeta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.planeta_seq OWNER TO kepler;

--
-- Name: planeta_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('planeta_seq', 8, true);


SET default_with_oids = true;

--
-- Name: registros; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE registros (
    id_horario integer NOT NULL,
    login character varying NOT NULL,
    segundos integer NOT NULL,
    tempo_total integer,
    dia_semana character varying NOT NULL,
    excluido character varying NOT NULL
);


ALTER TABLE public.registros OWNER TO kepler;

--
-- Name: registros_id_horario_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE registros_id_horario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.registros_id_horario_seq OWNER TO kepler;

--
-- Name: registros_id_horario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kepler
--

ALTER SEQUENCE registros_id_horario_seq OWNED BY registros.id_horario;


--
-- Name: registros_id_horario_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('registros_id_horario_seq', 454, true);


--
-- Name: relacao_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE relacao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.relacao_seq OWNER TO kepler;

--
-- Name: relacao_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('relacao_seq', 115, true);


SET default_with_oids = false;

--
-- Name: relacao; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE relacao (
    id_inst integer,
    tipo integer DEFAULT 0 NOT NULL,
    login character varying NOT NULL,
    id_relacao integer DEFAULT nextval('relacao_seq'::regclass) NOT NULL
);


ALTER TABLE public.relacao OWNER TO kepler;

--
-- Name: TABLE relacao; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE relacao IS 'Define quais usuários pertencem a quais instituições.';


--
-- Name: COLUMN relacao.tipo; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN relacao.tipo IS '0 = Membro; 1 = Admin';


--
-- Name: seq_slides; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE seq_slides
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_slides OWNER TO kepler;

--
-- Name: seq_slides; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('seq_slides', 1, false);


--
-- Name: slides_index; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE slides_index (
    id_slide integer DEFAULT nextval('seq_slides'::regclass) NOT NULL,
    imagem_slide character varying DEFAULT 'imagens/slides_index/slides1.jpg'::character varying NOT NULL,
    descr_slide character varying(100) NOT NULL,
    link_slide character varying
);


ALTER TABLE public.slides_index OWNER TO kepler;

--
-- Name: TABLE slides_index; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE slides_index IS 'Slides que aparecem na página home.';


--
-- Name: COLUMN slides_index.link_slide; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN slides_index.link_slide IS 'URL que o slide leva quando é clicado.';


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE usuario (
    login character varying(64) NOT NULL,
    nome character varying(32) NOT NULL,
    cpf character varying(14) DEFAULT '000.000.000-00'::character varying,
    data_nasc character varying(11) DEFAULT to_char(now(), 'dd/mm/yyyy'::text) NOT NULL,
    nvl_acad character varying(50),
    tipo integer DEFAULT 0 NOT NULL,
    email character varying(64) NOT NULL,
    excluido character varying DEFAULT 'n'::character varying NOT NULL,
    sobrenome character varying(32) NOT NULL,
    senha character varying NOT NULL,
    sobre character varying(5000) DEFAULT 'Nada informado.'::character varying NOT NULL,
    cidade character varying,
    num_agend integer DEFAULT 0 NOT NULL,
    avatar character varying DEFAULT 'imagens/perfil-default.png'::character varying NOT NULL,
    estado character varying,
    link_user character varying(200),
    tempo_ban character varying
);


ALTER TABLE public.usuario OWNER TO kepler;

--
-- Name: COLUMN usuario.tipo; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.tipo IS '0 = Normal; 1 = Admin';


--
-- Name: COLUMN usuario.excluido; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.excluido IS 'Exclusão Lógica. n = não excluído; s = excluído.';


--
-- Name: COLUMN usuario.sobre; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.sobre IS 'Campo do perfil do usuário onde ele pode falar alguma coisa sobre si mesmo, ou colocar informações extras.';


--
-- Name: COLUMN usuario.num_agend; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.num_agend IS 'Número de agendamentos realizados pelo usuário.';


--
-- Name: COLUMN usuario.avatar; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.avatar IS 'Avatar (ícone) do perfil do usuário.';


--
-- Name: COLUMN usuario.tempo_ban; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN usuario.tempo_ban IS 'Essa coluna só tem valor se o usuário tiver o campo excluido igual a ''s''.';


--
-- Name: videos; Type: TABLE; Schema: public; Owner: kepler; Tablespace: 
--

CREATE TABLE videos (
    id_video integer NOT NULL,
    nome character varying(100) NOT NULL,
    descr character varying(1300),
    data_pub character varying DEFAULT '00/00/0000'::character varying NOT NULL,
    views integer DEFAULT 0 NOT NULL,
    ytlink character varying NOT NULL,
    destaque integer DEFAULT 0 NOT NULL,
    horario character varying DEFAULT '00:00:00'::character varying NOT NULL,
    img_cover character varying DEFAULT 'imagens/thumbnail/thumb-video1.jpg'::character varying NOT NULL,
    excluido character varying(1) DEFAULT 'n'::character varying NOT NULL
);


ALTER TABLE public.videos OWNER TO kepler;

--
-- Name: TABLE videos; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON TABLE videos IS 'Vídeos salvos pelos administradores.';


--
-- Name: COLUMN videos.nome; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN videos.nome IS 'Título do vídeo.';


--
-- Name: COLUMN videos.data_pub; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN videos.data_pub IS 'Data de publicação do vídeo.';


--
-- Name: COLUMN videos.views; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN videos.views IS 'Número de visualizações do vídeo para ordenar por popularidade.';


--
-- Name: COLUMN videos.ytlink; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN videos.ytlink IS 'ID do vídeo do Youtube (parâmetro que fica depois do "watch?v=" do link)';


--
-- Name: COLUMN videos.horario; Type: COMMENT; Schema: public; Owner: kepler
--

COMMENT ON COLUMN videos.horario IS 'H:m:s';


--
-- Name: videos_data_pub_seq; Type: SEQUENCE; Schema: public; Owner: kepler
--

CREATE SEQUENCE videos_data_pub_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.videos_data_pub_seq OWNER TO kepler;

--
-- Name: videos_data_pub_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kepler
--

ALTER SEQUENCE videos_data_pub_seq OWNED BY videos.data_pub;


--
-- Name: videos_data_pub_seq; Type: SEQUENCE SET; Schema: public; Owner: kepler
--

SELECT pg_catalog.setval('videos_data_pub_seq', 28, true);


--
-- Name: id_astro; Type: DEFAULT; Schema: public; Owner: kepler
--

ALTER TABLE astros ALTER COLUMN id_astro SET DEFAULT nextval('astros_id_astro_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: kepler
--

ALTER TABLE codigo_email ALTER COLUMN id SET DEFAULT nextval('codigo_email_id_seq'::regclass);


--
-- Name: id_den; Type: DEFAULT; Schema: public; Owner: kepler
--

ALTER TABLE denuncias ALTER COLUMN id_den SET DEFAULT nextval('denuncias_id_den_seq'::regclass);


--
-- Name: id_horario; Type: DEFAULT; Schema: public; Owner: kepler
--

ALTER TABLE registros ALTER COLUMN id_horario SET DEFAULT nextval('registros_id_horario_seq'::regclass);


--
-- Name: id_video; Type: DEFAULT; Schema: public; Owner: kepler
--

ALTER TABLE videos ALTER COLUMN id_video SET DEFAULT nextval('videos_data_pub_seq'::regclass);


--
-- Data for Name: agendamento; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO agendamento VALUES (0, '2017-11-13', 21, 18, 'asteroide', 'denis');
INSERT INTO agendamento VALUES (1, '2017-11-14', 8, 13, 'planeta', 'pedro@pedro');
INSERT INTO agendamento VALUES (2, '2017-11-14', 9, 7, 'planeta', 'pedro@pedro');
INSERT INTO agendamento VALUES (4, '2017-11-14', 10, 9, 'planeta', 'teste');
INSERT INTO agendamento VALUES (5, '2017-11-14', 15, 8, 'planeta', 'deborah');
INSERT INTO agendamento VALUES (6, '2017-11-30', 4, 18, 'asteroide', 'diego');


--
-- Data for Name: anuncios; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO anuncios VALUES (4, '05/11/2017 22:41', 'diego', 'Resultados', 'Segundo Andersen, os pesquisadores avaliaram vários cenários para entender os bizarros trânsitos focando em explicações plausíveis, como a passagem de um disco circunstelar — uma nuvem de poeira, gás e fragmentos que circula uma estrela. Mas, depois de buscar sinais em infravermelho associados a esses discos, os cientistas não encontraram nenhum, sem falar que essas nuvens costumam circundar estrelas mais jovens, o que não é o caso da KIC 8462852.');
INSERT INTO anuncios VALUES (3, '10/11/2017 08:33', 'denis', 'Como funciona o kepler', 'O Kepler aponta constantemente para um mesmo grupo de 150.000 estrelas, nas constelações de Cygnus e Lyra, na Via Láctea. Detecta os planetas através da observação de uma diminuição temporária do brilho das estrelas que vigia. Quando um planeta passa na frente da sua estrela, como Mercúrio fez diante do Sol na segunda-feira, por exemplo, a luz da estrela parece diminuir levemente. O Kepler pode perceber inclusive variações muito sutis de brilho, que indicam a presença de um planeta. O telescópio é tão poderoso que, se apontasse para a Terra durante a noite, poderia notar a mudança no brilho quando alguém acende uma luz na varanda de uma casa em uma cidade pequena.<br />
<br />
https://noticias.uol.com.br/ciencia/ultimas-noticias/afp/2016/05/10/cinco-informacoes-sobre-o-telescopio-espacial-kepler.htm');
INSERT INTO anuncios VALUES (1, '14/11/2017 11:08', 'mozartmt', 'Apresentacao 6', 'Outro texto');
INSERT INTO anuncios VALUES (2, '14/11/2017 11:06', 'mozartmt', '', '<i>[Publicação excluída por um administrador.]</i>');


--
-- Data for Name: astros; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO astros VALUES (4, 'Espiga', 'Ou Alpha Virginis é a mais brilhante da constelação de Virgem, e a décima quinta mais brilhante do céu. Está a 260 anos-luz da Terra.', 'imagens/estrela/Espiga.jpg', 0, 5148180, 'https://pt.wikipedia.org/wiki/Espiga_(estrela)', 'estrela', 'n');
INSERT INTO astros VALUES (5, 'Antares', 'Ou Alpha Scorpii é uma estrela supergigante vermelha na constelação de Scorpius. É a 16ª estrela mais brilhante do céu noturno.  Junto com Aldebaran, Spica, e Regulus, Antares é uma das quatro estrelas mais brilhantes próximas da eclíptica.', 'imagens/estrela/Antares.jpg', 0, 486990000, 'https://pt.wikipedia.org/wiki/Antares', 'estrela', 'n');
INSERT INTO astros VALUES (6, 'Kaus Australis', 'Ou Epsilon Sagittarii é uma estrela na direção da constelação de Sagittarius. Possui uma ascensão reta de 18h 24m 10.35s e uma declinação de −34° 23′ 03.5″. Sua magnitude aparente é igual a 1.79. Considerando sua distância de 145 anos-luz em relação à Terra, sua magnitude absoluta é igual a −1.44. Pertence à classe espectral B9.5III.', 'imagens/estrela/Kaus Australis.jpg', 0, 236538000, 'https://pt.wikipedia.org/wiki/Epsilon_Sagittarii', 'estrela', 'n');
INSERT INTO astros VALUES (1, 'Hamal', 'Ou Alpha Arietis é a estrela mais brilhante da constelação de Aries. É uma estrela gigante do tipo K2 IIICa, significando que é uma estrela de grandes dimensões e alaranjada. A notação "Ca" indica linhas de cálcio no seu espectro electromagnético. É uma estrela ligeiramente variável. O satélite Hipparcos indica que a estrela se distancia 65,9 anos-luz da Terra.', 'imagens/estrela/Hamal.jpg', 4, 10500000, 'https://pt.wikipedia.org/wiki/Alpha_Arietis', 'estrela', 'n');
INSERT INTO astros VALUES (3, 'Polux', 'Ou Beta Geminorum é a estrela mais brilhante da constelação de Gemini e a 17ª mais brilhante de todo o céu. Em 2006, foi confirmada a existência de planeta extrassolar orbitando-a. Pólux é a estrela mais brilhante com um planeta conhecido. Pólux é maior que o Sol, com cerca de duas vezes sua massa e quase nove vezes seu raio. Pólux já consumiu todo o hidrogênio de seu núcleo e evoluiu tornando-se uma estrela gigante com uma classificação estelar de K0 III.', 'imagens/estrela/Polux.jpg', 0, 5500000, 'https://pt.wikipedia.org/wiki/P%C3%B3lux_(estrela)', 'estrela', 'n');
INSERT INTO astros VALUES (2, 'Aldebaran', 'Ou Alpha Tauri é a estrela mais brilhante da constelação Taurus. O seu nome provém da palavra árabe al-dabarān que significa "aquela que segue" ou "olho do Touro" – referência à forma como a estrela parece seguir o aglomerado estelar das Plêiades durante o seu movimento aparente ao longo do céu noturno.Aldebarã é uma estrela de tipo espectral K5 III (é uma gigante vermelha), o que significa que tem cor alaranjada.', 'imagens/estrela/Aldebaran.jpg', 0, 26500000, 'https://pt.wikipedia.org/wiki/Aldebar%C3%A3', 'estrela', 'n');
INSERT INTO astros VALUES (9, 'Marte', 'É o quarto planeta a partir do Sol, o segundo menor do Sistema Solar. Batizado em homenagem ao deus romano da guerra, muitas vezes é descrito como o "Planeta Vermelho", porque o óxido de ferro predominante em sua superfície lhe dá uma aparência avermelhada. Marte é um planeta rochoso com uma atmosfera fina, com características de superfície que lembram tanto as crateras de impacto da Lua quanto vulcões, vales, desertos e calotas polares da Terra. O período de rotação e os ciclos sazonais de Marte são também semelhantes aos da Terra, assim como é a inclinação que produz as suas estações do ano.', 'imagens/planeta/Marte.jpg', 0, 3390, 'https://pt.wikipedia.org/wiki/Marte_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (10, 'Jupiter', 'É o maior planeta do Sistema Solar, tanto em diâmetro quanto em massa, e é o quinto mais próximo do Sol. Possui menos de um milésimo da massa solar, contudo tem 2,5 vezes a massa de todos os outros planetas em conjunto. É um planeta gasoso, junto com Saturno, Urano e Netuno. Estes quatro planetas são por vezes chamados de planetas jupiterianos ou planetas jovianos, e são os quatro gigantes gasosos, isto é, que não são compostos primariamente de matéria sólida.', 'imagens/planeta/Jupiter.jpg', 0, 69911, 'https://pt.wikipedia.org/wiki/J%C3%BApiter_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (11, 'Saturno', 'É o sexto planeta a partir do Sol e o segundo maior do Sistema Solar atrás de Júpiter. Pertencente ao grupo dos gigantes gasosos, possui cerca de 95 massas terrestres e orbita a uma distância média de 9,5 unidades astronômicas. Possui um pequeno núcleo rochoso, circundado por uma espessa camada de hidrogênio metálico e hélio. A sua atmosfera, também composta principalmente de hidrogênio, apresenta faixas com fortes ventos, cuja energia provém tanto do calor recebido do Sol quanto da energia irradiada de seu centro.', 'imagens/planeta/Saturno.jpg', 0, 58232, 'https://pt.wikipedia.org/wiki/Saturno_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (12, 'Urano', 'É o sétimo planeta a partir do Sol, o terceiro maior e o quarto mais massivo dos oito planetas do Sistema Solar. Embora seja visível a olho nu em boas condições de visualização, não foi reconhecido pelos astrônomos antigos como um planeta devido a seu pequeno brilho e lenta órbita. William Herschel anunciou sua descoberta em 13 de março de 1781, expandindo as fronteiras do Sistema Solar pela primeira vez na história moderna. Urano tem uma composição similar à de Netuno, e ambos possuem uma composição química diferente da dos maiores gigantes gasosos, Júpiter e Saturno. ', 'imagens/planeta/Urano.jpg', 0, 25362, 'https://pt.wikipedia.org/wiki/Urano_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (13, 'Netuno', 'É o oitavo planeta do Sistema Solar. Pertencente ao grupo dos gigantes gasosos, possui um tamanho ligeiramente menor que o de Urano, mas maior massa, equivalente a 17 massas terrestres. Netuno orbita o Sol a uma distância média de 30,1 unidades astronômicas. O planeta é formado por um pequeno núcleo rochoso ao redor do qual encontra-se uma camada formada possivelmente por água, amônia e metano sobre a qual situa-se sua turbulenta atmosfera, constituída predominantemente de hidrogênio e hélio. De fato, notáveis eventos climáticos ocorrem em Netuno, inclusive a formação de diversas camadas de nuvens, tempestades ciclônicas visíveis, como a já extinta Grande Mancha Escura, além dos ventos mais rápidos do Sistema Solar, que atingem mais de 2 000 km/h.', 'imagens/planeta/Netuno.jpg', 0, 24622, 'https://pt.wikipedia.org/wiki/Netuno_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (18, '2 Pallas', 'É o segundo maior corpo do cinturão de asteroides entre Marte e Júpiter. Foi descoberto em 28 de Março de 1802 por Heinrich Olbers quando observava Ceres. Olbers, batizou em honra à deusa grega da sabedoria.', 'imagens/asteroide/2 Pallas.jpg', 0, 975, 'https://pt.wikipedia.org/wiki/2_Palas', 'asteroide', 'n');
INSERT INTO astros VALUES (16, 'Lemmon', 'O cometa Lemmon é a bola da vez nos céus do hemisfério sul e um dos alvos mais procurados pelos astrofotógrafos e astrônomos amadores. E não é para menos. Lemmon está aumentando diariamente seu brilho e de acordo com observadores mais experientes, sua magnitude já atinge 6 pontos, o que o coloca no limiar de percepção da visão humana e forte o suficiente para ser visto através de binóculos ou registrado em fotografias. Lemmon está se aproximando do Sol e à medida que a distância fica menor o brilho se intensifica e poderá atingir a magnitude 3 quando chegar ao periélio, no dia 24 de março. Alguns observadores acreditam que o cometa tem potencial para ficar ainda mais brilhante e até mesmo atingir magnitudes negativas.', 'imagens/cometa/Lemmon.jpg', 0, 1, 'http://www.apolo11.com/cometa_73p.php?posic=dat_20130201-104427.inc', 'cometa', 'n');
INSERT INTO astros VALUES (46, 'Parminha', '', 'imagens/404.png', 0, 0, '', 'estrela', 's');
INSERT INTO astros VALUES (7, 'Mercurio', 'É o menor e mais interno planeta do Sistema Solar, orbitando o Sol a cada 87,969 dias terrestres. A sua órbita tem a maior excentricidade e o seu eixo apresenta a menor inclinação em relação ao plano da órbita dentre todos os planetas do Sistema Solar. Mercúrio completa três rotações em torno de seu eixo a cada duas órbitas. A sua aparência é brilhante quando observado da Terra, tendo uma magnitude aparente que varia de −2,6 a 5,7,  Só pode ser observado a olho nu durante o crepúsculo matutino ou vespertino.', 'imagens/404.png', 0, 2440, 'https://pt.wikipedia.org/wiki/Merc%C3%BArio_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (19, 'T Tauri', 'T Tauri é uma estrela localizada na constelação Taurus. É o protótipo das estrelas T Tauri.', 'imagens/404.png', 0, 1, 'https://pt.wikipedia.org/wiki/T_Tauri', 'estrela', 'n');
INSERT INTO astros VALUES (15, 'Loneos', 'O cometa foi descoberto no dia 28 de Julho de 2001, pelo programa LONEOS da NASA através do telescópio do Observatório Lowell. Após a sua descoberta em 2001, inicialmente se acreditava de que se tratava de um asteroide. Observações feitas em janeiro e fevereiro de 2002 mostrou que o objeto quando se aproximou do seu periélio desenvolveu uma pequena quantidade de atividade cometária. Posteriormente, foi reclassificado como um cometa. O cometa veio ao periélio (abordagem mais próximo do Sol) em 15 de março de 2002. A próxima passagem pelo periélio é calculada para ocorrer em 6 de junho de 2050', 'imagens/cometa/Loneos.jpg', 0, 1, 'https://pt.wikipedia.org/wiki/C/2001_OG108_(LONEOS)', 'cometa', 'n');
INSERT INTO astros VALUES (17, 'Lua', 'É o único satélite natural da Terra e o quinto maior do Sistema Solar. É o maior satélite natural de um planeta no sistema solar em relação ao tamanho do seu corpo primário, tendo 27% do diâmetro e 60% da densidade da Terra, o que representa 1⁄81 da sua massa. Entre os satélites cuja densidade é conhecida, a Lua é o segundo mais denso, atrás de Io. Estima-se que a formação da Lua tenha ocorrido há cerca de 4,51 mil milhões* de anos, relativamente pouco tempo após a formação da Terra.', 'imagens/satelite/Lua.jpg', 0, 1700, 'https://pt.wikipedia.org/wiki/Lua', 'satelite', 'n');
INSERT INTO astros VALUES (8, 'Venus', 'É o segundo planeta do Sistema Solar em ordem de distância a partir do Sol, orbitando-o a cada 224,7 dias. Vênus é considerado um planeta do tipo terrestre ou telúrico, chamado com frequência de planeta irmão da Terra, já que ambos são similares quanto ao tamanho, massa e composição. Vénus é coberto por uma camada opaca de nuvens de ácido sulfúrico altamente reflexivas, impedindo que a sua superfície seja vista do espaço na luz visível. Ele possui a mais densa atmosfera entre todos os planetas terrestres do Sistema Solar, constituída principalmente de dióxido de carbono.', '/imagens/planeta/Venus.jpg', 0, 6052, 'https://pt.wikipedia.org/wiki/V%C3%A9nus_(planeta)', 'planeta', 'n');
INSERT INTO astros VALUES (20, 'Europa', 'Europa é uma das quatro luas do planeta Júpiter conhecidas como luas de Galileu. É a sexta maior lua do Sistema Solar. Europa foi descoberta em 1610 por Galileu Galilei, recebendo o nome de Europa, a mãe do rei lendário Minos de Creta e amante de Zeus (equivalente ao deus romano Júpiter).', 'imagens/satelite/Europa.jpg', 0, 671, 'https://pt.wikipedia.org/wiki/Europa_(sat%C3%A9lite)', 'satelite', 's');
INSERT INTO astros VALUES (14, 'Hallee Bopp', 'Foi um dos maiores cometas observados no século XX e um dos mais brilhantes da segunda metade do século XX. Pôde ser contemplado a olho nu durante 18 meses, quase o dobro do tempo do Grande cometa de 1811. Foi descoberto a 23 de Julho de 1995 a uma grande distância do Sol, criando-se desde logo uma ', 'imagens/404.png', 0, 60, 'https://pt.wikipedia.org/wiki/Hale-Bopp', 'cometa', 'n');


--
-- Data for Name: codigo_email; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO codigo_email VALUES (73, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', '2017-10-06 04:49:36-03', NULL, 'n');
INSERT INTO codigo_email VALUES (75, 'YW5kcmUuZ29uY2FsdmVzQGdtYWlsLmNvbQ==', NULL, 'n', 'n');
INSERT INTO codigo_email VALUES (78, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 16:09:38-02', NULL, 's');
INSERT INTO codigo_email VALUES (80, 'ZmFzZGZhc2Rmc0BhamZsw6dhc2prZC5jb20=', '2017-10-24 18:03:14-02', NULL, 'n');
INSERT INTO codigo_email VALUES (82, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:03:31-02', NULL, 'n');
INSERT INTO codigo_email VALUES (84, 'YWZkc2E=', '2017-10-24 18:04:41-02', NULL, 'n');
INSERT INTO codigo_email VALUES (86, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:06:25-02', NULL, 'n');
INSERT INTO codigo_email VALUES (88, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:08:30-02', NULL, 'n');
INSERT INTO codigo_email VALUES (90, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:10:54-02', NULL, 'n');
INSERT INTO codigo_email VALUES (92, 'bWF0aGV1cy5wYXJtZWdpYW5pQGhvdG1haWwuY29t', NULL, 's', 's');
INSERT INTO codigo_email VALUES (99, 'ZGVuaXMuZ2FicmllbC5saWJhbm9AaG90bWFpbC5jb20=', NULL, 'n', 'n');
INSERT INTO codigo_email VALUES (103, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', '2017-11-14 20:33:48-02', NULL, 's');
INSERT INTO codigo_email VALUES (105, 'a2FyZW5tdXJhazA4QGhvdG1haWwuY29t', NULL, 's', 's');
INSERT INTO codigo_email VALUES (97, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (101, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (107, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (110, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 'n', 'n');
INSERT INTO codigo_email VALUES (74, 'YWx2ZXNAZGFzLmNvbQ==', NULL, 'n', 'n');
INSERT INTO codigo_email VALUES (76, 'cHJvZmJpY3Vkb2N0aUBnbWFpbC5jb20=', NULL, 's', 's');
INSERT INTO codigo_email VALUES (77, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 16:08:04-02', NULL, 's');
INSERT INTO codigo_email VALUES (79, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 16:11:25-02', NULL, 'n');
INSERT INTO codigo_email VALUES (81, 'ZGllZ28=', '2017-10-24 18:03:24-02', NULL, 'n');
INSERT INTO codigo_email VALUES (83, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:04:13-02', NULL, 'n');
INSERT INTO codigo_email VALUES (85, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:05:37-02', NULL, 'n');
INSERT INTO codigo_email VALUES (87, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:07:55-02', NULL, 'n');
INSERT INTO codigo_email VALUES (89, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:09:34-02', NULL, 'n');
INSERT INTO codigo_email VALUES (91, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-10-24 18:12:59-02', NULL, 'n');
INSERT INTO codigo_email VALUES (93, 'bWF0aGV1cy5wYXJtZWdpYW5pQGdtYWlsLmNvbQ==', '2017-11-04 15:11:59-02', NULL, 's');
INSERT INTO codigo_email VALUES (94, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-11-08 10:47:47-02', NULL, 'n');
INSERT INTO codigo_email VALUES (95, 'ZGllZ28wN2Rnb0Bob3RtYWlsLmNvbQ==', '2017-11-10 07:56:19-02', NULL, 'n');
INSERT INTO codigo_email VALUES (100, 'YXJraXVzYnJ2aWRlb3NAZ21haWwuY29t', NULL, 's', 's');
INSERT INTO codigo_email VALUES (102, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', '2017-11-14 20:22:03-02', NULL, 's');
INSERT INTO codigo_email VALUES (104, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', '2017-11-14 20:34:53-02', NULL, 's');
INSERT INTO codigo_email VALUES (98, 'a2FyZW5tdXJhazA4QGhvdG1haWwuY29t', NULL, 's', 's');
INSERT INTO codigo_email VALUES (72, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (96, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (106, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 's', 's');
INSERT INTO codigo_email VALUES (108, 'ZGVib3JhaC5mcmFuY2lzY29AZ21haWwuY29t', NULL, 's', 's');
INSERT INTO codigo_email VALUES (109, 'ZGllZ28xMDAxMDAxQGdtYWlsLmNvbQ==', NULL, 'n', 'n');


--
-- Data for Name: denuncias; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO denuncias VALUES (112, 'helena', 'perfil_falso', 'Dados Falsos', '122', 'i', '24/11/2017');
INSERT INTO denuncias VALUES (106, 'mozart', 'abuso_tele', 'Ficou movimentando o telescópio de um lado para o outro a todo momento, sem focar em um só planeta. Não usa o telescópio da forma que deveria e atrapalha quem realmente quer ver os astros.', 'theucp', 'u', '08/11/2017');
INSERT INTO denuncias VALUES (107, 'teste', 'assedio', 'teste', 'diego', 'u', '14/11/2017');
INSERT INTO denuncias VALUES (108, 'teste', 'spam', 'teste', 'bicudo', 'u', '14/11/2017');
INSERT INTO denuncias VALUES (109, 'teste', 'perfil_falso', 'teste', '122', 'i', '14/11/2017');


--
-- Data for Name: inst_convites; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO inst_convites VALUES ('mozartmt', 'kepler-normal', 2);
INSERT INTO inst_convites VALUES ('mozartmt', 'aaa', 2);
INSERT INTO inst_convites VALUES ('theucp', '@pedro@pedro', 2);


--
-- Data for Name: instituicao; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO instituicao VALUES (4, 'Universidade Federal do Oeste do Pará (UFOPA)', 'imagens/perfil-default.png', 'Nada Informado', 'Avenida Marechal Rondon, s/n', 'Caranazal', 'Santarém', 'PA', '(93) 2101-4910', 'reitoria@ufopaedubr', 'n', 'imagens/banner_default.png', NULL, NULL, NULL);
INSERT INTO instituicao VALUES (3, 'Instituto Toledo de Ensino (ITE)', 'imagens/perfil-default.png', 'Nada Informado', 'Praça IX de Julho, 1-51 ', 'Vila Pacífico', 'Bauru', 'SP', '(14) 2107-5000', 'canaldiretoite@iteedubr', 's', 'imagens/banner_default.png', NULL, '09/11/2017 04:05', NULL);
INSERT INTO instituicao VALUES (63, 'Universidade Federal do Paraná', 'https://upload.wikimedia.org/wikipedia/commons/d/d6/Universidade_Federal_do_Parana_3_Curitiba_Parana.jpg', 'Nada Informado', 'Rua XV de Novembro, 1299', 'Centro', 'Curitiba', 'PR', '(89) 75347-8573', 'letraslibras@ufpr.br', 'n', 'imagens/banner_default.png', 'http://www.ufpr.br/portalufpr/', NULL, NULL);
INSERT INTO instituicao VALUES (64, 'Universidade Federal do Ceará', 'https://s2.glbimg.com/st8ZCpAl0DYbUR_q_VHK3Wwf_QU=/0x0:620x465/984x0/smart/filters:strip_icc()/s.glbimg.com/jo/g1/f/original/2017/07/04/ufc-reitoria-fachada.jpg', 'Nada Informado', 'Av. da Universidade, 2853', 'Benfica', 'Fortaleza', 'CE', '(79) 57397-2474', 'acessoinformacao@cgu.gov.br', 'n', 'imagens/banner_default.png', 'http://www.ufc.br/', '06/11/2017 03:05', NULL);
INSERT INTO instituicao VALUES (62, 'Universidade Federal do Rio de Janeiro', 'https://image.freepik.com/icones-gratis/escola_318-23393.jpg', 'Nada Informado', 'Av. Pedro Calmon, 550', 'Cidade Universitária', 'Rio de Janeiro ', 'RJ', '(97) 53489-7589', 'acessograduacao@ufrj.br', 'n', 'imagens/banner_default.png', 'https://ufrj.br/', NULL, NULL);
INSERT INTO instituicao VALUES (8, 'Universidade Paulista (UNIP)', 'http://s2.glbimg.com/kQL3iTxNHfcKLNS1hQ_PWW7y_V8=/620x465/s.glbimg.com/jo/g1/f/original/2015/10/05/unip.jpg', 'Qualidade Comprovada', 'Av. Alberto Benassi, 200', 'Parque das Laranjeiras', 'Araraquara', 'SP', '(78) 5397-5983', 'unip@edu.com.br', 'n', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (76, 'Universidade Federal de Pernambuco', 'https://www.estudopratico.com.br/wp-content/uploads/2016/11/conheca-a-universidade-federal-de-pernambuco-ufpe-2-e1478626734872.jpg', 'Nada Informado', 'Av. Prof. Moraes Rego, 1235', 'Cidade Universitária', 'Recife', 'PE', '(95) 75579-3573', 'proreitor.propesq@ufpe.br', 's', 'imagens/banner_default.png', 'https://www.ufpe.br/', NULL, NULL);
INSERT INTO instituicao VALUES (61, 'Escola Pública Estadual Prof. Morais Pacheco ', 'https://image.freepik.com/icones-gratis/escola_318-23393.jpg', 'Nada Informado', 'Rua Primeiro de Maio Quadra ', 'Parque Boa Vista ', 'Bauru', 'SP', '(73) 4737-5782', 'e025458@see.sp.gov.br', 'e', 'imagens/banner_default.png', 'http://www.escol.as/191708-morais-pacheco-prof', NULL, NULL);
INSERT INTO instituicao VALUES (2, 'IPMet', 'https://pbs.twimg.com/profile_images/519553542479040513/9ultOpyg.jpeg', 'Instituto de Pesquisas Meteorológicas - IPMet / UNESP', 'Estrada Municipal José Sandrin, s/n', 'Chácara Bauruense', 'Bauru', 'SP', '(14) 3103-6030', 'supervisao@ipmet.unesp.br', 'n', 'imagens/banner_default.png', 'https://www.ipmet.unesp.br/', NULL, NULL);
INSERT INTO instituicao VALUES (7, 'Universidade Federal do Piauí', 'https://www.estudopratico.com.br/wp-content/uploads/2016/11/conheca-a-universidade-federal-do-piaui-ufpi-e1479305363572.jpg', 'Nada Informado', 'Rua Cícero Eduardo, S/N', 'Ininga', 'Teresina', 'PI', '(73) 3623-4324', 'comunicacao@ufpi.edu.br', 'e', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (45, 'Escola Pública Estadual Azarias Leite', 'http://cdn.securebox.com.br/custom/411/uploads/noticias/policia/2015/novembro/0escolabauru.png', 'Nada Informado', 'Rua Adante Gigo, 580 ', 'Jardim Dona Lili ', 'Bauru', 'SP', '(58) 4365-7373', 'e043597@see.sp.gov.br', 'n', 'imagens/banner_default.png', 'http://www.escol.as/193006-azarias-leite', NULL, NULL);
INSERT INTO instituicao VALUES (5, 'Universidade Estadual de Campinas (UNICAMP)', 'imagens/perfil-default.png', 'Nada Informado', 'Cidade Universitária "Zeferino Vaz" ', 'Distrito de Barão Geraldo', 'Campinas', 'SP', '(19) 3521-7000', 'cgu@reitoriaunicampbr', 'n', 'imagens/banner_default.png', NULL, NULL, NULL);
INSERT INTO instituicao VALUES (97, 'Universidade Estadual de Londrina', 'http://www.uel.br/gabinete/portal/pages/arquivos/imagens/p1000073.jpg', 'Nada Informado', 'Rodovia Celso Garcia Cid, Km 380, s/n', 'Campus Universitário', 'Londrina', 'PR', '(97) 54389-7583', 'cops@uel.br', 'n', 'imagens/banner_default.png', 'http://www.uel.br/portal/', NULL, NULL);
INSERT INTO instituicao VALUES (109, 'Colégio Seta', 'imagens/avatar_inst_upload/109.jpg', 'Nada Informado', 'Rua Antônio Garcia', 'Jd Brasil', 'Bauru', 'SP', '(14) 21067-000', 'supervisao@ipmet.unesp.br', 's', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (103, 'Kepler', 'http://200.145.153.172/kepler/Kepler/imagens/logo.png', 'O projeto tem como foco a automatização de um telescópio do IPMET, este sistema faz com que os usuários consigam visualizar astros em tempo real remotamente, para fins acadêmicos ou pessoais.', 'Avenida Nações Unidas, 58-50', 'Nucleo Res. Pres. Geisel', 'Bauru', 'SP', '(14) 3103-6150', 'projeto.kepler@gmail.com', 'n', 'imagens/banner_default.png', 'http://200.145.153.172/kepler/Kepler', NULL, NULL);
INSERT INTO instituicao VALUES (120, 'Colégio X', 'imagens/avatar_inst_upload/120.jpg', 'Nada Informado', 'Rua Z, 2-20', 'Bairro Y', 'Bauru', 'SP', '(14) 98114-1010', 'colegiox@gmail.com', 's', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (111, 'Universidade Sagrado Coração (USC)', 'imagens/perfil-default.png', 'Nada Informado', 'Irmã Arminda 1050', 'Jardim Brasil', 'Bauru', 'SP', '(12) 12123-2133', 'diego07dgo@hotmail.com', 'a', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (122, 'Teste Teste', 'imagens/avatar_inst_upload/122.jpg', 'Nada Informado', '', '', 'Bauru', 'SP', '(14) 93111-1111', 'diego1001001@gmail.com', 'n', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (106, 'Colégio Politécnico da UFSM', 'imagens/avatar_inst_upload/106.jpg', 'Nada Informado', 'Av. Roraima, 1000 ', 'Camobi', 'Santa Maria', 'RS', '(14) 77732-5232', 'secretaria@politecnico.ufsm.br', 'n', 'imagens/banner_default.png', 'http://www.politecnico.ufsm.br/', NULL, NULL);
INSERT INTO instituicao VALUES (68, 'Universidade Federal do Rio Grande do Sul', 'imagens/avatar_inst_upload/68.jpg', 'Nada Informado', 'Av. Paulo Gama, 110 ', 'Farroupilha', 'Porto Alegre', 'RS', '(78) 46776-7456', 'mauricio@progesp.ufrgs.br', 'n', 'imagens/banner_default.png', 'http://www.ufrgs.br/ufrgs/inicial', NULL, 'Durante o processo de verificação dos dados da Instituição de Ensino, foi encontrado um erro que torna inviável a aprovação da solicitação de Cadastro da Instituição de Ensino.');
INSERT INTO instituicao VALUES (60, 'Escola Pública Estadual Vereador Antonio Ferreira de Menezes ', 'https://image.freepik.com/icones-gratis/escola_318-23393.jpg', 'Nada Informado', 'Rua Capitao Mario Rossi Quadra ', 'Jardim Petrópolis', 'Bauru', 'SP', '(74) 7368-5638', 'e901003a@see.sp.gov.br', 'n', 'imagens/banner_default.png', 'http://www.escol.as/221228-antonio-ferreira-de-men', NULL, NULL);
INSERT INTO instituicao VALUES (104, 'Colégio Adalberto Nascimento', 'http://conteudo.imguol.com.br/c/noticias/cf/2016/01/28/a-escola-estadual-waldemir-barros-da-silva-foi-selecionada-para-participar-do-projeto-piloto-1454000103377_615x300.jpg', 'Nada Informado', 'Rua Adalberto Maia, 235', 'Taquaral', 'Campinas', 'SP', '(19) 3251-2824', 'e018284a@see.sp.gov.br', 'n', 'imagens/banner_default.png', 'http://www.escol.as/191132-adalberto-nascimento', NULL, NULL);
INSERT INTO instituicao VALUES (121, 'Universidade Federal de São Paulo (UNIFESP)', 'https://upload.wikimedia.org/wikipedia/pt/2/29/Logotipo_UNIFESP.png', 'Nada Informado', 'R. Sena Madureira, 1501', 'Vila Clementina', 'São Paulo', 'SP', '(66) 66666-6666', 'unifesp@edu.br', 'n', 'imagens/banner_default.png', 'http://www.unifesp.br/', NULL, NULL);
INSERT INTO instituicao VALUES (110, 'Escola Publica Estadual Prof Christino Cabral', 'http://s2.glbimg.com/bT46KEgvr55WA04ElYcdOTp7xGo=/620x465/s.glbimg.com/jo/g1/f/original/2014/10/03/urnas_transporte3.jpg', 'Nada Informado', 'Rua Gerson Franca Quadra 19165', 'Jardim Estoril Ii', 'Bauru', 'SP', '(97) 5737-3363', 'e025598a@see.sp.gov.br', 'e', 'imagens/banner_default.png', 'http://www.escol.as/191721-christino-cabral-prof', NULL, 'Dados Inválidos.');
INSERT INTO instituicao VALUES (118, 'UNINOVE', 'https://acontecebotucatu.com.br/portal/wp-content/uploads/2017/10/N2dr76814.jpg', 'Nada Informado', 'Av Nossa Senhora de Fatima 61', 'Jardim Panorama', 'Bauru', 'SP', '(95) 73987-5837', 'uninove@hotmail.com', 'a', 'imagens/banner_default.png', 'http://www.uninove.br/unidade/bauru/', NULL, 'Dados Inválidos.');
INSERT INTO instituicao VALUES (123, 'Fundação Getúlio Vargas', 'http://isbe.com.br/wp-content/uploads/2015/09/Logo-FGV-sozinho.png', 'Nada Informado', 'Praia de Botafogo, 190', 'Edifício Luiz Simões Lopes', 'BotaFogo', 'RJ', '(44) 58774-5487', 'fgv@edu.com.br', 'a', 'imagens/banner_default.png', 'http://portal.fgv.br/', NULL, 'Dados Inválidos');
INSERT INTO instituicao VALUES (133, 'Instituicao', 'imagens/perfil-default.png', 'Nada Informado', '', '', '', 'AC', '(75) 93758-9475', 'instituicao@gmail.com', 'a', 'imagens/banner_default.png', '', NULL, NULL);
INSERT INTO instituicao VALUES (134, 'Instituicao', 'imagens/perfil-default.png', 'Nada Informado', '', '', '', 'AC', '(54) 35353-5353', 'teste@teste.com', 'a', 'imagens/banner_default.png', '', NULL, NULL);


--
-- Data for Name: livestream; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO livestream VALUES ('RtU_mdL2vBM', 'n');


--
-- Data for Name: paginas; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO paginas VALUES ('n', 'n', 'n', 'n', 'n');


--
-- Data for Name: registros; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO registros VALUES (358, 'denis', 37134, 6510, 'Terça', 's');
INSERT INTO registros VALUES (449, 'diego', 56049, 4031, 'Quarta', 's');
INSERT INTO registros VALUES (365, 'mozartmt', 40749, 2862, 'Terça', 's');
INSERT INTO registros VALUES (323, 'ana', 72217, 175, 'Sabado', 's');
INSERT INTO registros VALUES (451, 'denis', 55354, 300, 'Quinta', 's');
INSERT INTO registros VALUES (445, 'helena', 63071, 13986, 'Segunda', 's');
INSERT INTO registros VALUES (447, 'diego', 55743, 48, 'Quarta', 's');
INSERT INTO registros VALUES (292, 'diego', 69133, 1239, 'Terça', 's');
INSERT INTO registros VALUES (281, 'diego', 36883, 13, 'Terça', 's');
INSERT INTO registros VALUES (303, 'diego', 33783, 2554, 'Quarta', 's');
INSERT INTO registros VALUES (453, 'karen', 64707, 12766, 'Quinta', 's');
INSERT INTO registros VALUES (354, 'mozartmt', 56995, 1087, 'Segunda', 's');
INSERT INTO registros VALUES (293, 'peralta', 70466, 219, 'Terça', 's');
INSERT INTO registros VALUES (319, 'diego', 58530, 15, 'Sabado', 's');
INSERT INTO registros VALUES (362, 'diego', 39554, 83, 'Terça', 's');
INSERT INTO registros VALUES (350, 'peralta', 32965, 1693, 'Segunda', 's');
INSERT INTO registros VALUES (297, 'denis', 32547, 5829, 'Quarta', 's');
INSERT INTO registros VALUES (280, 'mozartmt', 36666, 458, 'Terça', 's');
INSERT INTO registros VALUES (298, 'mozartmt', 32675, 5726, 'Quarta', 's');
INSERT INTO registros VALUES (283, 'mozartmt', 37815, 6485, 'Terça', 's');
INSERT INTO registros VALUES (300, 'karen', 32873, 611, 'Quarta', 's');
INSERT INTO registros VALUES (296, 'diego', 77970, 4212, 'Terça', 's');
INSERT INTO registros VALUES (299, 'diego', 32723, 43, 'Quarta', 's');
INSERT INTO registros VALUES (284, 'karen', 38003, 4495, 'Terça', 's');
INSERT INTO registros VALUES (304, 'karen', 34256, 23554, 'Quarta', 's');
INSERT INTO registros VALUES (306, 'mozartmt', 38405, 4, 'Quarta', 's');
INSERT INTO registros VALUES (285, 'pedro@pedro', 40944, 659, 'Terça', 's');
INSERT INTO registros VALUES (278, 'diego', 36394, 11, 'Segunda', 's');
INSERT INTO registros VALUES (313, 'mozartmt', 47927, 3488, 'Sabado', 's');
INSERT INTO registros VALUES (308, 'mozartmt', 46685, 38, 'Sabado', 's');
INSERT INTO registros VALUES (301, 'ana', 33491, 758, 'Quarta', 's');
INSERT INTO registros VALUES (346, 'diego', 20936, 42, 'Segunda', 's');
INSERT INTO registros VALUES (295, 'karen', 73719, 683, 'Terça', 's');
INSERT INTO registros VALUES (327, 'theucp', 74503, 1609, 'Sabado', 's');
INSERT INTO registros VALUES (315, 'theucp', 51575, 876, 'Sabado', 's');
INSERT INTO registros VALUES (309, 'mozartmt', 46910, 840, 'Sabado', 's');
INSERT INTO registros VALUES (282, 'theucp', 37577, 6821, 'Terça', 's');
INSERT INTO registros VALUES (311, 'mozartmt', 47830, 3, 'Sabado', 's');
INSERT INTO registros VALUES (288, 'diego', 44479, 236, 'Terça', 's');
INSERT INTO registros VALUES (310, 'theucp', 47356, 300, 'Sabado', 's');
INSERT INTO registros VALUES (312, 'mozartmt', 47885, 1, 'Sabado', 's');
INSERT INTO registros VALUES (294, 'diego', 70690, 4411, 'Terça', 's');
INSERT INTO registros VALUES (302, 'peralta', 33491, 288, 'Quarta', 's');
INSERT INTO registros VALUES (324, 'ana', 72615, 166, 'Sabado', 's');
INSERT INTO registros VALUES (286, 'diego', 41609, 357, 'Terça', 's');
INSERT INTO registros VALUES (289, 'diego', 44742, 3483, 'Terça', 's');
INSERT INTO registros VALUES (305, 'diego', 38116, 521, 'Quarta', 's');
INSERT INTO registros VALUES (290, 'diego', 48774, 7761, 'Terça', 's');
INSERT INTO registros VALUES (347, 'theucp', 31799, 21, 'Segunda', 's');
INSERT INTO registros VALUES (348, 'denis', 32349, 3359, 'Segunda', 's');
INSERT INTO registros VALUES (344, 'karen', 11721, 99, 'Segunda', 's');
INSERT INTO registros VALUES (291, 'diego', 56541, 8, 'Terça', 's');
INSERT INTO registros VALUES (320, 'theucp', 69419, 3751, 'Sabado', 's');
INSERT INTO registros VALUES (316, 'karen', 53752, 481, 'Sabado', 's');
INSERT INTO registros VALUES (287, 'pedro@pedro', 43808, 111, 'Terça', 's');
INSERT INTO registros VALUES (318, 'karen', 54629, 17224, 'Sabado', 's');
INSERT INTO registros VALUES (317, 'ana', 54240, 379, 'Sabado', 's');
INSERT INTO registros VALUES (326, 'theucp', 73569, 822, 'Sabado', 's');
INSERT INTO registros VALUES (321, 'karen', 71919, 216, 'Sabado', 's');
INSERT INTO registros VALUES (352, 'mozartmt', 53133, 271, 'Segunda', 's');
INSERT INTO registros VALUES (322, 'ana', 72143, 7, 'Sabado', 's');
INSERT INTO registros VALUES (307, 'denis', 38461, 128, 'Quarta', 's');
INSERT INTO registros VALUES (349, 'pedro@pedro', 32901, 6, 'Segunda', 's');
INSERT INTO registros VALUES (314, 'mozartmt', 51471, 2003, 'Sabado', 's');
INSERT INTO registros VALUES (357, 'mozartmt', 36481, 3321, 'Terça', 's');
INSERT INTO registros VALUES (353, 'mozartmt', 54274, 2503, 'Segunda', 's');
INSERT INTO registros VALUES (363, 'mozartmt', 39912, 7, 'Terça', 's');
INSERT INTO registros VALUES (343, 'karen', 9330, 2280, 'Segunda', 's');
INSERT INTO registros VALUES (355, 'denis', 59436, 48, 'Segunda', 's');
INSERT INTO registros VALUES (361, 'diego', 39348, 11, 'Terça', 's');
INSERT INTO registros VALUES (366, 'diego', 41701, 2161, 'Terça', 's');
INSERT INTO registros VALUES (359, 'theucp', 37226, 7230, 'Terça', 's');
INSERT INTO registros VALUES (345, 'karen', 11837, 1492, 'Segunda', 's');
INSERT INTO registros VALUES (364, 'mozartmt', 40353, 3, 'Terça', 's');
INSERT INTO registros VALUES (356, 'karen', 36419, 7793, 'Terça', 's');
INSERT INTO registros VALUES (351, 'peralta', 34903, 1299, 'Segunda', 's');
INSERT INTO registros VALUES (367, 'denis', 43751, 4, 'Terça', 's');
INSERT INTO registros VALUES (360, 'puchille', 37671, 42, 'Terça', 's');
INSERT INTO registros VALUES (422, 'helena', 16124, 116, 'Terça', 's');
INSERT INTO registros VALUES (381, 'peralta', 74894, 31, 'Quinta', 's');
INSERT INTO registros VALUES (382, 'peralta', 75380, 3, 'Quinta', 's');
INSERT INTO registros VALUES (369, 'karen', 32589, 6284, 'Quarta', 's');
INSERT INTO registros VALUES (384, 'denis', 26726, 1351, 'Sexta', 's');
INSERT INTO registros VALUES (430, 'puchille', 38307, 5, 'Terça', 's');
INSERT INTO registros VALUES (376, 'denis', 38205, 492, 'Quarta', 's');
INSERT INTO registros VALUES (392, 'helena', 36361, 1729, 'Sexta', 's');
INSERT INTO registros VALUES (444, 'helena', 68846, 3109, 'Domingo', 's');
INSERT INTO registros VALUES (407, 'diego', 50876, 1314, 'Segunda', 's');
INSERT INTO registros VALUES (417, 'karen', 14278, 441, 'Terça', 's');
INSERT INTO registros VALUES (443, 'karen', 68757, 69, 'Domingo', 's');
INSERT INTO registros VALUES (399, 'mozartmt', 75068, 1371, 'Sabado', 's');
INSERT INTO registros VALUES (439, 'karen', 32563, 10583, 'Sexta', 's');
INSERT INTO registros VALUES (368, 'mozartmt', 32353, 446, 'Quarta', 's');
INSERT INTO registros VALUES (426, 'teste', 35126, 1006, 'Terça', 's');
INSERT INTO registros VALUES (436, 'helena', 29390, 550, 'Sexta', 's');
INSERT INTO registros VALUES (423, 'pedro@pedro', 31948, 1964, 'Terça', 's');
INSERT INTO registros VALUES (418, 'helena', 14730, 69, 'Terça', 's');
INSERT INTO registros VALUES (371, 'denis', 36565, 73, 'Quarta', 's');
INSERT INTO registros VALUES (387, 'mozartmt', 28956, 633, 'Sexta', 's');
INSERT INTO registros VALUES (370, 'mozartmt', 36245, 431, 'Quarta', 's');
INSERT INTO registros VALUES (372, 'mozartmt', 36671, 431, 'Quarta', 's');
INSERT INTO registros VALUES (411, 'pedro@pedro', 74073, 5420, 'Segunda', 's');
INSERT INTO registros VALUES (452, 'denis', 56596, 3340, 'Quinta', 'n');
INSERT INTO registros VALUES (419, 'karen', 14809, 8, 'Terça', 's');
INSERT INTO registros VALUES (408, 'diego', 71927, 1086, 'Segunda', 's');
INSERT INTO registros VALUES (393, 'karen', 38097, 3201, 'Sexta', 's');
INSERT INTO registros VALUES (373, 'peralta', 36706, 208, 'Quarta', 's');
INSERT INTO registros VALUES (385, 'pedro@pedro', 27680, 1108, 'Sexta', 's');
INSERT INTO registros VALUES (409, 'peralta', 73303, 8, 'Segunda', 's');
INSERT INTO registros VALUES (394, 'helena', 41605, 190, 'Sexta', 's');
INSERT INTO registros VALUES (440, 'helena', 43155, 1257, 'Sexta', 's');
INSERT INTO registros VALUES (377, 'diego', 27385, 1182, 'Quinta', 's');
INSERT INTO registros VALUES (398, 'pedro@pedro', 43577, 21, 'Sexta', 's');
INSERT INTO registros VALUES (414, 'karen', 10234, 158, 'Terça', 's');
INSERT INTO registros VALUES (397, 'theucp', 43482, 187, 'Sexta', 's');
INSERT INTO registros VALUES (410, 'peralta', 74059, 20, 'Segunda', 's');
INSERT INTO registros VALUES (433, 'karen', 27834, 3889, 'Quinta', 's');
INSERT INTO registros VALUES (404, 'mozart2', 47923, 2179, 'Segunda', 's');
INSERT INTO registros VALUES (405, 'mozartmt', 48625, 1347, 'Segunda', 's');
INSERT INTO registros VALUES (383, 'karen', 26678, 4549, 'Sexta', 's');
INSERT INTO registros VALUES (378, 'denis', 27509, 2036, 'Quinta', 's');
INSERT INTO registros VALUES (389, 'theucp', 31505, 11, 'Sexta', 's');
INSERT INTO registros VALUES (379, 'denis', 30708, 264, 'Quinta', 's');
INSERT INTO registros VALUES (380, 'diego', 30976, 298, 'Quinta', 's');
INSERT INTO registros VALUES (454, 'karen', 82968, 2871, 'Quinta', 'n');
INSERT INTO registros VALUES (375, 'diego', 37601, 300, 'Quarta', 's');
INSERT INTO registros VALUES (386, 'denis', 28109, 3075, 'Sexta', 's');
INSERT INTO registros VALUES (412, 'peralta', 74167, 526, 'Segunda', 'n');
INSERT INTO registros VALUES (396, 'denis', 43433, 322, 'Sexta', 's');
INSERT INTO registros VALUES (432, 'deborah', 55967, 345, 'Terça', 'n');
INSERT INTO registros VALUES (374, 'peralta', 36922, 661, 'Quarta', 's');
INSERT INTO registros VALUES (391, 'karen', 36346, 6, 'Sexta', 's');
INSERT INTO registros VALUES (390, 'helena', 31526, 266, 'Sexta', 's');
INSERT INTO registros VALUES (431, 'karen', 42460, 1482, 'Terça', 's');
INSERT INTO registros VALUES (437, 'karen', 29951, 2551, 'Sexta', 's');
INSERT INTO registros VALUES (388, 'pedro@pedro', 30978, 5333, 'Sexta', 's');
INSERT INTO registros VALUES (395, 'karen', 41803, 2753, 'Sexta', 's');
INSERT INTO registros VALUES (448, 'diego', 55796, 8, 'Quarta', 's');
INSERT INTO registros VALUES (446, 'helena', 77086, 235, 'Segunda', 's');
INSERT INTO registros VALUES (415, 'theucp', 10478, 827, 'Terça', 'n');
INSERT INTO registros VALUES (416, 'helena', 11129, 3114, 'Terça', 's');
INSERT INTO registros VALUES (420, 'helena', 14830, 1241, 'Terça', 's');
INSERT INTO registros VALUES (438, 'helena', 32509, 42, 'Sexta', 's');
INSERT INTO registros VALUES (425, 'diego', 34318, 106, 'Terça', 's');
INSERT INTO registros VALUES (427, 'teste', 36663, 1603, 'Terça', 's');
INSERT INTO registros VALUES (428, 'mozartmt', 37664, 576, 'Terça', 's');
INSERT INTO registros VALUES (421, 'karen', 16080, 33, 'Terça', 's');
INSERT INTO registros VALUES (424, 'helena', 34192, 3467, 'Terça', 's');
INSERT INTO registros VALUES (429, 'mozartmt', 38270, 28, 'Terça', 's');
INSERT INTO registros VALUES (406, 'mozartmt', 50117, 59, 'Segunda', 's');
INSERT INTO registros VALUES (441, 'karen', 44418, 65, 'Sexta', 's');
INSERT INTO registros VALUES (413, 'denis', 75825, 2306, 'Segunda', 's');
INSERT INTO registros VALUES (450, 'helena', 74882, 1971, 'Quarta', 'n');
INSERT INTO registros VALUES (434, 'denis', 29008, 2314, 'Quinta', 's');
INSERT INTO registros VALUES (435, 'karen', 27412, 1964, 'Sexta', 's');
INSERT INTO registros VALUES (442, 'karen', 64638, 3151, 'Domingo', 's');


--
-- Data for Name: relacao; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO relacao VALUES (119, 1, 'helena', 96);
INSERT INTO relacao VALUES (2, 1, 'mozartmt', 2);
INSERT INTO relacao VALUES (3, 1, 'diego', 3);
INSERT INTO relacao VALUES (6, 1, 'diego', 6);
INSERT INTO relacao VALUES (7, 1, 'ana', 8);
INSERT INTO relacao VALUES (8, 1, 'ana', 9);
INSERT INTO relacao VALUES (9, 1, 'ana', 10);
INSERT INTO relacao VALUES (10, 1, 'ana', 11);
INSERT INTO relacao VALUES (11, 1, 'ana', 12);
INSERT INTO relacao VALUES (12, 1, 'ana', 13);
INSERT INTO relacao VALUES (13, 1, 'ana', 14);
INSERT INTO relacao VALUES (14, 1, 'ana', 15);
INSERT INTO relacao VALUES (15, 1, 'ana', 16);
INSERT INTO relacao VALUES (16, 1, 'ana', 17);
INSERT INTO relacao VALUES (17, 1, 'ana', 18);
INSERT INTO relacao VALUES (2, 2, 'denis', 84);
INSERT INTO relacao VALUES (18, 1, 'ana', 21);
INSERT INTO relacao VALUES (120, 1, 'mozart2', 98);
INSERT INTO relacao VALUES (121, 1, 'helena', 99);
INSERT INTO relacao VALUES (106, 0, 'helena', 101);
INSERT INTO relacao VALUES (19, 1, 'ana', 22);
INSERT INTO relacao VALUES (122, 1, 'teste', 102);
INSERT INTO relacao VALUES (20, 1, 'ana', 23);
INSERT INTO relacao VALUES (21, 1, 'ana', 24);
INSERT INTO relacao VALUES (22, 1, 'ana', 25);
INSERT INTO relacao VALUES (30, 1, 'ana', 26);
INSERT INTO relacao VALUES (43, 1, 'ana', 27);
INSERT INTO relacao VALUES (44, 1, 'ana', 28);
INSERT INTO relacao VALUES (45, 1, 'ana', 29);
INSERT INTO relacao VALUES (60, 1, 'ana', 30);
INSERT INTO relacao VALUES (61, 1, 'ana', 31);
INSERT INTO relacao VALUES (62, 1, 'ana', 32);
INSERT INTO relacao VALUES (63, 1, 'ana', 33);
INSERT INTO relacao VALUES (64, 1, 'ana', 34);
INSERT INTO relacao VALUES (123, 1, 'helena', 104);
INSERT INTO relacao VALUES (124, 1, 'helena', 105);
INSERT INTO relacao VALUES (125, 1, 'helena', 106);
INSERT INTO relacao VALUES (126, 1, 'helena', 107);
INSERT INTO relacao VALUES (127, 1, 'helena', 108);
INSERT INTO relacao VALUES (2, 0, '140242', 36);
INSERT INTO relacao VALUES (65, 1, 'karen', 38);
INSERT INTO relacao VALUES (66, 1, 'karen', 39);
INSERT INTO relacao VALUES (67, 1, 'karen', 40);
INSERT INTO relacao VALUES (68, 1, 'karen', 41);
INSERT INTO relacao VALUES (69, 1, 'karen', 42);
INSERT INTO relacao VALUES (70, 1, 'karen', 43);
INSERT INTO relacao VALUES (71, 1, 'karen', 44);
INSERT INTO relacao VALUES (72, 1, 'karen', 45);
INSERT INTO relacao VALUES (97, 1, 'karen', 46);
INSERT INTO relacao VALUES (2, 0, 'puchille', 47);
INSERT INTO relacao VALUES (128, 1, 'helena', 109);
INSERT INTO relacao VALUES (2, 0, 'theucp', 35);
INSERT INTO relacao VALUES (3, 0, 'mozartmt', 49);
INSERT INTO relacao VALUES (98, 1, 'karen', 51);
INSERT INTO relacao VALUES (99, 1, 'karen', 52);
INSERT INTO relacao VALUES (100, 1, 'karen', 53);
INSERT INTO relacao VALUES (101, 1, 'karen', 54);
INSERT INTO relacao VALUES (102, 1, 'theucp', 55);
INSERT INTO relacao VALUES (103, 1, 'mozartmt', 57);
INSERT INTO relacao VALUES (129, 1, 'helena', 110);
INSERT INTO relacao VALUES (103, 2, 'theucp', 59);
INSERT INTO relacao VALUES (130, 1, 'helena', 111);
INSERT INTO relacao VALUES (131, 1, 'helena', 112);
INSERT INTO relacao VALUES (5, 0, 'mozartmt', 62);
INSERT INTO relacao VALUES (103, 0, 'pedro@pedro', 63);
INSERT INTO relacao VALUES (104, 1, 'karen', 64);
INSERT INTO relacao VALUES (105, 1, 'karen', 65);
INSERT INTO relacao VALUES (103, 0, 'karen', 67);
INSERT INTO relacao VALUES (106, 1, 'karen', 68);
INSERT INTO relacao VALUES (107, 1, 'karen', 69);
INSERT INTO relacao VALUES (108, 1, 'karen', 70);
INSERT INTO relacao VALUES (76, 1, 'ana', 71);
INSERT INTO relacao VALUES (109, 1, 'mozartmt', 73);
INSERT INTO relacao VALUES (5, 0, 'theucp', 74);
INSERT INTO relacao VALUES (3, 1, 'denis', 50);
INSERT INTO relacao VALUES (63, 2, 'karen', 48);
INSERT INTO relacao VALUES (106, 2, 'ana', 76);
INSERT INTO relacao VALUES (31, 2, 'ana', 56);
INSERT INTO relacao VALUES (110, 1, 'karen', 78);
INSERT INTO relacao VALUES (111, 1, 'peralta', 79);
INSERT INTO relacao VALUES (103, 0, 'puchille', 80);
INSERT INTO relacao VALUES (103, 0, 'denis', 87);
INSERT INTO relacao VALUES (112, 1, 'denis', 89);
INSERT INTO relacao VALUES (113, 1, 'helena', 90);
INSERT INTO relacao VALUES (114, 1, 'helena', 91);
INSERT INTO relacao VALUES (115, 1, 'helena', 92);
INSERT INTO relacao VALUES (116, 1, 'helena', 93);
INSERT INTO relacao VALUES (117, 1, 'helena', 94);
INSERT INTO relacao VALUES (118, 1, 'helena', 95);
INSERT INTO relacao VALUES (132, 1, 'helena', 113);
INSERT INTO relacao VALUES (133, 1, 'helena', 114);
INSERT INTO relacao VALUES (134, 1, 'helena', 115);
INSERT INTO relacao VALUES (0, 3, 'karen', 75);


--
-- Data for Name: slides_index; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO slides_index VALUES (2, 'imagens/slides_index/slides2.jpg', 'Clique aqui e confira alguns dos melhores vídeos sobre o espaço selecionados pelos administradores!', 'videos.php');
INSERT INTO slides_index VALUES (3, 'imagens/slides_index/slides3.jpg', 'Curta a página da Kepler no Facebook e fique por dentro de todas as notícias em relação ao sistema!', 'https://www.facebook.com/projeto.kepler/');
INSERT INTO slides_index VALUES (1, 'imagens/slides_index/slides1.jpg', 'Jamal', '');


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO usuario VALUES ('diego', 'Diego', '', '17/08/2006', 'medio_incomp', 1, 'diego07dgo@hotmail.com', 'n', 'Peralta', '078c007bd92ddec308ae2f5115c1775d', 'sou eu bola de fogo', 'Bauru', 25, 'https://media.giphy.com/media/3oriNY7jFpuXvzBBTO/giphy.gif', 'SP', '', NULL);
INSERT INTO usuario VALUES ('bicudo', 'andre', '', '02/04/1970', 'fund_incomp', 0, 'profbicudocti@gmail.com', 'n', 'bicudo', '827ccb0eea8a706c4c34a16891f84e7b', 'Nada Informado', 'Bauru', 4, 'imagens/avatar_upload/bicudo.jpg', 'SP', '', NULL);
INSERT INTO usuario VALUES ('testes', 'diego', NULL, '12/11/2013', NULL, 0, 'diego1001001@gmail.com', 'ns', 'diego', '078c007bd92ddec308ae2f5115c1775d', 'Nada Informado', NULL, 0, 'perfil-default.png', NULL, NULL, NULL);
INSERT INTO usuario VALUES ('ana', 'Ana ', '266.720.881-13', '19/08/1992', 'medio_incomp', 0, 'bbbbijouxbaratobonito@gmail.com', 's', 'dos Santos', '276b6c4692e78d4799c12ada515bc3e4', 'Estudante', 'Bauru', 1, 'imagens/avatar_upload/ana.jpg', 'SP', '', '08/11/2017 12:00');
INSERT INTO usuario VALUES ('karen', 'Karen', '', '07/10/2000', 'fund_incomp', 1, 'karenmurak08@gmail.com', 'n', 'Aya', 'e10adc3949ba59abbe56e057f20f883e', 'Nada Informado...', '', 2, 'http://www.contioutra.com/content/uploads/2016/06/aurora-boreal_4.jpg', 'PR', '', NULL);
INSERT INTO usuario VALUES ('puchille', 'Vinicius Marcelo', NULL, '30/11/1999', NULL, 1, 'vini.puchille@gmail.com', 's', 'Puchille Martins', 'aca3ec7278a47144c0a863e60c595abe', 'Nada Informado', NULL, 1, 'https://s-media-cache-ak0.pinimg.com/originals/55/45/5c/55455c578c2edf184d4b615c167ec507.jpg', NULL, NULL, '15/11/2017 12:00');
INSERT INTO usuario VALUES ('theucp', 'Matheus', '488.227.778-67', '28/12/1999', 'medio_incomp', 1, 'matheus.parmegiani@gmail.com', 's', 'Parmegiani', 'e99a18c428cb38d5f260853678922e03', 'Nada Informado.', 'Bauru', 3, 'https://i.pinimg.com/736x/92/db/34/92db34245f28fd2ce6c703a783a1cfef--nanatsu-no-taizai-seven-deadly-sins.jpg', 'SP', 'http://200.145.153.172/kepler/Kepler/', '22/11/2017 10:00');
INSERT INTO usuario VALUES ('denis', 'Deni', '', '12/03/1999', 'medio_comp', 1, 'denis.gabriel.libano@gmail.com', 'n', 'a', '3cbe82d86650a10ec33414bba6218907', 'nada informado  /div ', 'bauruu', 18, 'https://scontent.fbau2-1.fna.fbcdn.net/v/t1.0-9/23319263_345833712546904_5474492717655955438_n.jpg?oh=ae8360e6b7fec07197340b373e50f1fe&oe=5AAE4C92', 'PE', '', NULL);
INSERT INTO usuario VALUES ('mozartmt', 'Mozart', '000.000.000-00', '26/05/2000', 'medio_incomp', 1, 'mozartraulmt@gmail.com', 'n', 'Mattar', '381a32d9dba66b89d38ab02181a7334d', 'Nada Informado.', 'Bauru', 12, 'imagens/avatar_upload/mozartmt.jpg', 'SP', 'http://200.145.153.172/kepler/Kepler', NULL);
INSERT INTO usuario VALUES ('helena', 'Helena', NULL, '16/11/1928', NULL, 0, 'karenmurak08@hotmail.com', 'n', 'dos Santos', 'e10adc3949ba59abbe56e057f20f883e', 'Nada Informado', NULL, 0, 'https://thumbs.dreamstime.com/z/%C3%ADcone-do-usu%C3%A1rio-9233164.jpg', NULL, NULL, NULL);
INSERT INTO usuario VALUES ('pedro@pedro', 'Pedro', '', '19/02/2000', 'fund_incomp', 1, 'pabcosta300@gmail.com', 'n', 'Augusto', 'ffea1005dd6ce407e216f13ed7c43429', 'Nada Informado', '', 16, 'https://cbspower96.files.wordpress.com/2014/12/homer-simpson-vanish.gif?w=420&h=315', 'AC', '', NULL);
INSERT INTO usuario VALUES ('deborah', 'Dborah', NULL, '30/03/2001', NULL, 0, 'deborah.francisco@gmail.com', 'n', 'Domeneghetti', 'e10adc3949ba59abbe56e057f20f883e', 'Nada Informado', NULL, 1, 'http://www.gadoo.com.br/wp-content/uploads/2015/07/2079.jpg', NULL, NULL, NULL);


--
-- Data for Name: videos; Type: TABLE DATA; Schema: public; Owner: kepler
--

INSERT INTO videos VALUES (3, 'Além do Cosmos: O Espaço (Dublado) Documentário National Geographic', 'Além do Cosmos: O Espaço (Dublado) Documentário National Geographic', '25/08/2017', 112396, 'QX85U_w0Law', 0, '08:09:08', 'https://i.ytimg.com/vi/QX85U_w0Law/default.jpg', 'n');
INSERT INTO videos VALUES (11, 'The Largest Black Holes In The Whole Universe 2017 Space Documentary', '''''A black hole is a region of spacetime exhibiting such strong gravitational effects that nothing—not even particles and electromagnetic radiation such as light—can escape from inside it. The theory of general relativity predicts that a sufficiently compact mass can deform spacetime to form a black hole.[2][3] The boundary of the region from which no escape is possible is called the event horizon. Although the event horizon has an enormous effect on the fate and circumstances of an object crossing it, no locally detectable features appear to be observed. In many ways a black hole acts like an ideal black body, as it reflects no light.[4][5] Moreover, quantum field theory in curved spacetime predicts that event horizons emit Hawking radiation, with the same spectrum as a black body of a temperature inversely proportional to its mass. This temperature is on the order of billionths of a kelvin for black holes of stellar mass, making it essentially impossible to observe.''''', '05/09/2017', 85239, 'VGQQn9mdrTg', 0, '11:12:09', 'https://i.ytimg.com/vi/VGQQn9mdrTg/default.jpg', 'n');
INSERT INTO videos VALUES (28, 'Henrique e Juliano - MAQUIAGEM NÃO DISFARÇA - DVD O Céu Explica Tudo', 'INSCREVA-SE NO NOSSO CANAL http://encurtador.com.br/gJUW0<br />
ASSISTA AO DVD. CLIQUE NO LINK: https://goo.gl/cXc9dO<br />
OUÇA NOSSO NOVO CD: https://goo.gl/6XgKBT<br />
Shows: (62) 3241-7163 - comercial@henriqueejuliano.com.br<br />
Compositores: Hiago Vinícius<br />
<br />
Henrique e Juliano - MAQUIAGEM NÃO DISFARÇA - DVD O Céu Explica Tudo<br />
<br />
MAQUIAGEM NÃO DISFARÇA [ letra ]<br />
<br />
Pera aí<br />
Quem ela tá tentando enganar<br />
Mostrando esse sorriso falso<br />
Só pra disfarçar<br />
No meio da boate, toda produzida, pra impressionar<br />
Mas quem ela tá tentando enganar<br />
Foi só me ver<br />
Sorriso sumiu, a postura caiu<br />
Veio me contar que tava arrependida<br />
Mas não era a vida que você queria<br />
Tô vendo, aprendeu<br />
Foi tarde, mas percebeu<br />
Que não tem meu beijo na boca do copo<br />
Não tem meu colo na perna da mesa<br />
Que hoje o choro borra o lápis de olho é certeza<br />
Maquiagem não disfarça tristeza', '14/11/2017', 33998247, '-YrF9RubtO8', 0, '11:11:11', 'https://i.ytimg.com/vi/-YrF9RubtO8/default.jpg', 'n');
INSERT INTO videos VALUES (27, '5 Strangest Anomalies in Space', 'White holes have never been seen before, but scientists predict they should exist. What are they? Where are they? And why can''t they be found? Subscribe to Dark5 ► http://bit.ly/dark5<br />
Music: Cry Kestrel - Empty Hands And Little Things ► https://youtu.be/RqWU-7s7R48<br />
<br />
Dark5 presents 5 mysterious space anomalies that scientists can''t explain... including White Holes, the strange opposites of black holes that should exist but haven''t been found; the Great Attractor that is pulling our galaxy the Milky Way to an unknown point across the universe; the Viking probe discovery of methane on Mars that could be proof of alien life; the unidentified force of the Pioneer Anomaly that is slowing down 2 NASA space just after they passed Saturn; and the Kuiper Cliff that could be proof the the missing Planet 9.<br />
<br />
Download the track ► https://soundcloud.com/northcloudscollective/cry-kestrel-empty-hands-and-little-things<br />
More music from North Clouds Collective ► https://soundcloud.com/northcloudscollective<br />', '04/11/2017', 75076, 'uqWM3yaG5HY', 0, '14:10:11', 'https://i.ytimg.com/vi/uqWM3yaG5HY/default.jpg', 'n');
INSERT INTO videos VALUES (5, '2017 Solar Eclipse', '2017 Solar Eclipse', '27/08/2017', 669364, 't7FP_lyg1uE', 1, '10:51:08', 'https://i.ytimg.com/vi/t7FP_lyg1uE/default.jpg', 'n');
INSERT INTO videos VALUES (6, 'Kepler 73A - CTI', 'Kepler 73A - CTI', '01/09/2017', 6, 'baRuTcH6gVE', 0, '10:41:09', 'https://i.ytimg.com/vi/baRuTcH6gVE/default_live.jpg', 's');
INSERT INTO videos VALUES (2, 'Britânicos lançam torta ao espaço para testar efeitos sobre estrutura molecular', 'Britânicos lança torta ao espaço para testar efeitos sobre estrutura molecular. Teste.', '25/08/2017', 1269508, '5n9b55X4u2Y', 0, '08:02:08', 'https://i.ytimg.com/vi/5n9b55X4u2Y/default.jpg', 'n');
INSERT INTO videos VALUES (4, '73A CTI Unesp Bauru -  Kepler 2a apresentação de projeto', '73A CTI Unesp Bauru -  Kepler 2a apresentação de projeto', '26/08/2017', 15, 'zK1DEg77RVk', 0, '09:16:08', 'https://i.ytimg.com/vi/zK1DEg77RVk/default.jpg', 'n');


--
-- Name: anuncios_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY anuncios
    ADD CONSTRAINT anuncios_pkey PRIMARY KEY (id_anuncio);


--
-- Name: astros_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY astros
    ADD CONSTRAINT astros_pkey PRIMARY KEY (id_astro);


--
-- Name: codigo_email_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY codigo_email
    ADD CONSTRAINT codigo_email_pkey PRIMARY KEY (id);


--
-- Name: denuncias_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY denuncias
    ADD CONSTRAINT denuncias_pkey PRIMARY KEY (id_den);


--
-- Name: instituicao_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY instituicao
    ADD CONSTRAINT instituicao_pkey PRIMARY KEY (id_inst);


--
-- Name: registros_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY registros
    ADD CONSTRAINT registros_pkey PRIMARY KEY (id_horario);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (login);


--
-- Name: videos_pkey; Type: CONSTRAINT; Schema: public; Owner: kepler; Tablespace: 
--

ALTER TABLE ONLY videos
    ADD CONSTRAINT videos_pkey PRIMARY KEY (id_video);


--
-- Name: inst_convites_id_inst_fkey; Type: FK CONSTRAINT; Schema: public; Owner: kepler
--

ALTER TABLE ONLY inst_convites
    ADD CONSTRAINT inst_convites_id_inst_fkey FOREIGN KEY (id_inst) REFERENCES instituicao(id_inst);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

