$('.verCandidato').click(function () {

    $('#competenciasUsuario').empty();
    var candidateID = $(this).attr('candidatoid');
    var usuarioID = $(this).attr('usuarioid');

    $.ajax({
        url: 'getCandidato',
        method: 'POST',
        data: {
            candidateID: candidateID,
            usuarioID: usuarioID
        },
        success: function (response) {

            var data = JSON.parse(response);
            var candidatoData = data.candidatoData[0];
            var competenciaData = data.competenciaData;

            console.log(candidatoData);

            $('#idPuesto').val(candidatoData.id_puestos);
            $('#idCandidato').val(candidatoData.id_candidatos);
            $('#idUser').val(candidatoData.id_usuario);

            $('#nombre').text(candidatoData.nombre_usuario);
            $('#posicion').text(candidatoData.nombre_puesto);
            $('#hiddenSalary').val(candidatoData.salario);
            $('#salarioDeseado').text('RD$ '+Intl.NumberFormat('en-US').format(candidatoData.salario));

            competenciaData.forEach(function (element){

                $('#competenciasUsuario').append('<li>' +
                    element.descripcion_competencia +
                    '</li>');
            });

        }
    });

});

$('#aceptarCandidato').click(function () {

    Swal.fire({
        title: 'Desea contratar a este candidato para esta posicion?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#dd3333',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if(result.isConfirmed){

            var idPuesto = $('#idPuesto').val();
            var idUser = $('#idUser').val();
            var idCandidato = $('#idCandidato').val();
            var salario= $('#hiddenSalary').val();

            $.ajax({
                url: 'contratar',
                method: 'POST',
                data: {
                    idPuesto: idPuesto,
                    idUser: idUser,
                    idCandidato: idCandidato,
                    salario: salario
                },
                success: function (response){

                    Swal.fire({
                        title : 'Candidato contratado!',
                        text : 'Candidato contratado exitosamente!',
                        icon :'success'
                    }).then((result) => {
                        location.reload(true);
                    });

                }
            });

        }

    });

});