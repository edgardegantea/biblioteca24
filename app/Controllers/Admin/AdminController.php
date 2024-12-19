<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{

    public function __construct()
    {
        if (session()->get('role') != 'admin') {
            echo view('errors/access_denied');
            exit;
        }
    }


    public function index()
    {
        return view('admin/dashboard');
    }
}
