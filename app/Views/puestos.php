<?php

include 'header.php';

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Puestos</h1>
    </div>
    <div>
        <button type="button" class="right btn btn-primary " data-toggle="modal" data-target="#add_puesto">Añadir puestos</button>
    </div>
    <br>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de puestos</h6>
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
                                    <th>Nivel de riesgo</th>
                                    <th>Salario minimo</th>
                                    <th>Salario maximo</th>
                                    <th>Editar puesto</th>
                                </tr>
                                </thead>
                                <tfoot>

                                <tr>
                                    <th>ID</th>
                                    <th>Puesto</th>
                                    <th>Nivel de riesgo</th>
                                    <th>Salario minimo</th>
                                    <th>Salario maximo</th>
                                    <th>Editar puesto</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php if(isset($puestos) and count($puestos) > 0){
                                    foreach($puestos as $puesto){?>
                                        <tr>

                                            <td><?php echo $puesto->id_puestos;?></td>
                                            <td><?php echo $puesto->nombre_puesto;?></td>
                                            <td><?php

                                                $nivel = '';

                                                switch ($puesto->nivel_riesgo){
                                                    case 'b':
                                                        $nivel = 'Bajo';
                                                        break;
                                                    case 'm':
                                                        $nivel = 'Medio';
                                                        break;
                                                    case 'a':
                                                        $nivel = 'Alto';
                                                        break;
                                                }
                                                echo $nivel;?></td>
                                            <td><?php echo 'RD$ '.number_format($puesto->salario_minimo, '2');?></td>
                                            <td><?php echo 'RD$ '.number_format($puesto->salario_maximo, '2');?></td>
                                            <td>
                                                <button class="btn btn-success editPuesto" data-toggle="modal" data-target="#edit_puesto" puestoid="<?php echo $puesto->id_puestos;?>">
                                                    <i class="fa fa-clipboard"></i> Editar
                                                </button>
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



    <div class="modal fade" id="add_puesto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 60% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Introducir un nuevo puesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="addPuesto">
                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Nombre del puesto:</label>
                                        <input type="text" placeholder="ejemplo: Contable." class="form-control" id="puesto" name="puesto" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Nivel de riesgo:</label>
                                        <select class="form-control" id="nivelRiesgo" name="nivelRiesgo" required>
                                            <option value="">Seleccionar nivel...</option>
                                            <option value="b">Bajo</option>
                                            <option value="m">Medio</option>
                                            <option value="a">Alto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Salario minimo:</label>
                                        <input type="number" class="form-control" name="salarioMinimo" id="salarioMinimo" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Salario maximo:</label>
                                        <input type="number" class="form-control" name="salarioMaximo" id="salarioMaximo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name">Competencias:</label>
                                <?php if(isset($competencias) and count($competencias) > 0){
                                            foreach($competencias as $competencia){
                                ?>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input id="competencia_<?php echo $competencia->id_competencia;?>" class="form-check-input competencias" type="checkbox" value="<?php echo $competencia->id_competencia;?>" name="competencia_<?php echo $competencia->id_competencia;?>"><?php echo $competencia->descripcion_competencia;?>
                                        </label>
                                    </div>

                                <?php }
                                }?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    <input id="addPuesto" type="submit" class="btn btn-success" name="addPuesto" value="AÑADIR">
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="edit_puesto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 60% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Modificar puesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Nombre del puesto:</label>
                                        <input type="text" placeholder="ejemplo: Contable." class="form-control" id="puestoEdit" name="puesto" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Nivel de riesgo:</label>
                                        <select class="form-control" id="nivelRiesgoEdit" name="nivelRiesgo" required>
                                            <option value="">Seleccionar nivel...</option>
                                            <option value="b">Bajo</option>
                                            <option value="m">Medio</option>
                                            <option value="a">Alto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Salario minimo:</label>
                                        <input type="number" class="form-control" name="salarioMinimo" id="salarioMinimoEdit" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Salario maximo:</label>
                                        <input type="number" class="form-control" name="salarioMaximo" id="salarioMaximoEdit" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name">Competencias:</label>
                                <?php if(isset($competencias) and count($competencias) > 0){
                                    foreach($competencias as $competencia){
                                        ?>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input id="competencia_edit_<?php echo $competencia->id_competencia;?>" class="form-check-input competenciasEdit" type="checkbox" value="<?php echo $competencia->id_competencia;?>" name="competencia_<?php echo $competencia->id_competencia;?>"><?php echo $competencia->descripcion_competencia;?>
                                            </label>
                                        </div>

                                    <?php }
                                }?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    <input id="editPuesto" type="button" class="btn btn-success" value="Editar">
                    <input id="idPuestoEdit" type="hidden">
                </div>
            </div>

        </div>
    </div>



</div>




<?php

include 'footer.php';

?>

