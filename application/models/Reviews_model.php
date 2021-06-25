<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'reviews';
		$this->folder		= 'reviews';
		$this->page			= 'reviews';
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
		
		unset($return['date'], $return['time']);
		
		return $return;
	}
}