<?php


namespace App\Controllers;

use App\Models\ManagementModel;

class Candidatos extends BaseController
{
    protected $ManagementModel;

    function __construct(){

        $this->ManagementModel = new ManagementModel;

    }

    public function index(){

        $session = session();

        $data['userData'] = $session->userData;

        if(empty($data['userData'])){
            return redirect()->to('login');
            exit();
        }

        $parametros = array(
            'tabla' => 'candidatos c',
            'joins' => array(
                array(
                    'tabla' => 'usuario u',
                    'expresion' => 'u.id_usuario = c.id_usuario'
                ),
                array(
                    'tabla' => 'puestos p',
                    'expresion' => 'p.id_puestos = c.id_puesto'
                ),
            ),
            'condicion' => array(
                'c.estado' => 1
            )
        );

        $data['candidatos'] = $this->ManagementModel->getCombinedData($parametros);

        return view('candidatos', $data);

    }

    public function getCandidato(){

        if(isset($_POST['candidateID'])){

            $userID = $_POST['usuarioID'];

            $parametros = array(
                'tabla' => 'candidatos c',
                'joins' => array(
                    array(
                        'tabla' => 'usuario u',
                        'expresion' => 'u.id_usuario = c.id_usuario'
                    ),
                    array(
                        'tabla' => 'puestos p',
                        'expresion' => 'p.id_puestos = c.id_puesto'
                    ),
                ),
                'condicion' => array(
                    'id_candidatos' => $_POST['candidateID']
                )
            );

            $competencias = array(
                'tabla' => 'competencias_usuario cp',
                'joins' => array(
                    array(
                        'tabla' => 'competencia c',
                        'expresion' => 'c.id_competencia = cp.id_competencia'
                    )
                ),
                'condicion' => array(
                    'id_usuario' => $userID
                )
            );

            $candidato = $this->ManagementModel->getCombinedData($parametros);
            $competenciaData = $this->ManagementModel->getCombinedData($competencias);

            $candidatoData = array(
                'candidatoData' => $candidato,
                'competenciaData' => $competenciaData
            );

            echo json_encode($candidatoData);

        }

    }

    public function contratar(){

        if(isset($_POST['idPuesto']) and isset($_POST['idCandidato']) and isset($_POST['idUser'])){

            $puestoEdit = array(
                'tabla' => 'puestos',
                'primaryKey' => 'id_puestos',
                'id' => $_POST['idPuesto'],
                'updateData' => array(
                    'estado' => 2
                )
            );

            $candidatoEdit = array(
                'tabla' => 'candidatos',
                'primaryKey' => 'id_candidatos',
                'id' => $_POST['idCandidato'],
                'updateData' => array(
                    'estado' => 2
                )
            );

            $userEdit = array(
                'tabla' => 'usuario',
                'primaryKey' => 'id_usuario',
                'id' => $_POST['idUser'],
                'updateData' => array(
                    'tipo' => 3
                )
            );

            $empleadoInsert = array(
                'tabla' => 'empleados',
                'insertData' => array(
                    'id_empleados' => NULL,
                    'id_usuario' => $_POST['idUser'],
                    'fecha_ingreso' => date('Y-m-d'),
                    'id_puesto' => $_POST['idPuesto'],
                    'salario' => $_POST['salario'],
                    'estatus' => 1
                )
            );

            $this->ManagementModel->updateData($puestoEdit);
            $this->ManagementModel->updateData($candidatoEdit);
            $this->ManagementModel->updateData($userEdit);
            $this->ManagementModel->insertData($empleadoInsert);

            echo 'done';

        }
    }
}