<?php


namespace App\Controllers;

use App\Models\ManagementModel;

class Reportes extends BaseController
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

        $puestos = array(
            'tabla' => 'puestos',
            'condiciones' => array(
                'estado' => 1
            )
        );

        $competencias = array(
            'tabla' => 'competencia',
            'condiciones' => array(
                'estado_competencia' => 1
            )
        );

        $data['puestos'] = $this->ManagementModel->getData($puestos);
        $data['competencias'] = $this->ManagementModel->getData($competencias);

        return view('reportes', $data);

    }

    public function getReporte()
    {

        if(isset($_POST['tipoConsulta'])){

            $tabla = ($_POST['tipoConsulta'] == 1) ? 'empleados e' : 'candidatos c';

            $parametros = array(
                'tabla' => $tabla,
                'puestos' => $_POST['posiciones'],
                'competencias' => $_POST['competencias'],
                'fDesde' => $_POST['fDesde'],
                'fHasta' => $_POST['fHasta']
            );

            $reporte = $this->ManagementModel->getReporteData($parametros);

            echo json_encode($reporte);

        }

    }

}