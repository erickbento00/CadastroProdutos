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

$contador = $conn -> query("SELECT * FROM produto");
$codigo = $contador->num_rows;
$codigo += 1;

$descricao = htmlspecialchars($_POST['descricao']);
$cod_categoria = htmlspecialchars($_POST['cod_categoria']);
$preco = htmlspecialchars($_POST['preco']);
$quantidade = htmlspecialchars($_POST['quantidade']);
$observacao = htmlspecialchars($_POST['observacao']);

$insere = "INSERT INTO produto (cod_prod, descricao_prod, cod_categoria, valor_uni, quant_prod, obs_prod)
VALUES ('$codigo', '$descricao', '$cod_categoria', '$preco', '$quantidade', '$observacao')";
$conn->query($insere);

$conn->close();
die("Cadastrado com sucesso!");

?>
