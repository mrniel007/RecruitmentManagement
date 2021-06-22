<?php

namespace App\Controllers;

use App\Models\ManagementModel;

class Puestos extends BaseController
{
    protected $ManagementModel;

    function __construct()
    {

        $this->ManagementModel = new ManagementModel;

    }

    public function index()
    {
        $session = session();

        $data['userData'] = $session->userData;

        if(empty($data['userData'])){
            return redirect()->to('login');
            exit();
        }

        $parametros = array(
            'tabla' => 'puestos'
        );

        $competencias = array(
            'tabla' => 'competencia',
            'condicion' => array(
                'estado_competencia' => '1'
            )
        );

        $data['puestos'] = $this->ManagementModel->getData($parametros);
        $data['competencias'] = $this->ManagementModel->getData($competencias);

        return view('puestos', $data);

    }

    public function addPuesto()
    {

        if(isset($_POST['addPuesto'])){

            //log_message('error', json_encode($_POST));

            $competencias = $_POST['competencias'];

            $data = array(
                'tabla' => 'puestos',
                'returnID' => true,
                'insertData' => array(
                    'id_puestos' => NULL,
                    'nombre_puesto' => $_POST['puesto'],
                    'nivel_riesgo' => $_POST['nivelRiesgo'],
                    'salario_minimo' => $_POST['salarioMin'],
                    'salario_maximo' => $_POST['salarioMax'],
                    'estado' => '1'
                )
            );

            $insertPuesto = $this->ManagementModel->insertData($data);

            $competenciaData = array();

            foreach($competencias as $competencia){

                $data = array(
                    'id_competencias' => $competencia,
                    'id_puestos' => $insertPuesto
                );

                array_push($competenciaData, $data);

            }

            $competenciaInsertData = array(
                'tabla' => 'competencias_puestos',
                'insertBatchData' => $competenciaData
            );

            $this->ManagementModel->insertBatchData($competenciaInsertData);

            log_message('error', json_encode($competenciaData));

            echo 'true';

        }

    }

    public function getPuesto(){

        if(isset($_POST['id'])){

            $puestoData = array(
                'tabla' => 'puestos',
                'condicion' => array(
                    'id_puestos' => $_POST['id']
                )
            );

            $competenciaData = array(
                'tabla' => 'competencias_puestos',
                'condicion' => array(
                    'id_puestos' => $_POST['id']
                )
            );

            $puesto = $this->ManagementModel->getData($puestoData);

            $competencias = $this->ManagementModel->getData($competenciaData);

            $data = array(
                'puesto' => $puesto,
                'competencias' => $competencias
            );

            echo json_encode($data);

        }

    }

    public function editPuesto(){

        if(isset($_POST['editarPuesto'])){

            $competencias = array();

            foreach ($_POST['competencias'] as $competencia){

                $data = array(
                    'id_competencias_puestos' => null,
                    'id_competencias' => $competencia,
                    'id_puestos' => $_POST['id']
                );

                array_push($competencias, $data);

            }

            log_message('error', json_encode($competencias));

            $updateData = array(
                'tabla' => 'puestos',
                'primaryKey' => 'id_puestos',
                'id' => $_POST['id'],
                'updateData' => array(
                    'nombre_puesto' => $_POST['puesto'],
                    'nivel_riesgo' => $_POST['nivelRiesgo'],
                    'salario_minimo' => $_POST['salarioMin'],
                    'salario_maximo' => $_POST['salarioMax']
                )
            );

            $this->resetPuestoCompetencia($_POST['id']);

            $replaceData = array(
              'tabla' => 'competencias_puestos',
                'insertBatchData' => $competencias
            );

            $this->ManagementModel->updateData($updateData);
            $this->ManagementModel->insertBatchData($replaceData);

            echo 'true';

        }

    }

    private function resetPuestoCompetencia($id){

        $data = array(
            'tabla' => 'competencias_puestos',
            'condicion' => array(
                'id_puestos' => $id
            )
        );

        $compPuestoData = $this->ManagementModel->getData($data);

        if(count($compPuestoData) > 0){

            foreach ($compPuestoData as $comp){

                $deleteData = array(
                    'tabla' => 'competencias_puestos',
                    'condicion' => array(
                        'id_competencias_puestos' => $comp->id_competencias_puestos
                    )
                );

                $this->ManagementModel->deleteData($deleteData);

            }

        }

       return true;

    }
}