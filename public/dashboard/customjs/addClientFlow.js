function getRandomInteger(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}
function randomDate(start, end) {
    return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
}


// function setupFrom(position, data, required="required"){
//     formulaire = '<div class="row">'+
//               '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputNom">Nom *</label>'+
//                 '<input value="test" '+required+' type="text" class="form-control" id="'+data+'InputNom" name="'+data+'nom" placeholder="Entrer nom">'+
//              '</div>'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputPrenom">Prenom *</label>'+
//                 '<input value="test" '+required+' type="text" class="form-control" id="'+data+'InputPrenom" name="'+data+'prenom" placeholder="Entrer prenom">'+
//              '</div>'+
//           '</div>'+
//           '<div class="row">'+
//              '<div class="form-group col-md-4">'+
//                 '<label for="'+data+'InputEmail">Date de naissance *</label>'+
//                 '<input value="1990-02-02" '+required+' type="date" class="form-control" id="'+data+'InputNaissance"  onchange="age(\''+data+'InputNaissance\')" class="telcheck"name="'+data+'date_naissance" placeholder="Entrer date de naissance">'+
//                 '<div id="'+data+'InputNaissance-error" class="text-danger"></div>'+
//              '</div>'+
//              '<div class="form-group col-md-4">'+
//                 '<label>Sexe *</label>'+
//                 '<select '+required+' class="form-control select2bs4" id="'+data+'sexe" name="'+data+'sexe">'+
//                    '<option value="" selected disabled>Choisissez une option...</option>'+
//                    '<option selected value="Masculin" >Masculin</option>'+
//                    '<option value="Feminin" >Féminin</option>'+
//                 '</select>'+
//              '</div>'+
//              '<div class="form-group col-md-4">'+
//                 '<label>Situation Matrimoniale *</label>'+
//                 '<select '+required+' class="form-control select2bs4" id="'+data+'situationmatrimoniale" name="'+data+'situation_matrimoniale">'+
//                    '<option value="" selected disabled>Choisissez une option...</option>'+
//                    '<option selected value="Marié(e)" >Marié(e)</option>'+
//                    '<option value="Celibataire" >Celibataire</option>'+
//                    '<option value="Divorcé(e)" >Divorcé(e)</option>'+
//                    '<option value="Veuf(ve)" >Veuf(ve)</option>'+
//                 '</select>'+
//              '</div>'+
//           '</div>'+
//           '<div class="row">'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputTelephone">Telephone *</label>'+
//                 '<input value="test" '+required+' type="number" class="form-control" id="'+data+'InputTelephone" name="'+data+'telephone" placeholder="Entrer telephone">'+
//                 '<small id="'+data+'InputTelephone-error" class="text-danger"></small>'+
//              '</div>'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputEmail">Email</label>'+
//                 '<input type="text" class="form-control" id="'+data+'InputEmail" name="'+data+'email" placeholder="Entrer email">'+
//              '</div>'+
//           '</div>'+
//           '<div class="row">'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputAdresse">Adresse *</label>'+
//                 '<input value="test" '+required+' type="text" class="form-control" id="'+data+'InputAdresse" name="'+data+'adresse" placeholder="Entrer adresse">'+
//              '</div>'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputIFU">IFU</label>'+
//                 '<input value="test" type="text" class="form-control" id="'+data+'InputIFU" name="'+data+'ifu" placeholder="Entrer IFU">'+
//              '</div>'+
//           '</div>'+
//           '<div class="row">'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputProfession">Profession *</label>'+
//                 '<input value="test" type="text" class="form-control" id="'+data+'InputProfession" name="'+data+'profession" placeholder="Entrer profession">'+
//              '</div>'+
//              '<div class="form-group col-md-6">'+
//                 '<label for="'+data+'InputEmployeur">Employeur *</label>'+
//                 '<input value="test" type="text" class="form-control" id="'+data+'InputEmployeur" name="'+data+'employeur" placeholder="Entrer employeur">'+
//              '</div>'+
//             '</div>';
          
          
//      $(position).html(formulaire);
//      document.getElementById(data+'InputTelephone').addEventListener("change", function(event){
//       event.preventDefault();
//       checkTelephone2('#'+data+'InputTelephone');
//        });
//  }

 
function setupFrom(position, data, required="required"){
    formulaire = '<div class="row">'+
              '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputNom">Nom *</label>'+
                '<input '+required+' type="text" class="form-control" id="'+data+'InputNom" name="'+data+'nom" placeholder="Entrer nom">'+
             '</div>'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputPrenom">Prenom *</label>'+
                '<input '+required+' type="text" class="form-control" id="'+data+'InputPrenom" name="'+data+'prenom" placeholder="Entrer prenom">'+
             '</div>'+
          '</div>'+
          '<div class="row">'+
             '<div class="form-group col-md-4">'+
                '<label for="'+data+'InputEmail">Date de naissance *</label>'+
                '<input '+required+' type="date" class="form-control" id="'+data+'InputNaissance"  onchange="age(\''+data+'InputNaissance\', \''+data+'\')" class="telcheck"name="'+data+'date_naissance" placeholder="Entrer date de naissance">'+
                '<div id="'+data+'InputNaissance-error" class="text-danger"></div>'+
             '</div>'+
             '<div class="form-group col-md-4">'+
                '<label>Sexe *</label>'+
                '<select '+required+' class="form-control select2bs4" id="'+data+'sexe" name="'+data+'sexe">'+
                   '<option value="" selected disabled>Choisissez une option...</option>'+
                   '<option value="Masculin" >Masculin</option>'+
                   '<option value="Feminin" >Féminin</option>'+
                '</select>'+
             '</div>'+
             '<div class="form-group col-md-4">'+
                '<label>Situation Matrimoniale *</label>'+
                '<select '+required+' class="form-control select2bs4" id="'+data+'situationmatrimoniale" name="'+data+'situation_matrimoniale">'+
                   '<option value="" selected disabled>Choisissez une option...</option>'+
                   '<option value="Marié(e)" >Marié(e)</option>'+
                   '<option value="Celibataire" >Celibataire</option>'+
                   '<option value="Divorcé(e)" >Divorcé(e)</option>'+
                   '<option value="Veuf(ve)" >Veuf(ve)</option>'+
                '</select>'+
             '</div>'+
          '</div>'+
          '<div class="row">'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputTelephone">Telephone *</label>'+
                '<input '+required+' type="number" class="form-control" id="'+data+'InputTelephone" name="'+data+'telephone" placeholder="Entrer telephone">'+
                '<small id="'+data+'InputTelephone-error" class="text-danger"></small>'+
                '<div id="'+data+'InputTelephone-results" class=""></div>'+
             '</div>'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputEmail">Email</label>'+
                '<input type="text" class="form-control" id="'+data+'InputEmail" name="'+data+'email" placeholder="Entrer email">'+
             '</div>'+
          '</div>'+
          '<div class="row">'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputAdresse">Adresse *</label>'+
                '<input '+required+' type="text" class="form-control" id="'+data+'InputAdresse" name="'+data+'adresse" placeholder="Entrer adresse">'+
             '</div>'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputIFU">IFU</label>'+
                '<input type="text" class="form-control" id="'+data+'InputIFU" name="'+data+'ifu" placeholder="Entrer IFU">'+
             '</div>'+
          '</div>'+
          '<div class="row">'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputProfession">Profession *</label>'+
                '<input type="text" class="form-control" id="'+data+'InputProfession" name="'+data+'profession" placeholder="Entrer profession">'+
             '</div>'+
             '<div class="form-group col-md-6">'+
                '<label for="'+data+'InputEmployeur">Employeur *</label>'+
                '<input type="text" class="form-control" id="'+data+'InputEmployeur" name="'+data+'employeur" placeholder="Entrer employeur">'+
             '</div>'+
            '</div>';
          
          
     $(position).html(formulaire);
     document.getElementById(data+'InputTelephone').addEventListener("change", function(event){
      event.preventDefault();
      checkTelephone2('#'+data+'InputTelephone');
       });
 }

 

 function loadTaux(data="", required=""){
    remainingtaux = getRemainingTaux();
    formulaire =  '<label for="'+data+'_InputTaux">Taux *</label>'+
 '<div class="input-group">'+
 '<input '+required+' type="number" min="0" max="'+remainingtaux+'" value="0" onchange="checkSommeTaux()" class="form-control" id="'+data+'_InputTaux" name="'+data+'_taux" placeholder="Entrer Taux">'+
 '<div class="input-group-append"><span class="input-group-text">%</span></div>'+
 '<small id="ajaxInputTaux-error" class="text-danger"></small>'+
 '<div id="ajaxInputTaux-results" class=""></div>';
    $(formulaire).insertAfter('#add_'+data);
 }

 function loadTauxIn(position, data="", required=""){
    remainingtaux = getRemainingTaux();
    formulaire =  '<label for="'+data+'_InputTaux">Taux *</label>'+
 '<div class="input-group">'+
 '<input '+required+' type="number" min="0" max="'+remainingtaux+'" value="0" onchange="checkSommeTaux()" class="form-control" id="'+data+'_InputTaux" name="'+data+'_taux" placeholder="Entrer Taux">'+
 '<div class="input-group-append"><span class="input-group-text">%</span></div>'+
 '<small id="ajaxInputTaux-error" class="text-danger"></small>'+
 '<div id="ajaxInputTaux-results" class=""></div>';
//    $(position).html(formulaire);
    //$(formulaire).insertAfter(position);
    $(formulaire).appendTo(position);
 }

 function loadSearchByTelephoneForm(position, data="", required=""){
    remainingtaux = getRemainingTaux();
    formulaire = '<h4>Trouver l\'utilisateur:</h4> <hr class="my-3"></hr>'+
            '<div class="input-group">'+
            '<div class="input-group-prepend"><span class="input-group-text">+ 229 </span></div>'+
            '<input required type="number" max="'+remainingtaux+'" value="" class="form-control" id="'+data+'ajaxInputTelephone" name="'+data+'ajaxTelephone" placeholder="Entrer Telephone">'+
            '<button class="btn btn-primary" id="'+data+'searchUserBtn">Chercher</button></div>'+
            '<small id="'+data+'ajaxInputTelephone-error" class="text-danger"></small>'+
            '<div id="'+data+'ajaxInputTelephone-results" class=""></div>';

    $(position).html(formulaire);
    document.getElementById(data+'searchUserBtn').addEventListener("click", function(event){
        event.preventDefault();
        checkTelephone('#'+data+'ajaxInputTelephone');
    });
}

function createTab(data){
    dataT = data+'_';
    removeTab(data);
    $('#'+data+'_Questions').after('<div class="tab" id="'+data+'_Tab"><h4>Informations '+data+':</h4> <hr class="my-3"><div class="" id="add_'+data+'"></div></div>');
    setupFrom('#add_'+data, data+'_', required="required");
    $('#stepList').append('<span class="step" id="'+data+'_Step"></span>');
}

function regenerateNextQuestionTab(data){
    // createTab(data, required="");
    // loadTaux(data, 'required');
    $('#'+data+'_Questions').show();
    $('#'+data+'_QuestionStep').show();
}

function removeTab(datakey){
    $('#'+datakey+'_Tab').remove();
    $('#'+datakey+'_Step').remove();
}

function removeQuestionsTab(datakey){
    $('#'+datakey+'_Questions').remove();
    $('#'+datakey+'_QuestionStep').remove();
}

function oldUser(datakey){
    loadSearchByTelephoneForm('#'+datakey+'_searchByTelephoneDiv', datakey);
    $('#'+datakey+'_searchByTelephoneDiv').removeClass("d-none");
    removeTab(datakey);
}

function emptyPhoneDiv(data){
    if ($('#'+data+'_searchByTelephoneDiv').html().length){
        $('#'+data+'_searchByTelephoneDiv').html('');
        $('#'+data+'_searchByTelephoneDiv').addClass('d-none');
    }
}

function optionAssure(){
    emptyPhoneDiv('assure');
    removeTab('assure');
    setBeneficiaireNonEligle();
}

function optionBeneficiaire(){
    emptyPhoneDiv('beneficiaire1');
    removeTab('beneficiaire1');
    $('#beneficiaire1_searchByTelephoneDiv').removeClass('d-none');
    loadTauxIn('#beneficiaire1_searchByTelephoneDiv', "beneficiaire1");
    setAssureNonEligle();
}

function addSouscripteurAssure(){
    option = '<input type="radio" required name="assure_type" value="assure_clients" id="assure_clientsRadioInput"> '+
    '<label id="assure_clientsRadioLabel" for="assure_clients">Le souscripteur lui-même </label> <br id="assure_keyline">';
    $(option).insertBefore('#assure_newuserRadioInput');
    document.getElementById('assure_clientsRadioInput').addEventListener("click", function(event){
        optionAssure();
    });
}

function addSouscripteurBeneficiare(){
    option = '<input type="radio" required name="beneficiaire1_type" value="beneficiaire1_clients" id="beneficiaire1_clientsRadioInput"> '+
    '<label id="beneficiaire1_clientsRadioLabel" for="beneficiaire1_clients">Le souscripteur lui-même </label> <br id="beneficiaire1_keyline">';
    $(option).insertBefore('#beneficiaire1_newuserRadioInput');
    document.getElementById('beneficiaire1_clientsRadioInput').addEventListener("click", function(event){
        optionBeneficiaire();
    });
}


function setBeneficiaireEligle(){
    if ( !$("#beneficiaire1_clientsRadioInput").length ) {
        addSouscripteurBeneficiare();
    }
}

function setBeneficiaireNonEligle(){
    $('#beneficiaire1_clientsRadioInput').remove();
    $('#beneficiaire1_clientsRadioLabel').remove();
    $('br#beneficiaire1_keyline').remove();
}

function setAssureEligle(){
    if ( !$("#assure_clientsRadioInput").length ) {
        addSouscripteurAssure();
    }
}

function setAssureNonEligle(){
    $('#assure_clientsRadioInput').remove();
    $('#assure_clientsRadioLabel').remove();
    $('br#assure_keyline').remove();
}

function skipChecks(){
    currentTauxSum = sommeTaux();
    remainingtaux = getRemainingTaux();
    if(currentTauxSum != remainingtaux){
       alert('Le total des taux doit être de '+remainingtaux+'%. Valeur actuelle: '+currentTauxSum+'%. Veuillez d\'abord verifier les taux.');
       return false;
    }else if(currentTauxSum == remainingtaux){
        if(confirm("Etes vous sur d'avoir fini de saisir les bénéficiaires?")){ return true; } else{ return false; }   
    } else {
        alert('Veuillez d\'abord verifier les taux.');
        return false;
    }
}

// function getBackToAssure(){
//     if($("#assure_clientsRadioInput").prop("checked")){
//         $("#assure_clientsRadioInput").prop("checked", false);
//         nextPrev(-1);
//     }
// }

function checkSommeTaux(){
    currentTauxSum = sommeTaux();
    remainingtaux = getRemainingTaux();
    if(currentTauxSum > remainingtaux){
       alert('Le total des taux doit être de '+remainingtaux+'%. Valeur actuelle: '+currentTauxSum+'%. Veuillez verifier les taux.');
       return false;
    }
}

function getRemainingTaux(){
    if(parseInt($("#remainingtaux").text())){ 
        return parseInt($("#remainingtaux").text());
    } else{
        return 0;
    }
}

function sommeTaux(){
    var t2=0;
    var t3=0;
    var t4=0;
    var t5=0;
    var t1=parseInt($("#beneficiaire1_InputTaux").val());
    if(parseInt($("#beneficiaire2_InputTaux").val())){ t2=parseInt($("#beneficiaire2_InputTaux").val()); } else{ t2 =0; }
    if(parseInt($("#beneficiaire3_InputTaux").val())){ t3=parseInt($("#beneficiaire3_InputTaux").val()); } else{ t3 =0; }
    if(parseInt($("#beneficiaire4_InputTaux").val())){ t4=parseInt($("#beneficiaire4_InputTaux").val()); } else{ t4 =0; }
    if(parseInt($("#beneficiaire5_InputTaux").val())){ t5=parseInt($("#beneficiaire5_InputTaux").val()); } else{ t5 =0; }

    return t1+t2+t3+t4+t5;
 }

$('#client_olduserRadioInput').on('click', function() { 
    oldUser('client'); 
});
$('#client_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('client');
    createTab('client');
});


$('#assure_olduserRadioInput').on('click', function() { 
    oldUser('assure');
    setBeneficiaireEligle();
});
$('#assure_clientsRadioInput').on('click', function() {
    optionAssure();
});
$('#assure_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('assure');
    createTab('assure');
    setBeneficiaireEligle();
});


$('#beneficiaire1_olduserRadioInput').on('click', function() { 
    oldUser('beneficiaire1');
    //loadTaux('beneficiaire1', 'required');
    loadTauxIn('#beneficiaire1_searchByTelephoneDiv', "beneficiaire1");
    setAssureEligle();
 });

 $('#beneficiaire1_clientsRadioInput').on('click', function() {
    optionBeneficiaire();
 });
 $('#beneficiaire1_newuserRadioInput').on('click', function() {
     emptyPhoneDiv('beneficiaire1');
     createTab('beneficiaire1');
     loadTaux('beneficiaire1', 'required');
     setAssureEligle();
 }); 


$('#beneficiaire2_olduserRadioInput').on('click', function() { 
    oldUser('beneficiaire2');
    //loadTaux('beneficiaire2', 'required');
    loadTauxIn('#beneficiaire2_searchByTelephoneDiv', "beneficiaire2");
    // regenerateNextQuestionTab('beneficiaire2');
 });
$('#beneficiaire2_clientsRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire2');
    removeTab('beneficiaire2');
});
$('#beneficiaire2_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire2');
    createTab('beneficiaire2', required="");
    loadTaux('beneficiaire2', 'required');
    // regenerateNextQuestionTab('beneficiaire2');
});
$('#beneficiaire2_skipRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire2');
    removeTab('beneficiaire2');
    
    skip = skipChecks();
    if(skip){
        emptyPhoneDiv('beneficiaire3');
        removeTab('beneficiaire3');
        removeQuestionsTab('beneficiaire3');
    
        emptyPhoneDiv('beneficiaire4');
        removeTab('beneficiaire4');
        removeQuestionsTab('beneficiaire4');
    
        emptyPhoneDiv('beneficiaire5');
        removeTab('beneficiaire5');
        removeQuestionsTab('beneficiaire5');

        $('input[name="beneficiaire2_type"]').prop('disabled', true);
    } else{ return false; }

    // nextPrev(1);
});


$('#beneficiaire3_olduserRadioInput').on('click', function() { 
    oldUser('beneficiaire3');
    //loadTaux('beneficiaire3', 'required');
    loadTauxIn('#beneficiaire3_searchByTelephoneDiv', "beneficiaire3");
 });

$('#beneficiaire3_clientsRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire3');
    removeTab('beneficiaire3');
});

$('#beneficiaire3_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire3');
    createTab('beneficiaire3', required="");
    loadTaux('beneficiaire3', 'required');
});

$('#beneficiaire3_skipRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire3');
    removeTab('beneficiaire3');

    skip = skipChecks();
    if(skip){
        emptyPhoneDiv('beneficiaire4');
        removeTab('beneficiaire4');
        removeQuestionsTab('beneficiaire4');
    
        emptyPhoneDiv('beneficiaire5');
        removeTab('beneficiaire5');
        removeQuestionsTab('beneficiaire5');

        $('input[name="beneficiaire3_type"]').prop('disabled', true);
    } else{ return false; }
    // nextPrev(1);
});


$('#beneficiaire4_olduserRadioInput').on('click', function() { 
    oldUser('beneficiaire4');
    //loadTaux('beneficiaire4', 'required');
    loadTauxIn('#beneficiaire4_searchByTelephoneDiv', "beneficiaire4");
 });

$('#beneficiaire4_clientsRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire4');
    removeTab('beneficiaire4');
});

$('#beneficiaire4_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire4');
    createTab('beneficiaire4', required="");
    loadTaux('beneficiaire4', 'required');
});

$('#beneficiaire4_skipRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire4');
    removeTab('beneficiaire4');

    emptyPhoneDiv('beneficiaire5');
    removeTab('beneficiaire5');
    removeQuestionsTab('beneficiaire5');

    skip = skipChecks();
    if(skip){    
        emptyPhoneDiv('beneficiaire5');
        removeTab('beneficiaire5');
        removeQuestionsTab('beneficiaire5');

        $('input[name="beneficiaire4_type"]').prop('disabled', true);
    } else{ return false; }
    // nextPrev(1);
});


$('#beneficiaire5_olduserRadioInput').on('click', function() { 
    oldUser('beneficiaire5');
    loadTauxIn('#beneficiaire5_searchByTelephoneDiv', "beneficiaire5");
 });

$('#beneficiaire5_clientsRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire5');
    removeTab('beneficiaire5');
});

$('#beneficiaire5_newuserRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire5');
    createTab('beneficiaire5', required="");
    loadTaux('beneficiaire5', 'required');
});

$('#beneficiaire5_skipRadioInput').on('click', function() {
    emptyPhoneDiv('beneficiaire5');
    removeTab('beneficiaire5');
    // nextPrev(1);
});


