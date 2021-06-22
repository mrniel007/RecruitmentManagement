<?php

namespace App\Controllers;

use App\Models\ManagementModel;

class Userinfo extends BaseController
{

    protected $ManagementModel;

    function __construct(){

        $this->ManagementModel = new ManagementModel;

    }

    public function index()
    {
        $session = session();

        $userid = $session->userData[0]->id_usuario;

        $usario = array(
            'tabla' => 'usuario',
            'condicion' => array(
                'id_usuario' => $userid
            )
        );

        $usario = array(
            'tabla' => 'usuario',
            'condicion' => array(
                'id_usuario' => $userid
            )
        );

        $data['userData'] = $this->ManagementModel->getData($usario);

        $data['experiencia'] = $this->getExperiencia($userid);
        $data['competencias'] = $this->getCompetencias($userid);


        if(empty($data['userData'])){
            return redirect()->to('login');
            exit();
        }

        return view('userinfo', $data);
    }

    public function addExperiencia(){
        if(isset($_POST['institucion'])){

            $session = session();

            $userid = $session->userData[0]->id_usuario;

            $expData = array(
                'tabla' => 'experiencia_laboral',
                'returnID' => true,
                'insertData' => array(
                    'id_experiencia_laboral' => NULL,
                    'id_usuario' => $userid,
                    'empresa' => $_POST['institucion'],
                    'puesto' => $_POST['puesto'],
                    'fecha_desde' => $_POST['fDesde'],
                    'fecha_hasta' => $_POST['fHasta'],
                    'salario' => $_POST['salario'],
                )
            );

            $insertExp = $this->ManagementModel->insertData($expData);

            $detallesData = array();

            foreach($_POST['detalles'] as $detalle){

                $data = array(
                    'id_experiencia_laboral' => $insertExp,
                    'detalle' => $detalle
                );

                array_push($detallesData, $data);
            }

            $insertDetail = array(
                'tabla' => 'detalle_experiencia',
                'insertBatchData' => $detallesData
            );

            $this->ManagementModel->insertBatchData($insertDetail);

            echo 'true';

        }

    }

    private function getExperiencia($id)
    {

        $experiences = array();

        $experiencia = array(
            'tabla' => 'experiencia_laboral',
            'condicion' => array(
                'id_usuario' => $id
            )
        );

        $experiencias = $this->ManagementModel->getData($experiencia);

        foreach($experiencias as $exp){

            $data = array(
                'tabla' => 'detalle_experiencia',
                'condicion' => array(
                    'id_experiencia_laboral' => $exp->id_experiencia_laboral
                )
            );

            $detalles = $this->ManagementModel->getData($data);

            $experience = array(
                'id_experiencia_laboral' => $exp->id_experiencia_laboral,
                'id_usuario' => $exp->id_usuario,
                'empresa' => $exp->empresa,
                'puesto' => $exp->puesto,
                'fecha_desde' => $exp->fecha_desde,
                'fecha_hasta' => $exp->fecha_hasta,
                'salario' => $exp->salario,
                'detalles' => $detalles
            );

            array_push($experiences, $experience);

        }

        return $experiences;

    }

    private function getCompetencias($id){

        $competencias = array();

        $competencia = array(
            'tabla' => 'competencia',
            'condicion' => array(
                'estado_competencia' => 1
            )
        );

        $compData = $this->ManagementModel->getData($competencia);

        $compUser = array(
            'tabla' => 'competencias_usuario',
            'condicion' => array(
                'id_usuario' => $id
            )
        );

        $compUserData = $this->ManagementModel->getData($compUser);

        foreach ($compData as $comp){

            $hasCompetencia = 'No';

            foreach($compUserData as $compU){
                if($compU->id_competencia == $comp->id_competencia){

                    $hasCompetencia = $compU->id_competencia_usuario;

                }
            }

            $data = array(
                'id_competencia' => $comp->id_competencia,
                'descripcion_competencia' => $comp->descripcion_competencia,
                'estado_competencia' => $comp->estado_competencia,
                'hasCompetencia' => $hasCompetencia,
            );

            array_push($competencias, $data);

        }

        return $competencias;

    }

    public function editProfile()
    {

        if(isset($_POST['correo'])){

            $updateData = array(
                'tabla' => 'usuario',
                'primaryKey' => 'id_usuario',
                'id' => $_POST['id'],
                'updateData' => array(
                    'correo' => $_POST['correo'],
                    'nombre_usuario' => $_POST['nombre'],
                    'cedula' => $_POST['cedula'],
                )
            );

            $this->ManagementModel->updateData($updateData);

            $usario = array(
                'tabla' => 'usuario',
                'condicion' => array(
                    'id_usuario' => $_POST['id']
                )
            );

            $data['userData'] = $this->ManagementModel->getData($usario);

            $sessionData = array(
                'userData' => $data['userData'],
            );

            $session = session();

            $session->remove('userData');

            $session->set($sessionData);

            echo 'true';

        }

    }

    public function toggleUserComp()
    {

        if($_POST['deleteOrCreate']){



            if($_POST['deleteOrCreate'] == 'true'){

                $newComp = array(
                    'tabla' => 'competencias_usuario',
                    'returnID' => true,
                    'insertData' => array(
                        'id_competencia_usuario' => NULL,
                        'id_competencia' => $_POST['id'],
                        'id_usuario' => $_POST['userID']
                    )
                );

                $insertComp = $this->ManagementModel->insertData($newComp);

                echo $insertComp;

            }else{

                $deleteComp = array(
                    'tabla' => 'competencias_usuario',
                    'condicion' => array(
                        'id_competencia_usuario' => $_POST['userCompID']
                    )
                );

                $this->ManagementModel->deleteData($deleteComp);

                echo 'deleted';

            }

        }

    }

}