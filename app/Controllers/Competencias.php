<?php

namespace App\Controllers;

use App\Models\ManagementModel;

class Competencias extends BaseController
{

    protected $ManagementModel;

    function __construct(){

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
            'tabla' => 'competencia'
        );

        $data['competencias'] = $this->ManagementModel->getData($parametros);

        return view('competencias', $data);

    }

    public function addCompetencias()
    {

        if(isset($_POST['addCompetencia'])){

            $data = array(
                'tabla' => 'competencia',
                'insertData' => array(
                    'id_competencia' => NULL,
                    'descripcion_competencia' => $_POST['competencia'],
                    'estado_competencia' => 1
                )
            );

            $this->ManagementModel->insertData($data);

            return redirect('competencias');

        }

    }

    public function toggleCompetencias(){

        if(isset($_POST['toggleCompetencia'])){

            $data = array(
                'tabla' => 'competencia',
                'primaryKey' => 'id_competencia',
                'id' => $_POST['id'],
                'updateData' => array(
                    'estado_competencia' => $_POST['estado']
                )
            );

            $updateData = $this->ManagementModel->updateData($data);

            echo ($updateData) ? 'true' : 'false';

        }

    }

}