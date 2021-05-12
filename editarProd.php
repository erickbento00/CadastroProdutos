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
};

$operador = isset($_POST['operador']) ? htmlspecialchars($_POST['operador']) : '';
$codigo = isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : '';
$descricao = isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '';
$cod_categoria = isset($_POST['cod_categoria']) ? htmlspecialchars($_POST['cod_categoria']) : '';
$preco = isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '';
$quantidade = isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '';
$observacao = isset($_POST['observacao']) ? htmlspecialchars($_POST['observacao']) : '';

if($operador == 'buscar'){
    $retorno = null;
    if ($retorno = $conn->query("SELECT * FROM produto WHERE cod_prod = $codigo")) {
        while($linha = $retorno->fetch_array(MYSQLI_ASSOC)) {
            $meuArr[] = $linha;
        }
        $retorno = json_encode($meuArr);
    };

    $conn->close();
    die($retorno);
}elseif($operador == 'atualizar'){
    $conn->query("UPDATE produto SET descricao_prod='$descricao', cod_categoria='$cod_categoria', valor_uni='$preco', quant_prod='$quantidade', obs_prod='$observacao' WHERE cod_prod = $codigo");

    $conn->close();
    die("Editado com sucesso!");
}elseif($operador =='excluir'){
    $conn->query("DELETE FROM produto WHERE cod_prod = $codigo");
    
    $conn->close();
    die("Editado com sucesso!");
};

?>
