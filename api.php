<?php

use Illuminate\Http\Request;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user', function (Request $request) {
     return $request;
 });

Route::post('check-user', 'Api\UssdController@check_user');

Route::post('liste-contrats', 'Api\UssdController@liste_contrats');

# Route::post('liste-contrats', 'Api\UssdController@liste_contrats');

Route::post('post-paiement', 'Api\UssdController@post_paiement');


Route::post('/logIn', 'Api\AuthController@logIn')->name('log_in.api');

Route::middleware('auth:api')->group(function () {
    Route::post('/logOut', 'Api\AuthController@logOut')->name('log_out.api');
    Route::get('/getUser', 'Api\AuthController@getUser')->name('get_user.api');
    Route::get('/getCommunes', 'Api\AuthController@getCommunes')->name('get_communes.api');
    Route::get('/getUserProspects', 'Api\AuthController@getUserProspects')->name('get_user_prospects.api');
    Route::get('/getUserSinistres', 'Api\AuthController@getUserSinistres')->name('get_user_sinistres.api');
    Route::get('/getUserContrats', 'Api\AuthController@getUserContrats')->name('get_user_contrats.api');
    Route::get('/getUserMarchands', 'Api\AuthController@getUserMarchands')->name('get_user_marchands.api');

    Route::get('/getCounts', 'Api\AuthController@getCounts')->name('get_counts.api');
    Route::get('/getAllProspects', 'Api\AuthController@getAllProspects')->name('get_all_prospects.api');
    Route::get('/getAllSinistres', 'Api\AuthController@getAllSinistres')->name('get_all_sinistres.api');
    Route::get('/getAllContrats', 'Api\AuthController@getAllContrats')->name('get_all_contrats.api');
    Route::get('/getAllMarchands', 'Api\AuthController@getAllMarchands')->name('get_all_marchands.api');
    Route::get('/getAllSuperMarchands', 'Api\AuthController@getAllSuperMarchands')->name('get_all_supermarchands.api');

    Route::post('/addNewProspect', 'Api\AuthController@addProspect')->name('add_new_prospect.api');
    Route::post('/addNewSinistre', 'Api\AuthController@addSinistre')->name('add_new_sinistre.api');
    Route::post('/addNewContrat', 'Api\ContratController@store')->name('add_new_contrat.api');
    Route::post('/addBeneficiaires', 'Api\ContratController@storeBeneficiaires')->name('add_new_beneficiaire.api');
    Route::post('/paiementPrime', 'Api\ContratController@paiementPrime')->name('paiement_prime.api');


//OK
    Route::get('/getContratByTelephone/{telephone}', 'Api\ContratController@getContratByTelephone')->name('get_contrat_by_telephone.api');
    Route::get('/getUserByTelephone/{telephone}/{message}', 'Api\ContratController@getUserByTelephone')->name('get_user_by_telephone.api');
    Route::get('/verifAge/{date}/{usertype}', 'Api\ContratController@verifAge')->name('verif_age.api');
    Route::get('/verifTelephone/{telephone}/{who}', 'Api\ContratController@verifTelephone')->name('verif_telephone.api');
    Route::get('/verifEmail/{email}/{who}', 'Api\ContratController@verifEmail')->name('verif_email.api');
    Route::post('/verifIfBeneficiaireNotAlreadyAssure/{id}/{telephone}/{message}', 'Api\ContratController@verifIfBeneficiaireNotAlreadyAssure')->name('verif_if_beneficiaire_not_already_assure.api');
    Route::get('/ajouterBeneficiaire/{reference}', 'Api\ContratController@ajouterBeneficiaires')->name('ajouter_beneficiaires.api');
    Route::get('/checkIfReferenceExist/{reference}', 'Api\ContratController@checkIfReferenceExist')->name('check_if_reference_exist.api');

});
