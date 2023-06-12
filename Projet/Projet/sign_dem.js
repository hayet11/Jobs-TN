let form=document.getElementById("form2");

//controle cin form2
let cin=document.getElementById("cin");
let err_cin=document.getElementById("err_cin");

function cin_val(){
    if(cin.value>99999999 || cin.value<10000000){
      err_cin.innerHTML="Le numero de cin doit etre composé de 8 chiffres";
      return false;}
    else
      {err_cin.innerHTML="";
      return true;}
  }
  
  cin.addEventListener('blur',cin_val);
  
  //controle nom
  let nomformat=/^[a-zA-Z\s]+$/;
  let nom=document.getElementById("nomp");
  let err_nom=document.getElementById("err_nomp");
  
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
  //controle email
  let mailformat = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
  let mail=document.getElementById("email");
  let err_mail=document.getElementById("err_email");
  
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

  form.addEventListener('submit',function(e){
  
      if(!(nom_val()) || !(email_val())|| !(cin_val()))
          e.preventDefault();});