const passwordField = document.getElementById('userPassword');
const passwordCheck = document.getElementById('mdp_verif');
const emailField = document.getElementById('email');
const date = document.getElementById('birthDate');

const message = document.getElementById('message');
const messageEmail = document.getElementById('messageEmail');
const messagePass = document.getElementById('messagePass');
const messageForm = document.getElementById('messageForm');
const messageDate = document.getElementById('messageDate');

var isEmailSub = false;
var isPassSub = false;
var isPass2Sub = false;
var isDateSub = false;

function isPass(){
    if(passwordField.value == passwordCheck.value){
        message.style.color ='green';
        message.innerText ='correspond';
        isPass2Sub = true;
    }
    else{
      message.style.color ='red';
      message.innerText ='Entrées non identiques';
      isPass2Sub = false;
    }
}



function validateEmail(){
  var filtre = /^\S+@\S+\.+([a-zA-Z0-9]{2,4})+$/;
  if (filtre.test(emailField.value)){
    return true;
  }else{
    return false;
  }

}

function checkmail(){
  if (validateEmail()){
    messageEmail.style.color ='green';
        messageEmail.innerText ='format email valide';
        isEmailSub = true;
  }
  else{
      messageEmail.style.color ='red';
      messageEmail.innerText ='adresse email non valide!';
      isEmailSub = false;
    }
}

function checkPass(){
  var filtre = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[ !"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~])[A-Za-z\d !"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]{8,}$/;
  if (filtre.test(passwordField.value)){
    messagePass.style.color ='green';
        messagePass.innerText ='format du mot de passe valide';
        isPassSub = true;
  }else{
    messagePass.style.color ='red';
        messagePass.innerText ='Le mot de passe doit comprendre au moins 8 caractères, dont au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère scpécial!';
        isPassSub = false;
  }

}


function checkDate(){

  var dateNow   =  new Date(), 
       strSaisie    =  date.value,
       dateJour, 
       dateSaisie;
 
  dateJour = new Date(dateNow.getFullYear(), dateNow.getMonth(), dateNow.getDate());
  strSaisie = strSaisie.replace(/-/g,"");
  dateSaisie = new Date(strSaisie.substr(0,4), strSaisie.substr(4,2)-1, strSaisie.substr(6,2));
 
  if (dateSaisie < dateJour ) {
    messageDate.style.color ='green';
    messageDate.innerText ='date de naissance valide';
    isDateSub = true;
  }
  else {
    messageDate.style.color ='red';
    messageDate.innerText ='la date de naissance doit être avant aujourd\'hui!';
    isDateSub = false;
  }
}

function isSubmittable(){
  if (isPassSub && isPass2Sub && isEmailSub && isDateSub){
    return true;
  }else{
    messageForm.style.color ='red';
        messageForm.innerText ='Veuillez remplir correctement tous les champs...';
    return false;
  }
}


emailField.onblur = checkmail;
passwordField.onkeyup = checkPass;
passwordCheck.onkeyup = isPass;
date.onblur = checkDate;
