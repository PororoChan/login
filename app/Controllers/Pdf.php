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
        $border = 1;

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
        $pdf->Cell(25, 5, 'Banyaknya', $border, 0, 'C');
        $pdf->Cell(90, 5, 'Nama Barang', $border, 0, 'C');
        $pdf->Cell(25, 5, 'Harga Satuan', $border, 0, 'C');
        $pdf->Cell(25, 5, 'Discount', $border, 0, 'C');
        $pdf->Cell(23, 5, 'Jumlah', $border, 1, 'C');

        // row 1
        $pdf->Cell(25, 5, '', $border, 0, 'C');
        $pdf->Cell(90, 5, 'Belanja Alat Kesehatan', $border, 0, 'L');
        $pdf->Cell(25, 5, '', $border, 0, 'C');
        $pdf->Cell(25, 5, '', $border, 0, 'C');
        $pdf->Cell(23, 5, '', $border, 1, 'C');

        // row 2
        $pdf->Cell(25, 10, '2', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'RGB MEDICAL ELECTRONIC THERMOMETER / TERMOMETER BADAN - THM001', $border, 'L');
        $pdf->SetXY(125, 60);
        $pdf->Cell(25, 10, '500,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '0%', $border, 0, 'R');
        $pdf->Cell(23, 10, '1,000,000', $border, 1, 'R');

        // row 3
        $pdf->Cell(25, 10, '1', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'RGB MEDICAL ALUMUNIUM ALLOY DUAL-HEAD DELUXE STETHOSCOPE FOR CHILD/ STETOSKOP - ST005', $border, 'L');
        $pdf->SetXY(125, 70);
        $pdf->Cell(25, 10, '770,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '50%', $border, 0, 'R');
        $pdf->Cell(23, 10, '385,000', $border, 1, 'R');

        // row 4 
        $pdf->Cell(25, 10, '1', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'RGB MEDICAL BLOOD PRESSURE MONITOR/ TENSIMETER DIGITAL PLUS ADAPTOR - BPM001', $border, 'L');
        $pdf->SetXY(125, 80);
        $pdf->Cell(25, 10, '90,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '0%', $border, 0, 'R');
        $pdf->Cell(23, 10, '90,000', $border, 1, 'R');

        // row 5 
        $pdf->Cell(25, 5, '2', $border, 0, 'C');
        $pdf->Cell(90, 5, 'Masker Five Care 3 Ply Headloop', $border, 0, 'L');
        $pdf->Cell(25, 5, '476,300', $border, 0, 'R');
        $pdf->Cell(25, 5, '50%', $border, 0, 'R');
        $pdf->Cell(23, 5, '476,300', $border, 1, 'R');

        // row 6
        $pdf->Cell(25, 10, '7', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'ELITECH - INDONESIA ELITECH PULSE OXIMETER/OXYMETER FOX-1', $border, 'L');
        $pdf->SetXY(125, 95);
        $pdf->Cell(25, 10, '259,457', $border, 0, 'R');
        $pdf->Cell(25, 10, '0%', $border, 0, 'R');
        $pdf->Cell(23, 10, '1,816,000', $border, 1, 'R');

        // row 7
        $pdf->Cell(25, 10, '4', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'BEIXIKANG - Protection Face Mask Disposable 3ply 1 Box isi 50 Pcs', $border, 'L');
        $pdf->SetXY(125, 105);
        $pdf->Cell(25, 10, '45,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '50%', $border, 0, 'R');
        $pdf->Cell(23, 10, '90,000', $border, 1, 'R');

        // row 8 
        $pdf->Cell(25, 5, '2', $border, 0, 'C');
        $pdf->Cell(90, 5, 'ELITECH - INDONESIA PULSE OXYMETER FOX-3', $border, 0, 'L');
        $pdf->Cell(25, 5, '1,500,000', $border, 0, 'R');
        $pdf->Cell(25, 5, '0%', $border, 0, 'R');
        $pdf->Cell(23, 5, '3,000,000', $border, 1, 'R');

        // row 9 
        $pdf->Cell(25, 10, '2', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'ELITECH - INDONESIA KERTAS ECG / ROLL PAPER - ROLL PAPER FOR ECG-300G', $border, 'L');
        $pdf->SetXY(125, 120);
        $pdf->Cell(25, 10, '770,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '50%', $border, 0, 'R');
        $pdf->Cell(23, 10, '770,000', $border, 1, 'R');

        // row 10 
        $pdf->Cell(25, 10, '1', $border, 0, 'C');
        $pdf->MultiCell(90, 5, 'RGB MEDICAL ALUMUNIUM ALLOY DUAL-HEAD DELUXE STETHOSCOPE FOR ADULT/ STETOSKOP - ST004', $border, 'L');
        $pdf->SetXY(125, 130);
        $pdf->Cell(25, 10, '45,000', $border, 0, 'R');
        $pdf->Cell(25, 10, '50%', $border, 0, 'R');
        $pdf->Cell(23, 10, '22,500', $border, 1, 'R');

        // footer row
        $pdf->MultiCell(140, 5, 'Berdasarkan :' . "\n" . 'a. Surat Pesanan (SP) / Kontrak' . "\n" . 'Nomor :' . "\n" . 'b. E-Purchasing' . "\n" . 'Nomor ID : OFFLINE2021-0322 tanggal 31 Desember 2021', $border, 'L');
        $pdf->SetXY(150, 140);
        $pdf->Cell(25, 25, 'Grand Total', 1, 0, 'C');
        $pdf->Cell(23, 25, '7,650,000', 1, 1, 'R');
        $pdf->Ln(2);

        // footer msg
        $border = 0;
        $pdf->SetFont($font, 'B', 11);
        $pdf->Cell(23, 5, 'Terbilang :', $border, 0, 'L');
        $pdf->SetFont($font, '', 10);
        $pdf->MultiCell(145, 5, 'Tujuh juta enam ratus lima puluh ribu Rupiah', $border, 'L');
        $pdf->Ln(6);

        // footer
        $pdf->SetFont($font, '', 9);
        $pdf->Cell(135, 5, 'Diterima Oleh', $border, 0, 'L');
        $pdf->Cell(45, 5, 'PT.EMINDO JAYA BERSAMA', $border, 1, 'L');
        $pdf->Ln(25);
        $pdf->Cell(135, 5, '', $border, 0, 'R');
        $pdf->SetFont($font, 'U', 9);
        $pdf->Cell(45, 5, 'Deviatri Syam', $border, 1, 'L');
        $pdf->Cell(135, 5, '', $border, 0, 'R');
        $pdf->SetFont($font, '', 9);
        $pdf->Cell(45, 5, 'Direktur Utama', $border, 1, 'L');
        $pdf->Ln(5);

        $pdf->Cell(100, 5, 'NB: Barang yang sudah dibeli tidak dapat ditukar dan dikembalikan', $border, 0, 'L');

        $pdf->Output('D:/CobaFPDF.pdf', 'F');
    }
}
