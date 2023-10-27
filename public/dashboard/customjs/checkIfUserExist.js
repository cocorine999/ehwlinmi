function checkReference(obj){
    var reference = $(obj).val();
    // alert(reference);
    if (reference.trim().length > 1) {
      var server_url = '/check-reference';
      var formData = new FormData();
      formData.append('reference', reference);
      $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: server_url,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'text',
  
        success: function(response){
          var response = JSON.parse(response);
  
          if (response.user) {
            $("#reference-error").html('<span class="text-danger" role="alert"><strong>Ce numéro est déjà utilisé, veuillez le changer.</strong></span>');
            $(obj).attr('data-ok','');
          }
          else {
            $("#reference-error").html('');
            $(obj).attr('data-ok','ok');
          }
        },
        error: function(error){
          console.log(error.responseText);
        }
      });
    }
  }
  
  function checkEmail(elmt){
    var email = $(elmt).val();
    // alert(email);
    if (email.trim().length > 2) {
      var server_url = '/check-user-email';
      var formData = new FormData();
      formData.append('email', email);
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
            $("#email-error").html('<span class="text-danger" role="alert"><strong>Cette adresse email est déjà utilisée.</strong></span>');
            $(elmt).attr('data-ok','');
          }
          else {
            // alert("not exist");
            $("#email-error").html('');
            $(elmt).attr('data-ok','ok');
          }
        },
        error: function(error){
          console.log(error.responseText);
        }
      });
    }
  }
  
  function checkTelephone(elmt){
    var telephone = $(elmt).val();
    if (telephone.trim().length >= 1) {
      var server_url = '/check-user-telephone';
      var formData = new FormData();
      formData.append('telephone', telephone);
      formData.append('check_to_block', false);
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
          console.log(response);
          console.log(elmt+"-error");
          
          if (response.user) {
            $(elmt+"-error").html('');
            $(elmt+"-results").html('<div class="card mt-2"><div class="card-body">'+response.user.nom+' '+response.user.prenom+'</div></div>');
            $(elmt).attr('data-ok','ok');
          }
          else {      
            $(elmt+"-error").html('<span class="text-danger" role="alert"><strong>Ce téléphone n\'appartient à aucun utilisateur ou ne peut être utilisé.</strong></span>');
            $(elmt+"-results").html('');
            $(elmt).attr('data-ok','');
          }
        },
        error: function(error){
          console.log(error.responseText);
        }
      });
    }
    else{
      alert('Le telephone contient au moins 8 chiffres.')
    }
  }
  
    
  function checkTelephone2(elmt){
    var telephone = $(elmt).val();
    if (telephone.trim().length >= 1) {
      
      var server_url = '/check-user-telephone';
      var formData = new FormData();
      formData.append('telephone', telephone);
      formData.append('check_to_block', true);
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
          // alert(elmt+ " "+telephone+" "+response);
          var response = JSON.parse(response);
          console.log(response);
          console.log(elmt+"-error");
          if (response.user || response.user == false ) {
            $(elmt+"-error").html('<span class="text-danger" role="alert"><strong>Ce téléphone appartient à un utilisateur ou ne peut être utilisé.</strong></span>');
            $(elmt+"-results").html('');
            $(elmt).attr('data-ok','');
          }
          else {      
            //faire un autre if ici pour voir si le numero n'est pas utilisé sur l'un des formulaires de la page
            $(elmt+"-error").remove();
            $(elmt).attr('data-ok','ok');
          }
        },
        error: function(error){
          console.log(error.responseText);
        }
      });
    }
  }
  
  $('#form').on('submit', function() {
    // alert("en cours de soumission");
    var count_null=0;
    var errormsg = "";
  
    $("#form input").each(function(){
      if($(this).attr('name') != null){
        count_null = count_null+($.trim($(this).val())=="" ? 1 : 0);
      }
    });
    var count_valid=0;
    $('#form input[data-ok="ok"]').each(function(){
        count_valid = count_valid+($.trim($(this).attr('data-ok'))=="ok" ? 1 : 0);
    });
  
    if(count_null != 0){
      errormsg += "Veuillez remplir tous les champs\n";
    }
    if(count_valid != 3){
      errormsg += "Veuillez fournir les données valides"+count_valid;
    }
  
    if(count_null == 0 && count_valid == 3) {
      return true;
    }else {
      alert(errormsg);
      return false;
    }
  });
  
