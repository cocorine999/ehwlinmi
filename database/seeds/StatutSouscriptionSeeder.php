<?php

use Illuminate\Database\Seeder;
use App\Models\StatutSouscription;

class StatutSouscriptionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $statuts = [
      'Attente de paiement', 'Attente de traitement', 'Valide', 'Rejeté', 'Sinistre', 'Terminé',  'Résilié', 'Annulé'
    ];
    foreach ($statuts as $s) {
      StatutSouscription::create(['label' => $s]);
    }
  }
}
