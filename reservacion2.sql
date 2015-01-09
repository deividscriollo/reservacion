--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.2
-- Dumped by pg_dump version 9.2.2
-- Started on 2015-01-09 15:45:28

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 8 (class 2615 OID 82672)
-- Name: localizacion; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA localizacion;


ALTER SCHEMA localizacion OWNER TO postgres;

--
-- TOC entry 7 (class 2615 OID 25329)
-- Name: seg; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA seg;


ALTER SCHEMA seg OWNER TO postgres;

--
-- TOC entry 184 (class 3079 OID 11727)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2031 (class 0 OID 0)
-- Dependencies: 184
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 197 (class 1255 OID 49904)
-- Name: servicios_mayusculas(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION servicios_mayusculas() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN

  NEW.nom := upper(NEW.nom);
  NEW.descripcion := upper(NEW.descripcion);
  NEW.otros := upper(NEW.otros);
  
  
  RETURN NEW;

END
$$;


ALTER FUNCTION public.servicios_mayusculas() OWNER TO postgres;

SET search_path = localizacion, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 176 (class 1259 OID 82694)
-- Name: ciudad; Type: TABLE; Schema: localizacion; Owner: postgres; Tablespace: 
--

CREATE TABLE ciudad (
    id text NOT NULL,
    id_provincia text,
    nom_ciudad text,
    fecha time with time zone,
    stado integer
);


ALTER TABLE localizacion.ciudad OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 82673)
-- Name: pais; Type: TABLE; Schema: localizacion; Owner: postgres; Tablespace: 
--

CREATE TABLE pais (
    id text NOT NULL,
    nom_pais text,
    fecha time with time zone,
    stado integer
);


ALTER TABLE localizacion.pais OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 82681)
-- Name: provincia; Type: TABLE; Schema: localizacion; Owner: postgres; Tablespace: 
--

CREATE TABLE provincia (
    id text NOT NULL,
    id_pais text,
    nom_provincia text,
    fecha time with time zone,
    stado integer
);


ALTER TABLE localizacion.provincia OWNER TO postgres;

SET search_path = public, pg_catalog;

--
-- TOC entry 171 (class 1259 OID 74483)
-- Name: dias_laborables; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dias_laborables (
);


ALTER TABLE public.dias_laborables OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 131850)
-- Name: horario_servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE horario_servicios (
    id text NOT NULL,
    id_servicio text,
    dias text,
    horai text,
    horaf text,
    fecha timestamp with time zone,
    stado text
);


ALTER TABLE public.horario_servicios OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 131829)
-- Name: horarios_reservados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE horarios_reservados (
    id text NOT NULL,
    id_usuario text,
    hinicio text,
    hfin text,
    dia text,
    fecha text,
    stado text
);


ALTER TABLE public.horarios_reservados OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 74486)
-- Name: reservacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reservacion (
);


ALTER TABLE public.reservacion OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 58105)
-- Name: servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE servicios (
    id text NOT NULL,
    nom text,
    descripcion text,
    otros text,
    nomimg text,
    fecha timestamp without time zone,
    stado text
);


ALTER TABLE public.servicios OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 131842)
-- Name: stado_proceso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE stado_proceso (
    id text NOT NULL,
    id_usuario text
);


ALTER TABLE public.stado_proceso OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 99069)
-- Name: tarifa; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tarifa (
    id text NOT NULL,
    id_servicio text,
    nom_tarifa text,
    precio numeric,
    fecha timestamp with time zone,
    stado text
);


ALTER TABLE public.tarifa OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 74489)
-- Name: usuario_clientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario_clientes (
);


ALTER TABLE public.usuario_clientes OWNER TO postgres;

SET search_path = seg, pg_catalog;

--
-- TOC entry 178 (class 1259 OID 82733)
-- Name: auditoria; Type: TABLE; Schema: seg; Owner: postgres; Tablespace: 
--

CREATE TABLE auditoria (
    id text NOT NULL,
    proceso text,
    idusuario text,
    tabla text,
    campos text,
    idregistro text,
    fecha timestamp without time zone,
    otros text
);


ALTER TABLE seg.auditoria OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 90864)
-- Name: nivel; Type: TABLE; Schema: seg; Owner: postgres; Tablespace: 
--

CREATE TABLE nivel (
    id text NOT NULL,
    id_usuario text,
    nivel text,
    fecha timestamp with time zone,
    stado text
);


ALTER TABLE seg.nivel OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 82725)
-- Name: usuario; Type: TABLE; Schema: seg; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    id text NOT NULL,
    cedula text,
    nombre text,
    fono text,
    edad timestamp without time zone,
    correo text,
    pass text,
    direccion text,
    id_ciudad text,
    fecha timestamp without time zone,
    stado integer
);


ALTER TABLE seg.usuario OWNER TO postgres;

SET search_path = localizacion, pg_catalog;

--
-- TOC entry 2016 (class 0 OID 82694)
-- Dependencies: 176
-- Data for Name: ciudad; Type: TABLE DATA; Schema: localizacion; Owner: postgres
--

COPY ciudad (id, id_provincia, nom_ciudad, fecha, stado) FROM stdin;
1	1	IBARRA	\N	1
2	1	OTAVALO	\N	1
3	1	ATUNTAQUI	\N	1
4	2	QUITO	\N	1
\.


--
-- TOC entry 2014 (class 0 OID 82673)
-- Dependencies: 174
-- Data for Name: pais; Type: TABLE DATA; Schema: localizacion; Owner: postgres
--

COPY pais (id, nom_pais, fecha, stado) FROM stdin;
1	Ecuador	\N	1
2	Colombia	\N	1
3	Peru	\N	1
sdfb52fgb	Brazil	\N	1
\.


--
-- TOC entry 2015 (class 0 OID 82681)
-- Dependencies: 175
-- Data for Name: provincia; Type: TABLE DATA; Schema: localizacion; Owner: postgres
--

COPY provincia (id, id_pais, nom_provincia, fecha, stado) FROM stdin;
1	1	IMBABURA	\N	1
2	1	PICHINCHA	\N	1
\.


SET search_path = public, pg_catalog;

--
-- TOC entry 2011 (class 0 OID 74483)
-- Dependencies: 171
-- Data for Name: dias_laborables; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dias_laborables  FROM stdin;
\.


--
-- TOC entry 2023 (class 0 OID 131850)
-- Dependencies: 183
-- Data for Name: horario_servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY horario_servicios (id, id_servicio, dias, horai, horaf, fecha, stado) FROM stdin;
2015010914403654b02eb46d6ac	20141211160003548a05d39b5c8	LUNES,MARTES	12:00	18:00	2015-01-09 14:40:36-05	1
\.


--
-- TOC entry 2021 (class 0 OID 131829)
-- Dependencies: 181
-- Data for Name: horarios_reservados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY horarios_reservados (id, id_usuario, hinicio, hfin, dia, fecha, stado) FROM stdin;
\.


--
-- TOC entry 2012 (class 0 OID 74486)
-- Dependencies: 172
-- Data for Name: reservacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY reservacion  FROM stdin;
\.


--
-- TOC entry 2010 (class 0 OID 58105)
-- Dependencies: 170
-- Data for Name: servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY servicios (id, nom, descripcion, otros, nomimg, fecha, stado) FROM stdin;
20141211160003548a05d39b5c8	MUSEO	EXPOSIÓN ABIERTA DE MIÉRCOLES A VIERNES DE 9H00 A 17H00 (ÚLTIMO INGRESO A LAS 16H15),   SÁBADO Y DOMINGO, DE 10H00 A 18H00 (ÚLTIMO INGRESO A LAS 17H00).\r\nLA ENTRADA ES DE $3,00 PARA ADULTOS Y $1,50 PARA NIÑOS; PERSONAS CON DISCAPACIDAD, ADULTOS MAYORES, ESTUDIANTES Y NIÑOS MENORES DE 6 AÑOS ENTRAN GRATIS.   	NINGUNO	20141211160003548a05d39b5c8.png	2014-12-11 16:00:03	1
20141211160155548a0643d0616	CENTRO DE CONVENCIONES “LOS ARRIEROS”	LOS PRINCIPALES BENEFICIOS SON:\r\n \r\n1.LOS ASISTENTES A LAS CONFERENCIAS TIENEN LA OPORTUNIDAD DE:\r\n \r\nUTILIZAR TRES SALAS DISEÑADAS EXCLUSIVAMENTE PARA ESTE TIPO DE EVENTOS.\r\nDISPONER DE EQUIPO DE AMPLIﬁCACIÓN DE ALTA ﬁDELIDAD.\r\nDISPONER DE PROYECTORES Y PIZARRAS ELECTRÓNICAS DE ÚLTIMA TECNOLOGÍA.\r\nEL SERVICIO INCLUYE COFFEBREAKS.\r\n2.TOTAL PRIVACIDAD QUE PERMITE A LOS PARTICIPANTES CONCENTRARSE EN EL EVENTO.\r\n\r\n3.EL SERVICIO INCLUYE UN TOUR DE COMPRAS POR EL CANTÓN ANTONIO ANTE.\r\n\r\n4.DISPONIBILIDAD DE INTERNET CON WI-ﬁ.\r\n\r\n5.LOS PARTICIPANTES PUEDEN VISITAR GRATUITAMENTE LOS MUSEOS.\r\n\r\n6.LOS PARTICIPANTES PUEDEN ADQUIRIR ARTESANÍAS, RECUERDOS Y SOUVENIRES.\r\n\r\n7.LOS VISITANTES DISPONEN DE UN PUESTO DE INFORMACIÓN TURÍSTICA DE TODA LA REGIÓN.	NINGUNO	20141211160155548a0643d0616.png	2014-12-11 16:01:55	1
20141211160521548a07112af84	RESTAURANTE “LAS POSADAS”	ES EL ÁREA DE DESCANSO, DONDE EL PÚBLICO QUE ASISTA AL COMPLEJO FÁBRICA IMBABURA, DISFRUTARÁ DE LA MEJOR COMIDA ECUATORIANA E INTERNACIONAL.	NINGUNO	20141211160521548a07112af84.png	2014-12-11 16:05:21	1
20141211160613548a07457dffd	TEATRO AUDITORIO “CLUB L.I.A.”	LOS ASISTENTES A LOS EVENTOS ARTÍSTICOS TIENEN LA OPORTUNIDAD DE:\r\nUTILIZAR MOBILIARIO ERGONÓMICO.\r\nDISPONER DE EQUIPO DE AMPLIFICACIÓN DE ALTA FIDELIDAD.\r\nDISPONER DE PROYECTORES DE ÚLTIMA TECNOLOGÍA.\r\nADQUIRIR COMIDA NACIONAL E INTERNACIONAL VARIADA.\r\nGUARDIANÍA Y SEGURIDAD.\r\nLOS PARTICIPANTES PUEDEN ADQUIRIR ARTESANÍAS, RECUERDOS Y SUVENIRES A PRECIOS MÓDICOS.\r\nLOS VISITANTES DISPONEN DE UN PUESTO DE INFORMACIÓN TURÍSTICA DE TODA LA REGIÓN.	NINGUNO	20141211160613548a07457dffd.png	2014-12-11 16:06:13	1
2014122916485654a1cc48f1df6	DC	SDF	SDF	2014122916485654a1cc48f1df6.jpg	2014-12-29 16:48:57	0
2014122911295054a1817e71af4	EJEMPLO H	EJEMADSD	SFGSDFG	2014122911295054a1817e71af4.jpg	2014-12-29 11:29:50	0
201412171215255491ba2d5208b	EJEMPLO	AFDVGV 	 ASD	201412171215255491ba2d5208b.jpg	2014-12-17 12:15:25	0
2014123109104254a403e2aa843	EJEMPLO	BLA BLA BLA	BLABLA BLA	2014123109104254a403e2aa843.jpg	2014-12-31 09:10:42	0
2014123109131854a4047e90c1f	DF	SDF	SDF	2014123109131854a4047e90c1f.jpg	2014-12-31 09:13:18	0
2014123109181854a405aa021a4	SDF	SDF	SDF	2014123109181854a405aa021a4.jpg	2014-12-31 09:18:18	0
2014123112301554a432a7be35a	MUSEOS	VCVFGCV GVCG G CG  	JJJHJKHHJJH	2014123112301554a432a7be35a.jpg	2014-12-31 12:30:15	0
2014123111435354a427c970b9c	EJEMPLO	SDFSD	435	2014123111435354a427c970b9c.jpg	2014-12-31 11:43:53	0
\.


--
-- TOC entry 2022 (class 0 OID 131842)
-- Dependencies: 182
-- Data for Name: stado_proceso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY stado_proceso (id, id_usuario) FROM stdin;
\.


--
-- TOC entry 2020 (class 0 OID 99069)
-- Dependencies: 180
-- Data for Name: tarifa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tarifa (id, id_servicio, nom_tarifa, precio, fecha, stado) FROM stdin;
2014122911051654a17bbc26eb7	20141211160521548a07112af84	TERCERA EDAD	12.50	2014-12-29 11:05:16-05	1
2014122911011754a17acd1dfc4	20141211160521548a07112af84	ESTUDIANTES	12	2014-12-29 11:01:17-05	0
2014122911063954a17c0f49830	20141211160003548a05d39b5c8	234	234	2014-12-29 11:06:39-05	0
2014122911124254a17d7a6012e	20141211160613548a07457dffd	CASE	23.80	2014-12-29 11:12:42-05	0
2014122911310454a181c853acf	2014122911295054a1817e71af4	NIÑOS	2.50	2014-12-29 11:31:04-05	1
2014122911122554a17d69c9501	20141211160613548a07457dffd	ESTUDIANTES	12	2014-12-29 11:12:25-05	0
2014122915294254a1b9b6445eb	20141211160521548a07112af84	NIÑOS	1.50	2014-12-29 15:29:42-05	1
2014123111454954a4283da68f7	2014123111435354a427c970b9c	ESTUDIANTES	1.50	2014-12-31 11:45:49-05	1
2014123111460654a4284e7f276	2014123111435354a427c970b9c	ADULTOS	3.00	2014-12-31 11:46:06-05	1
2014123112330154a4334d6f978	2014123112301554a432a7be35a	ADULTOS	3.00	2014-12-31 12:33:01-05	1
2014122911072054a17c388d979	20141211160003548a05d39b5c8	ESTUDIANTE	2.50	2014-12-29 11:07:20-05	1
2014122917105554a1d16f56113	20141211160003548a05d39b5c8	TERCERA EDAD	1.50	2014-12-29 17:10:55-05	1
2014122917384654a1d7f68176c	20141211160003548a05d39b5c8	ADULTOS	3.50	2014-12-29 17:38:46-05	1
2015010911202954afffcdb11a1	20141211160003548a05d39b5c8	NIÑOS	1.25	2015-01-09 11:20:29-05	0
\.


--
-- TOC entry 2013 (class 0 OID 74489)
-- Dependencies: 173
-- Data for Name: usuario_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario_clientes  FROM stdin;
\.


SET search_path = seg, pg_catalog;

--
-- TOC entry 2018 (class 0 OID 82733)
-- Dependencies: 178
-- Data for Name: auditoria; Type: TABLE DATA; Schema: seg; Owner: postgres
--

COPY auditoria (id, proceso, idusuario, tabla, campos, idregistro, fecha, otros) FROM stdin;
2015010911283454b001b21e4a8	INSERT	2015010911283454b001b21e49a	SEG.USUARIO	TODOS	2015010911283454b001b21e49a	2015-01-09 11:28:34	REGISTRO CUENTA USUARIO
2015010911303354b002291e7cc	INSERT	2015010911303354b002291e7b4	SEG.USUARIO	TODOS	2015010911303354b002291e7b4	2015-01-09 11:30:33	REGISTRO CUENTA USUARIO
2015010911340854b0030003b87	INSERT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 11:34:08	REGISTRO CUENTA USUARIO
2015010911355354b0036987685	UPDATE	2015010911340854b0030003b71	SEG.USUARIO	STADO	2015010911340854b0030003b71	2015-01-09 11:35:53	ACTIVACION CUENTA
2015010911370654b003b2bf32f	UPDATE	2015010911340854b0030003b71	SEG.USUARIO	STADO	2015010911340854b0030003b71	2015-01-09 11:37:06	ACTIVACION CUENTA
2015010911373354b003cd32c2b	SELECT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 11:37:33	INICIO SESSION
2015010911534954b0079d199cb	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 11:53:49	ENVIO CORREO MASIVO
2015010911540154b007a92a279	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 11:54:01	ENVIO CORREO MASIVO
2015010911560354b0082364473	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 11:56:03	ENVIO CORREO MASIVO
2015010911584954b008c9f1add	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 11:58:49	ENVIO CORREO MASIVO
2015010911591454b008e22f15b	SALIR	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 11:59:14	CERRAR SESSION
2015010912001154b0091ba3cb7	INSERT	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:00:11	REGISTRO CUENTA USUARIO
2015010912010454b0095071ea3	UPDATE	2015010912001154b0091ba3ca0	SEG.USUARIO	STADO	2015010912001154b0091ba3ca0	2015-01-09 12:01:04	ACTIVACION CUENTA
2015010912012354b00963318d2	SELECT	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:01:23	INICIO SESSION
2015010912034054b009ecb1138	SALIR	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:03:40	CERRAR SESSION
2015010912035754b009fd25e4b	SELECT	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:03:57	INICIO SESSION
2015010912035754b009fd269cf	SELECT	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:03:57	INICIO SESSION
2015010912125054b00c12e9c96	SELECT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:12:50	INICIO SESSION
2015010912125154b00c1304eb1	SELECT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:12:51	INICIO SESSION
2015010912145254b00c8c4f325	SALIR	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:14:52	CERRAR SESSION
2015010912173054b00d2a8caa9	SALIR	2015010912001154b0091ba3ca0	SEG.USUARIO	TODOS	2015010912001154b0091ba3ca0	2015-01-09 12:17:30	CERRAR SESSION
2015010912173654b00d30597cb	SALIR	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:17:36	CERRAR SESSION
2015010912174854b00d3c48d89	SELECT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:17:48	INICIO SESSION
2015010912195254b00db872255	SELECT	2015010911340854b0030003b71	SEG.USUARIO	TODOS	2015010911340854b0030003b71	2015-01-09 12:19:52	INICIO SESSION
2015010912202154b00dd5f2373	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 12:20:21	ENVIO CORREO MASIVO
2015010912202654b00dda2dfe1	CORREO MASIVO	2015010911340854b0030003b71	SEG.USUARIO	PASSWORD	2015010911340854b0030003b71	2015-01-09 12:20:26	ENVIO CORREO MASIVO
\.


--
-- TOC entry 2019 (class 0 OID 90864)
-- Dependencies: 179
-- Data for Name: nivel; Type: TABLE DATA; Schema: seg; Owner: postgres
--

COPY nivel (id, id_usuario, nivel, fecha, stado) FROM stdin;
2015010912001954b00923c2ce3	2015010912001154b0091ba3ca0	cliente	2015-01-09 12:00:19-05	1
2015010911341754b00309c0251	2015010911340854b0030003b71	administrador	2015-01-09 11:34:17-05	1
\.


--
-- TOC entry 2017 (class 0 OID 82725)
-- Dependencies: 177
-- Data for Name: usuario; Type: TABLE DATA; Schema: seg; Owner: postgres
--

COPY usuario (id, cedula, nombre, fono, edad, correo, pass, direccion, id_ciudad, fecha, stado) FROM stdin;
2015010911340854b0030003b71	1004034805	Deivid Criollo	0900000000	2015-01-09 11:34:17	deivid.criollo@live.com	de7c7436622758fceda46656c4ea60a4		1	2015-01-09 11:34:17	1
2015010912001154b0091ba3ca0	1002910345	Estaban Criollo	0900000000	2015-01-09 12:00:19	deividscriollo@gmail.com	de7c7436622758fceda46656c4ea60a4		1	2015-01-09 12:00:19	1
\.


SET search_path = localizacion, pg_catalog;

--
-- TOC entry 1987 (class 2606 OID 82701)
-- Name: ciudad_pkey; Type: CONSTRAINT; Schema: localizacion; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY (id);


--
-- TOC entry 1983 (class 2606 OID 82680)
-- Name: pais_pkey; Type: CONSTRAINT; Schema: localizacion; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY (id);


--
-- TOC entry 1985 (class 2606 OID 82688)
-- Name: provincia_pkey; Type: CONSTRAINT; Schema: localizacion; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY provincia
    ADD CONSTRAINT provincia_pkey PRIMARY KEY (id);


SET search_path = public, pg_catalog;

--
-- TOC entry 2001 (class 2606 OID 131857)
-- Name: horario_servicios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY horario_servicios
    ADD CONSTRAINT horario_servicios_pkey PRIMARY KEY (id);


--
-- TOC entry 1997 (class 2606 OID 131836)
-- Name: horarios_reservados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY horarios_reservados
    ADD CONSTRAINT horarios_reservados_pkey PRIMARY KEY (id);


--
-- TOC entry 1981 (class 2606 OID 58112)
-- Name: servicios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id);


--
-- TOC entry 1999 (class 2606 OID 131849)
-- Name: stado_proceso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY stado_proceso
    ADD CONSTRAINT stado_proceso_pkey PRIMARY KEY (id);


--
-- TOC entry 1995 (class 2606 OID 99076)
-- Name: tarifa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tarifa
    ADD CONSTRAINT tarifa_pkey PRIMARY KEY (id);


SET search_path = seg, pg_catalog;

--
-- TOC entry 1991 (class 2606 OID 82740)
-- Name: auditoria_pkey; Type: CONSTRAINT; Schema: seg; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT auditoria_pkey PRIMARY KEY (id);


--
-- TOC entry 1993 (class 2606 OID 90871)
-- Name: nivel_pkey; Type: CONSTRAINT; Schema: seg; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nivel
    ADD CONSTRAINT nivel_pkey PRIMARY KEY (id);


--
-- TOC entry 1989 (class 2606 OID 82732)
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: seg; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


SET search_path = public, pg_catalog;

--
-- TOC entry 2009 (class 2620 OID 58113)
-- Name: servicios_mayusculas_insertar; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER servicios_mayusculas_insertar BEFORE INSERT ON servicios FOR EACH ROW EXECUTE PROCEDURE servicios_mayusculas();


SET search_path = localizacion, pg_catalog;

--
-- TOC entry 2003 (class 2606 OID 82720)
-- Name: ciudad_id_provincia_fkey; Type: FK CONSTRAINT; Schema: localizacion; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_id_provincia_fkey FOREIGN KEY (id_provincia) REFERENCES provincia(id);


--
-- TOC entry 2002 (class 2606 OID 82715)
-- Name: provincia_id_pais_fkey; Type: FK CONSTRAINT; Schema: localizacion; Owner: postgres
--

ALTER TABLE ONLY provincia
    ADD CONSTRAINT provincia_id_pais_fkey FOREIGN KEY (id_pais) REFERENCES pais(id);


SET search_path = public, pg_catalog;

--
-- TOC entry 2008 (class 2606 OID 131858)
-- Name: horario_servicios_id_servicio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY horario_servicios
    ADD CONSTRAINT horario_servicios_id_servicio_fkey FOREIGN KEY (id_servicio) REFERENCES servicios(id);


--
-- TOC entry 2007 (class 2606 OID 131837)
-- Name: horarios_reservados_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY horarios_reservados
    ADD CONSTRAINT horarios_reservados_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES seg.usuario(id);


--
-- TOC entry 2006 (class 2606 OID 99077)
-- Name: tarifa_id_servicio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tarifa
    ADD CONSTRAINT tarifa_id_servicio_fkey FOREIGN KEY (id_servicio) REFERENCES servicios(id);


SET search_path = seg, pg_catalog;

--
-- TOC entry 2005 (class 2606 OID 131824)
-- Name: nivel_id_usuario_fkey; Type: FK CONSTRAINT; Schema: seg; Owner: postgres
--

ALTER TABLE ONLY nivel
    ADD CONSTRAINT nivel_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES usuario(id);


--
-- TOC entry 2004 (class 2606 OID 107248)
-- Name: usuario_id_ciudad_fkey; Type: FK CONSTRAINT; Schema: seg; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_id_ciudad_fkey FOREIGN KEY (id_ciudad) REFERENCES localizacion.ciudad(id);


--
-- TOC entry 2030 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2015-01-09 15:45:28

--
-- PostgreSQL database dump complete
--

