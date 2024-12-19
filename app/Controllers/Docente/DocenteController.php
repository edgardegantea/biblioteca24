<?php

namespace App\Controllers\Docente;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DocenteController extends BaseController
{

    public function __construct()
    {
        if (session()->get('role') != 'docente') {
            echo view('errors/access_denied');
            exit;
        }
    }


    public function index()
    {
        // return view('docente/dashboard');
        echo 'Index de docente';
    }


    public function x()
    {
        echo 'Verificación';
    }
}
