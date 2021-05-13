<?php
require("libs/fpdf/fpdf.php");

class PDF extends FPDF
{
// Cabeçalho da Página
function Header()
{
    // Logo
    $this->Image('imagens/php.png', 10, 6, 20);
    // Arial bold 15
    $this->SetFont('Arial', 'B', 15);
    // Movendo para direita
    $this->Cell(80);
    // Titulo
    $this->Cell(30, 10, 'PDF', 1, 0, 'C');
    // Quebra de linha
    $this->Ln(20);
}

// Rodapé da Página
function Footer()
{
// Posicição a 1,5 cm da parte inferior
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I', 8);
    // Número da Página
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
}
}

// Instancias de classes Herdadas
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
for($i=1;$i<=10;$i++){
    $pdf->Cell(0, 5, 'Mostrando linha ' . $i, 0, 1);
};
$pdf->Output();
?>