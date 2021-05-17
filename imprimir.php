<?php
require("libs/fpdf/fpdf.php");
include("conexao.php");

//Definindo valores
$codigo = isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : '';
$descricao = isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$preco = isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : '';
$quantidade = isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : '';
$observacao = isset($_POST['observacao']) ? htmlspecialchars($_POST['observacao']) : '';

//Selecionando os valores do Banco de dados
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
    // Cabeçalho
    function Header() {
        // Logotipo
        $this->Image('imagens/php.png', 12, 8, 12);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Mover para direita/esquerda
        $this->Cell(80);
        // Título
        $this->Cell(30, 15, 'Dados cadastrados', 0, 1, 'C');
        // Quebra de linha
        $this->Ln(5);
    }

    // Tabela
    function ImprovedTable($header, $retorno) {
        // Larguras de coluna
        $w = array(19, 30, 30, 23, 23, 65);
        // Header (cabeçalho)
        for($i=0;$i<count($header);$i++) {
            $this->Cell($w[$i], 8, $header[$i], 1, 0, 'C');
        }
        $this->Ln();

        // Valores
        foreach ($retorno as $key => $produto) {
            $this->Cell($w[0], 8, number_format($produto["cod_prod"]), 'LR', 0, 'C');
            $this->Cell($w[1], 8, $produto["nome_categoria"], 'LR', 0, 'C');
            $this->Cell($w[2], 8, $produto["descricao_prod"], 'LR', 0, 'C' );
            $this->Cell($w[3], 8, number_format($produto["valor_uni"], 2, '.', ''), 'LR', 0, 'C');
            $this->Cell($w[4], 8, number_format($produto["quant_prod"]), 'LR', 0, 'C');
            $this->Cell($w[5], 8, $produto["obs_prod"], 'LR', 0, 'C');
            $this->Ln();
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Footer da Página
    function Footer() {
        // Posiçao 1.5cm da aprte inferior
        $this->SetY(-15);
        // Arial Italico 8
        $this->SetFont('Arial', 'I', 8);
        // Cor da letra
        $this->SetTextColor(128, 128, 128);
        // Número da Página
        $this->Cell(0, 10, 'Página '.$this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$header = array('Código', 'Descrição', 'Categoria', 'R$ Valor', 'Estoque', 'Observação');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->ImprovedTable($header,$retorno);
$pdf->AliasNbPages();
$pdf->Output();
?>
