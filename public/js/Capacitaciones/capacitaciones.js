$(document).ready(function (){

    let fDesde = document.getElementById('fDesde'),
        fHasta = document.getElementById('fHasta');

    function checkDates(){

        let fechaDesde = (new Date(fDesde.value)).getTime();
        let fechaHasta = (new Date(fHasta.value)).getTime();

        if(fechaDesde > fechaHasta){

            fDesde.setCustomValidity('La fecha de inicio no puede ser mayor que la fecha de termino.');

        }else{

            fDesde.setCustomValidity('');

        }
    }

    if(fDesde != null && fHasta != null){
        fDesde.addEventListener('focusout', (event) => {
            checkDates();
        });

        fHasta.addEventListener('focusout', (event) => {
            checkDates();
        });
    }

});

$('.inscripcionCapacitacion').click(function () {

    Swal.fire({
        title: 'Deseas inscribirte a esta capacitación?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#dd3333',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if(result.isConfirmed){

            var idCapacitacion = $(this).attr('idcapacitacion');
            var idUser = $('#idUser').val();

            $.ajax({
                url: 'inscribir',
                method: 'POST',
                data: {
                    idCapacitacion: idCapacitacion,
                    idUser: idUser
                },
                success: function (response){

                    Swal.fire({
                        title : 'Empleado inscrito!',
                        text : 'Empleado inscrito exitosamente!',
                        icon :'success'
                    }).then((result) => {
                        location.reload(true);
                    });

                }
            });

        }

    });

});