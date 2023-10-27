<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
     return $request->user();
});


Route::post('/login','Api\AuthController@login')->name('api.login');


Route::middleware('auth:api')->group(function() {


    Route::get('/user','Api\AuthController@get_authenticated_user')->name('api.get_authenticated_user');
    Route::get('/checkIfUserHasRole/{role}','Api\AuthController@checkIfUserHasRole')->name('api.check_if_user_has_role');
    Route::get('/getUserRoles','Api\AuthController@getUserRoles')->name('api.get_user_roles');
    Route::post('/logout','Api\AuthController@logout')->name('api.logout');


    Route::get('/getCommunes', 'Api\AppController@getCommunes')->name('get_communes.api');
    Route::get('/getUserProspects', 'Api\AppController@getUserProspects')->name('get_user_prospects.api');
    Route::get('/getUserSinistres', 'Api\AppController@getUserSinistres')->name('get_user_sinistres.api');
    Route::post('/addNewProspect', 'Api\AppController@addProspect')->name('add_new_prospect.api');
    Route::post('/addNewSinistre', 'Api\AppController@addSinistre')->name('add_new_sinistre.api');
    Route::get('/getUserMarchands', 'Api\AppController@getUserMarchands')->name('get_user_marchands.api');
    Route::get('/getMarchandByKey', 'Api\AppController@getMarchandByKey')->name('get_marchand_by_key.api');
    Route::get('/getCounts', 'Api\AppController@getCounts')->name('get_counts.api');
    Route::get('/getAllSuperMarchands', 'Api\AppController@getAllSuperMarchands')->name('get_all_supermarchands.api');



    Route::post('/paiementPrime', 'Api\ContratController@paiementPrime')->name('paiement_prime.api');
    Route::post('/addNewContrat', 'Api\ContratController@store')->name('add_new_contrat.api');
    Route::post('/addBeneficiaires', 'Api\ContratController@storeBeneficiaires')->name('add_new_beneficiaire.api');

    Route::get('/getUserContrats','Api\AppController@getUserContrats')->name('api.get_user_contrats');
    //Route::get('/getUserContratByReference','Api\AppController@getUserContratByReference')->name('api.get_user_contrats');
    Route::get('/getContratsValide','Api\AppController@getContratsValide')->name('api.get_contrats_valide');
    Route::get('/getContratByReference','Api\AppController@getContratByReference')->name('api.get_contrat_by_reference');
    Route::get('/getContratByReferenceOrPhone/{request}','Api\AppController@getContratByReferenceOrPhone')->name('api.get_contrat_by_reference_phone');
    Route::get('/getContratsByClientPhoneNumber/{request}','Api\AppController@getContratsByClientPhoneNumber')->name('api.get_contrats_by_client_phone_number');

    //Route::get('/getContratByTelephone/{telephone}', 'Api\ContratController@getContratByTelephone')->name('get_contrat_by_telephone.api');
    Route::get('/getUserByTelephone/{request}/{message}', 'Api\ContratController@getUserByTelephone')->name('get_user_by_telephone.api');
    Route::get('/verifAge/{request}/{type}', 'Api\ContratController@verifAge')->name('verif_age.api');
    Route::get('/verifTelephone/{request}', 'Api\ContratController@verifTelephone')->name('verif_telephone.api');
    Route::get('/verifEmail/{request}', 'Api\ContratController@verifEmail')->name('verif_email.api');
    Route::get('/verifIfBeneficiaireNotAlreadyAssure/{request}/{assure_user_id}', 'Api\ContratController@verifIfBeneficiaireNotAlreadyAssure')->name('verif_if_beneficiaire_not_already_assure.api');
    Route::get('/ajouterBeneficiaire', 'Api\ContratController@ajouterBeneficiaires')->name('ajouter_beneficiaires.api');
    //Route::get('/checkIfReferenceExist/{reference}', 'Api\ContratController@checkIfReferenceExist')->name('check_if_reference_exist.api');

});
