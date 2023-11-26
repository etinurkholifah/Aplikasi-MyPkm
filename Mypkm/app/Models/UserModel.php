<?php namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
      protected $table             ='users';
      protected $primaryKey        ='user_id';
      protected $useAutoIncrement  = true;
      protected $allowedFields     = ['user_npm', 'user_email', 'user_password'];

	public function get_data($npm, $password)
	{
      return $this->db->table('users')
      ->where(array('user_npm' => $npm, 'user_password' => $password))
      ->get()->getRowArray();
	}
      
}