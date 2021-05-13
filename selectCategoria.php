<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="mercadoria";

$selectCategoria = isset($_POST['nome_categoria']) ? htmlspecialchars($_POST['nome_categoria']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$search = "";
if($selectCategoria){
    $search = " AND nome_categoria LIKE '$selectCategoria'";
};

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a Conexão
if ($conn->connect_error) {
    die("Falha na Conexão " . $conn->connect_error);
};

// Realizar a consulta
$retorno = null;
if ($retorno = $conn->query("SELECT * FROM categoria WHERE 1 = 1 $search")) {
    while($linha = $retorno->fetch_array(MYSQLI_ASSOC)) {
        $meuArr[] = $linha;
    }
    $retorno = json_encode($meuArr);
};

$conn->close();
die($retorno);
?>
