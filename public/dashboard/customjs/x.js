// $('#oldcontratRadioInput').on('click', function() {
//     loadSearchByTelephoneForm("#searchByTelephoneDiv");
//     $("#searchByTelephoneDiv").removeClass("d-none");
//     removeAssureTab();
// });

function checkReference(elmt){
    var reference = $(elmt).val();
    if (reference.trim().length >= 4) {
      var server_url = '/check-contrat-reference';
      var formData = new FormData();
      formData.append('reference', reference);
      $.ajax({
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: server_url,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'text',

        success: function(response){
          var response = JSON.parse(response);
          if (response.contrat) {
            $("#ajaxInputReference-error").html('');
            $("#ajaxInputReference-results").html('<div class="card mt-2"><div class="card-body">Réference: '+response.contrat.reference+' <br>Assuré: '+response.assure+'</div></div>');
            $("#ajaxInputReference-sinistre").html('<button type="submit" class="btn btn-primary d-none">Enregistrer</button>');
            $("#ajaxInputReference-sinistre-msg").html('<div class="card mt-2"><div class="card-body">Réference: '+response.contrat.reference+' <br>Assuré: '+response.assure+' <br><span class="text-danger" role="alert"><strong>Un sinistre existe sur ce contrat.</strong></span></div></div> ');
            $(elmt).attr('data-ok','ok');
          }
          else {
            $("#ajaxInputReference-error").html('<span class="text-danger" role="alert"><strong>Ce contrat n\'existe pas.</strong></span>');
            $("#ajaxInputReference-results").html('');
            $("#ajaxInputReference-ok").html('<button type="submit" class="btn btn-primary">Enregistrer</button>');
            $(elmt).attr('data-ok','');
          }
        },
        error: function(error){
          console.log(error.responseText);
        }
      });
    }
    }



