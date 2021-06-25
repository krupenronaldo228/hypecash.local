<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_site_model extends Base_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'users';
		$this->folder		= 'users';
	}
	
	public function getUserByLogin($login)
	{
		return $this->db
			->where('login', $this->input->post('login'))
			->or_where('email', $this->input->post('login'))
			->or_where('phone', $this->input->post('login'))
			->get($this->table)
			->row_array();
	}

	public function logout(){
		delete_cookie('userid');
		delete_cookie('hash');
		$this->session->sess_destroy();
	}
	

	# FILES
	
	public function thumb_size()
	{
		return array(
			'x' => 200,
			'y' => 200,
			'type' => 'thumb',
		);
	}
	

	# HELPERS

	public function post()
	{
		$return = $this->input->post();
	}

	public function post_insert()
	{
		$return = $this->input->post();
		
		$return['password'] = password_hash($return['password'], PASSWORD_DEFAULT);
		$return['hash']	= $this->generate_hash();
		
		unset($return['url'], $return['password_confirm']);
		
		return $return;
	}

	public function post_profile()
	{
		$return = $this->input->post();
		
		unset($return['action']);
		
		return $return;
	}
	
	public function post_password()
	{
		return [
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'hash'	=> $this->generate_hash(),
		];
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
