CREATE TABLE roles
(
    id serial NOT NULL,
    name character varying(30) NOT NULL,
    status character DEFAULT 'A', --A:active,I:Inactive
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer NOT NULL,
    modified_by integer,
    PRIMARY KEY (id)
);

CREATE TABLE users
(
    id serial NOT NULL,
    document character varying(30) NOT NULL,
    firstname character varying(60) NOT NULL,
    lastname character varying(60) NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(60) NOT NULL,
    email character varying(60),
    address character varying(60),
    mobile character varying(15),
    phone character varying(15),
    last_access timestamp without time zone,
    last_ip character varying(15),
    last_change_password timestamp without time zone,
    remember_token character varying(100),
    status character DEFAULT 'A', --A:active,I:Inactive
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer NOT NULL,
    modified_by integer,
    role_id integer NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES roles (id)
);

CREATE TABLE participants (
    id serial,
    name character varying(180) NOT NULL,
    email character varying(90) NOT NULL,
    mobile numeric(8,0) NOT NULL,
    qr character varying(240) NOT NULL,
    gender character,
    occupation character varying(180) NOT NULL,
    skills text,
    technologies text,
    type character DEFAULT 'B',
    status character DEFAULT 'A',
    created timestamp without time zone NOT NULL,
    modified timestamp without time zone,
    created_by integer NOT NULL,
    modified_by integer,
    PRIMARY KEY (id)
);
