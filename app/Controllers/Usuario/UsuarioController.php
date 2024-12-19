<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ArchivoModel;

class UsuarioController extends BaseController
{
    public function __construct()
    {
        if (session()->get('rol') != "usuario") {
            echo view('accesonoautorizado');
            exit;
        }
    }


    public function index()
    {
        $searchTerm = $this->request->getGet('q') ?? $this->request->getPost('termino_busqueda');

        $db = \Config\Database::connect();

        try {
            $query = $db->table('archivos a')
                ->select('a.*, c.nombre AS categoria_nombre')
                ->join('clasificaciones c', 'a.clasificacion_id = c.id', 'left');

            if (!empty($searchTerm)) {
                $query->like('a.nombre', $searchTerm)
                    ->orLike('a.tipo', $searchTerm);
            }

            $searchResults = $query->get()->getResultArray();
        } catch (DatabaseException $e) {
            log_message('error', $e->getMessage());
            $searchResults = [];
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON($searchResults);
        } else {
            $dashboardData = [
                'archivos' => [],
                'searchTerm' => $searchTerm
            ];

            if (!empty($searchTerm)) {
                $dashboardData['archivos'] = $searchResults;
            }

            return view('usuario/dashboard', $dashboardData);
        }
    }
}
