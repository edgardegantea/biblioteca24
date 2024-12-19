<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Security\PasswordHash;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['rol', 'nombre', 'apaterno', 'amaterno', 'telefono', 'email', 'username', 'password', 'reset_token', 'reset_token_expires', 'active'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getRoles()
    {
        $builder = $this->db->table('users');
        $builder->select('rol');
        $builder->distinct();
        $query = $builder->get();
        return $query->getResultArray();
    }

}
