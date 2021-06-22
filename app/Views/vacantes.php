<?php

include 'header.php';

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vacantes</h1>
    </div>
    <!-- Content Row -->

    <div class="row">

        <!-- Illustrations -->
        <div class="col-xl-12 col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vacantes para ti!</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                             src="public/img/undraw_job_offers_kw5d.svg" alt="...">
                    </div>
                    <p style="text-align: center;">Aqui estan las vacantes disponibles en tu aplicacion RecruitmentManagement™</p>

                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de vacantes</h6>
                </div>
                <!-- Card Body -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Puesto</th>
                                    <th>Salario</th>
                                    <th>Oferta</th>
                                </tr>
                                </thead>
                                <tfoot>

                                <tr>
                                    <th>ID</th>
                                    <th>Puesto</th>
                                    <th>Salario</th>
                                    <th>Oferta</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php if(isset($puestos) and count($puestos) > 0){
                                    foreach($puestos as $puesto){?>
                                        <tr>

                                            <td><?php echo $puesto->id_puestos;?></td>
                                            <td><?php echo $puesto->nombre_puesto;?></td>
                                            <td><?php echo 'De RD$ '.number_format($puesto->salario_minimo, 2).' a RD$ '.number_format($puesto->salario_maximo, 2);?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-success verVacante " data-toggle="modal" data-target="#ver_vacante" puestoid="<?php echo $puesto->id_puestos;?>">
                                                        <i class="fa fa-eye"></i> Ver
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="modal fade" id="ver_vacante" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Vacante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Posicion:</label>
                                    <span id="puesto">

                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Nivel de riesgo:</label>
                                    <span id="nivelRiesgo">

                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Salario minimo:</label>
                                    <span id="salarioMinimo">

                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Salario maximo:</label>
                                    <span id="salarioMaximo">

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="name">Competencias:</label>
                            <ul id="competenciasPuesto">

                            </ul>
                        </div>
                        <div class="col-md-8">
                            <label for="name">Sueldo deseado:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RD$</div>
                                </div>
                                <input type="number" class="form-control" id="sueldoDeseado" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input id="postularVacante" type="button" class="btn btn-success" value="Postular">
                    <input id="idPuesto" type="hidden">
                    <input id="idUser" type="hidden" value="<?php echo $userData[0]->id_usuario;?>">
                </div>
            </div>

        </div>
    </div>



</div>




<?php

include 'footer.php';

?>
