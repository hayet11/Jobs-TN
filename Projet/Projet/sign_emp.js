
//________________________________________
let form1=document.getElementById("form1");

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

form1.addEventListener('submit',function(event){

  if(!(nom_val()) || !(email_val()))
      event.preventDefault();});

