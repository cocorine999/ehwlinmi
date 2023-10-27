function age(valeur, usertype) {
    if (!valeur){
        valeur = 'InputNaissance';
    }
    min = 0;
    max = 0;
    if(usertype == 'normal'){
        min=18;
        max=200;
    }
    if(usertype == 'client_'){
        min=18;
        max=200;
    }    
    if(usertype == 'assure_'){
        min=18;
        max=74;
    }
    if(usertype == 'beneficiaire1_'){
        min=0;
        max=300;
    }
    if(usertype == 'beneficiaire2_'){
        min=0;
        max=300;
    }
    if(usertype == 'beneficiaire3_'){
        min=0;
        max=300;
    }
    if(usertype == 'beneficiaire4_'){
        min=0;
        max=300;
    }
    if(usertype == 'beneficiaire5_'){
        min=0;
        max=300;
    }
    // console.log(usertype+' '+min+' '+max);

    var givenAge = "";
    var dateAnniversaire = document.getElementById(valeur).value;
    var Bday = +new Date(dateAnniversaire);
    givenAge += ~~ ((Date.now() - Bday) / (31557600000));
    givenAge = parseInt(givenAge);
    
    var dateResult = document.getElementById(valeur+'-error');
    if(givenAge < min || givenAge > max){
        dateResult.innerHTML = "Date incorrecte";
    }else{
        dateResult.innerHTML = "";
    }
}