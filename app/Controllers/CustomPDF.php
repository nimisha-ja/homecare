<?php

namespace App\Controllers; // This should match your project’s namespace

use TCPDF;

class CustomPDF extends TCPDF
{
    // Custom method to define footer (with page numbers)
    public function Footer()
    {
        // Position at 15mm from the bottom of the page
        $this->SetY(-15);

        // Set font for footer
        $this->SetFont('helvetica', 'I', 8);

        // Add page number to the footer: Page x of y
        $this->Cell(0, 10, 'Page ' . $this->getPage() . ' of ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}
