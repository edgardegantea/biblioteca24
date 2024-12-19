<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuarioModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends ResourceController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    // Lista todos los usuarios
    public function index()
    {
        $data['usuarios'] = $this->usuarioModel->findAll();
        return view('admin/usuarios/index', $data);
    }

    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        return view('admin/usuarios/create');
    }

    // Guarda un nuevo usuario en la base de datos
    public function store()
    {
        $data = $this->request->getPost();

        // Validación
        if (!$this->validate([
            'role' => 'required',
            'matricula' => 'required|is_unique[users.matricula]',
            'nombre' => 'required|min_length[3]',
            'apaterno' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'telefono' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Hash de la contraseña y configuración de campos adicionales
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['reset_token'] = null;
        $data['reset_token_expiration'] = null;
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['is_profile_complete'] = isset($data['is_profile_complete']) ? 1 : 0;

        $this->usuarioModel->save($data);
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario creado exitosamente.');
    }


    public function show($id = null)
    {
        $user = $this->usuarioModel->find($id);

        if (!$user) {
            throw new PageNotFoundException('Usuario no encontrado');
        }

        $data['user'] = $user;
        return view('admin/usuarios/show', $data);
    }

    // Muestra el formulario para editar un usuario existente
    public function edit($id = null)
    {
        $user = $this->usuarioModel->find($id);

        if (!$user) {
            throw new PageNotFoundException('Usuario no encontrado');
        }

        $data['user'] = $user;
        return view('admin/usuarios/edit', $data);
    }

    // Actualiza los datos de un usuario existente en la base de datos
    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Reglas de validación
        $rules = [
            'role' => 'required',
            'matricula' => "required|is_unique[users.matricula,id,{$id}]",
            'nombre' => 'required|min_length[3]',
            'apaterno' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'username' => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'telefono' => 'required|min_length[10]'
        ];

        // Validación y hash de la contraseña solo si se proporciona
        if (!empty($data['password'])) {
            $rules['password'] = 'min_length[8]';
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Campos adicionales
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['is_profile_complete'] = isset($data['is_profile_complete']) ? 1 : 0;

        $this->usuarioModel->update($id, $data);
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Elimina un usuario específico de la base de datos
    public function delete($id = null)
    {
        if (!$this->usuarioModel->find($id)) {
            throw new PageNotFoundException('Usuario no encontrado');
        }

        $this->usuarioModel->delete($id);
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario eliminado exitosamente.');
    }



    public function register()
    {
        return view('admin/usuarios/register');
    }


    public function storeRegister()
    {
        $data = $this->request->getPost();

        if (!$this->validate([
            'matricula' => 'required|is_unique[users.matricula]',
            'nombre' => 'required|min_length[3]',
            'apaterno' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'telefono' => 'required|min_length[10]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data['role'] = 'externo';
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['reset_token'] = null;
        $data['reset_token_expiration'] = null;
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['is_profile_complete'] = isset($data['is_profile_complete']) ? 1 : 0;

        $this->usuarioModel->save($data);
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario creado exitosamente.');
    }
}
