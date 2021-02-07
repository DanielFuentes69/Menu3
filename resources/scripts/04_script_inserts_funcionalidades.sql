/*==============================================================*/
/*MENUS PRINCIPALES*/
/*==============================================================*/
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (1,NULL,'MENU_SYSTEM_MOON','SYS_MOON','1','URLPAGES','_parent','URLPAGES','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (2,1,'Configuración','MNTO_CONFIGURACION','2','URLPAGES','_parent','fa fa-gear','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (3,1,'Página Web','MNTO_SLIDER','3','URLPAGES','_parent','fa fa-dashboard','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (4,1,'Tienda En Línea','MNTO_TIENDA','4','URLPAGES','_parent','fa fa-shopping-cart','text');
/*==============================================================*/

/*==============================================================*/
/*MENU CONFIGURACION*/
/*==============================================================*/
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (13,2,'Perfiles','MNTO_PER','1','krauff/views/perfiles_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (14,2,'Usuarios','MNTO_USU','2','krauff/views/usuarios_admin.php','_parent','','text');
/*==============================================================*/

/*==============================================================*/
/*MENU PAGINA WEB*/
/*==============================================================*/
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (21,3,'Gestionar Slider','MNTO_SLIDER','1','webpage/views/slider_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (22,3,'Gestionar Equipo','MNTO_TEAM','2','webpage/views/equipotrabajo_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (23,3,'Gestionar Blog','MNTO_BLOG','3','webpage/views/noticias_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (24,3,'Gestionar Clientes','MNTO_CLI','4','webpage/views/clientes_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (25,3,'Gestionar Preguntas','MNTO_PRE','5','webpage/views/preguntas_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (26,3,'Gestionar Promociones','MNTO_PROM','6','webpage/views/promociones_admin.php','_parent','','text');
--INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (27,3,'Gestionar Servicios','MNTO_SER','7','webpage/views/servicios_admin.php','_parent','','text');
/*==============================================================*/

/*==============================================================*/
/*MENU TIENDA EN LINEA*/
/*==============================================================*/
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (30,4,'Categorias','MNTO_CAT','1','tienda/views/categorias_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (31,4,'Listas Precios','MNTO_LPRE','2','tienda/views/listas_precios_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (32,4,'Productos','MNTO_PRO','3','tienda/views/productos_admin.php','_parent','','text');
INSERT INTO funcionalidades(codfunc,codpadre,nombre,identificador,orden,urlpagina,target,icono,tipo) VALUES (33,4,'Pedidos','MNTO_PED','4','tienda/views/pedidos_admin.php','_parent','','text');
/*==============================================================*/

/*==============================================================*/
/*ASIGNACION DE FUNCIONALIDADES A USUARIOS*/
/*==============================================================*/
INSERT into rel_funcusuarios (codusuario, codfunc) select 1,codfunc FROM funcionalidades;
/*==============================================================*/


