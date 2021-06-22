var detallesExtra = 0;

$('#addDetalle').click(function(){
    ++detallesExtra;
    var claseID = 'detalleExtra_'+detallesExtra;
    $('#extraDetails').append('<li class="'+claseID+'">' +
        '<input id="'+claseID+'" type="text" class="form-control input-sm expDetail">' +
        '</li>' +
        '<br class="'+claseID+'">');

    $('#divDetailsDelete').append('<button class="btn btn-danger deleteDetail '+claseID+'" detalleextra="'+claseID+'">' +
        'x' +
        '</button>' +
        '<br class="'+claseID+'">' +
        '<br class="'+claseID+'">');
});

$(document).on("click", 'button.deleteDetail', function (){

    --detallesExtra;
    var clase = $(this).attr('detalleExtra');

    console.log(clase);

    $('#'+clase).remove();
    $('.'+clase).remove();

});

$('#addExperiencia').click(function (){

    var detalles = [];

    $('.expDetail').each(function (i){
        detalles[i] = $(this).val();
    });

    var puesto = $('#puesto').val();
    var salario = $('#salario').val();
    var fDesde = $('#fDesde').val();
    var fHasta = $('#fHasta').val();
    var institucion = $('#institucion').val();

    $.ajax({
        url: 'addExperiencia',
        method: 'POST',
        data: {
            puesto: puesto,
            salario: salario,
            fDesde: fDesde,
            fHasta: fHasta,
            institucion: institucion,
            detalles: detalles,
        },
        success: function(response){

            Swal.fire({
                title : 'Experiencia laboral añadida!',
                text : 'Experiencia añadida correctamente!',
                icon :'success'
            }).then((result) => {
                location.reload(true);
            });

        }
    });

});

$('.editable').change(function (){

    $('#editProfile').prop('disabled', false);

});

$('#editProfile').click(function (){

    var correo = $('#correo').val();
    var correoOG = $('#correoOG').val();
    var nombre = $('#nombre').val();
    var cedula = $('#cedula').val();
    var userID = $('#userID').val();

    if(correo !== correoOG) {
        Swal.fire({
            title: 'Desea aplicar los cambios a este puesto?',
            text: 'Se cambio el correo y se va cerrar esta sesion.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if(result.isConfirmed){

                $.ajax({
                    url: 'editProfile',
                    method: 'POST',
                    data: {
                        id: userID,
                        correo: correo,
                        nombre: nombre,
                        cedula: cedula
                    },
                    success: function (response){

                        Swal.fire({
                            title : 'Perfil editado!',
                            text : 'Perfil editado correctamente!',
                            icon :'success'
                        }).then((result) => {
                            location.replace('http://localhost/EmployeeManagement/logout');
                        });

                    }
                });

            }else{

                location.reload(true);

            }

        });

    }else{

        Swal.fire({
            title: 'Desea aplicar los cambios a este puesto?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if(result.isConfirmed){

                $.ajax({
                    url: 'editProfile',
                    method: 'POST',
                    data: {
                        id: userID,
                        correo: correo,
                        nombre: nombre,
                        cedula: cedula
                    },
                    success: function (response){

                        Swal.fire({
                            title : 'Perfil editado!',
                            text : 'Perfil editado correctamente!',
                            icon :'success'
                        }).then((result) => {
                            location.reload(true);
                        });

                    }
                });

            }else{

                location.reload(true);

            }

        });

    }
});

$('.competenciasEditUserinfo').click(function (){

    var competenciaID = $(this).val();
    var userID = $('#userID').val();
    var userCompID = $(this).attr('competenciausuario');
    var deleteOrCreate = $(this).is(':checked');

    $.ajax({
        url: 'toggleUserComp',
        method: 'POST',
        data: {
            'id': competenciaID,
            'userID': userID,
            'userCompID': userCompID,
            'deleteOrCreate': deleteOrCreate
        },
        success: function (response){

            location.reload(true);

        }
    });

});