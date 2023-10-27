<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['p'=>'store assures',      'r'=> ['Marchand' ]],
            ['p'=>'index assures',      'r'=> ['*']],
            ['p'=>'create assures',     'r'=> ['Marchand']],
            ['p'=>'destroy assures',    'r'=> []],
            ['p'=>'update assures', 'r'=> ['Marchand', ]],
            ['p'=>'show assures', 'r'=> ['*', ]],
            ['p'=>'edit assures', 'r'=> ['Marchand', ]],
            ['p'=>'store beneficiaires', 'r'=> ['role', ]],
            ['p'=>'index beneficiaires', 'r'=> ['role', ]],
            ['p'=>'create beneficiaires', 'r'=> ['role', ]],
            ['p'=>'destroy beneficiaires', 'r'=> ['role', ]],
            ['p'=>'update beneficiaires', 'r'=> ['role', ]],
            ['p'=>'show beneficiaires', 'r'=> ['role', ]],
            ['p'=>'edit beneficiaires', 'r'=> ['role', ]],
            ['p'=>'index clients', 'r'=> ['role', ]],
            ['p'=>'store clients', 'r'=> ['role', ]],
            ['p'=>'create clients', 'r'=> ['role', ]],
            ['p'=>'destroy clients', 'r'=> ['role', ]],
            ['p'=>'update clients', 'r'=> ['role', ]],
            ['p'=>'show clients', 'r'=> ['role', ]],
            ['p'=>'edit clients', 'r'=> ['role', ]],
            ['p'=>'index dash', 'r'=> ['role', ]],
            ['p'=>'index directions', 'r'=> ['role', ]],
            ['p'=>'store directions', 'r'=> ['role', ]],
            ['p'=>'create directions', 'r'=> ['role', ]],
            ['p'=>'show directions', 'r'=> ['role', ]],
            ['p'=>'update directions', 'r'=> ['role', ]],
            ['p'=>'destroy directions', 'r'=> ['role', ]],
            ['p'=>'edit directions', 'r'=> ['role', ]],
            ['p'=>'index supermarchands', 'r'=> ['role', ]],
            ['p'=>'store supermarchands', 'r'=> ['role', ]],
            ['p'=>'create supermarchands', 'r'=> ['role', ]],
            ['p'=>'destroy supermarchands', 'r'=> ['role', ]],
            ['p'=>'update supermarchands', 'r'=> ['role', ]],
            ['p'=>'show supermarchands', 'r'=> ['role', ]],
            ['p'=>'edit supermarchands', 'r'=> ['role', ]],
            ['p'=>'store nsia', 'r'=> ['role', ]],
            ['p'=>'index nsia', 'r'=> ['role', ]],
            ['p'=>'create nsia', 'r'=> ['role', ]],
            ['p'=>'destroy nsia', 'r'=> ['role', ]],
            ['p'=>'update nsia', 'r'=> ['role', ]],
            ['p'=>'show nsia', 'r'=> ['role', ]],
            ['p'=>'edit nsia', 'r'=> ['role', ]],
            ['p'=>'confirm password', 'r'=> ['role', ]],
            ['p'=>'email password', 'r'=> ['role', ]],
            ['p'=>'request password', 'r'=> ['role', ]],
            ['p'=>'update password', 'r'=> ['role', ]],
            ['p'=>'reset password', 'r'=> ['role', ]],
            ['p'=>'store marchands', 'r'=> ['role', ]],
            ['p'=>'index marchands', 'r'=> ['role', ]],
            ['p'=>'create marchands', 'r'=> ['role', ]],
            ['p'=>'destroy marchands', 'r'=> ['role', ]],
            ['p'=>'update marchands', 'r'=> ['role', ]],
            ['p'=>'show marchands', 'r'=> ['role', ]],
            ['p'=>'edit marchands', 'r'=> ['role', ]],
            ['p'=>'status users', 'r'=> ['role', ]],
            ['p'=>'store utilisateurs', 'r'=> ['role', ]],
            ['p'=>'index utilisateurs', 'r'=> ['role', ]],
            ['p'=>'create utilisateurs', 'r'=> ['role', ]],
            ['p'=>'destroy utilisateurs', 'r'=> ['role', ]],
            ['p'=>'update utilisateurs', 'r'=> ['role', ]],
            ['p'=>'show utilisateurs', 'r'=> ['role', ]],
            ['p'=>'edit utilisateurs', 'r'=> ['role', ]],
            ['p'=>'index visiteurs', 'r'=> ['role', ]],
            ['p'=>'store visiteurs', 'r'=> ['role', ]],
            ['p'=>'create visiteurs', 'r'=> ['role', ]],
            ['p'=>'show visiteurs', 'r'=> ['role', ]],
            ['p'=>'update visiteurs', 'r'=> ['role', ]],
            ['p'=>'destroy visiteurs', 'r'=> ['role', ]],
            ['p'=>'edit visiteurs', 'r'=> ['role', ]],
        ];

        foreach ($permissions as $p){
            Permission::create(['name' => $p['p']]);
        }

        $roles = [
            'Direction', 'Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS',
            'SuperMarchand', 'Marchand', 'Client', 'Assuré', 'Bénéficiaire',
            'Nsia', 'Nsia1', 'Nsia2', 'ITNSIA',
        ];
        foreach ($roles as $r){
            Role::create(['name' => $r]);
        }

        // foreach (\App\User::all() as $user){
        //     $user->assignRole('Direction');
        // }
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo(['edit articles']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
