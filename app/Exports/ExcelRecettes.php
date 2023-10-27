<?php

namespace App\Exports;

use App\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExcelRecettes implements FromCollection, WithHeadings, WithTitle
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
    }

    public function headings(): array
    {
        return [
          'DATE ADHESION',
          'DATE DE PAIEMENT',
          'NUMERO DE POLICE',
          'IDENTIFIANT SOUSCRIPTEUR',
          'NOM & PRENOMS SOUSCRIPTEUR',
          'TELEPHONE', 
          'NOM & PRENOMS ASSURE',
          'MONTANT PAYE',
          'QUOTE PART NSIA', 
          'COMMISSION MMS',
          'COMMISSION SM', 
          'COMMISSION MARCHAND', 
        ];
    }
    
    public function title(): string
    {
        return
            "LISTE DES RECETTES";

      }
}
