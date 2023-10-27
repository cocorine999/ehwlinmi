<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // DepartementSeeder::class,
            // CommuneSeeder::class,
            // RolesAndPermissionsSeeder::class,
            // UserSeeder::class,
            // DirectionSeeder::class,
            // SuperMarchandSeeder::class,
            // MarchandSeeder::class,
            // AssureSeeder::class,
            // ClientSeeder::class,
            // BeneficiaireSeeder::class,
            // NsiaSeeder::class,
            // ContratSeeder::class,
            // StatutSouscriptionSeeder::class,
            TicketCategorySeeder::class,
            TicketPrioritySeeder::class,
            TicketStatusSeeder::class,

        ]);
        
    }
}
