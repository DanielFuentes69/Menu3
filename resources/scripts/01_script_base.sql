/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     8/11/2020 11:01:25 p. m.                     */
/*==============================================================*/


/*==============================================================*/
/* Table: accesos                                               */
/*==============================================================*/
create table accesos
(
   codacceso            int not null auto_increment  comment '',
   codusuario           int  comment '',
   fechaingreso         date not null  comment '',
   horaingreso          time not null  comment '',
   ipoculta             varchar(50)  comment '',
   ipvisible            varchar(50)  comment '',
   primary key (codacceso)
);

/*==============================================================*/
/* Table: archivos                                              */
/*==============================================================*/
create table archivos
(
   codarchivo           int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   tipo                 smallint not null  comment '',
   valorpagado          numeric  comment '',
   primary key (codarchivo)
);

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
/* Table: clientes                                              */
/*==============================================================*/
create table clientes
(
   codcliente           int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   nombre               varchar(300) not null  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   primary key (codcliente)
);

/*==============================================================*/
/* Table: detallepedidos                                        */
/*==============================================================*/
create table detallepedidos
(
   coddetallepedido     int not null auto_increment  comment '',
   codpedido            int not null  comment '',
   codproducto          int not null  comment '',
   cantidad             int not null  comment '',
   valor                numeric(10, 2) not null  comment '',
   impuesto             numeric(10, 2) not null  comment '',
   totalparcial         numeric(10, 2) not null  comment '',
   primary key (coddetallepedido)
);

/*==============================================================*/
/* Table: funcionalidades                                       */
/*==============================================================*/
create table funcionalidades
(
   codfunc              int not null auto_increment  comment '',
   codpadre             int  comment '',
   nombre               varchar(100) not null  comment '',
   identificador        varchar(30) not null  comment '',
   orden                int not null  comment '',
   urlpagina            varchar(100)  comment '',
   target               varchar(50) not null default '_parent'  comment '',
   icono                varchar(100)  comment '',
   tipo                 varchar(10) not null default 'text'  comment '',
   primary key (codfunc)
);

alter table funcionalidades comment 'Almacena todas las funcionalidades del sistema';

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
/* Table: noticias                                              */
/*==============================================================*/
create table noticias
(
   codnoticia           int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   titulo               varchar(300) not null  comment '',
   descripcion          text not null  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   tipo                 int not null  comment '1 - facturacion electronica
             2 - facturacion
             3 - Financiero
             4 - Seguridad
             5 - Informativo
             6 - Gerencia
             7 - Soporte
             8 - Cartera
             9 - Ventas
             10 - Judicial
             
             ',
   cantmegusta          int not null  comment '',
   primary key (codnoticia)
);

/*==============================================================*/
/* Table: pedidos                                               */
/*==============================================================*/
create table pedidos
(
   codpedido            int not null auto_increment  comment '',
   identificador        varchar(50) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   documento            varchar(50) not null  comment '',
   nombrecliente        varchar(500) not null  comment '',
   correo               varchar(100) not null  comment '',
   direccion            varchar(500) not null  comment '',
   celular              varchar(50) not null  comment '',
   despachado           smallint not null default 2  comment '1 entregado
             2 pendiente',
   primary key (codpedido)
);

/*==============================================================*/
/* Table: perfiles                                              */
/*==============================================================*/
create table perfiles
(
   codperfil            int not null auto_increment  comment '',
   nombreperfil         varchar(200) not null  comment '',
   primary key (codperfil)
);

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

/*==============================================================*/
/* Table: preguntas                                             */
/*==============================================================*/
create table preguntas
(
   codpregunta          int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   pregunta             text not null  comment '',
   respuesta            text not null  comment '',
   primary key (codpregunta)
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
   iva                  numeric(10,2) not null  comment '',
   primary key (codproducto)
);

/*==============================================================*/
/* Table: promociones                                           */
/*==============================================================*/
create table promociones
(
   codpromocion         int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   titulo               varchar(300) not null  comment '',
   nombreproducto       varchar(512) not null  comment '',
   descripcion          text not null  comment '',
   porcentaje           varchar(10) not null  comment '',
   fechafin             date not null  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   primary key (codpromocion)
);

/*==============================================================*/
/* Table: rel_functipousu                                       */
/*==============================================================*/
create table rel_functipousu
(
   codfunc              int not null  comment '',
   codperfil            int not null  comment '',
   primary key (codfunc, codperfil)
);

/*==============================================================*/
/* Table: rel_funcusuarios                                      */
/*==============================================================*/
create table rel_funcusuarios
(
   codusuario           int not null  comment '',
   codfunc              int not null  comment '',
   favorito             smallint not null default 2  comment '1 Inicia con esta opcion por defecto
             2 Inicia con la opcion del sistema',
   primary key (codusuario, codfunc)
);

/*==============================================================*/
/* Table: slider                                                */
/*==============================================================*/
create table slider
(
   codslider            int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   titulo1              text  comment '',
   titulo2              text  comment '',
   textoboton           text  comment '',
   urlboton             text  comment '',
   descripcion          text  comment '',
   colortexto           int not null  comment '1 - negro
             2 - blanco',
   active               int not null  comment '',
   primary key (codslider)
);

/*==============================================================*/
/* Table: team                                                  */
/*==============================================================*/
create table team
(
   codteam              int not null auto_increment  comment '',
   codusuario           int not null  comment '',
   nombre               varchar(200) not null  comment '',
   cargo                varchar(200) not null  comment '',
   facebook             varchar(500)  comment '',
   twitter              varchar(500)  comment '',
   instagram            varchar(500)  comment '',
   youtube              varchar(500)  comment '',
   linkedin             varchar(500)  comment '',
   imagencodificada     varchar(200) not null  comment '',
   mime                 varchar(200) not null  comment '',
   tamanno              varchar(200) not null  comment '',
   nombreimagen         varchar(200) not null  comment '',
   fecha                date not null  comment '',
   hora                 time not null  comment '',
   primary key (codteam)
);

/*==============================================================*/
/* Table: ubicaciones                                           */
/*==============================================================*/
create table ubicaciones
(
   codubicacion         int not null auto_increment  comment '',
   codpadre             int  comment '',
   identificador        varchar(30) not null  comment '',
   nombre               varchar(200) not null  comment '',
   tipo                 varchar(10) not null  comment '',
   primary key (codubicacion)
);

/*==============================================================*/
/* Table: usuarios                                              */
/*==============================================================*/
create table usuarios
(
   codusuario           int not null auto_increment  comment '',
   codperfil            int not null  comment '',
   codubicacion         int  comment '',
   codlistaprecio       int  comment '',
   tipodoc              varchar(3) default 'CC'  comment '',
   documento            varchar(30)  comment '',
   nombres              varchar(100)  comment '',
   primerapellido       varchar(100)  comment '',
   segundoapellido      varchar(100)  comment '',
   correo               varchar(200)  comment '',
   direccion            varchar(100)  comment '',
   telefono             varchar(30)  comment '',
   celular              varchar(30)  comment '',
   whastapp             varchar(100)  comment '',
   fechanacimiento      date  comment '',
   genero               smallint default 1  comment '1 Masculino
             2 Femenino',
   nombreusuario        varchar(100)  comment '',
   clave                varchar(50)  comment '',
   imagencodificada     varchar(200)  comment '',
   mime                 varchar(200)  comment '',
   tamanno              varchar(200)  comment '',
   nombreimagen         varchar(200)  comment '',
   fechacreacion        date  comment '',
   estado               smallint not null  comment '1 activo
             2 inactivo',
   edad                 smallint  comment '',
   tipousuario          smallint  comment '',
   tratamientodatos     smallint  comment '1 - acepto
             2 - no acepto',
   direccionjudicial    text  comment '',
   matriculamercantil   varchar(100)  comment '',
   representantelegal   varchar(300)  comment '',
   digitoverificacion   int  comment '',
   primary key (codusuario)
);

alter table accesos add constraint fk_accesos_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table archivos add constraint fk_archivos_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete restrict on update cascade;

alter table clientes add constraint fk_clientes_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table detallepedidos add constraint fk_detallepro_ref_pedidos foreign key (codpedido)
      references pedidos (codpedido) on delete restrict on update cascade;

alter table detallepedidos add constraint fk_detallepro_ref_productos foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;

alter table funcionalidades add constraint fk_func_ref_func foreign key (codpadre)
      references funcionalidades (codfunc) on delete cascade on update cascade;

alter table imagenes add constraint fk_imagenes_ref_producto foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;

alter table noticias add constraint fk_noticias_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table precios add constraint fk_precios_ref_listaspr foreign key (codlistaprecio)
      references listasprecios (codlistaprecio) on delete restrict on update cascade;

alter table precios add constraint fk_precios_ref_producto foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;

alter table preguntas add constraint fk_pregunta_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table productos add constraint fk_producto_refe_categori foreign key (codcategoria)
      references categorias (codcategoria) on delete restrict on update cascade;

alter table promociones add constraint fk_promocio_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table rel_functipousu add constraint fk_func_ref_tipousuario foreign key (codfunc)
      references funcionalidades (codfunc) on delete cascade on update cascade;

alter table rel_functipousu add constraint fk_perfil_ref_relmenusu foreign key (codperfil)
      references perfiles (codperfil) on delete cascade on update cascade;

alter table rel_funcusuarios add constraint fk_usu_ref_relmenusu foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table rel_funcusuarios add constraint fk_func_ref_relmenusu foreign key (codfunc)
      references funcionalidades (codfunc) on delete cascade on update cascade;

alter table slider add constraint fk_slider_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table team add constraint fk_team_ref_usuarios foreign key (codusuario)
      references usuarios (codusuario) on delete cascade on update cascade;

alter table ubicaciones add constraint fk_ubicacion_ref_ubicacion foreign key (codpadre)
      references ubicaciones (codubicacion) on delete restrict on update cascade;

alter table usuarios add constraint fk_usuarios_ref_perfiles foreign key (codperfil)
      references perfiles (codperfil) on delete cascade on update cascade;

alter table usuarios add constraint fk_usuarios_ref_listaspr foreign key (codlistaprecio)
      references listasprecios (codlistaprecio) on delete restrict on update cascade;

alter table usuarios add constraint fk_usuarios_ref_ubicacio foreign key (codubicacion)
      references ubicaciones (codubicacion) on delete cascade on update cascade;

