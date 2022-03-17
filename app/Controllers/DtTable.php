<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Datatable;
use App\Helpers\Datatables\Datatables;
use App\Models\Dttable as ModelsDttable;

class DtTable extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->group = new ModelsDttable;
    }
    public function datatable()
    {
        $datatable = Datatables::method([ModelsDttable::class, 'getAll'], 'search')
            ->setParams(1, 'kedua')
            ->make();
        echo db_connect()->showLastQuery();
        $datatable->updateRow(function ($db, $nomor) {
            return [
                $nomor,
                $db->nama,
                $db->kelas,
                $db->usia,
                " <button type='button' class='btn btn-warning' data-id='$db->id_data'><i class='fas fa-pencil-alt'></i></button>"
            ];
        });
        $datatable->toJson();
    }
}
