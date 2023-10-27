<?php

namespace App\Exports\Etat;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductionNsia implements FromView
{
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('dash.etats.tables.prod_nsia', [
            'contrats' => $this->data['contrats'],
        ]);
    }
}

