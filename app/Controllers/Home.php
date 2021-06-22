<?php

namespace App\Controllers;

use App\Models\ManagementModel;

class Home extends BaseController
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

        $puestos = array(
            'tabla' => 'puestos',
            'condicion' => array(
                'estado' => 1
            )
        );

        $empleados = array(
            'tabla' => 'empleados'
        );

        $capacitaciones = array(
            'tabla' => 'capacitaciones'
        );

        $candidatos = array(
            'tabla' => 'candidatos',
            'condicion' => array(
                'estado' => 1
            )
        );

		$data['puestos'] = $this->ManagementModel->getData($puestos);
		$data['empleados'] = $this->ManagementModel->getData($empleados);
		$data['capacitaciones'] = $this->ManagementModel->getData($capacitaciones);
		$data['candidatos'] = $this->ManagementModel->getData($candidatos);

		return view('home', $data);
	}

	public function logout()
	{

		return view('login');

	}

}
