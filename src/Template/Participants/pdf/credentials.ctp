<?php

use App\Utils\Pdf;
use App\Utils\Verhoeff;
use Cake\Core\Configure;

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

$pdf = new Pdf('Credenciales', 'R', array(210, 297));

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(255, 255, 255);

$pdf->AddPage();

$pdf->SetY(38);
$pdf->SetFont('dejavusans', 'B', 9);
$x = 5;
$y = 5;
$i = 0;
foreach ($participants as $participant) {
    $i++;
    switch ($participant->type) {
        case 'O':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'credential-organizator.jpg', $x, $y, 65);
        break;
        case 'E':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'credential-expositor.jpg', $x, $y, 65);
        break;
        default:
            $pdf->Image(WWW_ROOT . 'img' . DS . 'credential-participant.jpg', $x, $y, 65);
    }

    $pdf->StartTransform();
    $pdf->MultiCell(55, 9, mb_strtoupper($participant->name), 0, 'C', 1, 0, $x + 5, $y + 42, 1, '', '', '', 9, 'M');
    $pdf->StopTransform();

    // $text_qr = $this->Url->build(['controller' => 'Participants', 'action' => 'view', ], false);
    if ($participant->type == 'P') {
        $pdf->write2DBarcode('https://gdgsucre.rootcode.com.bo/init/qr/' . md5(Configure::Read('Security.salt') . $participant->id), 'QRCODE,M', $x + 18.5, $y + 60.6, 28, 28, $styleQR, 'N');
    }

    $x += 67.5;
    if ($i % 3 == 0) {
        $y += 96;
        $x = 5;
    }

}
$pdf->SetFont('dejavusans', 'BI', 8);

$pdf->Output('credenciales_' . '.pdf', 'I');
