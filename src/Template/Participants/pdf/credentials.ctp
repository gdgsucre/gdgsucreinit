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
    switch ($participant->type) {
        case 'O':
        break;
        case 'E':
        break;
        default:
            $pdf->Image(WWW_ROOT . 'img' . DS . 'credential-participant.jpg', $x, $y, 65);
    }

    $pdf->StartTransform();
    $pdf->MultiCell(55, 9, mb_strtoupper($participant->name), 0, 'C', 1, 0, $x + 5, $y + 42, 1, '', '', '', 9, 'M');
    $pdf->StopTransform();

    // $text_qr = $this->Url->build(['controller' => 'Participants', 'action' => 'view', ], false);

    $pdf->write2DBarcode('https://gdgsucre.rootcode.com.bo/init/qr/' . md5(Configure::Read('Security.salt') . $participant->id), 'QRCODE,M', $x + 18.5, $y + 60.6, 28, 28, $styleQR, 'N');

    $x += 70;
    if ($i % 3 != 0) $y += 100;
    $i++;
}
$pdf->SetFont('dejavusans', 'BI', 8);
// $pdf->MultiCell(185, 6, 'TOTAL: ', 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
// $pdf->MultiCell(20, 6, number_format($total['discount'], 2, ',', '.'), 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
// $pdf->MultiCell(18, 6, number_format($total['income'], 2, ',', '.'), 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
// $pdf->MultiCell(18, 6, number_format($total['expense'], 2, ',', '.'), 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
// $pdf->MultiCell(18, 6, number_format($total['income'] - $total['expense'], 2, ',', '.'), 1, 'R', '', 1, '', '', 1, '', '', '', 6, 'M');

$pdf->Output('credenciales_' . '.pdf', 'I');
