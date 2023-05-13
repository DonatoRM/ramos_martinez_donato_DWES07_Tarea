create database proyecto default character set=utf8mb4 collate=utf8mb4_unicode_ci;
create user 'gestor'@'localhost' identified by 'secreto';
grant all on proyecto.* to 'gestor'@'localhost';
use proyecto;
create table if not exists tiendas(
    id int auto_increment,
    nombre varchar(100) not null,
    tlf varchar(13) null,
    constraint pk_tie primary key(id)
);
create table if not exists familias(
    cod varchar(6),
    nombre varchar(200) not null,
    constraint pk_fam primary key(cod)
);
create table if not exists productos(
    id int auto_increment,
    nombre varchar(200) not null,
    nombre_corto varchar(50) unique not null,
    descripcion text null,
    pvp decimal(10,2) not null,
    familia varchar(6) not null,
    constraint pk_pro primary key(id),
    constraint fk_prod_fam foreign key(familia) references familias(cod) on update cascade on delete cascade
);
create table if not exists stocks(
    producto int,
    tienda int,
    unidades int unsigned not null,
    constraint pk_sto primary key(producto,tienda),
    constraint fk_sto_pro foreign key(producto) references productos(id) on update cascade on delete cascade,
    constraint fk_sto_tie foreign key(tienda) references tiendas(id) on update cascade on delete cascade
);
create table if not exists usuarios(
usuario varchar(20) primary key,
pass varchar(64) not null
);
create table if not exists votos(
    id int auto_increment primary key,
    cantidad int default 0,
    idPr int not null,
    idUs varchar(20) not null,
    constraint fk_votos_usu foreign key(idUs) references usuarios(usuario) on delete cascade on update cascade,
    constraint fk_votos_pro foreign key(idPr) references productos(id) on delete cascade on update cascade
);