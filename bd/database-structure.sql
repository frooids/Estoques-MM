use restaurante_bd;

create table `usuario` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `situacao` varchar(255) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

alter table `usuario` add column nome varchar(255) default null;

insert into `usuario` values (null, 'email@gmail.com', 'Habilitado', '25d55ad283aa400af464c76d713c07ad');
# a senha acima é 12345678 encriptada #

select *from `usuario`;
--
create table `produto` (
  `codigo` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) DEFAULT NULL,
  `valor` decimal(7,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `info_adicional` varchar(255) DEFAULT NULL,
  `codigo_usuario` int NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

alter table `produto` add column data_hora datetime default now();
select *from `produto`;


