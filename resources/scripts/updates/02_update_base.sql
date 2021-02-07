-------------------------------------------------------------------------------
-- ALTER TABLA productos
--------------------------------------------------------------------------------
ALTER TABLE productos add COLUMN iva numeric(10, 2);
UPDATE productos set iva = 19;
ALTER TABLE productos MODIFY iva numeric(10, 2) NOT NULL;


/*==============================================================*/
/* nueva tabla: pedidos                                               */
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
/* nueva tabla: detallepedidos                                        */
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

alter table detallepedidos add constraint fk_detallepro_ref_pedidos foreign key (codpedido)
      references pedidos (codpedido) on delete restrict on update cascade;

alter table detallepedidos add constraint fk_detallepro_ref_productos foreign key (codproducto)
      references productos (codproducto) on delete restrict on update cascade;
