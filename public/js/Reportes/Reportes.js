function validate() {
    var inputsWithValues = 0;

    // get all input fields except for type='submit'
    var myInputs = $(".reporteInput");

    myInputs.each(function (e) {
        // if it has a value, increment the counter
        if ($(this).val()) {
            inputsWithValues += 1;
        }
    });

    if (inputsWithValues == myInputs.length) {
        $('#getReporte')
            .prop('disabled', false)
            .addClass('btn-primary');
    } else {
        $('#getReporte')
            .prop('disabled', true)
            .removeClass('btn-primary');
    }

}

$('#tipoConsulta').change(function (){

    var tipoConsulta = $(this).val();

    if(tipoConsulta == 1){

        $('.desdeHasta').prop('hidden', false);

    }else{

        $('.desdeHasta').prop('hidden', true);

    }

});

$('#posiciones_reporte').change(function () {

    var posicion = $(this).val();

    if(posicion.length > 0){

        $('.competenciasDiv').prop('hidden', false);

    }else{

        $('.competenciasDiv').prop('hidden', true);

    }

});

$('.reporteInput').change(function () {

    validate();

});

$('#getReporte').click(function () {

    var tipoConsulta = $('#tipoConsulta').val();
    var posiciones = $('#posiciones_reporte').val();
    var competencias = $('#competencia_reporte').val();

    var fDesde = $('#mes_desde').val()+'-01';
    var fHasta = $('#mes_hasta').val()+'-01';

    $.ajax({
        url: 'getReporte',
        method: 'POST',
        data: {
            tipoConsulta: tipoConsulta,
            posiciones: posiciones,
            competencias: competencias,
            fDesde: fDesde,
            fHasta: fHasta
        },
        success: function (response) {

            var reporteData = JSON.parse(response);

            var tableData = [];
            console.log(reporteData);



            if(tipoConsulta == 1){

                reporteData.forEach(function (element){

                    tableData.push({
                        'nombre': element.nombre_usuario,
                        'puesto': element.nombre_puesto,
                        'fecha': element.fecha_ingreso,
                        'salario': 'RD$ '+Intl.NumberFormat('en-US').format(element.salario),
                    });

                });

                renderDataTableEmpleado(tableData);

                $('#tableEmpleados').prop('hidden', false);
                $('#tableCandidatos').prop('hidden', true);

            }else{

                reporteData.forEach(function (element){

                    tableData.push({
                        'nombre': element.nombre_usuario,
                        'puesto': element.nombre_puesto,
                        'salario': 'RD$ '+Intl.NumberFormat('en-US').format(element.salario),
                    });

                });

                renderDataTableCandidato(tableData);

                $('#tableEmpleados').prop('hidden', true);
                $('#tableCandidatos').prop('hidden', false);

            }
        }
    })

});

function renderDataTableEmpleado(data) {

    $('#dataTableEmpleado').DataTable({
        data: data,
        "bDestroy": true,
        "dom": 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        columns: [
            {
                "data": "nombre",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }, {
                "data": "puesto",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }, {
                "data": "fecha",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }, {
                "data": "salario",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }
        ]
    });

}

function renderDataTableCandidato(data) {

    $('#dataTableCandidato').DataTable({
        data: data,
        "bDestroy": true,
        "dom": 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        columns: [
            {
                "data": "nombre",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }, {
                "data": "puesto",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }, {
                "data": "salario",
                "render": function (data, type, row, meta) {
                    return data;
                }
            }
        ]
    });

}

