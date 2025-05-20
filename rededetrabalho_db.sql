create database dbRedeDeTrabalho;

use dbrededetrabalho;

create table tbUsuario(
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

INSERT INTO tbUsuario (
    nome_usua, login_usua, senha_usua, end_usua, profis_usua, email_usua, tel_usua, cel_usua, cpf_usua, sexo_usua
) VALUES (
    'Ana Paula', 'anap', 'senha123', 'Rua das Flores, 123', 'Professora', 'ana.paula@email.com', '1133221100', '1199887766', '123.456.789-00', 'F'
),(
    'Carlos Silva', 'carlos.s', 'seguro456', 'Av. Central, 456', 'Engenheiro', 'carlos.silva@email.com', '1122334455', '1199776655', '987.654.321-00', 'M'
);