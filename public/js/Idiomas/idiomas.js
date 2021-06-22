$('.estadoIdioma').click(function(){

    var id = this.id;
    var estado = (this.checked == true) ? 1 : 0;

    /*console.log('El idioma con el id: '+id+', tiene el estado: '+estado);*/

    $.ajax({
        url: 'toggleIdioma',
        method: 'POST',
        data: {
            id: id,
            estado: estado,
            toggleIdioma: true
        },
        success: function(response){

            Swal.fire({
                title : 'Estado cambiado!',
                text : 'Estado de idioma cambiado satisfactoriamente!',
                icon :'success'
            });

        }
    });

});