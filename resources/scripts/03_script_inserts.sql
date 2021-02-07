/*==============================================================*/
/*CREACION DE PERFILES*/
/*==============================================================*/
INSERT INTO perfiles(codperfil, nombreperfil) VALUES (1, 'Administrador');
INSERT INTO perfiles(codperfil, nombreperfil) VALUES (2, 'WebMaster');
INSERT INTO perfiles(codperfil, nombreperfil) VALUES (3, 'Cliente');
ALTER TABLE perfiles AUTO_INCREMENT = 10;
/*==============================================================*/

/*==============================================================*/
/*CREACION DE LISTAS DE PRECIOS*/
/*==============================================================*/
INSERT INTO listasprecios(codlistaprecio, nombrelistaprecio, estado) VALUES (1, 'Mostrador', 1);
INSERT INTO listasprecios(codlistaprecio, nombrelistaprecio, estado) VALUES (2, 'Minorista', 1);
INSERT INTO listasprecios(codlistaprecio, nombrelistaprecio, estado) VALUES (3, 'Mayorista', 1);
ALTER TABLE listasprecios AUTO_INCREMENT = 4;
/*==============================================================*/

/*==============================================================*/
/*CREACION DE USUARIOS BASES DEL SISTEMA*/
/*==============================================================*/
INSERT INTO usuarios(codusuario, codperfil, tipodoc, documento, nombres, primerapellido, segundoapellido, correo, direccion, telefono, celular, fechanacimiento, 
					 genero, nombreusuario, clave, codubicacion, imagencodificada, mime, tamanno, nombreimagen, fechacreacion, estado, codlistaprecio)
VALUES (1, 1, 'CC', 'XXX', 'JHON JAIRO', 'CORTES', 'PAREDES', 'JHONJAIRO.CORTESP@LIVE.COM', 'XXX', 'XXX', 'XXX', '1988-05-23', 
		1, 'jhonjairo.cortesp@live.com', 'c68b4f3691f7cf7d940c220f7b999a7b', 892, '215456456465454.png', 'image/png', '10mb', 'jhonjairo.cortesp.png', '2018/02/03', 1, 1);
				
ALTER TABLE usuarios AUTO_INCREMENT = 2;
/*==============================================================*/

