CREATE DATABASE mercadoria;

USE mercadoria;

CREATE TABLE produto (
	cod_prod SMALLINT PRIMARY KEY,
	descricao_prod VARCHAR(255),
	tipo_prod VARCHAR(255),
	valor_uni DECIMAL(10, 2),
	quant_prod INT(100),
	obs_prod VARCHAR(255)	
);

SELECT * FROM produto;

SELECT * FROM produto
WHERE descricao_prod LIKE '%ão%';


