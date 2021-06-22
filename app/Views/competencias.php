<?php

include 'header.php';

?>


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Competencias</h1>
        </div>
        <div>
            <button type="button" class="right btn btn-primary " data-toggle="modal" data-target="#add_competencias">Añadir competencias</button>
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
                        <h6 class="m-0 font-weight-bold text-primary">Lista de competencias</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Competencias</th>
                                        <th>Estado</th>

                                    </tr>
                                    </thead>
                                    <tfoot>

                                    <tr>
                                        <th>ID</th>
                                        <th>Competencias</th>
                                        <th>Estado</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php if(isset($competencias) and count($competencias) > 0){
                                        foreach($competencias as $competencia){?>
                                            <tr>

                                                <td><?php echo $competencia->id_competencia;?></td>
                                                <td><?php echo $competencia->descripcion_competencia;?></td>
                                                <td><input id="<?php echo $competencia->id_competencia;?>" type="checkbox" class="estadoCompetencia" <?php echo ($competencia->estado_competencia == 1) ? 'checked' : '';?>></td>

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
                        <h5 class="modal-title" id="">Introducir una nueva competencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="addCompetencias">
                            <!-- Content Row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Descripcion de la competencia</label>
                                    <input type="text" placeholder="ejemplo: Toma de desiciones." class="form-control" id="" name="competencia">
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                        <input type="submit" class="btn btn-success" name="addCompetencia" value="AÑADIR">
                    </div>
                </div>
                </form>
            </div>
        </div>




    </div>




<?php

include 'footer.php';

?>