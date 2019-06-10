<?php

use App\Utils\Pdf;

set_time_limit(3600);

$pdf = new Pdf('Certificado de ' . $participant->name, 'L');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(255, 255, 255);

$pdf->AddPage();
// ['P' => 'Participante', 'E' => 'Expositor', 'O' => 'Organizador','S'=>'Soporte','C'=>'Speaker','M'=>'Mentora'];
// dd($participant);
switch ($participant->type) {
    case 'P':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_P.jpg', 0, 0, 279);
        break;
    case 'E':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_E.jpg', 0, 0, 279);
        break; 
    case 'O':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_O.jpg', 0, 0, 279);
        break;        
    case 'S':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_p.jpg', 0, 0, 279);
        break; 
    case 'C':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_C.jpg', 0, 0, 279);
        break;   
    case 'M':
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_M.jpg', 0, 0, 279);
        break;       
    default:
        $pdf->Image(WWW_ROOT . 'img' . DS . 'c_P.jpg', 0, 0, 279);
        break;
}

$pdf->SetFont('dejavusans', 'B', 24);

$pdf->StartTransform();
$pdf->setTextRenderingMode($stroke=0.25, $fill=true, $clip=false);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(255, 255, 255);
$pdf->MultiCell('', 12, $participant->name, 0, 'C', 0, 0, '', 98, 1, '', '', '', 12, 'M');
$pdf->StopTransform();

$pdf->Output('certificado_' . $participant->qr . '.pdf', 'I');
