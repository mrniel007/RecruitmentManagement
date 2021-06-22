<?php

include 'header.php';

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Candidatos</h1>
    </div>
    <!-- Content Row -->

    <div class="row">

        <!-- Illustrations -->
        <div class="col-xl-12 col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidatos aqui!</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                             src="public/img/undraw_Hire_re_gn5j.svg" alt="...">
                    </div>
                    <p style="text-align: center;">Aqui estan los candidatos para las posiciones disponibles en tu aplicacion RecruitmentManagement™</p>

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
                    <h6 class="m-0 font-weight-bold text-primary">Lista de candidatos</h6>
                </div>
                <!-- Card Body -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Salario deseado</th>
                                    <th>Ver candidato</th>
                                </tr>
                                </thead>
                                <tfoot>

                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Salario deseado</th>
                                    <th>Ver candidato</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php if(isset($candidatos) and count($candidatos) > 0){
                                    foreach($candidatos as $candidato){?>
                                        <tr>

                                            <td><?php echo $candidato->id_candidatos;?></td>
                                            <td><?php echo $candidato->nombre_usuario;?></td>
                                            <td><?php echo $candidato->nombre_puesto;?></td>
                                            <td><?php echo 'RD$ '.number_format($candidato->salario, 2);?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-success verCandidato" data-toggle="modal" data-target="#ver_candidato" usuarioid="<?php echo $candidato->id_usuario;?>" candidatoid="<?php echo $candidato->id_candidatos;?>">
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

    <div class="modal fade" id="ver_candidato" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                    <label for="name">Nombre:</label>
                                    <span id="nombre">

                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Posicion:</label>
                                    <span id="posicion">

                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Salario Deseado:</label>
                                    <span id="salarioDeseado">

                                    </span>
                                    <input type="hidden" id="hiddenSalary">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="name">Competencias:</label>
                            <ul id="competenciasUsuario">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input id="aceptarCandidato" type="button" class="btn btn-success" value="Contratar">
                    <input id="idPuesto" type="hidden">
                    <input id="idCandidato" type="hidden">
                    <input id="idUser" type="hidden">
                </div>
            </div>

        </div>
    </div>



</div>




<?php

include 'footer.php';

?>

