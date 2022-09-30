create table customer
(
    id   int(11) unsigned auto_increment
        primary key,
    name tinytext not null,
    data text     null
);

create table equipment
(
    id          int(11) unsigned auto_increment
        primary key,
    customer_id int(11) unsigned not null,
    name        tinytext         not null,
    mark        tinytext         null,
    city        tinytext         null comment 'город, где живет этот станок',
    address     tinytext         null comment 'адрес объекта',
    serial      tinytext         null comment 'серийный № станка',
    notes       text             null,
    constraint `equipment-customer`
        foreign key (customer_id) references customer (id)
            on update cascade on delete cascade
);

create table document
(
    id           int(11) unsigned auto_increment
        primary key,
    equipment_id int(11) unsigned null,
    filename     text             null,
    constraint `document-equipment`
        foreign key (equipment_id) references equipment (id)
            on update cascade on delete cascade
);

create index `doc-equip`
    on document (equipment_id);

create index `equip-cust`
    on equipment (customer_id);

create table request
(
    id           int(11) unsigned auto_increment
        primary key,
    equipment_id int(11) unsigned                     null comment 'на какой станок заявка',
    name         tinytext                             null,
    status       tinyint(1) default 0                 not null comment '0: новая, 1: в работе; 2: готово',
    notes        text                                 null,
    created      timestamp  default CURRENT_TIMESTAMP null,
    updated      timestamp  default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    constraint `request-equipment`
        foreign key (equipment_id) references equipment (id)
            on update cascade on delete cascade
);

create table payment
(
    id         int(11) unsigned auto_increment
        primary key,
    request_id int unsigned                        null,
    type       tinyint(1)                          null comment '1 — работы, 0 — накладные расходы',
    sum        int                                 null comment 'в копейках',
    note       varchar(14)                         null,
    created    timestamp default CURRENT_TIMESTAMP null,
    constraint `payment-request`
        foreign key (request_id) references request (id)
            on update cascade on delete cascade
);

create index `paym-req`
    on payment (request_id);

create index `req-eqip`
    on request (equipment_id);

create table users
(
    id       int unsigned auto_increment
        primary key,
    username varchar(255) not null,
    password varchar(255) not null,
    constraint username
        unique (username)
)
    charset = utf8mb4;


