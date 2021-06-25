<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_brands_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'shop_brands';
		$this->folder		= 'brands';
	}
	
	private $table_products = 'shop_products';
	
	# FRONT
	
	public function getItemsByCategory($categories = [])
	{
		if(empty($categories))
			return [];
		
		$items = $this->db
			->select("{$this->table}.id")
			->select("{$this->table}.name")
			->join($this->table_products, "{$this->table}.id = {$this->table_products}.id_brand")
			->where_in("{$this->table_products}.id_parent", $categories)
			->where("{$this->table_products}.visibility", 1)
			->where("{$this->table_products}.display", 1)
			->order_by("{$this->table}.name ASC")
			->group_by("{$this->table}.id")
			->get($this->table)
			->result_array();
		
		return $items;
		var_dump($items);  die;
	}


	# FILTER

	public function filter_admin()
	{
		$search = $this->input->get('search');
		if(!empty($search))
		{
			$this->db
				->group_start()
				->like('name', $search)
				->or_like('title', $search)
				->or_like('meta_title', $search)
				->group_end();
		}

		return $this;
	}
	
	
	# HELPER
	
	public function post()
	{
		$return = $this->input->post();
		
		$return['home'] = !empty($return['home'])
			? $return['home'] ? 1 : 0
			: 0;
		
		$return['mod_date'] = date('Y-m-d H:i:s');
		
		return $return;
	}
	
	public function thumb_size()
	{
		return [
			'x' => 300,
			'y' => 200,
			'type' => 'best_fit',
		];
	}
}
