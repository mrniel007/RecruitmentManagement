<?php

namespace App\Controllers;

use App\Models\ManagementModel;

class Idiomas extends BaseController
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
            'tabla' => 'idiomas'
        );

        $data['idiomas'] = $this->ManagementModel->getData($parametros);

		return view('idiomas', $data);
        
	}

	public function addIdioma()
	{

		if(isset($_POST['addIdioma'])){
			
			$data = array(
				'tabla' => 'idiomas',
				'insertData' => array(
					'id_idiomas' => NULL,
					'nombre_idioma' => $_POST['idioma'],
					'estado' => 1
				)
			);

			$this->ManagementModel->insertData($data);

			return redirect('idiomas');

		}

	}

	public function toggleIdioma(){

		if(isset($_POST['toggleIdioma'])){

			$data = array(
				'tabla' => 'idiomas',
				'primaryKey' => 'id_idiomas',
				'id' => $_POST['id'],
				'updateData' => array(
					'estado' => $_POST['estado']
				)
			);

			$updateData = $this->ManagementModel->updateData($data);

			echo ($updateData) ? 'true' : 'false';

		}

	}


}