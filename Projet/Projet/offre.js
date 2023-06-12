/*********************************************************************************************/
let form=document.getElementById("form");
let nomformat=/^[a-zA-Z\s]+$/;
let mailformat = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 

/*validation du titre */
let titre=document.getElementById("titre")
let err_titre=document.getElementById("err_titre");

function titre_val(){
    if(!(titre.value.match(nomformat)))
    {
        err_titre.innerHTML="Titre invalide, réessayez";
        return false;
    }
    else{
        err_titre.innerHTML="";
        return true;
    }
}
titre.addEventListener('blur',titre_val);
/**validation de salaire et nbr d'années d'experience */
let nbr=document.getElementById("nbr");
let err_nbr=document.getElementById("err_nbr");
let sal=document.getElementById("sal");
let err_sal=document.getElementById("err_sal");

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
function sal_val(){
    if(sal.value<0){
        err_sal.innerHTML="Le salaire doit etre positif";
        return false;
    }
    else{
        err_sal.innerHTML="";
        return true;
    }
}

nbr.addEventListener('blur',nbr_val);
sal.addEventListener('blur',sal_val);


form.addEventListener('submit',function(e){
    if(!(titre_val())||!(nbr_val())||!(sal_val()))
        e.preventDefault();});