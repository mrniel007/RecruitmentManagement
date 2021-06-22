$(document).ready(function(){
    
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Las contraseñas no coinciden");
    } else {
        confirm_password.setCustomValidity('');
    }
    }


    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    $('#submitForm').click(function(){

        var cedula = document.getElementById("cedula")
        , cedulaValor = document.getElementById("cedula").value;

        if(cedulaValor.length > 11 || cedulaValor.length < 11){
            cedula.setCustomValidity('La cedula debe tener 11 numeros');
        }else{
            cedula.setCustomValidity('');
        }

    });

});