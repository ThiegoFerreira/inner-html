CREATE DATABASE netshoes;
USE netshoes;

CREATE TABLE tipo(
	id_tipo INT NOT NULL AUTO_INCREMENT,
    nome varchar(255),
    PRIMARY KEY(id_tipo)
);

INSERT INTO tipo values (1,'ROUPAS');
INSERT INTO tipo values (2,'CALÇADOS');
INSERT INTO tipo values (3,'BONÉS');

CREATE TABLE produto(
	id_produto INT NOT NULL AUTO_INCREMENT,
    foto VARCHAR(255),
    nome VARCHAR(255),
    marca VARCHAR(255),
    descricao VARCHAR(255),
    modelo VARCHAR(255),
    cor VARCHAR(100),
    tamanho INT,
    quantidade INT,
    preco INT,
    id_tipo INT,
    PRIMARY KEY(id_produto),
    FOREIGN KEY(id_tipo) REFERENCES tipo(id_tipo)
);

SELECT * FROM produto;