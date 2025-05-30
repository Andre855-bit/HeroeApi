
create database android;

use android;

CREATE TABLE `heroes` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `realname` varchar(200) NOT NULL,
  `rating` int NOT NULL,
  `teamaffiliation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `heroes` (`id`, `name`, `realname`, `rating`, `teamaffiliation`)
VALUES (1, 'Captain', 'Steve', 3, 'Avengers'),
(2, 'Batman', 'Bruce Wayne', 5, 'Justice League');

ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `heroes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


  create table tbUsuariosERROR(
cod_usua int not null auto_increment,
nome_usua varchar(50) not null,
login_usua varchar(20) not null,
senha_usua varchar(12) not null,
end_usua varchar(50) not null,
profis_usua varchar(30) not null,
email_usua varchar(50) not null unique,
tel_usua char(10),
cel_usua char(10) not null,
cpf_usua char(14) not null unique,
sexo_usua char(1) default "X" check(sexo_usua in("F","M","X")),
primary key (cod_usua));

INSERT INTO tbUsuariosERROR (
    nome_usua, login_usua, senha_usua, end_usua, profis_usua, email_usua, tel_usua, cel_usua, cpf_usua, sexo_usua
) VALUES (
    'Ana Paula', 'anap', 'senha123', 'Rua das Flores, 123', 'Professora', 'ana.paula@email.com', '1133221100', '1199887766', '123.456.789-00', 'F'
),(
    'Carlos Silva', 'carlos.s', 'seguro456', 'Av. Central, 456', 'Engenheiro', 'carlos.silva@email.com', '1122334455', '1199776655', '987.654.321-00', 'M'
);



create table tbUsuarios(
cod_usua int not null auto_increment,
nome_usua varchar(50) not null,
usuario_usua varchar(20) not null,
senha_usua varchar(12) not null,
email_usua varchar(50) not null unique,
cel_usua char(10),
primary key (cod_usua));

INSERT INTO tbUsuarios (nome_usua, usuario_usua, senha_usua, email_usua, cel_usua) 
VALUES 
('João Silva', 'joaosilva', 'senha123', 'joao.silva@email.com', '9876543210'),
('Maria Oliveira', 'mariaoliveira', 'senha456', 'maria.oliveira@email.com', '9123456789');



create table tbLojas(
cod_loja int not null auto_increment,
cod_usua int not null,
cnpj_loja char(15) not null,
nome_loja varchar(50) not null unique,
imagem_loja longblob,
desc_loja varchar(255),
end_loja varchar(100),
email_loja varchar(50) not null,
cel_loja char(13),
tel_loja char(13),
primary key(cod_loja, nome_loja),
foreign key(cod_usua) references tbUsuarios(cod_usua));

INSERT INTO tbLojas (
    cod_usua, cnpj_loja, nome_loja, imagem_loja, desc_loja, end_loja, email_loja, cel_loja, tel_loja
) VALUES (
     1, '12345678000190', 'Loja das Flores', NULL, 
    'Loja especializada em flores ornamentais e buquês.', 
    'Rua Jardim Primavera, 101', 
    'contato@lojaflores.com', '11999998888', '1133221100'
),(
     2, '98765432000155', 'Tech Mania', NULL, 
    'Loja de eletrônicos e acessórios tecnológicos.', 
    'Av. Inovação, 404', 
    'suporte@techmania.com.br', '11988887777', '1144332211'
);


create table tbServicos(
cod_serv int not null auto_increment,
cod_usua int not null,
nome_serv varchar(50) not null,
desc_serv varchar(250) not null,
valor_serv decimal (5,2) not null,
imagem_serv longblob,
primary key(cod_serv),
foreign key (cod_usua) references tbUsuarios(cod_usua));

INSERT INTO tbServicos (
    cod_usua, nome_serv, desc_serv, valor_serv, imagem_serv
) VALUES (
    1, 
    'Aula particular de matemática', 
    'Aulas para ensino fundamental e médio, com foco em reforço escolar e vestibulares.', 
    75.00, 
    NULL
),(
    2, 
    'Consultoria em obras residenciais', 
    'Análise estrutural, acompanhamento de obras e elaboração de projetos civis.', 
    200.00, 
    NULL -- Imagem será enviada depois
);