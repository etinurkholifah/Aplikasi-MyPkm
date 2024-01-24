<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    protected $table            = 'tb_admin';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;
    protected $allowedFields       = ['id_admin', 'nama', 'username', 'password', 'status', 'foto'];

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

    public function authenticate($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && $user['password'] === sha1($password)) {
            return $user;
        }
        return null;
    }
}
