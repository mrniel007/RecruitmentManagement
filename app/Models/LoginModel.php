<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    
    public function signIn($email, $password){

        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');

        $builder->select('
            id_usuario,
            correo,
            nombre_usuario,
            cedula,
            tipo
        ');

        $builder->where('correo', $email);
        $builder->where('clave', $password);

        $result = $builder->get()->getResult();

        return $result;

    }

    public function registerUser($datos){

        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');

        $builder->insert($datos);

        return $this->db->affectedRows() > 0;

    }

}
