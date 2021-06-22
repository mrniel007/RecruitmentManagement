$('.estadoCompetencia').click(function(){

    var id = this.id;
    var estado = (this.checked == true) ? 1 : 0;

    /*console.log('El idioma con el id: '+id+', tiene el estado: '+estado);*/

    $.ajax({
        url: 'toggleCompetencias',
        method: 'POST',
        data: {
            id: id,
            estado: estado,
            toggleCompetencia: true
        },
        success: function(response){

            Swal.fire({
                title : 'Estado cambiado!',
                text : 'Estado de competencia cambiado satisfactoriamente!',
                icon :'success'
            });

        }
    });

});