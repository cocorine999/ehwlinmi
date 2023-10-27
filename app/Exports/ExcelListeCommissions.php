<?php

namespace App\Exports;

use App\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExcelListeCommissions implements FromCollection,WithHeadings,WithTitle
{
  use Exportable;


    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return collect($this->data);
        //return Excel::all();
    }

    public function headings(): array
    {
        return [
            'N°',
            'Souscripteur',
            'Assuré',
            'Numéro de police',
            'Montant',
            'Prime totale Payée' ,
            'Reste à Payer',
            'Commission Marchand',
            'Commission Super-marchand',
            // 'Forfait gestion administrative',
            // 'Forfait gestion commerciale',
            //'Commission GMMS',
            //'NSIA',
        ];

      }
    public function title(): string
    {
        return
            "LISTE DES PRIMES";

      }
}
