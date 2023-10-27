function checkReference(elmt){
  // alert("ok");
  var reference = $(elmt).val();
  if (reference.trim().length >= 8) {
    var server_url = '/check-user-reference';
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
        if (response.user) {
          $("#ajaxInputReference-error").html('');
          $("#ajaxInputReference-results").html('<div class="card mt-2"><div class="card-body">'+response.contrat+'</div></div>');
          $(elmt).attr('data-ok','ok');
        }
        else {      
          $("#ajaxInputReference-error").html('<span class="text-danger" role="alert"><strong>Ce téléphone n\'appartient à aucun utilisateur.</strong></span>');
          $("#ajaxInputReference-results").html('');
          $(elmt).attr('data-ok','');
        }
      },
      error: function(error){
        console.log(error.responseText);
      }
    });
  }
  else{
    alert('Le reference contient au moins 8 chiffres.')
  }
}