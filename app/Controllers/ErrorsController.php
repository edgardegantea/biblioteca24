<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ErrorsController extends BaseController
{
    public function accessDenied()
    {
        return view('errors/access_denied');
    }
}
