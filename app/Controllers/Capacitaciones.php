<?php


namespace App\Controllers;

use App\Models\ManagementModel;


class Capacitaciones extends BaseController
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
            'tabla' => 'capacitaciones'
        );

        $capacitaciones = array(
            'tabla' => 'capacitaciones_usuario',
            'condicion' => array(
                'id_usuario' => $session->userData[0]->id_usuario
            )
        );

        $data['capacitaciones'] = $this->ManagementModel->getData($parametros);
        $data['capacitaciones_usuario'] = $this->ManagementModel->getData($capacitaciones);

        return view('capacitaciones', $data);

    }

    public function addCapacitaciones()
    {

        if(isset($_POST['addCapacitaciones'])){

            $data = array(
                'tabla' => 'capacitaciones',
                'insertData' => array(
                    'id_capacitaciones' => NULL,
                    'desc_capacitaciones' => $_POST['capacitacion'],
                'nivel_capacitacion' => $_POST['nivelAcademico'],
                    'fecha_desde' => $_POST['fDesde'],
                    'fecha_hasta' => $_POST['fHasta'],
                    'institucion' => $_POST['institucion']
                )
            );

            $this->ManagementModel->insertData($data);

            return redirect('capacitaciones');

        }

    }

    public function inscribir()
    {

        if(isset($_POST['idCapacitacion'])){

            $inscribir = array(
                'tabla' => 'capacitaciones_usuario',
                'insertData' => array(
                    'id_capacitaciones_usuario' => NULL,
                    'id_capacitaciones' => $_POST['idCapacitacion'],
                    'id_usuario' => $_POST['idUser']
                )
            );

            $this->ManagementModel->insertData($inscribir);

            echo 'true';

        }

    }

}