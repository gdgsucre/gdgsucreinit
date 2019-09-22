<?php

use App\Utils\Pdf;

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

$haveType = false;
foreach ($participant->types as $type_p) {

    if ($type_p->alias == $type) {
        $haveType = true;
    }
}

if ($haveType) {
    $pdf = new Pdf('Certificado de ' . $participant->name .'-'.$type, 'L');

    $pdf->setAutoPageBreak(false);
    $pdf->SetFillColor(255, 255, 255);

    $pdf->AddPage();

    $pdf->Image(WWW_ROOT . 'img' . DS . $type . '.jpg', 0, 0, 279);

    $pdf->SetFont('dejavusans', 'B', 24);

    $pdf->StartTransform();
    $pdf->setTextRenderingMode($stroke = 0.25, $fill = true, $clip = false);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->MultiCell('', 12, $participant->name, 0, 'C', 0, 0, 50, 110, 1, '', '', '', 12, 'M');
    $pdf->write2DBarcode('https://boliviarobotics.itgroup.systems/qr/' . $participant->qr, 'QRCODE,M', 250, 10, 20, 20, $styleQR, 'N');

    $pdf->StopTransform();

    $pdf->Output('certificado_' . $participant->qr . '.pdf', 'I');
}
