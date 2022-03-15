<?php

namespace App\Models;

use CodeIgniter\Model;
use FontLib\Table\Type\head;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as writerx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as readerx;

class Excel extends Model
{
    protected $table = 'biodata';
    protected $db;
    protected $dt;

    //attr
    private $spreadsheet;
    private $writer;
    private $alpha;

    //excel-dt
    private $title;
    private $filename;
    private $header;
    private $data;

    private $border_header = [
        "alignment" => [
            "horizontal" => Alignment::HORIZONTAL_CENTER
        ],
        "borders" => [
            "allBorders" => [
                "borderStyle" => Border::BORDER_MEDIUM,
            ],
        ],
    ];

    private $border_body = [
        "alignment" => [
            "horizontal" => Alignment::HORIZONTAL_CENTER
        ],
        "borders" => [
            "allBorders" => [
                "borderStyle" => Border::BORDER_THIN
            ],
        ],
    ];

    private $title_style = [
        "alignment" => [
            "horizontal" => Alignment::HORIZONTAL_CENTER
        ],
        "font" => [
            "bold" => true,
            "size" => 14,
        ]
    ];

    public function __construct()
    {
        //db-pref
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);

        $this->spreadsheet = new Spreadsheet();
        $this->alpha = array_merge(range('A', 'Z'));
        $this->writer = new writerx($this->spreadsheet);
    }

    public function set_filename($name)
    {
        $this->filename = $name;
        return $this;
    }

    public function set_header_style_border($style)
    {
        $this->border_header = $style;
    }

    public function set_body_style_border($style)
    {
        $this->border_body = $style;
    }

    public function set_title_style($style)
    {
        $this->title_style = $style;
    }

    public function set_title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function set_data($data, $header = [], $option = [])
    {
        $this->header = $header;
        $this->data = $data;
        $this->option = $option;
        return $this;
    }

    private function table()
    {
        //export-excel
        $sheet = $this->spreadsheet->getActiveSheet();
        $column_count = count($this->data[0]);
        $row_count = count($this->data);

        $this->apply_style();

        $i = 1;
        if ($this->title) {
            //set-title
            $start = 'A1';
            $end = $this->alpha[$column_count - 1] . "$i";
            $sheet->setCellValue("A$i", strtoupper($this->title));
            $sheet->mergeCells("$start:$end");
            $sheet->getStyle($start)->applyFromArray($this->title_style);

            $i++;
        }

        if ($this->header) {
            foreach ($this->header as $key => $val) {
                $al = $this->alpha[$key];
                $sheet->setCellValue("$al$i", strtoupper($val));
            }

            $al = $this->alpha[count($this->header) - 1] . "$i";
            $sheet->getStyle("A$i:$al")->applyFromArray($this->border_header);

            $i++;
        }

        foreach ($this->data as $row) {
            $k = 0;
            foreach ($row as $cell) {
                $alphas = $this->alpha[$k++];
                $sheet->getColumnDimension($alphas)->setAutoSize(true);
                $sheet->setCellValue("$alphas$i", $cell);
            }
            $i++;
        }

        $start = 'A' . ($i - $row_count);
        $end = $this->alpha[$column_count - 1] . ($i - 1);

        $sheet->getStyle("$start:$end")->applyFromArray($this->border_body);
    }

    public function download()
    {
        $this->table();

        //download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $this->filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $this->writer->save('php://output');
    }

    private function apply_style()
    {
        $sheet = $this->spreadsheet->getActiveSheet();
        foreach ($this->option as $opt => $opt_v) {
            foreach ($opt_v as $key => $style) {
                if ($opt == "columns") {
                    if (in_array($key, $this->alpha)) {
                        $sheet->getStyle("$key:$key")->applyFromArray($style);
                    } else {
                        $head = array_search($key, $this->header);
                        $alph = $this->alpha[$head];
                        $sheet->getStyle("$alph:$alph")->applyFromArray($style);
                    }
                } else if ($opt == "rows") {
                    $sheet->getStyle("$key:$key")->applyFromArray($style);
                } else if ($opt == "cells") {
                    $sheet->getStyle("$key")->applyFromArray($style);
                }
            }
        }
    }
}
