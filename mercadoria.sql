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

/*SELECT column_name(s)
FROM table1
LEFT JOIN table2
ON table1.column_name = table2.column_name;*/

SELECT p.cod_prod,
       c.nome_categoria,
       p.descricao_prod,
       p.valor_uni,
       p.quant_prod,
       p.obs_prod
  FROM produto p
  LEFT JOIN categoria c
  ON p.cod_categoria = c.cod_categoria
  WHERE p.cod_categoria = 1
  
SELECT produto.cod_categoria, categoria.nome_categoria
FROM produto
LEFT JOIN categoria
ON produto.cod_categoria = categoria.cod_categoria;
