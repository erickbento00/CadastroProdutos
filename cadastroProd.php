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

$descricao = isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$preco = isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '';
$quantidade = isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '';
$observacao = isset($_POST['observacao']) ? htmlspecialchars($_POST['observacao']) : '';

$insere = "INSERT INTO produto (cod_prod, descricao_prod, cod_categoria, valor_uni, quant_prod, obs_prod)
VALUES ('$codigo', '$descricao', '$categoria', '$preco', '$quantidade', '$observacao')";
$conn->query($insere);

$conn->close();
die("Cadastrado com sucesso!");

?>
