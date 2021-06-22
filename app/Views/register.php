<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RecruitmentManagement</title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crea tu cuenta!</h1>
                                <?php if(isset($error)){?>
                                <h5 class="h5" style="color: red"><?php echo $error;?></h5>
                                <?php }?>
                            </div>
                            <form class="user" action="register" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nombres"
                                            placeholder="Nombres" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="apellidos"
                                            placeholder="Apellidos" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" name="email"
                                            placeholder="Correo electronico" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="cedula" class="form-control form-control-user" name="cedula"
                                            placeholder="Cedula" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="confirm_password" placeholder="Confirme Contraseña" required>
                                    </div>
                                </div>
                                <input type="submit" id="submitForm" name="registerUser" class="btn btn-primary btn-user btn-block" value="Registrar">
                    
                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="login">Ya tiene cuenta? inicie sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>
    <script src="public/js/registro/registro.js"></script>

</body>

</html>