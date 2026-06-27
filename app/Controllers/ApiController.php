<?php

namespace App\Controllers;

use App\Models\SensorModel;

class ApiController extends BaseController
{
    public function insertar()
    {
        $model = new SensorModel();

        $model->insert([
            'temperatura' => $this->request->getGet('temperatura'),
            'humedad'     => $this->request->getGet('humedad'),
            'indice'      => $this->request->getGet('indice'),
            'gasraw'      => $this->request->getGet('gasraw'),
            'movimiento'  => $this->request->getGet('movimiento') ?? 0
        ]);

        return $this->response->setJSON([
            'mensaje' => 'OK'
        ]);
    }

    public function recientes()
    {
        $limit = $this->request->getGet('limit') ?? 30;

        $model = new SensorModel();

        $datos = $model
            ->orderBy('id','DESC')
            ->findAll($limit);

        return $this->response->setJSON(
            array_reverse($datos)
        );
    }
}
