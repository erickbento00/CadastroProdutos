CREATE DATABASE mercadoria;

USE mercadoria;

CREATE TABLE categoria (
	cod_categoria INT PRIMARY KEY,
	nome_categoria VARCHAR(50)
);

CREATE TABLE produto (
	cod_prod INT PRIMARY KEY,
	cod_categoria INT,
	descricao_prod VARCHAR(255),
	valor_uni DECIMAL(10, 2),
	quant_prod INT(100),
	obs_prod VARCHAR(255),
	FOREIGN KEY (cod_categoria) REFERENCES categoria(cod_categoria)
);

SELECT * FROM produto;
SELECT * FROM categoria;

INSERT INTO categoria(cod_categoria, nome_categoria) 
VALUES (1, 'Grão');
INSERT INTO categoria(cod_categoria, nome_categoria) 
VALUES (2, 'Tubérculo');
INSERT INTO categoria(cod_categoria, nome_categoria) 
VALUES (3, 'Verdura');
INSERT INTO categoria(cod_categoria, nome_categoria) 
VALUES (4, 'Legume');
INSERT INTO categoria(cod_categoria, nome_categoria) 
VALUES (5, 'Fruta');

INSERT INTO produto (cod_prod, descricao_prod, cod_categoria, valor_uni, quant_prod,obs_prod) 
VALUES (1, "Uva", 3, 2.00, 100, "");
INSERT INTO produto (cod_prod, descricao_prod, cod_categoria, valor_uni, quant_prod,obs_prod) 
VALUES (6, "Uva", 4, 2.00, 100, "");
