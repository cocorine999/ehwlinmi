<?php

use App\Models\TicketPriority;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $priorities = [
            'Faible', 'Moyenne', 'Elevée'
        ];

        foreach($priorities as $priority)
        {
            TicketPriority::create([
                'name'  => $priority,
                'color' => $faker->hexcolor
            ]);
        }
    }
}
