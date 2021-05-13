<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="mercadoria";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a Conexão
if ($conn->connect_error) {
    die("Falha na Conexão " . $conn->connect_error);
}

$insere = "INSERT INTO produto (cod_prod, descricao_prod, cod_categoria, valor_uni, quant_prod, obs_prod)
VALUES ('$codigo', '$descricao', '$categoria', '$preco', '$quantidade', '$observacao')";
$conn->query($insere);

$conn->close();
die("Cadastrado com sucesso!");

?>
