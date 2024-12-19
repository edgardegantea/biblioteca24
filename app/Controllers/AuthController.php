<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController extends BaseController
{

    public function login()
    {
        return view('auth/login'); // Carga la vista de login
    }

    public function authenticate()
    {
        $usuarioModel = new UsuarioModel();
        $usernameOrEmail = $this->request->getPost('username_or_email');
        $password = $this->request->getPost('password');

        $usuario = $usuarioModel->getUserByUsernameOrEmail($usernameOrEmail);

        if ($usuario) {
            if (password_verify($password, $usuario['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $usuario['id'],
                    'username' => $usuario['username'],
                    'email' => $usuario['email'],
                    'role' => $usuario['role'],
                    'is_logged_in' => true,
                ]);

                // Redirección dependiendo de si el perfil está completo
                if (!$usuario['is_profile_complete']) {
                    return redirect()->to('/complete-profile');
                }

                // Redirigir basado en el rol
                switch ($usuario['role']) {
                    case 'admin':
                        return redirect()->to('/admin');
                    case 'docente':
                        return redirect()->to('/docente');  // Asegúrate de que esta ruta esté definida
                    case 'estudiante':
                        return redirect()->to('/estudiante');  // Asegúrate de que esta ruta esté definida
                    default:
                        return redirect()->to('/login')->with('error', 'Rol no válido.');
                }
            } else {
                return redirect()->back()->with('error', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->back()->with('error', 'Usuario o email no encontrado');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy(); // Destruir la sesión al cerrar sesión
        return redirect()->to('/login')->with('message', 'Sesión cerrada con éxito');
    }
}