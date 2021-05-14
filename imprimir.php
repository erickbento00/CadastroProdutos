<?php
require("libs/fpdf/fpdf.php");
include("conexao.php");

// busca os dados no banco de dados

$codigo = isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : '';
$descricao = isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$preco = isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '';
$quantidade = isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '';
$observacao = isset($_POST['observacao']) ? htmlspecialchars($_POST['observacao']) : '';

$retorno = null;
$retorno = $conn->query("SELECT p.cod_prod, c.nome_categoria, p.descricao_prod, p.valor_uni, p.quant_prod, p.obs_prod 
FROM produto p LEFT JOIN categoria c ON p.cod_categoria = c.cod_categoria");

if ($retorno) {
    while($linha = $retorno->fetch_array(MYSQLI_ASSOC)) {
        $meuArr[] = $linha;
    }
    $retorno = $meuArr;
};



$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 5, 'Código');
$pdf->SetX(35);
$pdf->Cell(40, 5, 'Categoria');
$pdf->SetX(63);
$pdf->Cell(40, 5, 'Nome');
$pdf->SetX(83);
$pdf->Cell(40, 5, 'Valor Unitário');
$pdf->SetX(115);
$pdf->Cell(40, 5, 'Quantidade');
$pdf->SetX(150);
$pdf->Cell(100, 5, 'Observação');
$pdf->SetX(15);


$x = 20;
$z = 30;
$y = 20;
foreach ($retorno as $key => $produto) {
    $pdf->Cell($x+10, $y, $produto["cod_prod"]);
    $pdf->SetX(35);
    $pdf->Cell($x+10, $y, $produto["nome_categoria"]);
    $pdf->SetX(62);
    $pdf->Cell($x+10, $y, $produto["descricao_prod"]);
    $pdf->SetX(90);
    $pdf->Cell($x+10, $y, $produto["valor_uni"]);
    $pdf->SetX(120);
    $pdf->Cell($x+10, $y, $produto["quant_prod"]);
    $pdf->SetX(145);
    $pdf->Cell($x+10, $y, $produto["obs_prod"]);
    $pdf->SetX(15);
    $y += 30;
}

$pdf->Output();

?>
