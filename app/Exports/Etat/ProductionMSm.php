<?php

namespace App\Exports\Etat;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductionMSm implements FromView
{
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('dash.etats.tables.prod_m_et_sm', [
            'users' => $this->data['users'],
        ]);
    }
}

