@extends('layouts.dash')
@section('pagetitle', "Ajouter un contrat")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/customcss/stepForm.css')}}">
@endsection
@section('content')
<div class="card">
   <div class="card-body">
      <form autocomplete="off" id="regForm" class="CreateContratForm" action="{{route('contrats.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div id="tabList">
            <div class="tab" id="client_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le souscripteur est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="client_type" value="client_olduser" id="client_olduserRadioInput" required="required">
                     <label id="client_olduserRadioLabel" for="client_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="client_type" value="client_newuser" id="client_newuserRadioInput">
                     <label id="client_newuserRadioLabel" for="client_newuser">Un nouvel utilisateur </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="client_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="client_Tab">
               <h4>Informations Souscripteur:</h4>
               <hr class="my-3">
               <div class="" id="add_client"></div>
            </div>
            <div class="tab" id="assure_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>L'assuré est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="assure_type" value="assure_olduser" id="assure_olduserRadioInput" required="required"> 
                     <label id="assure_olduserRadioLabel" for="assure_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="assure_type" value="assure_clients" id="assure_clientsRadioInput"> 
                     <label id="assure_clientsRadioLabel" for="assure_clients">Le souscripteur lui-même </label> <br id="assure_keyline">
                     <input type="radio" name="assure_type" value="assure_newuser" id="assure_newuserRadioInput"> 
                     <label id="assure_newuserRadioLabel" for="assure_newuser">Un nouvel utilisateur </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="assure_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="assure_Tab">
               <h4>Informations Assuré:</h4>
               <hr class="my-3">
               <div class="" id="add_assure"></div>
            </div>
            <!-- <div class="tab" id="beneficiaire1_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le bénéficiaire n°1 est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="beneficiaire1_type" value="beneficiaire1_olduser" id="beneficiaire1_olduserRadioInput" required="required"> 
                     <label id="beneficiaire1_olduserRadioLabel" for="beneficiaire1_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="beneficiaire1_type" value="beneficiaire1_clients" id="beneficiaire1_clientsRadioInput"> 
                     <label id="beneficiaire1_clientsRadioLabel" for="beneficiaire1_clients">Le souscripteur lui-même </label> <br id="beneficiaire1_keyline">
                     <input type="radio" name="beneficiaire1_type" value="beneficiaire1_newuser" id="beneficiaire1_newuserRadioInput"> 
                     <label id="beneficiaire1_newuserRadioLabel" for="beneficiaire1_newuser">Un nouvel utilisateur </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="beneficiaire1_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="beneficiaire1_Tab">
               <h4>Informations Beneficiaire 1:</h4>
               <hr class="my-3">
               <div class="" id="add_beneficiaire1"></div>
               <div id="addTauxbeneficiaire1"></div>
               <br>
               <hr>
               <br>
            </div>
            <div class="tab" id="beneficiaire2_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le bénéficiaire n°2 est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="beneficiaire2_type" value="beneficiaire2_olduser" id="beneficiaire2_olduserRadioInput" required="required"> 
                     <label id="beneficiaire2_olduserRadioLabel" for="beneficiaire2_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="beneficiaire2_type" value="beneficiaire2_newuser" id="beneficiaire2_newuserRadioInput"> 
                     <label id="beneficiaire2_newuserRadioLabel" for="beneficiaire2_newuser">Un nouvel utilisateur </label>  <br>
                     <input type="radio" name="beneficiaire2_type" value="beneficiaire2_skip" id="beneficiaire2_skipRadioInput"> 
                     <label id="beneficiaire2_skipRadioLabel" for="beneficiaire2_skip">Pas de bénéficiaire 2 </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="beneficiaire2_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="beneficiaire2_Tab">
               >
               <h4>Informations Beneficiaire 2:</h4>
               <hr class="my-3">
               <div class="" id="add_beneficiaire2"></div>
               <div id="addTauxbeneficiaire2"></div>
               <br>
               <hr>
               <br>
            </div>
            <div class="tab" id="beneficiaire3_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le bénéficiaire n°3 est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="beneficiaire3_type" value="beneficiaire3_olduser" id="beneficiaire3_olduserRadioInput" required="required"> 
                     <label id="beneficiaire3_olduserRadioLabel" for="beneficiaire3_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="beneficiaire3_type" value="beneficiaire3_newuser" id="beneficiaire3_newuserRadioInput"> 
                     <label id="beneficiaire3_newuserRadioLabel" for="beneficiaire3_newuser">Un nouvel utilisateur </label>  <br>
                     <input type="radio" name="beneficiaire3_type" value="beneficiaire3_skip" id="beneficiaire3_skipRadioInput"> 
                     <label id="beneficiaire3_skipRadioLabel" for="beneficiaire3_skip">Pas de bénéficiaire 3 </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="beneficiaire3_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="beneficiaire3_Tab">
               <h4>Informations Beneficiaire 3:</h4>
               <hr class="my-3">
               <div class="" id="add_beneficiaire3"></div>
               <div id="addTauxbeneficiaire3"></div>
               <br>
               <hr>
               <br>
            </div>
            
            <div class="tab" id="beneficiaire4_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le bénéficiaire n°4 est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="beneficiaire4_type" value="beneficiaire4_olduser" id="beneficiaire4_olduserRadioInput" required="required"> 
                     <label id="beneficiaire4_olduserRadioLabel" for="beneficiaire4_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="beneficiaire4_type" value="beneficiaire4_newuser" id="beneficiaire4_newuserRadioInput"> 
                     <label id="beneficiaire4_newuserRadioLabel" for="beneficiaire4_newuser">Un nouvel utilisateur </label>  <br>
                     <input type="radio" name="beneficiaire4_type" value="beneficiaire4_skip" id="beneficiaire4_skipRadioInput"> 
                     <label id="beneficiaire4_skipRadioLabel" for="beneficiaire4_skip">Pas de bénéficiaire 4 </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="beneficiaire4_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="beneficiaire4_Tab">
               <h4>Informations Beneficiaire 4:</h4>
               <hr class="my-3">
               <div class="" id="add_beneficiaire4"></div>
               <div id="addTauxbeneficiaire4"></div>
               <br>
               <hr>
               <br>
            </div>
            
            <div class="tab" id="beneficiaire5_Questions">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Le bénéficiaire n°5 est :</h4>
                     <hr class="my-3">
                     <input type="radio" name="beneficiaire5_type" value="beneficiaire5_olduser" id="beneficiaire5_olduserRadioInput" required="required"> 
                     <label id="beneficiaire5_olduserRadioLabel" for="beneficiaire5_olduser">Un utilisateur déja présent dans le système </label> <br>
                     <input type="radio" name="beneficiaire5_type" value="beneficiaire5_newuser" id="beneficiaire5_newuserRadioInput"> 
                     <label id="beneficiaire5_newuserRadioLabel" for="beneficiaire5_newuser">Un nouvel utilisateur </label>  <br>
                     <input type="radio" name="beneficiaire5_type" value="beneficiaire5_skip" id="beneficiaire5_skipRadioInput"> 
                     <label id="beneficiaire5_skipRadioLabel" for="beneficiaire5_skip">Pas de bénéficiaire 5 </label>  <br>
                  </div>
                  <div class="col-md-6 d-none" id="beneficiaire5_searchByTelephoneDiv"></div>
               </div>
            </div>
            <div class="tab" id="beneficiaire5_Tab">
               <h4>Informations Beneficiaire 5:</h4>
               <hr class="my-3">
               <div class="" id="add_beneficiaire5"></div>
               <div id="addTauxbeneficiaire5"></div>
               <br>
               <hr>
               <br>
            </div> -->
            <div class="tab">
               <div class="col-sm-12">
                  <div class="text-danger">NB: Ces questions sont destinées à la personne assurée.</div>
                  <div class="text-danger">Cochez si la réponse est oui</div>
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
                     <div class="form-group">
                        <label for="forcni">Carte Nationale Identité</label>
                        <input type="file" class="form-control" id="cni" name="cni" required accept=".jpeg,.png,.jpg" placeholder="Carte Nationale Identité">
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="form-group">
                        <label for="forbai">Bulletin Individuel d'Adhésion</label>
                        <input type="file" class="form-control" id="bai" name="bai" required accept=".jpeg,.png,.jpg" placeholder="Bulletin Individuel d'Adhésion">
                     </div>
                  </div>
               </div>
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
            <span class="step" id="client_Step"></span>
            <span class="step" id="assure_Step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <!-- <span class="step" id="beneficiaire1_Step"></span>
            <span class="step" id="beneficiaire1_QuestionStep"></span>
            <span class="step" id="beneficiaire2_Step"></span>
            <span class="step" id="beneficiaire2_QuestionStep"></span>
            <span class="step" id="beneficiaire3_Step"></span>
            <span class="step" id="beneficiaire3_QuestionStep"></span>
            <span class="step" id="beneficiaire4_Step"></span>
            <span class="step" id="beneficiaire4_QuestionStep"></span>
            <span class="step" id="beneficiaire5_Step"></span>
            <span class="step" id="beneficiaire5_QuestionStep"></span> -->
            <span class="step"></span>
         </div>
      </form>
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/checkIfUserExist.js')}}"></script>
<script src="{{ asset('dashboard/customjs/verficationAge.js')}}"></script>
<script src="{{ asset('dashboard/customjs/addClientFlow.js')}}"></script>
<script src="{{ asset('dashboard/customjs/stepForm.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
<script type="text/javascript"> 
   $(function() {
    setupFrom('#add_client', 'client_', required="required");
    setupFrom('#add_assure', 'assure_', required="required");
    
   //  setupFrom('#add_beneficiaire1', 'beneficiaire1_', required="required");
   //  loadTaux('beneficiaire1', 'required="true"');
   
   //  setupFrom('#add_beneficiaire2', 'beneficiaire2_');
   //  loadTaux('beneficiaire2', '');
   
   //  setupFrom('#add_beneficiaire3', 'beneficiaire3_');
   //  loadTaux('beneficiaire3', '');
    
   //  setupFrom('#add_beneficiaire4', 'beneficiaire4_');
   //  loadTaux('beneficiaire4', '');
    
   //  setupFrom('#add_beneficiaire5', 'beneficiaire5_');
   //  loadTaux('beneficiaire5', '');
    
   });
</script>
@endsection
