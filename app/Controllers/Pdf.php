<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use FPDF;

class Pdf extends BaseController
{
    public function genPDF()
    {
        $pdf = new FPDF();
        $font = 'Arial';

        $pdf->AddPage();

        // Header
        $pdf->SetFont($font, '', 10);
        $pdf->Cell(125, 5, 'Kepada Yth.', 0, 0);

        $pdf->SetFont($font, 'B', 11);
        $pdf->Cell(25, 5, 'FAKTUR', 0, 1, 'C');

        $pdf->SetFont($font, '', 10);
        $pdf->Cell(15, 5, 'Dita', 0, 1);
        $pdf->Cell(132, 5, 'Jakarta', 0, 0);

        $pdf->SetFont($font, 'B', 11);
        $pdf->Cell(25, 5, 'No. FAK1882387', 0, 1, 'C');
        $pdf->Cell(168, 5, 'Tanggal 07 Mei 2022', 0, 1, 'R');
        $pdf->Ln(10);

        $pdf->SetFont($font, '', 10);
        $pdf->Cell(25, 5, 'Surat Pesanan', 0, 0);
        $pdf->Cell(3, 5, '/', 0, 0);
        $pdf->Cell(25, 5, 'Kontrak No.', 0, 1);
        $pdf->Ln(5);

        // HeaderTabel
        $pdf->SetFont($font, '', 9);
        $pdf->Cell(25, 5, 'Banyaknya', 1, 0, 'C');
        $pdf->Cell(90, 5, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Harga Sultan', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Discount', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Jumlah', 1, 1, 'C');

        // row 1
        $pdf->Cell(25, 5, '', 1, 0, 'C');
        $pdf->Cell(90, 5, 'Belanja Alat Kesehatan', 1, 0, 'L');
        $pdf->Cell(25, 5, '', 1, 0, 'C');
        $pdf->Cell(25, 5, '', 1, 0, 'C');
        $pdf->Cell(25, 5, '', 1, 1, 'C');

        // row 2
        $pdf->Cell(25, 5, '2', 1, 0, 'C');
        $pdf->MultiCell(90, 5, 'RGB MEDICAL ELECTRONIC THERMOMETER / TERMOMETER BADAN - THM001', 1, 'J');

        $pdf->Output('D:/file.pdf', 'F');
    }
}
