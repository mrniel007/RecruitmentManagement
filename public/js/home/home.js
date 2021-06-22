$('#cerrarSesion').click(function(){

    Swal.fire({
        title: 'Desea cerrar la sesion?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#dd3333',
        confirmButtonText: 'Cerrar la sesión',
        cancelButtonText : 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('logout');
        }
    })

});

