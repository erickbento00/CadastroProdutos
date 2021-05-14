<?php
require("libs/fpdf/fpdf.php");
include("conexao.php");

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

class PDF extends FPDF {
    // Load data
    function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $retorno = array();
        foreach($lines as $line)
            $retorno[] = explode('=>',trim($line));
        return $retorno;
    }

// Better table
    function ImprovedTable($header, $retorno)
    {
        // Column widths
        $w = array(18, 30, 30, 20, 20, 60);
        // Header
        for($i=0;$i<count($header);$i++) {
            $this->Cell($w[$i], 9, $header[$i], 1, 0, 'C');
        }  
        $this->Ln();
        // Data
        foreach ($retorno as $key => $produto) {
            $this->Cell($w[0], 6, number_format($produto["cod_prod"]), 'LR', 0, 'R');
            $this->Cell($w[1], 6, $produto["nome_categoria"],'LR');
            $this->Cell($w[2], 6, $produto["descricao_prod"],'LR' );
            $this->Cell($w[3], 6, number_format($produto["valor_uni"]),'LR', 0, 'R');
            $this->Cell($w[4], 6, number_format($produto["quant_prod"]),'LR', 0, 'R');
            $this->Cell($w[5], 6, $produto["obs_prod"], 'LR');
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

$pdf = new PDF();
$header = array('Código', 'Descrição', 'Categoria', 'R$ Valor', 'Estoque', 'Observação');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->ImprovedTable($header,$retorno);
$pdf->Output();
?>