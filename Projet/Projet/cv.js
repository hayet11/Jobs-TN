let form=document.getElementById("form");

//controle sur le nom
let nomformat=/^[a-zA-Z\s]+$/;
let nom=document.getElementById("nom");
let err_nom=document.getElementById("err_nom");

function nom_val(){
    if(!(nom.value.match(nomformat)))
    {
        err_nom.innerHTML="Nom invalide, réessayez";
        return false;
    }
    else{
        err_nom.innerHTML="";
        return true;
    }
}
nom.addEventListener('blur',nom_val);

//controle mail
let mailformat = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
let mail=document.getElementById("mail");
let err_mail=document.getElementById("err_mail");

function email_val(){
    if(!(mail.value.match(mailformat))){
        err_mail.innerHTML="E-mail invalide réessayez";
        return false;
    }
    else
        {err_mail.innerHTML="";
        return true;}
}
mail.addEventListener('blur',email_val);

//controle diplomes 
let list=document.getElementsByName("diplomes");
let err_dip=document.getElementById("err_dip");

//controle nbr annees d'experience
let nbr=document.getElementById("nbr");
let err_nbr=document.getElementById("err_nbr");

function nbr_val(){
    if(nbr.value<0){
        err_nbr.innerHTML="Le nombre d'anneés doit etre positif";
        return false;
    }
    else{
        err_nbr.innerHTML="";
        return true;
    }
}

nbr.addEventListener('blur',nbr_val);


form.addEventListener('submit',function(event){
    var test=false;
    var i=0;
    if(!(nom_val()) || !(email_val()) || !(nbr_val()))
        event.preventDefault();
    
    while (!test && i<list.length){
        if(list[i].checked)
            test=true;
        else
            i++;
    }
    if(!test)
        {err_dip.innerHTML="Veuillez cocher au moins une proposition";
         event.preventDefault();
        }
    else
        err_dip="";
});

