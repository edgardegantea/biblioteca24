<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Security\PasswordHash;

class UsuarioModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['role', 'matricula', 'nombre', 'apaterno', 'amaterno', 'telefono', 'email', 'username', 'password', 'reset_token', 'reset_token_expiration', 'active', 'is_profile_complete'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserByUsernameOrEmail($usernameOrEmail)
    {
        return $this->where('username', $usernameOrEmail)
                    ->orWhere('email', $usernameOrEmail)
                    ->first();
    }

}
