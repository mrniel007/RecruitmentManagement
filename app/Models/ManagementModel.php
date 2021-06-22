<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagementModel extends Model
{

    public function getData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->select();

        if($data['condicion'] != null){

            $builder->where($data['condicion']);

        }

        return $builder->get()->getResult();

    }

    public function getCombinedData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->select();

        if($data['condicion'] != null){

            $builder->where($data['condicion']);

        }

        foreach ($data['joins'] as $join){

            $builder->join($join['tabla'], $join['expresion']);

        }

        return $builder->get()->getResult();

    }

    public function getReporteData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->select();

        if($data['tabla'] == 'candidatos c'){

            $builder->join('usuario u', 'u.id_usuario = c.id_usuario');
            $builder->join('competencias_usuario comp', 'comp.id_usuario = c.id_usuario');
            $builder->join('competencia com', 'com.id_competencia = comp.id_competencia');
            $builder->join('puestos p', 'p.id_puestos = c.id_puesto');

            $builder->where('c.estado', 1);
            if($data['competencias'] != 'Todas'){
                $builder->where('comp.id_competencia', $data['competencias']);
            }
            if($data['puestos'] != 'Todas'){
                $builder->where('p.id_puestos', $data['puestos']);
            }

        }else{

            $builder->join('usuario u', 'u.id_usuario = e.id_usuario');
            $builder->join('competencias_usuario comp', 'comp.id_usuario = e.id_usuario');
            $builder->join('competencia com', 'com.id_competencia = comp.id_competencia');
            $builder->join('puestos p', 'p.id_puestos = e.id_puesto');

            $builder->where('e.estatus', 1);
            if($data['competencias'] != 'Todas'){
                $builder->where('com.id_competencia', $data['competencias']);
            }
            if($data['puestos'] != 'Todas'){
                $builder->where('p.id_puestos', $data['puestos']);
            }
            $builder->where('fecha_ingreso >=', $data['fDesde']);
            $builder->where('fecha_ingreso <=', $data['fHasta']);

        }

        $builder->groupBy('u.id_usuario');

        return $builder->get()->getResult();

    }

    public function insertData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->insert($data['insertData']);

        if($db->affectedRows() > 0 and $data['returnID'] == true){

            return $db->insertID();

        }

    }

    public function insertBatchData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->insertBatch($data['insertBatchData']);

    }

    public function updateData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->where($data['primaryKey'], $data['id']);

        $builder->update($data['updateData']);

        return ($db->affectedRows() > 0);

    }

    public function deleteData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->where($data['condicion']);

        $builder->delete();

    }

    public function replaceData($data){

        $db      = \Config\Database::connect();
        $builder = $db->table($data['tabla']);

        $builder->replace($data['replaceData']);

    }

}