<?php

include 'header.php';

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Capacitaciones</h1>
    </div>
    <?php if($userData[0]->tipo == 1){?>
    <div>
        <button type="button" class="right btn btn-primary " data-toggle="modal" data-target="#add_competencias">Añadir capacitaciones</button>
    </div>
    <br>
    <?php }?>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de capacitaciones</h6>
                </div>
                <!-- Card Body -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <input type="hidden" id="idUser" value="<?php echo $userData[0]->id_usuario;?>">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Nivel</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Institución</th>
                                    <?php if($userData[0]->tipo == 3){?>
                                        <th>Inscripcion</th>
                                    <?php }?>
                                </tr>
                                </thead>
                                <tfoot>

                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Nivel</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Institución</th>
                                    <?php if($userData[0]->tipo == 3){?>
                                        <th>Inscripcion</th>
                                    <?php }?>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php if(isset($capacitaciones) and count($capacitaciones) > 0){
                                    foreach($capacitaciones as $capacitacion){?>
                                        <tr>

                                            <td><?php echo $capacitacion->id_capacitaciones;?></td>
                                            <td><?php echo $capacitacion->desc_capacitaciones;?></td>
                                            <td><?php

                                                $nivel = '';

                                                switch ($capacitacion->nivel_capacitacion){
                                                    case 'b':
                                                        $nivel = 'Bachiller';
                                                        break;
                                                    case 't':
                                                        $nivel = 'Técnico';
                                                        break;
                                                    case 'p':
                                                        $nivel = 'Post-grado';
                                                        break;
                                                }
                                                echo $nivel;?></td>
                                            <td><?php echo $capacitacion->fecha_desde;?></td>
                                            <td><?php echo $capacitacion->fecha_hasta;?></td>
                                            <td><?php echo $capacitacion->institucion;?></td>
                                            <?php if($userData[0]->tipo == 3){?>
                                            <td>
                                                <?php

                                                $estaInscrito = false;

                                                foreach ($capacitaciones_usuario as $cu){

                                                    if($cu->id_capacitaciones == $capacitacion->id_capacitaciones){

                                                        $estaInscrito = true;

                                                    }

                                                }

                                                if($estaInscrito == true){
                                                ?>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn" disabled>
                                                            Inscrito
                                                        </button>
                                                    </div>
                                                <?php }else{?>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-primary inscripcionCapacitacion" idcapacitacion="<?php echo $capacitacion->id_capacitaciones;?>">
                                                            Inscribirme
                                                        </button>
                                                    </div>
                                                <?php }?>
                                            </td>
                                            <?php }?>
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



    <div class="modal fade" id="add_competencias" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Introducir una nueva capacitación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="addCapacitaciones">
                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Descripcion de la capacitación:</label>
                                <input type="text" placeholder="ejemplo: Resolucion de Conflictos." class="form-control" name="capacitacion" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Nivel Academico:</label>
                                <select class="form-control" name="nivelAcademico" required>
                                    <option value="">Seleccionar nivel...</option>
                                    <option value="b">Bachiller</option>
                                    <option value="t">Técnico</option>
                                    <option value="p">Post-grado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Desde:</label>
                                <input type="date" class="form-control" name="fDesde" id="fDesde" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Hasta:</label>
                                <input type="date" class="form-control" name="fHasta" id="fHasta" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Institución:</label>
                                <input type="text" placeholder="ejemplo: INFOTEP" class="form-control" name="institucion" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    <input type="submit" class="btn btn-success" name="addCapacitaciones" value="AÑADIR">
                </div>
            </div>
            </form>
        </div>
    </div>




</div>




<?php

include 'footer.php';

?>
