<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Direction;
use App\Models\Nsia;
use App\Models\SuperMarchand;
use App\Models\Marchand;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //$users = factory(App\User::class, 10)->create();
    // UPDATE `users` SET `password` = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'
    //$2y$10$FD8TAPcBLHVF8L2yVdyUTOfLLCpvkLvgMxFhSHejUr3zaV5oi5g32

    $direction_id = "";
    $supermarchand = "";
    $supermarchand = "";

    for ($i = 0; $i < 12; $i++) {
      $faker = Faker\Factory::create();

      $user = new User([
        'nom' => $faker->name,
        'prenom' => $faker->name,
        'telephone' => '9700000' . $i,

        'sexe' => "Masculin",
        'date_naissance' => now(),
        'situation_matrimoniale' => $faker->name,
        'adresse' => $faker->name,
        'commune_id' => 2,

        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

      if ($i == 0) {
        $direction = Direction::create();
        $direction->users()->save($user)->assignRole('Direction');

        $direction_id = $direction->id;

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 1) {
        $direction_ARH = Direction::create();
        $direction_ARH->users()->save($user)->assignRole('Direction_ARH');
        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 2) {
        $direction_C = Direction::create();
        $direction_C->users()->save($user)->assignRole('Direction_C');
        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 3) {
        $direction_FC = Direction::create();
        $direction_FC->users()->save($user)->assignRole('Direction_FC');
        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 4) {
        $direction_MAC = Direction::create();
        $direction_MAC->users()->save($user)->assignRole('Direction_MAC');
        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 5) {
        $ITMMS = Direction::create();
        $ITMMS->users()->save($user)->assignRole('ITMMS');
        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 6) {
        $nsia = Nsia::create(["direction_id" => $direction_id]);
        $nsia->users()->save($user)->assignRole(config('custom.roles.nsia'));

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 7) {
        $nsia = Nsia::create(["direction_id" => $direction_id]);
        $nsia->users()->save($user)->assignRole(config('custom.roles.nsia1'));

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 8) {
        $nsia = Nsia::create(["direction_id" => $direction_id]);
        $nsia->users()->save($user)->assignRole(config('custom.roles.nsia2'));

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 9) {
        $supermarchand = SuperMarchand::create([
          'entreprise' => 'test',
          'registre' => 'test',
          'personne' => 'morale',
          'direction_id' => $direction_id,
        ]);
        $supermarchand->users()->save($user)->assignRole('SuperMarchand');
        $supermarchand_id = $supermarchand->id;

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      } elseif ($i == 10) {
        $marchand = Marchand::create([
          'entreprise' => 'test',
          'registre' => 'test',
          'personne' => 'morale',
        ]);
        $marchand->users()->save($user)->assignRole('Marchand');
        $marchand->super_marchands()->attach($supermarchand_id);

        $user->createWallet(['name' => 'Solde Principal', 'slug' => 'principal']);
        $user->createWallet(['name' => 'Solde Commission', 'slug' => 'commission']);
      }
    }
  }
}
