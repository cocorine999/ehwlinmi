<?php

namespace App\Exports\Etat;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EtatPrime implements FromView
{
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('dash.etats.tables.primes', [
            'primes' => $this->data['primes'],
        ]);
    }
}

