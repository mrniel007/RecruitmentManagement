<?php

include 'header.php';

?>
<link href="public/css/userinfo.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perfil del usuario</h1>

    </div>

    <!-- Content Row -->

    <div class="container light-style flex-grow-1 container-p-y">
        
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#work-experience">Experiencia Laboral</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#competencias">Competencias</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">

                            <div class="card-body media align-items-center">
                                <img src="public/img/undraw_profile.svg" alt="" class="d-block ui-w-80">
                            </div>
                            <hr class="border-light m-0">

                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Nombre Completo: </label>
                                    <input type="text" id="nombre" class="form-control editable mb-1" value="<?php echo $userData[0]->nombre_usuario;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail: </label>
                                    <input type="text" id="correo" class="form-control editable mb-1" value="<?php echo $userData[0]->correo;?>">
                                    <input type="hidden" id="correoOG" value="<?php echo $userData[0]->correo;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Cedula: </label>
                                    <input type="number" id="cedula" class="form-control editable" value="<?php echo $userData[0]->cedula;?>">
                                </div>
                                <div class="form-group">
                                    <div class="mt-3">
                                        <button id="editProfile" type="button" class="btn btn-success" disabled>
                                            Editar
                                        </button>
                                        <input id="userID" type="hidden" class="btn btn-success" value="<?php echo $userData[0]->id_usuario; ?>">
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="tab-pane fade" id="work-experience">
                            <div class="card-body pb-2">
                                <div>
                                    <button type="button" class="right btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#add_experiencia">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">
                                            Añadir experiencia laboral
                                        </span>
                                    </button>
                                </div>
                                <br>
                                <div class="entry">
                                    <?php if(isset($experiencia) and count($experiencia) > 0){
                                                foreach ($experiencia as $exp){
                                    ?>
                                    <div class="content">
                                        <h3><?php echo date( 'M Y' ,strtotime($exp['fecha_desde'])).' - '.date('M Y', strtotime($exp['fecha_hasta']));?></h3>
                                        <p><?php echo $exp['puesto'];?><br>
                                            <em><?php echo $exp['empresa'];?></em><br>
                                            <em><?php echo 'RD$ '.number_format($exp['salario'], 2);?></em> mensuales</p>
                                        <ul class="info">
                                            <?php if(!empty($exp['detalles'])){
                                                    foreach ($exp['detalles'] as $detalle){
                                                ?>
                                            <li><?php echo $detalle->detalle;?></li>
                                            <?php }
                                            }?>
                                        </ul>
                                    </div>
                                    <?php }
                                    }?>
                                </div>


                            </div>

                        </div>
                        <div class="tab-pane fade" id="competencias">
                            <div class="card-body pb-2">
                                <div class="entry">
                                    <div class="content">
                                        <label for="name"><h3>Competencias:</h3></label>
                                        <div class="form-group">
                                        <?php if(isset($competencias) and count($competencias) > 0){
                                            foreach($competencias as $competencia){
                                                ?>

                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input id="competencia_edit_userinfo_<?php echo $competencia['id_competencia'];?>" class="form-check-input competenciasEditUserinfo" type="checkbox" value="<?php echo $competencia['id_competencia'];?>" <?php

                                                            if($competencia['hasCompetencia'] != 'No'){
                                                                echo 'competenciausuario="'.$competencia['hasCompetencia'].'" checked';
                                                            }

                                                            ?>><?php echo $competencia['descripcion_competencia'];?>
                                                        </label>
                                                    </div>

                                            <?php }
                                        }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="add_experiencia" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 70% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Introducir una experiencia laboral</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="name">Puesto:</label>
                                    <input type="text" placeholder="ejemplo: Auxiliar." class="form-control" id="puesto" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Salario:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">RD$</div>
                                        </div>
                                        <input type="number" class="form-control" id="salario" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="name">Desde:</label>
                                    <input type="date" class="form-control" name="fDesde" id="fDesde" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Hasta:</label>
                                    <input type="date" class="form-control" name="fHasta" id="fHasta" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8">
                                    <label for="name">Institución:</label>
                                    <input id="institucion" type="text" placeholder="ejemplo: INFOTEP" class="form-control" name="institucion" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <button id="addDetalle" type="button" class="btn btn-primary btn-icon-split btn-sm float-right">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                            <span class="text">
                                        Añadir detalles
                                    </span>
                                        </button>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <ul>
                                            <li><input type="text" class="form-control input-sm expDetail"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <span>| Acción</span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <ul id="extraDetails">
                                        </ul>
                                    </div>
                                </div>
                                <div id="divDetailsDelete" class="col-md-4">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    <input id="addExperiencia" type="button" class="btn btn-success" value="AÑADIR">
                </div>
            </div>

        </div>
    </div>


    <?php

    include 'footer.php';

    ?>
