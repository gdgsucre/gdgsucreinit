CREATE TABLE roles
(
    id serial NOT NULL,
    name character varying(30) NOT NULL,
    status character DEFAULT 'A', --A:active,I:Inactive
    created datetime NOT NULL,
    modified datetime,
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
    last_access datetime,
    last_ip character varying(15),
    last_change_password datetime,
    remember_token character varying(100),
    status character DEFAULT 'A', --A:active,I:Inactive
    created datetime NOT NULL,
    modified datetime,
    created_by integer NOT NULL,
    modified_by integer,
    role_id integer NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES roles (id)
);

CREATE TABLE participants (
    id serial NOT NULL,
    name character varying(180) NOT NULL,
    email character varying(90),
    ci integer,
    team character varying(90),
    mobile numeric(8,0) NOT NULL,
    qr character varying(240) NOT NULL,
    gender character,
    type character DEFAULT 'P',
    printed character DEFAULT 'N',
    status character DEFAULT 'A',
    validate boolean default false,
    created datetime NOT NULL,
    modified datetime,
    created_by integer NOT NULL,
    modified_by integer,
    PRIMARY KEY (id)
);

CREATE TABLE types(
    id serial NOT NULL,
    name character varying(30) NOT NULL,
    alias character varying(30) NOT NULL,
    created datetime NOT NULL,
    modified datetime,
    created_by integer NOT NULL,
    modified_by integer,
    PRIMARY KEY (id)
);

CREATE TABLE types_participants (
    id serial NOT NULL,
    type_id integer NOT NULL REFERENCES types(id),
    participant_id integer NOT NULL REFERENCES participants(id),
    PRIMARY KEY (id),
    UNIQUE (type_id, participant_id)
);

CREATE TABLE logs_accesses
(
    id serial NOT NULL,
    ip varchar(15) NOT NULL,
    income_date timestamp NOT NULL,
    departure_date timestamp,
    additional_data text,
    user_id integer NOT NULL REFERENCES users(id),
    PRIMARY KEY (id)
);


INSERT INTO roles (id, name, created, created_by)
VALUES (1, 'Administrador', NOW(), 1);
INSERT INTO roles (id, name, created, created_by)
VALUES (2, 'Credenciales', NOW(), 1);
