$('#addPuesto').click(function (e){
    e.preventDefault();

    var competencias = [];

    $('.competencias:checked').each(function(i){
        competencias[i] = $(this).val();
    });

    var puesto = $('#puesto').val();
    var nivelRiesgo = $('#nivelRiesgo').val();
    var salarioMin = $('#salarioMinimo').val();
    var salarioMax = $('#salarioMaximo').val();

    $.ajax({
        url: 'addPuesto',
        method: 'POST',
        data: {
            puesto: puesto,
            nivelRiesgo: nivelRiesgo,
            salarioMin: salarioMin,
            salarioMax: salarioMax,
            competencias: competencias,
            addPuesto: true
        },
        success: function(response){

            Swal.fire({
                title : 'Puesto agregado!',
                text : 'Puesto agregado satisfactoriamente!',
                icon :'success'
            }).then((result) => {
                location.reload(true);
            });

        }
    });

});

$('.editPuesto').click(function(){

    $('#puestoEdit').val('');
    $('#nivelRiesgoEdit').val('');
    $('#salarioMinimoEdit').val('');
    $('#salarioMaximoEdit').val('');
    $('.competenciasEdit').prop('checked', false);

    var id = $(this).attr('puestoid');

    $.ajax({
        url: 'getPuesto',
        method: 'POST',
        data: {
          id: id
        },
        success: function(response){

            var puestoData = JSON.parse(response);
            var puesto = puestoData.puesto[0];
            var competencias = puestoData.competencias;

            $('#idPuestoEdit').val(puesto.id_puestos);
            $('#puestoEdit').val(puesto.nombre_puesto);
            $('#nivelRiesgoEdit').val(puesto.nivel_riesgo);
            $('#salarioMinimoEdit').val(puesto.salario_minimo);
            $('#salarioMaximoEdit').val(puesto.salario_maximo);

            competencias.forEach(function(element){
                $('#competencia_edit_'+element.id_competencias).prop('checked', true);
            });

        }
    });

});

$('#editPuesto').click(function(){

    Swal.fire({
        title: 'Desea aplicar los cambios a este puesto?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#dd3333',
        confirmButtonText: 'Confirmar',
        cancelButtonText : 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {

            var competenciasEdit = [];

            $('.competenciasEdit:checked').each(function (i){
                competenciasEdit[i] = $(this).val();
            });

            var idEdit = $('#idPuestoEdit').val();
            var puestoEdit = $('#puestoEdit').val();
            var nivelRiesgoEdit = $('#nivelRiesgoEdit').val();
            var salarioMinEdit = $('#salarioMinimoEdit').val();
            var salarioMaxEdit = $('#salarioMaximoEdit').val();

            $.ajax({
                url: 'editPuesto',
                method: 'POST',
                data: {
                    id: idEdit,
                    puesto: puestoEdit,
                    nivelRiesgo: nivelRiesgoEdit,
                    salarioMin: salarioMinEdit,
                    salarioMax: salarioMaxEdit,
                    competencias: competenciasEdit,
                    editarPuesto: true
                },
                success: function(response){

                    Swal.fire({
                        title : 'Puesto editado!',
                        text : 'Puesto editado correctamente!',
                        icon :'success'
                    }).then((result) => {
                        location.reload(true);
                    });

                }
            });

        }

    })

});