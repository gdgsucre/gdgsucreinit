<?php

use App\Utils\Pdf;

set_time_limit(3600);

$pdf = new Pdf('Certificado de ' . $participant->name, 'L');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(255, 255, 255);

$pdf->AddPage();

$pdf->Image(WWW_ROOT . 'img' . DS . 'certificate.jpg', 0, 0, 279);

$pdf->SetFont('dejavusans', 'B', 24);

$pdf->StartTransform();
$pdf->setTextRenderingMode($stroke=0.25, $fill=true, $clip=false);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(255, 255, 255);
$pdf->MultiCell('', 12, $participant->name, 0, 'C', 0, 0, '', 108, 1, '', '', '', 12, 'M');
$pdf->StopTransform();

$pdf->Output('certificado_' . $participant->qr . '.pdf', 'I');
