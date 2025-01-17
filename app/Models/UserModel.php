<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'nip_nuptk', 'photo', 'created_at'];

    public function getAllGurus()
    {
        return $this->where('role', 'guru')->findAll();
    }
}
