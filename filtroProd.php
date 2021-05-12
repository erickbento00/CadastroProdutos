<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="mercadoria";

$filtroCategoria = isset($_POST['filtroCategoria']) ? htmlspecialchars($_POST['filtroCategoria']) : '';
$pesquisa = isset($_POST['pesquisa']) ? htmlspecialchars($_POST['pesquisa']) : '';
$search = "";
if($filtroCategoria){
    $search = " AND tipo_prod LIKE '$filtroCategoria'";
};

if($pesquisa){
    $search = " AND descricao_prod LIKE '%$pesquisa%'";
};

if($filtroCategoria && $pesquisa) {
    $search = " AND descricao_prod LIKE '%$pesquisa%' AND tipo_prod LIKE '$filtroCategoria'";
};

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a Conexão
if ($conn->connect_error) {
    die("Falha na Conexão " . $conn->connect_error);
};

// Realizar a consulta
$retorno = null;
if ($retorno = $conn->query("SELECT * FROM produto WHERE 1 = 1 $search")) {
    while($linha = $retorno->fetch_array(MYSQLI_ASSOC)) {
        $meuArr[] = $linha;
    }
    $retorno = json_encode($meuArr);
};

$conn->close();
die($retorno);
?>
