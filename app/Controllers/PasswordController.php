<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;

class PasswordController extends BaseController
{
    public function requestReset()
    {
        return view('auth/request_reset');
    }

    public function sendResetLink()
    {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        

        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario) {
            $token = bin2hex(random_bytes(50));
            $usuarioModel->update($usuario['id'], [
                'reset_token' => $token,
                'reset_token_expiration' => date('Y-m-d H:i:s', strtotime('+1 hour'))
            ]);

            $email = \Config\Services::email();
            $email->setFrom('edgardegantea@yahoo.com', 'Sistema de Biblioteca UPN212');
            $email->setTo($usuario['email']);
            $email->setSubject('Restablecimiento de Contraseña');

            $resetLink = base_url("reset-password/$token");

            $email->setMessage("Haz clic en el siguiente enlace para restablecer tu contraseña: <a href=\"$resetLink\">Restablecer Contraseña</a>");

            if ($email->send()) {
                return redirect()->to('/login')->with('message', "Se ha enviado un enlace de restablecimiento a tu correo.");
            } else {
                return redirect()->back()->with('error', 'Error al enviar el correo: ' . $email->printDebugger(['headers']));
            }
        } else {
            return redirect()->back()->with('error', 'Email no encontrado');
        }
    }


    public function resetPassword($token = null)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('reset_token', $token)
                                 ->where('reset_token_expiration >', date('Y-m-d H:i:s'))
                                 ->first();

        if ($usuario) {
            return view('auth/reset_password', ['token' => $token]);
        } else {
            return redirect()->to('/login')->with('error', 'El token es inválido o ha expirado.');
        }
    }

    public function updatePassword()
    {
        $usuarioModel = new UsuarioModel();
        $token = $this->request->getPost('token');
        $password = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);

        $usuario = $usuarioModel->where('reset_token', $token)->first();

        if ($usuario) {
            $usuarioModel->update($usuario['id'], [
                'password' => $password,
                'reset_token' => null,
                'reset_token_expiration' => null
            ]);

            return redirect()->to('/login')->with('message', 'Contraseña restablecida con éxito.');
        } else {
            return redirect()->to('/login')->with('error', 'Error al restablecer la contraseña.');
        }
    }
}