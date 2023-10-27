<?php
Route::get('/test/mail', 'TestController@mail');
Route::get('/test/notif', 'TestController@notif');

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/', 'HomeController@search')->name('home.search');
Route::post('/contact', 'HomeController@contact')->name('home.contact');
Route::get('/trouver-marchand', 'HomeController@marchands')->name('home.marchands');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {

  Route::get('/tableau-de-bord', 'DashController@index')->name('dash.index');

  Route::group(['middleware' => ['roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.smarchand')]], function () {
    Route::post('utilisateurs',        ['as' => 'utilisateurs.store',   'uses' => 'UserController@store']); // Enregistrer utilisateurs
    Route::get('utilisateurs/create', ['as' => 'utilisateurs.create',  'uses' => 'UserController@create']); // Enregistrer utilisateurs
  });

  Route::group(['middleware' => ['roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.nsia_all')]], function () {
    Route::get('utilisateurs', ['as' => 'utilisateurs.index',   'uses' => 'UserController@index']); // Lister tous les utilisateurs
  });

  Route::get('utilisateurs/{utilisateur}',       ['middleware' => [
    'roles:' . config('custom.roles.working_users_all')
  ], 'as' => 'utilisateurs.show',    'uses' => 'UserController@show']); // Voir utilisateurs

  Route::group(['middleware' => ['roles:' . config('custom.roles.direction_all')]], function () {
    Route::put('utilisateurs/{utilisateur}',       ['as' => 'utilisateurs.update',  'uses' => 'UserController@update']); // Modifier utilisateurs
    Route::get('utilisateurs/{utilisateur}/edit',  ['as' => 'utilisateurs.edit',    'uses' => 'UserController@edit']); // Modifier utilisateurs
    Route::delete('utilisateurs/{utilisateur}',     ['as' => 'utilisateurs.destroy', 'uses' => 'UserController@destroy']); // Supprimer utilisateurs
    Route::get('/profil/utilisateur/{user}',        ['as' => 'direction.utilisateurs.profil',  'uses' => 'UserController@profildirection']); // Voir profil d'autres utilisateurs
  });

  Route::get('/profil',                           ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'utilisateurs.profil',   'uses' => 'UserController@profil']); // Voir profil utilisateur

  Route::post('utilisateurs/status',              ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_ARH')
  ], 'as' => 'utilisateurs.status',   'uses' => 'UserController@status']); // Bloquer utilisateurs

  Route::get('/point/commissions',                           ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.direction_FC')
  ], 'as' => 'directions.point_commissions',   'uses' => 'DirectionController@point_commission']);


  Route::post('utilisateurs/changer-mot-de-passe', ['as' => 'utilisateurs.changePassword',   'uses' => 'UserController@changePass']); // changer mot de passe utilisateurs

  Route::get('versements',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.index',   'uses' => 'VersementController@index']);

  Route::post('versements',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.store',   'uses' => 'VersementController@store']);

  Route::get('versements/create',            ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.create',  'uses' => 'VersementController@create']);

  Route::put('versements/{direction}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.update',  'uses' => 'VersementController@update']);

  Route::get('versements/{direction}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.show',    'uses' => 'VersementController@show']);

  Route::get('versements/{direction}/edit',  ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.edit',    'uses' => 'VersementController@edit']);

  Route::delete('versements/{direction}',     ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'versements.destroy', 'uses' => 'VersementController@destroy']);


  // Route::get('etats/liste',                   ['as' => 'etats.liste',   'uses' => 'EtatController@list']);
  // Route::post('etats/generate',                   ['as' => 'etats.generate',   'uses' => 'EtatController@generate']);

  Route::get('directions',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.index',   'uses' => 'DirectionController@index']);

  Route::post('directions',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.store',   'uses' => 'DirectionController@store']);

  Route::get('directions/create',            ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.create',  'uses' => 'DirectionController@create']);

  Route::put('directions/{direction}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.update',  'uses' => 'DirectionController@update']);

  Route::get('directions/{direction}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.show',    'uses' => 'DirectionController@show']);

  Route::get('directions/{direction}/edit',  ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.edit',    'uses' => 'DirectionController@edit']);

  Route::delete('directions/{direction}',     ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'directions.destroy', 'uses' => 'DirectionController@destroy']);



  Route::get('nsia',             ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.nsia_all')
  ], 'as' => 'nsia.index',   'uses' => 'NsiaController@index']);

  Route::group(['middleware' => ['roles:' . config('custom.roles.ITNSIA')]], function () {
    Route::post('nsia',         ['as' => 'nsia.store',   'uses' => 'NsiaController@store']);
    Route::get('nsia/create',  ['as' => 'nsia.create',  'uses' => 'NsiaController@create']);
  });

  // Route::put( 'nsia/{nsia}',      ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'nsia.update',  'uses'=>'NsiaController@update']);

  // Route::get( 'nsia/{nsia}',      ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'nsia.show',    'uses'=>'NsiaController@show']);

  // Route::get( 'nsia/{nsia}/edit', ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'nsia.edit',    'uses'=>'NsiaController@edit']);

  // Route::delete('nsia/{nsia}',    ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'nsia.destroy', 'uses'=>'NsiaController@destroy']);



  Route::get('super-marchands',             ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.index',   'uses' => 'SuperMarchandController@index']); // lister super-marchands

  Route::post('super-marchands',             ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.store',   'uses' => 'SuperMarchandController@store']);

  Route::get('super-marchands/create',      ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.create',  'uses' => 'SuperMarchandController@create']);

  Route::put('super-marchands/{super_marchand}',        ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.update',  'uses' => 'SuperMarchandController@update']);

  Route::get('super-marchands/{super_marchand}',        ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.show',    'uses' => 'SuperMarchandController@show']);

  Route::get('super-marchands/{super_marchand}/edit',   ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.edit',    'uses' => 'SuperMarchandController@edit']);

  Route::delete('super-marchands/{super_marchand}',      ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'super-marchands.destroy', 'uses' => 'SuperMarchandController@destroy']);

  Route::get('/mes-supermarchands',           ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'supermarchands.messupermarchands',  'uses' => 'SuperMarchandController@mes_supermarchands']);

  Route::get('/supermarchands-contrats',      ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'supermarchands.contrats',           'uses' => 'SuperMarchandController@mes_contrats']);

  Route::get('/supermarchands/{superMarchand}/', ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'supermarchands.show',            'uses' => 'SuperMarchandController@show']);

  Route::get('/sinistres-supermarchands',     ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'supermarchands.sinistres',          'uses' => 'SuperMarchandController@mes_sinistres']);



  Route::get('marchands',                    ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'marchands.index',       'uses' => 'MarchandController@index']);

  Route::post('marchands',                    ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'marchands.store',       'uses' => 'MarchandController@store']);

  Route::get('marchands/create',             ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'marchands.create',      'uses' => 'MarchandController@create']);

  Route::put('marchands/{marchand}',         ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'marchands.update',      'uses' => 'MarchandController@update']);

  Route::get('marchands/{marchand}',         ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'marchands.show',        'uses' => 'MarchandController@show']);

  Route::get('marchands/{marchand}/edit',    ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'marchands.edit',        'uses' => 'MarchandController@edit']);

  Route::delete('marchands/{marchand}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all')
  ], 'as' => 'marchands.destroy',     'uses' => 'MarchandController@destroy']);

  Route::get('/mes-marchands',                ['middleware' => [
    'roles:' . config('custom.roles.smarchand')
  ], 'as' => 'marchands.mesmarchands', 'uses' => 'MarchandController@mesmarchands']);

  Route::get('/sinistres-marchands',          ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'marchands.sinistres',   'uses' => 'MarchandController@messinistres']);



  Route::get('prospects',            ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.smarchand') . '|' . config('custom.roles.marchand')
  ], 'as' => 'prospects.index',   'uses' => 'ProspectController@index']);

  Route::post('prospects',            ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'prospects.store',   'uses' => 'ProspectController@store']);

  Route::get('prospects/create',     ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'prospects.create',  'uses' => 'ProspectController@create']);

  Route::put('prospects/{id}',       ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'prospects.update',  'uses' => 'ProspectController@update']);

  Route::get('prospects/{id}',       ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.smarchand') . '|' . config('custom.roles.marchand')
  ], 'as' => 'prospects.show',    'uses' => 'ProspectController@show']);

  Route::get('prospects/{id}/edit',  ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'prospects.edit',    'uses' => 'ProspectController@edit']);

  Route::delete('prospects/{id}',     ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'prospects.destroy', 'uses' => 'ProspectController@destroy']);



  Route::get('primes',               ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.index',   'uses' => 'PrimesController@index']);

  Route::post('primes',               ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.store',   'uses' => 'PrimesController@store']);

  Route::get('primes/create',        ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.create',  'uses' => 'PrimesController@create']);

  Route::get('primes/store-correction-maintenance/{reference}/{prime}',        ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'primes.store_correction_maintenance',  'uses' => 'PrimesController@store_correction_maintenance']);

  Route::get('primes/loop-correction/',        ['middleware' => [
    'roles:' . config('custom.roles.ITMMS')
  ], 'as' => 'primes.loop_correction_maintenance',  'uses' => 'FancyPrimeController@store_correction_maintenance']);

  Route::get('contrat/valider-manuellement/',        ['middleware' => [
    'roles:' . config('custom.roles.ITMMS')
  ], 'as' => 'souscriptions.valider_manuellement',  'uses' => 'FancySouscriptionController@payer_adhesion']);

  Route::put('primes/{prime}',       ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.update',  'uses' => 'PrimesController@update']);

  Route::get('primes/{prime}',       ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.show',    'uses' => 'PrimesController@show']);

  Route::get('primes/{prime}/edit',  ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.edit',    'uses' => 'PrimesController@edit']);

  Route::delete('primes/{prime}',     ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'primes.destroy', 'uses' => 'PrimesController@destroy']);



  Route::get('souscripteurs',                  ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.index',     'uses' => 'ClientController@index']);

  Route::post('souscripteurs',                  ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.store',     'uses' => 'ClientController@store']);

  Route::get('souscripteurs/create',           ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.create',    'uses' => 'ClientController@create']);

  Route::put('souscripteurs/{client}',         ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.update',    'uses' => 'ClientController@update']);

  Route::get('souscripteurs/{client}',         ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.show',      'uses' => 'ClientController@show']);

  Route::get('souscripteurs/{client}/edit',    ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.edit',      'uses' => 'ClientController@edit']);

  Route::delete('souscripteurs/{client}',       ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.destroy',   'uses' => 'ClientController@destroy']);

  Route::get('/mes-souscripteurs',              ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'clients.mesclients', 'uses' => 'ClientController@mesclients']);




  // Route::get( 'assures',                  ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.index',   'uses'=>'AssureController@index']);

  // Route::post('assures',                  ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.store',   'uses'=>'AssureController@store']);

  // Route::get( 'assures/create',           ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.create',  'uses'=>'AssureController@create']);

  // Route::put( 'assures/{assure}',         ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.update',  'uses'=>'AssureController@update']);

  // Route::get( 'assures/{assure}',         ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.show',    'uses'=>'AssureController@show']);

  // Route::get( 'assures/{assure}/edit',    ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.edit',    'uses'=>'AssureController@edit']);

  // Route::delete('assures/{assure}',       ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'assures.destroy', 'uses'=>'AssureController@destroy']);



  // Route::get( 'beneficiaires',                      ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.index',   'uses'=>'BeneficiaireController@index']);

  // Route::post('beneficiaires',                      ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.store',   'uses'=>'BeneficiaireController@store']);

  // Route::get( 'beneficiaires/create',               ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.create',  'uses'=>'BeneficiaireController@create']);

  // Route::put( 'beneficiaires/{beneficiaire}',       ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.update',  'uses'=>'BeneficiaireController@update']);

  // Route::get( 'beneficiaires/{beneficiaire}',       ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.show',    'uses'=>'BeneficiaireController@show']);

  // Route::get( 'beneficiaires/{beneficiaire}/edit',  ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.edit',    'uses'=>'BeneficiaireController@edit']);

  // Route::delete('beneficiaires/{beneficiaire}',     ['middleware' => [
  //     'roles:'.config('custom.roles.all')
  // ], 'as'=>'beneficiaires.destroy', 'uses'=>'BeneficiaireController@destroy']);



  Route::get('sinistres',                        ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.index',       'uses' => 'SinistreController@index']);

  Route::post('sinistres',                        ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.store',       'uses' => 'SinistreController@store']);

  Route::get('sinistres/create',                 ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.create',      'uses' => 'SinistreController@create']);

  Route::put('sinistres/{sinistre}',             ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.update',      'uses' => 'SinistreController@update']);

  Route::get('sinistres/{sinistre}',             ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.show',        'uses' => 'SinistreController@show']);

  Route::get('sinistres/{sinistre}/edit',        ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.edit',        'uses' => 'SinistreController@edit']);

  Route::delete('sinistres/{sinistre}',           ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.destroy',     'uses' => 'SinistreController@destroy']);

  Route::get('/mes-sinistres',                    ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.messinistres', 'uses' => "SinistreController@messinistres"]);

  Route::get('/terminer-mes-sinistres/{sinistre}', ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'sinistres.terminer',    'uses' => "SinistreController@termiersinistre"]);



  Route::get('souscriptions',                    ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.index',   'uses' => 'SouscriptionController@index']);

  Route::post('souscriptions',                    ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.store',   'uses' => 'SouscriptionController@store']);

  Route::get('souscriptions/create',             ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.create',  'uses' => 'SouscriptionController@create']);

  Route::put('souscriptions/{souscription}',     ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.update',  'uses' => 'SouscriptionController@update']);

  Route::get('souscriptions/{souscription}',     ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.show',    'uses' => 'SouscriptionController@show']);

  Route::get('souscriptions/{souscription}/edit', ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.edit',    'uses' => 'SouscriptionController@edit']);

  Route::delete('souscriptions/{souscription}',   ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'souscriptions.destroy', 'uses' => 'SouscriptionController@destroy']);

  Route::post('souscriptions/payer',              [
    'middleware' => [
      'roles:' . config('custom.roles.all')
    ], 'as' => 'souscriptions.payer',   'uses' => 'SouscriptionController@payer'
  ]);


  Route::post('souscriptions/renouveller',              [
    'middleware' => [
      'roles:' . config('custom.roles.all')
    ], 'as' => 'souscriptions.renouveller',   'uses' => 'SouscriptionController@renouveller'
  ]);



  Route::get('utilisateurs/{id}/transferall',                 ['middleware' => [
    'roles:' . config('custom.roles.direction') . "|" . config('custom.roles.direction_C') . "|" . config('custom.roles.ITMMS')
  ], 'as' => 'utilisateurs.transferall',   'uses' => 'UserController@transferall']);

  Route::post('utilisateurs/transferall',                 ['middleware' => [
    'roles:' . config('custom.roles.direction') . "|" . config('custom.roles.direction_C') . "|" . config('custom.roles.ITMMS')
  ], 'as' => 'utilisateurs.applytransferall',   'uses' => 'UserController@applyTransfer']);

  Route::get('contrats',                 ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.index',   'uses' => 'ContratController@index']);

  Route::post('contrats',                 ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'contrats.store',   'uses' => 'ContratController@store']);

  Route::post('contrats/resilier',                 ['middleware' => [
    'roles:' . config('custom.roles.ITMMS')
      . '|' . config('custom.roles.smarchand')
      . '|' . config('custom.roles.direction_C')
      . '|' . config('custom.roles.direction_C')
  ], 'as' => 'contrats.resilier',   'uses' => 'ContratController@resilier']);

  Route::post('contrats/annuler',                 ['middleware' => [
    'roles:' . config('custom.roles.ITMMS')
      . '|' . config('custom.roles.smarchand')
      . '|' . config('custom.roles.direction_C')
  ], 'as' => 'contrats.annuler',   'uses' => 'ContratController@annuler']);

  Route::get('contrats/create',          ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'contrats.create',  'uses' => 'ContratController@create']);

  Route::put('contrats/{contrat}',       ['middleware' => [
    'roles:'
      . config('custom.roles.ITMMS')
      . '|' . config('custom.roles.direction')
      . '|' . config('custom.roles.Direction_C')
  ], 'as' => 'contrats.update',  'uses' => 'ContratController@update']);

  Route::get('contrats/{contrat}',       ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.show',    'uses' => 'ContratController@show']);

  Route::get('contrats/{contrat}/edit',  ['middleware' => [
    'roles:' . config('custom.roles.direction')
  ], 'as' => 'contrats.edit',    'uses' => 'ContratController@edit']);

  Route::delete('contrats/{contrat}',     ['middleware' => [
    'roles:' . config('custom.roles.Direction') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'contrats.destroy', 'uses' => 'ContratController@destroy']);

  Route::get('/contrats/beneficiaires/ajouter/{contrat}',    ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'contrats.addBeneficiares',   'uses' => 'ContratController@ajouterBeneficiaires']);

  Route::post('/contrats/beneficiaires/ajouter',  ['middleware' => [
    'roles:' . config('custom.roles.marchand')
  ], 'as' => 'contrats.store.beneficiaires',   'uses' => 'ContratController@storebeneficiaires']);

  Route::get('tous-les-contrats',                ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.all',              'uses' => 'ContratController@all']);

  Route::get('/mes-contrats',                    ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.mescontrats',      'uses' => 'ContratController@mescontrats']);

  Route::get('/contrats-en-attente',             ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.enattente',        'uses' => 'ContratController@enattente']);

  Route::get('contrats-en-attente-paiement',     ['middleware' => [
    'roles:' . config('custom.roles.all')
  ], 'as' => 'contrats.enattentepaiement', 'uses' => 'ContratController@enattentepaiement']);

  Route::get('/valider-contrats/{contrat}',      ['middleware' => [
    'roles:' . config('custom.roles.nsia2')
  ], 'as' => 'contrats.valider',          'uses' => 'ContratController@valider']);

  Route::get('/rejeter-contrats/{contrat}',      ['middleware' => [
    'roles:' . config('custom.roles.nsia2')
  ], 'as' => 'contrats.rejeter',          'uses' => 'ContratController@rejeter']);



  Route::get('contrats/{contrat}/primes/',                 ['middleware' => [], 'as' => 'primes.contrat_primes',        'uses' => 'PrimesController@contrat_primes']);

  Route::get('transactions',                 ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.nsia_all')
  ], 'as' => 'transactions.index',        'uses' => 'MobileMoneyController@index']);

  Route::get('contrats/{contrat}/transactions/',                 ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.nsia_all')
  ], 'as' => 'transactions.contrat_transactions',        'uses' => 'MobileMoneyController@contrat_transactions']);

  Route::get('historique/transactions/',     ['middleware' => [
    'roles:' . config('custom.roles.direction_all') . '|' . config('custom.roles.nsia_all')
  ], 'as' => 'historique.transactions',   'uses' => 'MobileMoneyController@mobileMoneytPdf']);


  // js calls
  Route::post('/check-user-telephone', 'UserController@checkIfTelephoneExist')->name('checkIfTelephoneExist');
  Route::post('/check-user-telephone2', 'UserController@checkIfTelephoneExist2')->name('checkIfTelephoneExist2');
  Route::post('/check-contrat-reference', 'ContratController@checkIfReferenceExist')->name('checkIfReferenceExist');
  Route::post('/get-contrats-by-telephone', 'ContratController@getContratByTelephone')->name('getContratByTelephone');
  Route::get('/get-contrats-by-telephone/{telephone}', 'ContratController@getContratByTelephone2')->name('getContratByTelephone');
  Route::get('/contrats/statut/{reference}', 'SouscriptionController@statutreference')->name('getStatutContratByreference');


  Route::post('retraits/handle',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'retraits.handle',   'uses' => 'RetraitController@handle']);


  Route::post('reglement/multiple/',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.marchand') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'reglement.multiple.index',   'uses' => 'ReglementMultipleController@index']);
  Route::post('reglement/multiple/',                   ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.marchand') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'reglement.multiple.valider',   'uses' => 'ReglementMultipleController@valider']);


  // exportations
  Route::resource('retraits', 'RetraitController');
  Route::resource('etats', 'EtatController');
  Route::post('attente/recherches/contrats', 'EtatController@recherchecontratAttente')->name('attente.recherche.contrat');
  Route::post('historiques/recherches', 'EtatController@rechercheHistorique')->name('recherche.historique');
  Route::get('/etat/contrats', 'ContratController@etatContrat')->name('contrats.etat');
  Route::post('/etat/primes', 'EtatController@exportPrime')->name('primes.etat');
  Route::post('/recherche', 'EtatController@recherche')->name('etats.recherche');
  Route::post('/recherche-commission', 'EtatController@recherchecommission')->name('etats.recherchecommission');
  Route::post('/etat/primes/recherche', 'EtatController@etatPrimes')->name('etats.prime');
  Route::get('/etat/primes/perso', 'EtatController@index')->name('etats.perso');
  Route::get('/etat/primes/gmms', 'EtatController@listeCommissions')->name('etats.listeCommissions');
  Route::post('/export/excel', 'EtatController@export')->name('export');
  Route::post('/export/excel/liste-primes-gmms', 'EtatController@exportExcelListeCommissions')->name('export.excel.listeCommissions');
  Route::post('/historique/excel', 'EtatController@exporttransfert')->name('exporttransfert');
  Route::post('/transfert/excel', 'MobileMoneyController@exportTransfert')->name('exportTransferts');
  Route::post('/contrat/excel', 'EtatController@exportContrat')->name('exportContrat');
  Route::post('/pdf/contrats', 'EtatController@exportPdfContrat')->name('exportPdfContrat');
  Route::post('/pdf/marchands/contrats', 'EtatController@exportPdfContratM')->name('exportPdfContratM');
  Route::get('/pdf/mobileMoney', 'MobileMoneyController@mobileMoneytPdf')->name('momo.pdf');
  Route::post('/historique/contrats', 'EtatController@exportPdfTransfert')->name('exportPdfTransfert');
  Route::post('/pdf/etats', 'EtatController@exportPdfEtat')->name('exportPdfetat');
  Route::post('/pdf/etats/prime', 'EtatController@exportPrimePdfetat')->name('exportPrimePdfetat');
  Route::post('/etat/recettes', 'EtatController@etat_recettes')->name('etats.recettes');
  Route::post('/etat/production', 'EtatController@etat_production')->name('etats.production');

  #Route::get('/env', 'HomeController@env')->name('home.env');
  Route::get('/test/1', 'TestController@test1')->name('test.test1');
  Route::get('/test/2', 'TestController@test2')->name('test.test2');
  Route::get('/test/3', 'TestController@test3')->name('test.test3');
  Route::get('/test/4', 'TestController@test4')->name('test.test4');
  Route::get('/test/5', 'TestController@test5')->name('test.test5');
  Route::get('/test/changeflowcontrat', 'TestController@changeflowcontrat')->name('test.changeflowcontrat');
  Route::get('/test/paiement/', 'TestController@paiement')->name('test.paiement');
  Route::get('/test/sms/', 'TestController@sms')->name('test.sms');
  Route::get('/test/withparams/', 'TestController@withparams')->name('test.withparams');


  Route::get('/logout', 'AuthController@logout')->name('auth.getlogout');


  Route::get('/point/super-marchands',                           ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.direction_MAC')
  ], 'as' => 'directions.point_super_marchands',   'uses' => 'DirectionController@point_super_marchands']);


  Route::get('/point/marchands/{refsm}',                         ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.direction_MAC')
  ], 'as' => 'directions.point_marchands',   'uses' => 'DirectionController@point_marchands']);


  Route::get('/point/contrats/{refm}',                           ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.direction_ARH') . '|' . config('custom.roles.ITMMS') . '|' . config('custom.roles.direction_FC') . '|' . config('custom.roles.direction_MAC')
  ], 'as' => 'directions.point_contrats',   'uses' => 'DirectionController@point_contrats']);

  Route::resource('sms', 'SmsController');

  Route::post('ticket/{ticket}/correction',              ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'tickets.storeCorrection',   'uses' => 'TicketsSystem\TicketsController@correction']);



  Route::get('primes/store-correction-maintenance/{ticket}/{transref}',        ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'primes.store_correction_maintenance',  'uses' => 'PrimesController@store_correction_maintenance']);

  Route::get('contrat/souscription/{ticket}/{transref}',        ['middleware' => [
    'roles:' . config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')
  ], 'as' => 'souscriptions.payer_adhesion',  'uses' => 'SouscriptionController@payer_adhesion']);

  Route::get('etats/liste',                   ['middleware' => [
    'roles:' . config('custom.roles.working_users_all')
  ], 'as' => 'etats.liste',   'uses' => 'EtatController@list']);


  Route::post('etats/generate',                   ['middleware' => [
    'roles:' . config('custom.roles.working_users_all')
  ], 'as' => 'etats.generate',   'uses' => 'EtatController@generate']);



  Route::post('tickets/media', 'TicketController@storeMedia')->name('tickets.storeMedia');
  Route::post('tickets/comment/{ticket}', 'TicketController@storeComment')->name('tickets.storeComment');
  Route::resource('tickets', 'TicketController')->only(['show', 'create', 'store']);

  Route::group(['namespace' => 'TicketsSystem'], function () {
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Tickets
    Route::delete('tickets/destroy', 'TicketsController@massDestroy')->name('tickets.massDestroy');
    Route::post('tickets/media', 'TicketsController@storeMedia')->name('tickets.storeMedia');
    Route::post('tickets/comment/{ticket}', 'TicketsController@storeComment')->name('tickets.storeComment');
    Route::resource('tickets', 'TicketsController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');
  });
});
