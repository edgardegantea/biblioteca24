<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UsuarioModel;

class ProfileController extends BaseController
{
    public function completeProfile()
    {
        $usuarioModel = new UsuarioModel();
        $session = session();
        $usuario = $usuarioModel->find($session->get('user_id'));

        return view('profile/complete', ['usuario' => $usuario]);
    }

    public function updateProfile()
    {
        $usuarioModel = new UsuarioModel();
        $session = session();
        $data = $this->request->getPost();

        // Actualiza la información del perfil
        $usuarioModel->update($session->get('user_id'), $data);

        // Marca el perfil como completo
        $usuarioModel->update($session->get('user_id'), ['is_profile_complete' => 1]);

        // Intenta obtener el rol desde la sesión
        $role = $session->get('role');

        // Si no existe el rol en la sesión, obtén el rol desde la base de datos
        if (!$role) {
            $usuario = $usuarioModel->find($session->get('user_id'));
            $role = $usuario['role'] ?? null;

            // Si el rol existe, guardarlo en la sesión
            if ($role) {
                $session->set('role', $role);
            } else {
                return redirect()->to('/login');
            }
        }

        // Redireccionar según el rol
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin');
            case 'docente':
                return redirect()->to('/docente');
            case 'usuario':
                return redirect()->to('/usuario');
            default:
                return redirect()->to('/login');
        }
    }
}