<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'news';
		$this->folder		= 'news';
		$this->page			= 'news';
	}


	# FILTER

	public function filter_admin()
	{
		$search = $this->input->get('search');
		if(!empty($search))
		{
			$this->db
				->group_start()
				->like('title', $search)
				->or_like('meta_title', $search)
				->group_end();
		}

		$visibility = $this->input->get('visibility');
		if(!empty($visibility) && $visibility != 'all')
		{
			switch ($visibility)
			{
				case 'yes':
					$this->db->where('visibility', 1);
					break;
				case 'no':
					$this->db->where('visibility', 0);
					break;
			}
		}

		return $this;
	}
	
	
	# HELPER
	
	public function post()
	{
		$return = $this->input->post();
			
		$date = $return['date'] ?? date('d.m.Y');
		$time = $return['time'] ?? date('H:i');
		$return['pub_date'] = date('Y-m-d H:i:s', strtotime($date.' '.$time));
		
		$return['visibility'] = !empty($return['visibility'])
			? $return['visibility'] ? 1 : 0
			: 0;
			
		$return['mod_date'] = date('Y-m-d H:i:s');
		
		unset($return['date'], $return['time']);
		
		return $return;
	}
}
