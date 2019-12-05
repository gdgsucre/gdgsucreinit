<?php

use App\Utils\Pdf;
use Cake\Core\Configure;
use Cake\Utility\Security;
set_time_limit(3600);


$styleQR = array(
    'border' => 0,
    'vpadding' => 2,
    'hpadding' => 2,
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);
// dd($participants->toArray());
$pdf = new Pdf('Credenciales', 'R', array(210, 297),true,'UTF-8');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(255, 255, 255);

$pdf->AddPage();

$pdf->SetY(38);
$pdf->SetFont('dejavusans', 'B', 9);
$x = 5;
$y = 5;
$i = 0;
// dd($participants->toArray());
foreach ($participants as $participant) {
    $i++;
    //dd($participant);
        switch ($participant->type) {
        case 'SPEAKER':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'speaker.jpg', $x, $y, 65);
        break;
        case 'PARTICIPANT':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'participant.jpg', $x, $y, 65);
        break;
        case 'ORGANIZER':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'organizer.jpg', $x, $y, 65);
        break;
        default:
            $pdf->Image(WWW_ROOT . 'img' . DS . 'participant.jpg', $x, $y, 65);
    }
    $pdf->StartTransform();

    $pdf->SetFont('dejavusans', '', 11);
    $pdf->MultiCell(55, 12, strtoupper($participant->name), 0, 'C', 1, 0, $x + 5, $y + 32, 1, '', '', '', 12, 'M');
 
    $pdf->StopTransform();

   $pdf->write2DBarcode('https://devfestsucre2019.itgroup.systems/qr/' . $participant->qr, 'QRCODE,M', $x + 22.3, $y + 45.4, 20, 20, $styleQR, 'N');
    $x += 67.5;
    if ($i % 3 == 0) {
        $y += 96;
        $x = 5;
    }
}
$pdf->SetFont('dejavusans', 'BI', 8);

$pdf->Output('credenciales_' . '.pdf', 'I');
