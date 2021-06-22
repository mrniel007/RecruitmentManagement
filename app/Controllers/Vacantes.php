<?php


namespace App\Controllers;

use App\Models\ManagementModel;

class Vacantes extends BaseController
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
            'tabla' => 'puestos',
            'condiciones' => array(
                'estado' => 1
            )
        );

        $data['puestos'] = $this->ManagementModel->getData($parametros);

        return view('vacantes', $data);

    }

    public function getVacante(){

        if(isset($_POST['id'])){

            $puestoData = array(
                'tabla' => 'puestos',
                'condicion' => array(
                    'id_puestos' => $_POST['id']
                )
            );

            $competenciaData = array(
                'tabla' => 'competencias_puestos',
                'joins' => array(
                    array(
                        'tabla' => 'competencia c',
                        'expresion' => 'c.id_competencia = id_competencias'
                    )
                ),
                'condicion' => array(
                    'id_puestos' => $_POST['id']
                )
            );

            $checkCandidato = array(
                'tabla' => 'candidatos',
                'condicion' => array(
                    'id_usuario' => $_POST['idUser'],
                    'id_puesto' => $_POST['id']
                )
            );

            $candidato = $this->ManagementModel->getData($checkCandidato);

            $puesto = $this->ManagementModel->getData($puestoData);

            $competencias = $this->ManagementModel->getCombinedData($competenciaData);

            $data = array(
                'puesto' => $puesto,
                'competencias' => $competencias,
                'isCandidato' => (count($candidato) > 0) ? 'Si' : 'No'
            );

            echo json_encode($data);

        }

    }

    public function postular(){

        if($_POST['id']){

            $postular = array(
                'tabla' => 'candidatos',
                'insertData' => array(
                    'id_candidatos' => NULL,
                    'id_usuario' => $_POST['idUser'],
                    'id_puesto' => $_POST['id'],
                    'salario' => $_POST['sueldoDeseado'],
                    'estado' => 1
                )
            );

            $this->ManagementModel->insertData($postular);

            echo 'true';

        }

    }

}