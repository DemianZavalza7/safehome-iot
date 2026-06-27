<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class CorreoController extends BaseController
{
    public function enviar()
    {
        $email = \Config\Services::email();

        $to = $this->request->getGet('to');
        $mensaje = $this->request->getGet('mensaje');

        $email->setTo($to);
        $email->setFrom('tucorreo@gmail.com', 'SafeHome IoT');
        $email->setSubject('🚨 Alerta SafeHome IoT');
        $email->setMessage($mensaje);

        if ($email->send()) {
            return $this->response->setJSON(['status' => 'OK']);
        } else {
            return $this->response->setJSON(['status' => 'ERROR', 'debug' => $email->printDebugger()]);
        }
    }
}