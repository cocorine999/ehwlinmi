<?php

namespace App\Exports;

use App\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;

class ExcelExportMarchand implements FromCollection,WithHeadings
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
          'Numéro de police',
          'Souscripteur',
          'Assuré',
          'Statut',
      ];
    }
}
