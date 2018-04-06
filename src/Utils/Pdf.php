<?php

namespace App\Utils;

use TCPDF;

// require_once(ROOT . DS . 'vendor' . DS . 'tecnickcom' . DS . 'tcpdf' . DS . 'tcpdf.php');

/**
 * Constants
 * @author Lucio Marcelo Quispe Ortega <marceloquispeortega@gmail.com>
 */
class Pdf extends TCPDF
{
    public function __construct($title, $orientation = 'P', $format = array(215, 279))
    {
        parent::__construct($orientation, 'mm', $format, true, 'utf-8', false);

        $this->SetTitle($title);
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('RootCode');
        $this->SetKeywords('GDG, GDG Sucre');

        $this->SetPrintHeader(false);
        $this->SetPrintFooter(false);

        //cambiar margenes
        $this->SetMargins(10, 10, 10, 10);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $this->startPageGroup();

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->setJPEGQuality(100);
    }

}
