<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $LoginModel;

    function __construct(){

        $this->LoginModel = new LoginModel;

    }

    public function index()
    {

        return view('login');

    }

    public function signin()
    {

        if(isset($_POST['email']) and isset($_POST['password'])){

            $signInInfo = $this->LoginModel->signIn($_POST['email'], $_POST['password']);

            if(count($signInInfo) >= 1){

                $session = session();

                $sessionData = array(
                    'userData' => $signInInfo,
                    'loggedIn' => TRUE
                );

                $session->set($sessionData);

                return redirect()->to('home');

            }else{

                $data['mensaje'] = 'Email o contraseña equivocado'; 

                return view('login', $data);

            }


        }else{

            return redirect()->to('home');

        }

    }

    public function registerPage()
	{

		return view('register');

	}

    public function register()
    {

        if(isset($_POST['registerUser'])){

            $datos = array(

                'id_usuario' => null,
                'correo' => $_POST['email'],
                'nombre_usuario' => $_POST['nombres'].' '.$_POST['apellidos'],
                'cedula' => $_POST['cedula'],
                'tipo' => 2,
                'clave' => $_POST['password'],

            );

            $registerUser = $this->LoginModel->registerUser($datos);

            if($registerUser == true){

                $respuesta = array(
                    'mensaje' => 'Usuario creado satisfactoriamente'
                );

                return view('login', $respuesta);

            }else{

                $respuesta = array(
                    'error' => 'Error al crear usuario'
                );

                return view('register', $respuesta);

            }

        }

    }

}