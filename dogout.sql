--
-- PostgreSQL database dump
--

-- Dumped from database version 14.6 (Ubuntu 14.6-1.pgdg20.04+1)
-- Dumped by pg_dump version 15.1

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
-- Name: heroku_ext; Type: SCHEMA; Schema: -; Owner: u66tp9bme4bvr4
--

CREATE SCHEMA heroku_ext;


ALTER SCHEMA heroku_ext OWNER TO u66tp9bme4bvr4;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: vgerxvippgozfy
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO vgerxvippgozfy;

--
-- Name: pg_stat_statements; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pg_stat_statements WITH SCHEMA heroku_ext;


--
-- Name: EXTENSION pg_stat_statements; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pg_stat_statements IS 'track planning and execution statistics of all SQL statements executed';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: active_walks; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.active_walks (
    id_active_walk integer NOT NULL,
    id_place integer NOT NULL,
    time_of_walk character varying(100) NOT NULL,
    started_at time without time zone DEFAULT now() NOT NULL,
    id_user integer NOT NULL
);


ALTER TABLE public.active_walks OWNER TO vgerxvippgozfy;

--
-- Name: active_walks_id_active_walk_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.active_walks ALTER COLUMN id_active_walk ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.active_walks_id_active_walk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: addresses; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.addresses (
    id_address integer NOT NULL,
    postal_code character varying(10) NOT NULL,
    street character varying(100) NOT NULL,
    city integer NOT NULL,
    home_number character varying(10),
    country character varying(30) NOT NULL
);


ALTER TABLE public.addresses OWNER TO vgerxvippgozfy;

--
-- Name: addresses_id_address_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.addresses ALTER COLUMN id_address ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.addresses_id_address_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: cities; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.cities (
    id_city integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.cities OWNER TO vgerxvippgozfy;

--
-- Name: cities_id_city_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.cities ALTER COLUMN id_city ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.cities_id_city_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: dogs; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.dogs (
    id_dog integer NOT NULL,
    name character varying(100) NOT NULL,
    age integer NOT NULL,
    id_breed integer NOT NULL,
    gender boolean NOT NULL,
    description text NOT NULL,
    photo character varying(255) NOT NULL,
    id_user integer NOT NULL
);


ALTER TABLE public.dogs OWNER TO vgerxvippgozfy;

--
-- Name: dogs_breed; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.dogs_breed (
    id_dog_breed integer NOT NULL,
    name character varying(100) NOT NULL,
    id_dog_size integer
);


ALTER TABLE public.dogs_breed OWNER TO vgerxvippgozfy;

--
-- Name: dogs_breed_id_dog_breed_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.dogs_breed ALTER COLUMN id_dog_breed ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.dogs_breed_id_dog_breed_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: dogs_id_dog_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.dogs ALTER COLUMN id_dog ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.dogs_id_dog_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: dogs_sizes; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.dogs_sizes (
    id_dog_size integer NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.dogs_sizes OWNER TO vgerxvippgozfy;

--
-- Name: dogs_sizes_id_dog_size_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.dogs_sizes ALTER COLUMN id_dog_size ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.dogs_sizes_id_dog_size_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: new_places_ideas; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.new_places_ideas (
    id_new_place_idea integer NOT NULL,
    city character varying(100) NOT NULL,
    name character varying(100) NOT NULL,
    street character varying(100) NOT NULL,
    id_user integer NOT NULL
);


ALTER TABLE public.new_places_ideas OWNER TO vgerxvippgozfy;

--
-- Name: new_places_ideas_id_new_place_idea_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.new_places_ideas ALTER COLUMN id_new_place_idea ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.new_places_ideas_id_new_place_idea_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 99999999
    CACHE 1
);


--
-- Name: places; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.places (
    id_place integer NOT NULL,
    name character varying(100) NOT NULL,
    id_address integer NOT NULL,
    photo character varying(255) NOT NULL,
    id_city integer NOT NULL
);


ALTER TABLE public.places OWNER TO vgerxvippgozfy;

--
-- Name: places_id_place_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.places ALTER COLUMN id_place ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.places_id_place_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: roles; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.roles (
    id_role integer NOT NULL,
    role character varying(100) NOT NULL
);


ALTER TABLE public.roles OWNER TO vgerxvippgozfy;

--
-- Name: roles_id_role_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.roles ALTER COLUMN id_role ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.roles_id_role_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.users (
    id_user integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    created_at date DEFAULT now() NOT NULL,
    id_role integer DEFAULT 1 NOT NULL,
    has_dog boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO vgerxvippgozfy;

--
-- Name: users_details; Type: TABLE; Schema: public; Owner: vgerxvippgozfy
--

CREATE TABLE public.users_details (
    id_user_details integer NOT NULL,
    name character varying(100) NOT NULL,
    surname character varying(100) NOT NULL,
    id_user integer NOT NULL,
    id_city integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.users_details OWNER TO vgerxvippgozfy;

--
-- Name: users_details_id_user_details_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.users_details ALTER COLUMN id_user_details ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_details_id_user_details_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: users_id_user_seq; Type: SEQUENCE; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE public.users ALTER COLUMN id_user ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_user_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: active_walks; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.active_walks (id_active_walk, id_place, time_of_walk, started_at, id_user) OVERRIDING SYSTEM VALUE VALUES (39, 4, '1:00:00', '14:22:02.586727', 17);
INSERT INTO public.active_walks (id_active_walk, id_place, time_of_walk, started_at, id_user) OVERRIDING SYSTEM VALUE VALUES (42, 2, '1:00:00', '13:43:52.051154', 22);


--
-- Data for Name: addresses; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.addresses (id_address, postal_code, street, city, home_number, country) OVERRIDING SYSTEM VALUE VALUES (1, '30-198', 'Zygmunta Starego', 1, NULL, 'Poland');
INSERT INTO public.addresses (id_address, postal_code, street, city, home_number, country) OVERRIDING SYSTEM VALUE VALUES (5, '31-272', 'Jana Palacha', 1, '7', 'Poland');
INSERT INTO public.addresses (id_address, postal_code, street, city, home_number, country) OVERRIDING SYSTEM VALUE VALUES (6, '33-332', 'Aleja 3 Maja', 1, NULL, 'Poland');
INSERT INTO public.addresses (id_address, postal_code, street, city, home_number, country) OVERRIDING SYSTEM VALUE VALUES (4, '30-249', 'Aleja Żubrowa', 1, NULL, 'Poland');


--
-- Data for Name: cities; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.cities (id_city, name) OVERRIDING SYSTEM VALUE VALUES (1, 'Kraków');


--
-- Data for Name: dogs; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.dogs (id_dog, name, age, id_breed, gender, description, photo, id_user) OVERRIDING SYSTEM VALUE VALUES (26, 'Binia', 12, 81, false, 'Binia to piękny piesek kochający czekoladę. 🎂', 'binia.png', 17);
INSERT INTO public.dogs (id_dog, name, age, id_breed, gender, description, photo, id_user) OVERRIDING SYSTEM VALUE VALUES (27, 'Ciapek', 10, 24, false, 'lubi różnorakie pieski i nie gryzie tylko połyka ', '7557727911579606325-128.png', 22);


--
-- Data for Name: dogs_breed; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (43, 'English Cocker Spaniel', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (36, 'Belgian Malinois', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (35, 'Mastiff', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (47, 'Bichon Frise', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (26, 'English Springer Spaniel', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (5, 'Poodle', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (34, 'Basset Hound', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (27, 'Brittany', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (6, 'Bulldog', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (7, 'Beagle', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (2, 'French Bulldog', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (37, 'Chihuahua', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (38, 'Collie', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (21, 'Cane Corso', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (20, 'Bernese Mountain Dog', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (19, 'Sibierian Huskie', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (39, 'Maltese', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (17, 'Great Dane', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (10, 'Dachshund', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (16, 'Doberman Pinscher', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (33, 'Pug', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (25, 'Havanese', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (24, 'Pomeranian', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (46, 'West Highland White Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (30, 'Miniature American Shepherd', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (49, 'Dalmatian', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (11, 'Welsh Corgi Pembroke', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (40, 'Weimaraner', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (41, 'Rhodesian Ridgeback', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (23, 'Boston Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (22, 'Shih Tzu', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (51, 'Australian Cattle Dog', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (13, 'Yorkshire Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (18, 'Miniature Schnauzers', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (4, 'German Shepherd', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (15, 'Cavalier King Charles Spaniel', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (1, 'Labrador', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (81, 'Mongrel', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (14, 'Boxer', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (44, 'Portuguese Water Dog', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (12, 'Australian Shepherd', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (42, 'Shiba Inu', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (45, 'Newfoundland', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (9, 'Pointer', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (8, 'Rottweiler', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (29, 'Cocker Spaniel', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (31, 'Border Collie', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (28, 'Shetland Sheepdog', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (3, 'Golden Retriever', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (48, 'Chesapeake Bay Retriever', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (50, 'Bloodhound', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (32, 'Vizsla', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (52, 'Akita', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (56, 'Bullmastiff', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (65, 'Giant Schnauzer', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (64, 'Chinese Shar-Pei', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (66, 'Soft Coated Wheaten Terrier', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (53, 'St. Bernard', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (67, 'Cardigan Welsh Corgi', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (72, 'Russell Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (78, 'Greater Swiss Mountain Dog', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (79, 'Lagotti Romagnoli', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (58, 'Scottish Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (77, 'Chinese Crested', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (76, 'Miniature Pinschers', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (75, 'Staffordshire Bull Terrier', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (68, 'Alaskan Malamute', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (73, 'Italian Greyhound', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (55, 'Samoyed', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (71, 'Irish Setter', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (61, 'Bull Terrier', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (60, 'Wirehaired Pointing Griffon', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (63, 'Great Pyrenees', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (62, 'Airedale Terrier', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (57, 'Whippet', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (54, 'Papillon', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (80, 'Chow Chow', 2);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (74, 'Cairn Terrier', 1);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (59, 'German Wirehaired Pointer', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (70, 'Dogues de Bordeaux', 3);
INSERT INTO public.dogs_breed (id_dog_breed, name, id_dog_size) OVERRIDING SYSTEM VALUE VALUES (69, 'Old English Sheepdog', 3);


--
-- Data for Name: dogs_sizes; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.dogs_sizes (id_dog_size, name) OVERRIDING SYSTEM VALUE VALUES (1, 'Small');
INSERT INTO public.dogs_sizes (id_dog_size, name) OVERRIDING SYSTEM VALUE VALUES (2, 'Medium');
INSERT INTO public.dogs_sizes (id_dog_size, name) OVERRIDING SYSTEM VALUE VALUES (3, 'Large');


--
-- Data for Name: new_places_ideas; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.new_places_ideas (id_new_place_idea, city, name, street, id_user) OVERRIDING SYSTEM VALUE VALUES (1, 'Kraków', 'Park Jordana', 'Aleja 3 Maja', 21);
INSERT INTO public.new_places_ideas (id_new_place_idea, city, name, street, id_user) OVERRIDING SYSTEM VALUE VALUES (2, 'Kraków', 'Wybieg Jabłonkowska', 'Jabłonkowska 18', 21);


--
-- Data for Name: places; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.places (id_place, name, id_address, photo, id_city) OVERRIDING SYSTEM VALUE VALUES (1, 'Błonia', 6, 'krakow-blonia.jpg', 1);
INSERT INTO public.places (id_place, name, id_address, photo, id_city) OVERRIDING SYSTEM VALUE VALUES (2, 'Młynówka', 1, 'krakow-mlynowka.png', 1);
INSERT INTO public.places (id_place, name, id_address, photo, id_city) OVERRIDING SYSTEM VALUE VALUES (3, 'Park Krowoderski', 5, 'krakow-park-krowoderski.jpg', 1);
INSERT INTO public.places (id_place, name, id_address, photo, id_city) OVERRIDING SYSTEM VALUE VALUES (4, 'Lasek Wolski', 4, 'krakow-lasek-wolski.jpg', 1);


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.roles (id_role, role) OVERRIDING SYSTEM VALUE VALUES (1, 'User');
INSERT INTO public.roles (id_role, role) OVERRIDING SYSTEM VALUE VALUES (2, 'Admin');


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (16, 'ibobek@gmail.com', '$2y$10$MBzNEjGUrqz6tUADMXb52eZdZoH6p0w6nJbZWFAwYrEC6pDvmZ6zK', '2022-12-29', 1, false);
INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (20, 'bartek@gmail.com', '$2y$10$0ve00Qks/2/m8qSTHfnZL..1n1qUnVW9KvntPF7p63TTNc/HtaRd.', '2022-12-29', 1, false);
INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (17, 'iggi@gmail.com', '$2y$10$nC3cthZ1NL0jS7B0QOFaNeNf/63.9J9OXE9y/HudzpwJOd20Yvpwy', '2022-12-29', 1, true);
INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (18, 'anzak@gmail.com', '$2y$10$60wbVbaAh9L9vHoWayMi6uBSUZ07K7fgsQNq6DwwqYKjtsMag.mEy', '2022-12-29', 1, false);
INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (21, 'enrico@gmail.com', '$2y$10$JOsJJ/ByNScaF2yHNZjhuurpTd7i9KT.zJbT/01RwJ7vRZLZ4kmku', '2023-01-02', 2, false);
INSERT INTO public.users (id_user, email, password, created_at, id_role, has_dog) OVERRIDING SYSTEM VALUE VALUES (22, 'pipi@wp.pl', '$2y$10$aMOMLW/SzbFCGsLq6MAys./od2sfag6yqj7LQG7uRE0y8/wBnM9zK', '2023-01-04', 1, true);


--
-- Data for Name: users_details; Type: TABLE DATA; Schema: public; Owner: vgerxvippgozfy
--

INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (9, 'Igor', 'Bobek', 16, 1);
INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (10, 'Igor', 'Bobek', 17, 1);
INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (13, 'Bartłomiej', 'Grudziądz', 20, 1);
INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (11, 'Anna', 'Zakrzewska', 18, 1);
INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (14, 'Enrico', 'Łomzik', 21, 1);
INSERT INTO public.users_details (id_user_details, name, surname, id_user, id_city) OVERRIDING SYSTEM VALUE VALUES (15, 'Pipek', 'Mały', 22, 1);


--
-- Name: active_walks_id_active_walk_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.active_walks_id_active_walk_seq', 42, true);


--
-- Name: addresses_id_address_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.addresses_id_address_seq', 6, true);


--
-- Name: cities_id_city_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.cities_id_city_seq', 3, true);


--
-- Name: dogs_breed_id_dog_breed_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.dogs_breed_id_dog_breed_seq', 117, true);


--
-- Name: dogs_id_dog_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.dogs_id_dog_seq', 27, true);


--
-- Name: dogs_sizes_id_dog_size_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.dogs_sizes_id_dog_size_seq', 3, true);


--
-- Name: new_places_ideas_id_new_place_idea_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.new_places_ideas_id_new_place_idea_seq', 2, true);


--
-- Name: places_id_place_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.places_id_place_seq', 4, true);


--
-- Name: roles_id_role_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.roles_id_role_seq', 2, true);


--
-- Name: users_details_id_user_details_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.users_details_id_user_details_seq', 15, true);


--
-- Name: users_id_user_seq; Type: SEQUENCE SET; Schema: public; Owner: vgerxvippgozfy
--

SELECT pg_catalog.setval('public.users_id_user_seq', 22, true);


--
-- Name: active_walks active_walks_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.active_walks
    ADD CONSTRAINT active_walks_pk PRIMARY KEY (id_active_walk);


--
-- Name: addresses addresses_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.addresses
    ADD CONSTRAINT addresses_pk PRIMARY KEY (id_address);


--
-- Name: cities cities_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pk PRIMARY KEY (id_city);


--
-- Name: dogs_breed dogs_breed_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs_breed
    ADD CONSTRAINT dogs_breed_pk PRIMARY KEY (id_dog_breed);


--
-- Name: dogs dogs_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs
    ADD CONSTRAINT dogs_pk PRIMARY KEY (id_dog);


--
-- Name: dogs_sizes dogs_sizes_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs_sizes
    ADD CONSTRAINT dogs_sizes_pk PRIMARY KEY (id_dog_size);


--
-- Name: new_places_ideas new_places_ideas_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.new_places_ideas
    ADD CONSTRAINT new_places_ideas_pk PRIMARY KEY (id_new_place_idea);


--
-- Name: places places_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.places
    ADD CONSTRAINT places_pk PRIMARY KEY (id_place);


--
-- Name: roles roles_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pk PRIMARY KEY (id_role);


--
-- Name: users_details users_details_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.users_details
    ADD CONSTRAINT users_details_pk PRIMARY KEY (id_user_details);


--
-- Name: users users_pk; Type: CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pk PRIMARY KEY (id_user);


--
-- Name: active_walks active_walks_places_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.active_walks
    ADD CONSTRAINT active_walks_places_fk FOREIGN KEY (id_place) REFERENCES public.places(id_place) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: active_walks active_walks_users_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.active_walks
    ADD CONSTRAINT active_walks_users_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: addresses addresses_cities_null_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.addresses
    ADD CONSTRAINT addresses_cities_null_fk FOREIGN KEY (city) REFERENCES public.cities(id_city);


--
-- Name: dogs_breed dogs_breed_dogs_sizes_null_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs_breed
    ADD CONSTRAINT dogs_breed_dogs_sizes_null_fk FOREIGN KEY (id_dog_size) REFERENCES public.dogs_sizes(id_dog_size) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: dogs dogs_breed_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs
    ADD CONSTRAINT dogs_breed_fk FOREIGN KEY (id_breed) REFERENCES public.dogs_breed(id_dog_breed) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: dogs dogs_users_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.dogs
    ADD CONSTRAINT dogs_users_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: new_places_ideas new_places_ideas_users_null_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.new_places_ideas
    ADD CONSTRAINT new_places_ideas_users_null_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: places places_addresses_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.places
    ADD CONSTRAINT places_addresses_fk FOREIGN KEY (id_address) REFERENCES public.addresses(id_address) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: places places_cities_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.places
    ADD CONSTRAINT places_cities_fk FOREIGN KEY (id_city) REFERENCES public.cities(id_city) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users_details users_details_cities_id_city_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.users_details
    ADD CONSTRAINT users_details_cities_id_city_fk FOREIGN KEY (id_city) REFERENCES public.cities(id_city);


--
-- Name: users_details users_details_users_null_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.users_details
    ADD CONSTRAINT users_details_users_null_fk FOREIGN KEY (id_user) REFERENCES public.users(id_user) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users users_roles_fk; Type: FK CONSTRAINT; Schema: public; Owner: vgerxvippgozfy
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_roles_fk FOREIGN KEY (id_role) REFERENCES public.roles(id_role) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: SCHEMA heroku_ext; Type: ACL; Schema: -; Owner: u66tp9bme4bvr4
--

GRANT USAGE ON SCHEMA heroku_ext TO vgerxvippgozfy;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: vgerxvippgozfy
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: LANGUAGE plpgsql; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON LANGUAGE plpgsql TO vgerxvippgozfy;


--
-- PostgreSQL database dump complete
--

