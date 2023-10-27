<?php

use Illuminate\Database\Seeder;
use App\Models\Departement;
use App\Models\Commune;
class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'departement' => "Alibori",
                'code' => "Y",
                'prefecture' => "Kandi",
                'communes' => ["Banikoara", "Gogounou", "Kandi", "Karimama", "Malanville", "Segbana"],
            ],
            [
                'departement' => "Atacora",
                'code' => "V",
                'prefecture' => "Natitingou",
                'communes' => ["Boukoumbé", "Cobly", "Kérou", "Kouandé", "Matéri", "Natitingou", "Pehonko", "Tanguiéta", "Toucountouna"],
            ],
            [
                'departement' => "Atlantique",
                'code' => "A",
                'prefecture' => "Allada" 	,
                'communes' => ["Abomey-Calavi", "Allada", "Kpomassè", "Ouidah", "Sô-Ava", "Toffo", "Tori-Bossito", "Zè"],
            ],
            [
                'departement' => "Borgou",
                'code' => "B",
                'prefecture' => "Parakou",
                'communes' => ["Bembéréké", "Kalalé", "N'Dali", "Nikki", "Parakou", "Pèrèrè", "Sinendé", "Tchaourou"],
            ],
            [
                'departement' => "Collines",
                'code' => "C",
                'prefecture' => "Dassa-Zoumè",
                'communes' => ["Bantè", "Dassa-Zoumè", "Glazoué", "Ouèssè", "Savalou", "Savè"],
            ],
            [
                'departement' => "Couffo",
                'code' => "U",
                'prefecture' => "Aplahoué",
                'communes' => ["Aplahoué", "Djakotomey", "Dogbo-Tota", "Klouékanmè", "Lalo", "Toviklin"],
            ],
            [
                'departement' => "Donga",
                'code' => "D",
                'prefecture' => "Djougou",
                'communes' => ["Bassila", "Copargo", "Djougou", "Ouaké"],
            ],
            [
                'departement' => "Littoral",
                'code' => "L",
                'prefecture' => "Cotonou",
                'communes' => ["Cotonou"],
            ],
            [
                'departement' => "Mono",
                'code' => "M",
                'prefecture' => "Lokossa",
                'communes' => ["Athiémé", "Bopa", "Comè", "Grand-Popo", "Houéyogbé", "Lokossa"],
            ],
            [
                'departement' => "Ouémé",
                'code' => "O",
                'prefecture' => "Porto-Novo",
                'communes' => ["Adjarra", "Adjohoun", "Aguégués", "Akpro-Missérété", "Avrankou", "Bonou", "Dangbo", "Porto-Novo", "Sèmè-Kpodji"],
            ],
            [
                'departement' => "Plateau",
                'code' => "P",
                'prefecture' => "Pobè" 	,
                'communes' => ["Adja-Ouèrè", "Ifangni", "Kétou", "Pobè", "Sakété"],
            ],
            [
                'departement' => "Zou",
                'code' => "Z",
                'prefecture' => "Abomey" 	,
                'communes' => ["Abomey", "Agbangnizoun", "Bohicon", "Covè", "Djidja", "Ouinhi", "Zangnanado", "Za-Kpota", "Zogbodomey"],
            ]
        ];

        foreach ($data as $l){
            $d = Departement::create(['nom' => $l['departement'], 'code' =>$l['code'], 'prefecture' => $l['prefecture']]);
            foreach ($l['communes'] as $element){
                Commune::create(['nom'=> $element, 'departement_id'=> $d->id]);
            }
        }
    }
}
