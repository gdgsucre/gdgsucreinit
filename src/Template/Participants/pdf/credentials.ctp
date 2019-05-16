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
//dd($participants);
$pdf = new Pdf('Credenciales', 'R', array(210, 297),true,'UTF-8');

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
    //dd($participant);
        switch ($participant->type) {
        case 'O':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_organizador.jpg', $x, $y, 65);
        break;
        case 'E':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_expositora.jpg', $x, $y, 65);
        break;
        case 'S':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_soporte.jpg', $x, $y, 65);
        break;
        case 'P':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_participante.jpg', $x, $y, 65);
        break;
        case 'C':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_speaker_negro.jpg', $x, $y, 65);
        break;
        case 'M':
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_mentora.jpg', $x, $y, 65);
        break;
        default:
            $pdf->Image(WWW_ROOT . 'img' . DS . 'c_participante.jpg', $x, $y, 65);
    }
    $pdf->StartTransform();

    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->MultiCell(55, 12, strtoupper($participant->name), 0, 'C', 1, 0, $x + 5, $y + 43.5, 1, '', '', '', 12, 'M');
 
    $pdf->StopTransform();

    $key = 'gpt2o19';
    ;
    $pdf->write2DBarcode('https://gpt.itgroup.systems/qr/' . md5(Configure::Read('Security.salt') . $participant->id), 'QRCODE,M', $x + 19, $y + 63, 28, 28, $styleQR, 'N');
    //$pdf->write2DBarcode('https://192.168.1.6/gdgsucreinit/qr/' . md5(Configure::Read('Security.salt') . $participant->id), 'QRCODE,M', $x + 19, $y + 63, 28, 28, $styleQR, 'N');
    $x += 67.5;
    if ($i % 3 == 0) {
        $y += 96;
        $x = 5;
    }

}
$pdf->SetFont('dejavusans', 'BI', 8);

$pdf->Output('credenciales_' . '.pdf', 'I');
