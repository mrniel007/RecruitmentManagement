$('.verVacante').click(function(){

    $('#puesto').text('');
    $('#nivelRiesgo').text('');
    $('#salarioMinimo').text('');
    $('#salarioMaximo').text('');
    $('#competenciasPuesto').empty();
    $('.competencias').prop('checked', false);

    $('#postularVacante')
        .addClass('btn-success')
        .prop('disabled', false)
        .val('Postular');

    var id = $(this).attr('puestoid');
    var idUser = $('#idUser').val();

    $.ajax({
        url: 'getVacante',
        method: 'POST',
        data: {
            id: id,
            idUser: idUser
        },
        success: function(response){

            var puestoData = JSON.parse(response);
            var puesto = puestoData.puesto[0];
            var competencias = puestoData.competencias;

            var nivelRiesgo = '';

            switch (puesto.nivel_riesgo){
                case 'b':
                    nivelRiesgo = 'Bajo';
                    break;

                case 'm':
                    nivelRiesgo = 'Medio';
                    break;

                case 'a':
                    nivelRiesgo = 'Alto';
                    break;
            }

            $('#idPuesto').val(puesto.id_puestos);
            $('#puesto').text(puesto.nombre_puesto);
            $('#nivelRiesgo').text(nivelRiesgo);
            $('#salarioMinimo').text('RD$ '+Intl.NumberFormat('en-US').format(puesto.salario_minimo));
            $('#salarioMaximo').text('RD$ '+Intl.NumberFormat('en-US').format(puesto.salario_maximo));

            competencias.forEach(function(element){
                $('#competenciasPuesto').append('<li>' +
                    element.descripcion_competencia +
                    '</li>');
            });

            if(puestoData.isCandidato == 'Si'){

                $('#postularVacante')
                    .removeClass('btn-success')
                    .prop('disabled', true)
                    .val('Postulado');

            }

        }
    });

});

$('#postularVacante').click(function (){

    Swal.fire({
        title: 'Desea aplicar para a este puesto?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#dd3333',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if(result.isConfirmed){

            var id = $('#idPuesto').val();
            var idUser = $('#idUser').val();
            var sueldoDeseado= $('#sueldoDeseado').val();

            $.ajax({
                url: 'postular',
                method: 'POST',
                data: {
                    id: id,
                    idUser: idUser,
                    sueldoDeseado: sueldoDeseado
                },
                success: function (response){

                    Swal.fire({
                        title : 'Postulado a vacante!',
                        text : 'Postulado a vacante correctamente!',
                        icon :'success'
                    }).then((result) => {
                        location.reload(true);
                    });

                }
            });

        }

    });

});