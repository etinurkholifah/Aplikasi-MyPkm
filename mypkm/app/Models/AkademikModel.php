<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikModel extends Model
{
    protected $table            = 'tb_akademik';
    protected $primaryKey       = 'id_akademik';
    protected $useAutoIncrement = true;
    protected $allowedFields       = ['id_akademik', 'nip', 'nama', 'email', 'username', 'password', 'role', 'foto'];

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
        if ($user && sha1($password) === $user['password'] && in_array($user['role'], ['KABAG', 'KASUBAG', 'WADIR'])) {
            return $user;
        }
        return null;
    }
}
