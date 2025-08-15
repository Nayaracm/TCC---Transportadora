create database bd_gerenciamento_tcc;

use bd_gerenciamento_tcc;

create table tb_login(
	id_login char(18) not null,
    cd_senha char(30) not null,
		primary key(id_login));
        
create table tb_contato(
    id_contato int not null auto_increment,
    nr_celular varchar(11),
    nr_telefone varchar(9),
		primary key (id_contato));
        
create table tb_cep(
    cd_cep int not null auto_increment,
    nr_cep char(8),
		primary key (cd_cep));
        
create table tb_motorista(
		id_motorista int not null auto_increment,
        nm_motorista varchar(100) not null,
        nr_cpf char(11) not null,
        nr_telefone char(11) not null,
        primary key (id_motorista));
        
     create table tb_bairro(
     id_bairro int not null auto_increment,
	 nm_bairro varchar(60),
		primary key(id_bairro));
     
     create table tb_cidade(
     id_cidade int not null auto_increment,
     nm_cidade varchar (60),
		primary key(id_cidade));
        
	CREATE TABLE tb_endereco (
    id_endereco INT NOT NULL AUTO_INCREMENT,
    ds_rua VARCHAR(60) NOT NULL,
    nr_casa INT NOT NULL,
    ds_complemento VARCHAR(200),
    id_bairro INT NOT NULL,
    id_cidade INT NOT NULL,
    id_cep INT NOT NULL,
    PRIMARY KEY (id_endereco),
    FOREIGN KEY (id_bairro) REFERENCES tb_bairro(id_bairro),
    FOREIGN KEY (id_cep) REFERENCES tb_cep(cd_cep),
    FOREIGN KEY (id_cidade) REFERENCES tb_cidade(id_cidade));

    create table tb_cliente(
	id_cliente int not null auto_increment,
    cd_cpf char(11),
    cd_cnpj char(14),
    nm_cliente varchar(70) not null,
    id_contato int not null,
    id_endereco int not null,
		primary key (id_cliente),
		foreign key (id_contato) references tb_contato(id_contato),
        foreign key (id_endereco) references tb_endereco(id_endereco));
        
	create table tb_encomenda(
	id_encomenda int auto_increment not null,
    nm_encomenda varchar(200) not null,
    ds_encomenda varchar(500),
    qt_peso_encomenda int not null,
    nm_status_encomenda varchar(20) not null,
    id_cliente int,
		primary key (id_encomenda),
        foreign key (id_cliente) references tb_cliente(id_cliente) ON DELETE CASCADE);

select * from tb_encomenda;

CREATE VIEW vw_cliente_encomenda AS
SELECT 
	en.id_encomenda,
    en.nm_encomenda,
    cl.nm_cliente,
    ed.ds_rua,
    ci.nm_cidade,
    ba.nm_bairro,
    ce.nr_cep,
    ed.nr_casa,
    ed.ds_complemento,
    en.ds_encomenda,
    en.qt_peso_encomenda,
    en.nm_status_encomenda
FROM tb_encomenda AS en
INNER JOIN tb_cliente AS cl ON en.id_cliente = cl.id_cliente
INNER JOIN tb_endereco AS ed ON cl.id_endereco = ed.id_endereco
INNER JOIN tb_cidade AS ci ON ed.id_cidade = ci.id_cidade
INNER JOIN tb_bairro AS ba ON ed.id_bairro = ba.id_bairro
INNER JOIN tb_cep AS ce ON ed.id_cep = ce.cd_cep;
 drop view vw_cliente_encomenda;
select * from vw_cliente_encomenda;

INSERT INTO tb_cep (nr_cep) VALUES ('11300000'), ('11310000');
INSERT INTO tb_cidade (nm_cidade) VALUES ('São Vicente'), ('Santos');
INSERT INTO tb_bairro (nm_bairro) VALUES ('Centro'), ('Boa Vista');

INSERT INTO tb_endereco (ds_rua, nr_casa, ds_complemento, id_bairro, id_cidade, id_cep)
VALUES 
('Rua das Flores', 123, 'Apto 2', 1, 1, 1),
('Av. Brasil', 456, NULL, 2, 2, 2);

INSERT INTO tb_contato (nr_celular, nr_telefone)
VALUES 
('11999999999', '123456789'),
('11988888888', '987654321');

INSERT INTO tb_cliente (cd_cpf, cd_cnpj, nm_cliente, id_contato, id_endereco)
VALUES 
('12345678901', NULL, 'João Silva', 1, 1),
(NULL, '98765432100012', 'Empresa XYZ', 2, 2);

INSERT INTO tb_encomenda (nm_encomenda, ds_encomenda, qt_peso_encomenda, nm_status_encomenda, id_cliente)
VALUES 
('Pratos', 'Uma coletânea de pratos.', 5, 'Pendente', 1),
('Mesas', 'Uma coletânea de mesas.', 10, 'Em transporte', 2),
('Pratos', 'Uma coletânea de pratos.', 5, 'Pendente', 1),
('Mesas', 'Uma coletânea de mesas.', 10, 'Em transporte', 2),
('Pratos', 'Uma coletânea de pratos.', 5, 'Pendente', 1),
('Mesas', 'Uma coletânea de mesas.', 10, 'Em transporte', 2),
('Pratos', 'Uma coletânea de pratos.', 5, 'Pendente', 1),
('Mesas', 'Uma coletânea de mesas.', 10, 'Em transporte', 2),
('Cadeiras', 'Conjunto de cadeiras de madeira.', 8, 'Entregue', 1);

insert into tb_login(id_login, cd_senha) VALUES ("23.233.232/3333-33", "senha");