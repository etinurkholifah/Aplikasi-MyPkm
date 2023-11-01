<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table        = 'user';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['user_name', 'user_pass'];

	public function get_data($npm, $password)
	{
      return $this->db->table('user')
      ->where(array('user_name' => $npm, 'user_pass' => $password))
      ->get()->getRowArray();
	}

}
