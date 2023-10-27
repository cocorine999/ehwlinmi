<?php

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $statuses = [
            'Ouvert', 'En cours' , 'Fermé'
        ];

        foreach($statuses as $status)
        {
            TicketStatus::create([
                'name'  => $status,
                'color' => $faker->hexcolor
            ]);
        }
    }
}
