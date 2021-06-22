<?php

include 'header.php';

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reportes</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <div id="divConsulta" class="col-md-3">
            <label for="">Consultar:</label>
            <select name="" id="tipoConsulta" class="form-control reporteInput">
                <option value="">Seleccionar...</option>
                <option name="" value="1">Empleados</option>
                <option name="" value="2">Candidatos</option>
            </select>
        </div>

        <div id="divPosiciones" class="col-md-3">
            <label for="">Posiciones:</label>
            <select name="" id="posiciones_reporte" class="form-control reporteInput">
                <option value="">Seleccionar...</option>
                <option value="Todas">Todas</option>
                <?php if(isset($puestos)){

                    foreach($puestos as $puesto){
                        ?>
                        <option name="<?php echo $puesto->id_puestos;?>" value="<?php echo $puesto->id_puestos;?>"><?php echo $puesto->nombre_puesto;?></option>
                    <?php }
                }
                ?>
            </select>
        </div>
        <div id="divDesde" class="col-md-3 desdeHasta" hidden>

                <label for="">Desde:</label>
                <input type="month" class="form-control" name="" id="mes_desde" required>
        </div>

        <div id="divHasta" class="col-md-3 desdeHasta" hidden>
                <label for="">Hasta:</label>
            <input type="month" class="form-control" name="" id="mes_hasta" required>

        </div>
    </div>
    <div class="row">
        <div id="divCompetencias" class="col-md-6 competenciasDiv" hidden>
            <label for="">Competencias:</label>
            <select name="" id="competencia_reporte" class="form-control reporteInput">
                <option value="">Seleccionar...</option>
                <option value="Todas">Todas</option>
                <?php if(isset($competencias)){

                    foreach($competencias as $competencia){
                        ?>
                        <option name="<?php echo $competencia->id_competencia;?>" value="<?php echo $competencia->id_competencia;?>"><?php echo $competencia->descripcion_competencia;?></option>
                    <?php }
                }
                ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <button id="getReporte" class="btn btn-sm" disabled>GENERAR REPORTE</button>
        </div>
    </div>
    <br>
    <div class="row" id="tableEmpleados" hidden>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableEmpleado" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Fecha ingreso</th>
                                    <th>Salario</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Fecha ingreso</th>
                                    <th>Salario</th>
                                </tr>
                                </tfoot>
                                <tbody id="reporte_tbody_e">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="tableCandidatos" hidden>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableCandidato" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Salario deseado</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Salario deseado</th>
                                </tr>
                                </tfoot>
                                <tbody id="reporte_tbody_c">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>







</div>




<?php

include 'footer.php';

?>

