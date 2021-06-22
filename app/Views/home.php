<?php

    include 'header.php';

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
    
</div>

<!-- Content Row -->
<div class="row">

    <?php if($userData[0]->tipo == 1){?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Vacantes Disponibles</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($puestos);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Candidatos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($candidatos);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Empleados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($empleados);?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Capacitaciones disponibles
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo count($capacitaciones);?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }?>
</div>
<!-- Content Row -->
 <?php if($userData[0]->tipo == 1){?>
<div class="row">

    <!-- Illustrations -->
    <div class="col-xl-12 col-lg-7">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recluta!</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="public\img\undraw_Experts_re_i40h.svg" alt="...">
                </div>
                <p style="text-align: center;">Gestiona las solicitudes de reclutamiento y de nuevas posiciones en tu aplicacion RecruitmentManagement™</p>
            
            </div>
        </div>
    </div>

</div>

 <?php }?>

 <?php if($userData[0]->tipo == 2){?>
    <div class="row">

        <!-- Illustrations -->
        <div class="col-xl-12 col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Postulate!</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                             src="public/img/undraw_Filing_system_re_56h6.svg" alt="...">
                    </div>
                    <p style="text-align: center;">Postulate para las vacantes que tenemos disponibles para ti en RecruitmentManagement™</p>

                </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->
<?php }?>

<?php if($userData[0]->tipo == 3){
    $nombreArray = explode(' ' , trim($userData[0]->nombre_usuario));
    ?>
    <div class="row">

        <!-- Illustrations -->
        <div class="col-xl-12 col-lg-7">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hola <?php echo $nombreArray[0];?>!</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                             src="public/img/undraw_road_to_knowledge_m8s0.svg" alt="...">
                    </div>
                    <p style="text-align: center;">Aprende con las capacitaciones que tenemos disponibles para ti en RecruitmentManagement™</p>

                </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->
<?php }?>
<?php 

    include 'footer.php';

?>