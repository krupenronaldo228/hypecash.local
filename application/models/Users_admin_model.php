<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_admin_model extends Base_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'users';
		$this->folder		= 'users';
	}

	public function logout(){
		delete_cookie('adminid');
		delete_cookie('adminhash');
		$this->session->sess_destroy();
	}
	

	# ACCESS
	
	public function getAccess($key = null)
	{
		$return = [
			ACCESS_USER => [
				'title'		=> 'Пользователь',
				'access'	=> ACCESS_USER,
				'label'		=> 'warning',
			],
			ACCESS_ADMIN => [
				'title'		=> 'Администратор',
				'access'	=> ACCESS_ADMIN,
				'label'		=> 'success',
			],
		];
		
		if($key) return $return[$key];
		
		return $return;
	}
	
	public function getAccessList()
	{
		return [
			ACCESS_USER		=> 'Пользователь',
			ACCESS_ADMIN	=> 'Администратор',
		];
	}
	
	

	# HELPERS

	public function post()
	{
		return $this->input->post();
	}

	public function post_insert()
	{
		$return = $this->input->post();
		
		$return['password'] = password_hash($return['password'], PASSWORD_DEFAULT);
		$return['hash']	= $this->generate_hash();
		
		return $return;
	}
	
	public function post_password()
	{
		return [
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'hash'	=> $this->generate_hash(),
		];
	}

	public function time_period()
	{
		$time = array(
			1 => 'доброй ночи',
			2 => 'доброго утра',
			3 => 'хорошего дня',
			4 => 'приятного вечера',
		);
		$h = date('H');
		$h = ltrim($h, '0');
		$id = 2;
		if($h >= 23 or $h < 5) $id = 1;
		elseif($h >= 5 and $h < 11) $id = 2;
		elseif($h >= 11 and $h < 20) $id = 3;
		elseif($h >= 20) $id = 4;
		return $time[$id];
	}
	
	public function generate_password($length = 8)
	{
		return substr(md5(uniqid(mt_rand())), 0, $length);
	}
	
	public function generate_hash()
	{
		return md5(uniqid(mt_rand()));
	}
}
