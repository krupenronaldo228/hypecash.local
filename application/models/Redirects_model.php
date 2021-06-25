<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Redirects_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'redirects';
	}

	# FILTER

	protected function filter()
	{
		$search = $this->input->get('search');
		if($search)
		{
			$this->db
				->group_start()
				->like('url_from', $search)
				->or_like('url_to', $search)
				->group_end();
		}

		return $this;
	}

	
	
	# HELPER
	
	public function post()
	{
		$return = $this->input->post();
		
		return $return;
	}

	public function truncate()
	{
		$this->db->truncate($this->table);
	}

	public function insert_batch($insert)
	{
		if(empty($insert)) return;

		$this->db->insert_batch($this->table, $insert);
	}
}
