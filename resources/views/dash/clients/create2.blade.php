@extends('layouts.dash')
@section('pagetitle', "Ajouter un contrat")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
   .select2{
   width: 100%;
   }
   /* Mark input boxes that gets an error on validation: */
   input.invalid {
   background-color: #ffdddd;
   }
   /* Hide all steps by default: */
   .tab {
   display: none;
   }
   /* Make circles that indicate the steps of the form: */
   .step {
   height: 15px;
   width: 15px;
   margin: 0 2px;
   background-color: #bbbbbb;
   border: none;  
   border-radius: 50%;
   display: inline-block;
   opacity: 0.5;
   }
   .step.active {
   opacity: 1;
   }
   /* Mark the steps that are finished and valid: */
   .step.finish {
   background-color: #4CAF50;
   }
</style>
@endsection
@section('content')
<div class="card">
   <div class="card-body">
      <form autocomplete="off" id="regForm" class="CreateContratForm" action="{{route('clients.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div id="tabList">

            <div class="tab">
               <h4>Entrer les informations du client:</h4>
               <hr class="my-3">
               <div class="" id="addClient"></div>
            </div>

            <div class="tab" id="assureQuestions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>L'assuré est :</h4> <hr class="my-3">
                     <input type="radio" name="assuretype" value="olduser" id="olduserRadioInput"> <label id="olduserRadioLabel" for="olduser">Un utilisateur deja present dans le système </label> <br>
                     <input type="radio" name="assuretype" value="clients" id="clientsRadioInput"> <label id="clientsRadioLabel" for="clients">Le souscripteur lui-même </label> <br>
                     <input type="radio" name="assuretype" value="newuser" id="newuserRadioInput"> <label id="newuserRadioLabel" for="newuser">Un nouvel utilisateur </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="searchByTelephoneDiv"></div>
               </div>
            </div>

            <div class="tab" id="assureTab">
               <h4>Entrer les informations de l'assuré:</h4> <hr class="my-3">
               <div class="" id="addAssure"></div>
            </div>

            <div class="tab">
               <h4>Entrer les informations du Beneficiaire 1:</h4>
               <hr class="my-3">
               <div class="" id="addBeneficiaire1"></div> <div id="addTauxBeneficiaire1"></div> <br><hr><br>
               <h4>Entrer les informations du Beneficiaire 2:</h4>
               <hr class="my-3">
               <div class="" id="addBeneficiaire2"></div> <div id="addTauxBeneficiaire2"></div> <br><hr><br>
               <h4>Entrer les informations du Beneficiaire 3:</h4>
               <hr class="my-3">
               <div class="" id="addBeneficiaire3"></div> <div id="addTauxBeneficiaire3"></div> <br><hr><br>
            </div>

            <div class="tab">
               <div class="col-sm-12">
                  <div class="form-group">
                     <input type="checkbox" class="" id="q1" value="1" name="q1" >
                     <label for="forRef">Etes vous actuellement malade ou hospitalisé ?</label>
                  </div>
                  <div class="form-group">
                     <input type="checkbox" class="" id="q2" value="1" name="q2" >
                     <label for="forRef">Avez vous fait un accident au cours de ces trois derniers mois ?</label>
                  </div>
                  <div class="form-group">
                     <input type="checkbox" class="" id="q3" value="1" name="q3" >
                     <label for="forRef">Souffrez vous ou avez vous souffert de l'Hepatite, Tuberculose, Diabète, AVC ?</label>
                  </div>
                  <div class="form-group">
                     <input type="checkbox" class="" id="q4" value="1" name="q4" >
                     <label for="forRef">Etes vous immobilisé pour une raison de santé ?</label>
                  </div>
                  <div class="form-group">
                     <input type="checkbox" class="" id="q5" value="1" name="q5" >
                     <label for="forRef">Etes vous en bonne santé ?</label>
                  </div>
               </div>
            </div>

            <div class="tab">
               <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <!-- text input -->
                      <div class="form-group">
                       <label for="forcni">CNI</label>
                       <input type="file" class="form-control" id="cni" name="cni" required accept=".jpeg,.png,.jpg,.gif,.svg" placeholder="Référence">
                    </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                       <label for="forbia">BIA</label>
                       <input type="file" class="form-control" id="bia" name="bia" required accept=".jpeg,.png,.jpg,.gif,.svg" placeholder="Prime">
                   </div>
                    </div>
                  </div>
                  <p>
                  Un total de 1000 FCFA sera prelevé de votre compte pour validation de la création du contrat
                  </p>
            </div>
            
         </div>

         <hr class="my-3">
         <div style="overflow:auto;">
            <div>
               <button type="button" id="prevBtn" class="btn btn-primary float-left" onclick="nextPrev(-1)">Précédent</button>
               <button type="button" id="nextBtn" class="btn btn-primary float-right" onclick="nextPrev(1)">Suivant</button>
            </div>
         </div>
         <div style="text-align:center;margin-top:40px;" id="stepList">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step" id="assureStep"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
         </div>
      </form>
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/checkIfUserExist.js')}}"></script>
<script src="{{ asset('dashboard/customjs/verficationAge.js')}}" type="text/javascript"></script>
<script src="{{ asset('dashboard/customjs/addClientFlow.js')}}"></script>
<script src="{{ asset('dashboard/customjs/documentReadyAddClient.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
<script>
function sommeTaux(){
   var t1=parseInt($("#beneficiaire1_InputTaux").val());    
   var t2=parseInt($("#beneficiaire2_InputTaux").val());
   var t3=parseInt($("#beneficiaire3_InputTaux").val());    
   return t1+t2+t3;
}
</script>
<script>
   var currentTab = 0; // Current tab is set to be the first tab (0)
   showTab(currentTab); // Display the current tab
   
   function showTab(n) {
     // This function will display the specified tab of the form...
     var x = document.getElementsByClassName("tab");
     x[n].style.display = "block";
     //... and fix the Previous/Next buttons:
     if (n == 0) {
       document.getElementById("prevBtn").style.display = "none";
     } else {
       document.getElementById("prevBtn").style.display = "inline";
     }
     if (n == (x.length - 1)) {
       document.getElementById("nextBtn").innerHTML = "Enregistrer";
     } else {
       document.getElementById("nextBtn").innerHTML = "Suivant";
     }
     //... and run a function that will display the correct step indicator:
     fixStepIndicator(n)
   }
   
   function nextPrev(n) {
     // This function will figure out which tab to display
     var x = document.getElementsByClassName("tab");
     // Exit the function if any field in the current tab is invalid:
     if (n == 1 && !validateForm()) return false;
     // Hide the current tab:
     x[currentTab].style.display = "none";
     // Increase or decrease the current tab by 1:
     currentTab = currentTab + n;
     // if you have reached the end of the form...
     if (currentTab >= x.length) {
        totalTaux = sommeTaux();
       if(totalTaux == 100){
         document.getElementById("regForm").submit();
         return false;
       }
       else{
          alert('Le total des taux doit être de 100');
          currentTab = currentTab - 1;
       }
     }
     // Otherwise, display the correct tab:
     showTab(currentTab);
   }
   
   function validateForm() {
     // This function deals with validation of the form fields
     var x, y, i, valid = true;
     x = document.getElementsByClassName("tab");
     y = x[currentTab].getElementsByTagName("input");
     // A loop that checks every input field in the current tab:
     for (i = 0; i < y.length; i++) {
       // If a field is empty...
       if (y[i].value == "" && y[i].hasAttribute('required') ) {
         if(y[i].hasAttribute('required')){
           // add an "invalid" class to the field:
           y[i].className += " invalid";
           // and set the current valid status to false
           valid = false;
         }
       }
     }
     // If the valid status is true, mark the step as finished and valid:
     if (valid) {
       document.getElementsByClassName("step")[currentTab].className += " finish";
     }
     return valid; // return the valid status
   }
   
   function fixStepIndicator(n) {
     // This function removes the "active" class of all steps...
     var i, x = document.getElementsByClassName("step");
     for (i = 0; i < x.length; i++) {
       x[i].className = x[i].className.replace(" active", "");
     }
     //... and adds the "active" class on the current step:
     x[n].className += " active";
   }
</script>
<script type="text/javascript">
   function setupFrom(position, data, required=""){
    
     formulaire =             '<div class="row">'+
                '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputNom">Nom *</label>'+
                  '<input  '+required+' type="text" class="form-control" id="'+data+'InputNom" name="'+data+'nom" placeholder="Entrer nom">'+
               '</div>'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputPrenom">Prenom *</label>'+
                  '<input  '+required+' type="text" class="form-control" id="'+data+'InputPrenom" name="'+data+'prenom" placeholder="Entrer prenom">'+
               '</div>'+
            '</div>'+
            '<div class="row">'+
               '<div class="form-group col-md-4">'+
                  '<label for="'+data+'InputEmail">Date de naissance *</label>'+
                  '<input  '+required+' type="date" class="form-control" id="'+data+'InputNaissance"  onchange="age(\''+data+'InputNaissance\','+data+')" class="telcheck"name="'+data+'date_naissance" placeholder="Entrer date de naissance">'+
                  '<div id="'+data+'InputNaissance-error" class="text-danger"></div>'+
               '</div>'+
               '<div class="form-group col-md-4">'+
                  '<label>Sexe *</label>'+
                  '<select '+required+' class="form-control select2bs4" id="'+data+'sexe" name="'+data+'sexe">'+
                     '<option value="" selected disabled>Choisissez une option...</option>'+
                     '<option value="Masculin" >Masculin</option>'+
                     '<option selected value="Feminin" >Féminin</option>'+
                  '</select>'+
               '</div>'+
               '<div class="form-group col-md-4">'+
                  '<label>Situation Matrimoniale *</label>'+
                  '<select '+required+' class="form-control select2bs4" id="'+data+'situationmatrimoniale" name="'+data+'situation_matrimoniale">'+
                     '<option value="" selected disabled>Choisissez une option...</option>'+
                     '<option value="Marié(e)" >Marié(e)</option>'+
                     '<option value="Celibataire" >Celibataire</option>'+
                     '<option value="Divorcé(e)" >Divorcé(e)</option>'+
                     '<option selected value="Veuf(ve)" >Veuf(ve)</option>'+
                  '</select>'+
               '</div>'+
            '</div>'+
            '<div class="row">'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputTelephone">Telephone *</label>'+
                  '<input value="" '+required+' type="number" class="form-control" id="'+data+'InputTelephone" name="'+data+'telephone" placeholder="Entrer telephone">'+
                  '<small id="'+data+'InputTelephone-error" class="text-danger"></small>'+
               '</div>'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputEmail">Email</label>'+
                  '<input value="" type="email" class="form-control" id="'+data+'InputEmail" name="'+data+'email" placeholder="Entrer email">'+
               '</div>'+
            '</div>'+
            '<div class="row">'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputAdresse">Adresse *</label>'+
                  '<input  '+required+' type="text" class="form-control" id="'+data+'InputAdresse" name="'+data+'adresse" placeholder="Entrer adresse">'+
               '</div>'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputIFU">IFU</label>'+
                  '<input  type="text" class="form-control" id="'+data+'InputIFU" name="'+data+'ifu" placeholder="Entrer IFU">'+
               '</div>'+
            '</div>'+
            '<div class="row">'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputProfession">Profession *</label>'+
                  '<input  type="text" class="form-control" id="'+data+'InputProfession" name="'+data+'profession" placeholder="Entrer profession">'+
               '</div>'+
               '<div class="form-group col-md-6">'+
                  '<label for="'+data+'InputEmployeur">Employeur *</label>'+
                  '<input  type="text" class="form-control" id="'+data+'InputEmployeur" name="'+data+'employeur" placeholder="Entrer employeur">'+
               '</div>'
            '</div>';
            
            
       $(position).html(formulaire);
       document.getElementById(data+'InputTelephone').addEventListener("change", function(event){
        event.preventDefault();
        checkTelephone2('#'+data+'InputTelephone');
         });
   }


   function loadTaux(position, data="", required=""){
      formulaire =  '<label for="'+data+'InputTaux">Taux *</label>'+
               '<div class="input-group">'+
               '<input '+required+' type="number" value="0" class="form-control" id="'+data+'InputTaux" name="'+data+'taux" placeholder="Entrer Taux">'+
               '<div class="input-group-append"><span class="input-group-text">%</span></div>'+
               '<small id="ajaxInputTaux-error" class="text-danger"></small>'+
               '<div id="ajaxInputTaux-results" class=""></div>';
         
      $(position).html(formulaire);
   }

   
   $(function() {
    setupFrom('#addClient', 'client_', required="required");
    setupFrom('#addAssure', 'assure_', required="required");
    
    setupFrom('#addBeneficiaire1', 'beneficiaire1_', required="required");
    loadTaux('#addTauxBeneficiaire1', 'beneficiaire1_', required="required");

    setupFrom('#addBeneficiaire2', 'beneficiaire2_');
    loadTaux('#addTauxBeneficiaire2', 'beneficiaire2_', required="false");

    setupFrom('#addBeneficiaire3', 'beneficiaire3_');
    loadTaux('#addTauxBeneficiaire3', 'beneficiaire3_', required="false");
   });
</script>
@endsection
