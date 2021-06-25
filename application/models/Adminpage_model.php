<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpage_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();

		$this->table 		= 'pageinfo_admin';
	}


	# TREE
	
	public function tree()
	{
		$parents = $this->getItems(['id_parent' => 0, 'access' => 1], 'num ASC');
		if(empty($parents)) return array();
		
		$tree = array();
		foreach($parents as $parent)
		{
			$parent['items'] = [];
			$tree[$parent['id']] = $parent;
		}
		
		$items = $this->getItems(['id_parent !=' => 0, 'access' => 1], 'num ASC');
		foreach($items as $item)
		{
			if(array_key_exists($item['id_parent'], $tree))
			{
				$tree[$item['id_parent']]['items'][] = $item;
			}
		}
		
		return $tree;
	}
	
	public function counters()
	{
		$return = [
			'feedback' => [
				'count' => $this->db
					->where(['is_read' => 0])
					->count_all_results('feedback'),
				'color' => 'success',
				'icon'	=> fa5r('envelope'),
				'header' => true,
			],
			'reviews' => [
				'count' => $this->db
					->where(['is_read' => 0])
					->count_all_results('reviews'),
				'color' => 'error',
				'icon'	=> fa5r('comment'),
				'header' => true,
			],
		];
		
		return $return;
	}
}
