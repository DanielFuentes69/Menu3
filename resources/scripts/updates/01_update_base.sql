/*==============================================================*/
/* Table: categorias                                            */
/*==============================================================*/
create table categorias
(
   codcategoria         int not null auto_increment  comment '',
   nombrecategoria      varchar(300) not null  comment '',
   estado               smallint not null  comment '1 - activo
             2 - inactivo',
   primary key (codcategoria)
);

/*==============================================================*/
/* Table: listasprecios                                         */
/*==============================================================*/
create table listasprecios
(
   codlistaprecio       int not null auto_increment  comment '',
   nombrelistaprecio    varchar(200) not null  comment '',
   estado               smallint not null  comment '1 - activo
             2 - inactivo',
   primary key (codlistaprecio)
);

/*==============================================================*/
/* Table: productos                                             */
/*==============================================================*/
create table productos
(
   codproducto          int not null auto_increment  comment '',
   codcategoria         int not null  comment '',
   nombreproducto       text not null  comment '',
   referencia           varchar(100) not null  comment '',
   descripcion          text not null  comment '',
   primary key (codproducto)
);

alter table productos add constraint fk_producto_refe_categori foreign key (codcategoria)
      references categorias (codcategoria) on delete restrict on update cascade;
	  
/*==============================================================*/
/* Table: imagenes                                              */
/*==============================================================*/
create table imagenes
(
   codimagen            int not null auto_increment  comment '',
   codproducto          int not null  comment '',
   nombrereal           varchar(200) not null  comment '',
   nombrecodificado     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   primary key (codimagen)
);

alter table imagenes add constraint fk_imagenes_ref_producto foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;

/*==============================================================*/
/* Table: precios                                               */
/*==============================================================*/
create table precios
(
   codlistaprecio       int not null  comment '',
   codproducto          int not null  comment '',
   valor                numeric(10,2) not null  comment '',
   primary key (codlistaprecio, codproducto)
);

alter table precios add constraint fk_precios_ref_listaspr foreign key (codlistaprecio)
      references listasprecios (codlistaprecio) on delete restrict on update cascade;

alter table precios add constraint fk_precios_ref_producto foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;

--------------------------------------------------------------------------------
-- ALTER TABLA USUARIOS
--------------------------------------------------------------------------------
ALTER TABLE usuarios add COLUMN codlistaprecio INT;
alter table usuarios add constraint fk_usuarios_ref_listaspr foreign key (codlistaprecio)
      references listasprecios (codlistaprecio) on delete restrict on update cascade;
UPDATE usuarios SET codlistaprecio=1;
--------------------------------------------------------------------------------
