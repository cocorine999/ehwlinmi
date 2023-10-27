<?php

namespace App\Exports;

use App\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExcelEtatProduction implements FromCollection, WithHeadings, WithTitle
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
            "N°",
            "Date d'adhésion",
            "Code du produit",
            "Code de l'agent",
            "Nom et prénom de l'adhérent",
            "Profession de l'adhérent",
            "Numéro de téléphone de l'adhérent",
            "Nom et prénom de l'assuré",
            "Marchand ",
            "Statut",
            "Primes Payées",
            "Réponses au questionnaire médical",
        ];
    }
    
    public function title(): string
    {
        return
            "ETAT PRODUCTION";

      }
}
