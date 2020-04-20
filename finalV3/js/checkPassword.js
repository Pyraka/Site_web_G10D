const passwordField = document.getElementById('userPassword');
const passwordCheck = document.getElementById('mdp_verif');
const message = document.getElementById('message');

function isPass(){
    if(passwordField.value == passwordCheck.value){
        message.style.color ='green';
        message.innerText ='matching';
    }
    else{
      message.style.color ='red';
      message.innerText ='not matching';
    }
}

passwordCheck.onkeyup = isPass;