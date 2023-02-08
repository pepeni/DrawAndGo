create sequence table_name_id_seq
    as integer;

alter sequence table_name_id_seq owner to dbuser;

create sequence lockeves_id_seq
    as integer;

alter sequence lockeves_id_seq owner to dbuser;

create table users_details
(
    id         serial
        constraint users_details_pk
            primary key,
    created_at varchar(100) not null
);

alter table users_details
    owner to dbuser;

create table users
(
    id               integer default nextval('schema.table_name_id_seq'::regclass) not null
        constraint id
            primary key,
    nick             varchar(100)                                                  not null,
    email            varchar(100)                                                  not null,
    password         varchar(255)                                                  not null,
    id_users_details integer                                                       not null
        constraint users_users_details_id_fk
            references users_details
            on update cascade on delete cascade,
    admin            boolean default false                                         not null
);

alter table users
    owner to dbuser;

alter sequence table_name_id_seq owned by users.id;

create table loceves
(
    id              integer default nextval('schema.lockeves_id_seq'::regclass) not null
        constraint lockeves_pk
            primary key,
    name            varchar(100)                                                not null,
    description     varchar(1000)                                               not null,
    rating          integer                                                     not null,
    website         varchar(100)                                                not null,
    price           integer                                                     not null,
    image           varchar(100)                                                not null,
    number_of_votes integer                                                     not null,
    created_at      varchar(50)                                                 not null,
    event           boolean default false                                       not null,
    id_users        integer                                                     not null
        constraint lockeves_users_id_fk
            references users
            on update cascade on delete set null
);

alter table loceves
    owner to dbuser;

alter sequence lockeves_id_seq owned by loceves.id;

create table were_there
(
    id_user   integer not null
        constraint were_there_users_id_fk
            references users
            on update cascade on delete cascade,
    id_loceve integer not null
        constraint were_there_lockeves_id_fk
            references loceves
            on update cascade on delete cascade
);

alter table were_there
    owner to dbuser;

create table ratings
(
    id_user   integer not null
        constraint ratings_users_id_fk
            references users
            on update cascade on delete cascade,
    id_loceve integer not null
        constraint ratings_lockeves_id_fk
            references loceves
            on update cascade on delete cascade,
    rating    integer not null
);

alter table ratings
    owner to dbuser;


