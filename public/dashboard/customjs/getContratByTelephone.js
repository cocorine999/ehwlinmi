  function checkTelephone(elmt){
    var telephone = $(elmt).val();
    if (telephone.trim().length >= 1) {
      var server_url = '/get-contrats-by-telephone';
      var formData = new FormData();
      formData.append('telephone', telephone);
      
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
            $("#"+elmt.id+"-error").html('');
            $("#"+elmt.id+"-results").html('<div class="card mt-2"><div class="card-body">'+response.user.nom+' '+response.user.prenom+'</div></div>');
            response.contrats.forEach(myFunction)
            function myFunction(contrat) {
                var newOption = new Option(contrat.reference+' | Assuré:'+contrat.assure+' | '+contrat.primes+' primes restantes' , contrat.reference, false, false);
                $('.select2bs4').append(newOption).trigger('change');
                $(".select2bs4 option[value='" +contrat.reference+ "']").attr('primesr',contrat.primes);
                // if(contrat.primes==0){
                //   $(".select2bs4 option[value='" +contrat.reference+ "']").attr('disabled', 'disabled');
                // }
              } 
            $('.select2bs4').select2({theme: 'bootstrap4', placeholder: "Choisissez le contrat"});
            $(elmt).attr('data-ok','ok');
          }
          else {      
            $("#"+elmt.id+"-error").html('<span class="text-danger" role="alert"><strong>Ce téléphone n\'appartient à aucun utilisateur ou ne peut être utilisé.</strong></span>');
            $("#"+elmt.id+"-results").html('');
            $('.select2bs4').val(null).trigger('change');
            $(".select2bs4 option").remove();
            $('.select2bs4').select2({theme: 'bootstrap4', placeholder: "Aucun contrat disponible pour ce numero"});
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
  
$('.select2bs4').on('select2:select', function (e) {
    var data = e.params.data;
    primesRestantes = $(".select2bs4 option[value='"+data.id+"']").attr('primesr');
    $("#prime").attr("max", primesRestantes*1000);
});