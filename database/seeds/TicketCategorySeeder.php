<?php

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $permissions = [
        //      'user_management_access',
             
        //      'permission_create','permission_edit','permission_show','permission_delete','permission_access',

        //      'role_create', 'role_edit', 'role_show', 'role_delete', 'role_access', 
             
        //      'user_create', 'user_edit', 'user_show', 'user_delete', 'user_access',

        //      'status_create', 'status_edit', 'status_show', 'status_delete', 'status_access', 
             
        //      'priority_create','priority_edit','priority_show','priority_delete','priority_access',

        //      'category_create','category_edit','category_show','category_delete','category_access',

        //      'ticket_create','ticket_edit','ticket_show','ticket_delete','ticket_access',

        //      'comment_create','comment_edit','comment_show','comment_delete','comment_access',             

        //      'dashboard_access',
        // ];

        // foreach ($permissions as $p){
        //     Permission::create(['name' => $p['p']]);
        // }

        $faker = Faker\Factory::create();
        $categories = [
            "Paiement adhesion", "Paiement prime", "Edition Utilisateur", "Autres"
        ];

        foreach($categories as $category)
        {
            TicketCategory::create([
                'name'  => $category,
                'color' => $faker->hexcolor
            ]);
        }
    }
}
