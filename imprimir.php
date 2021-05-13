<?php
require("libs/fpdf/fpdf.php");
    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40, 10, 'Opa, imprime ai!');
    $pdf->Cell(40, 60,'Hello World !', 1, 1);
    $pdf->Cell(60, 80, "Olá Mundo!", 0, 1, 'C');
    $pdf->Output();
?>