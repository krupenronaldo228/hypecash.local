<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_products_front_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'shop_products';
		$this->folder		= 'products';
	}
	
	private $table_catalog = 'shop_categories';
	
	# FRONT
	
	public function getItemsFront($params = [], $order = null, $limit = null, $offset = null)
	{
		$this->setOrder($order);
		
		return $this->db
			->select("{$this->table}.*")
			->select("CONCAT('catalog/', {$this->table_catalog}.alias, '/', {$this->table}.alias) as path")
			->join($this->table_catalog, "{$this->table_catalog}.id = {$this->table}.id_parent")
			->group_by("{$this->table}.id")
			->where("{$this->table}.visibility", 1)
			->where("{$this->table}.display", 1)
			->get_where($this->table, $params, $limit, $offset)
			->result_array();
	}
	
	public function setCurrentsCategories($where = [])
	{
		if(empty($where)) $where[] = 'this text will never be found';
		
		$this->db->where_in("{$this->table}.id_parent", $where);
		
		return $this;
	}
	
	public function setSearch()
	{
		$search = $this->input->get('search');
		
		if(!empty($search))
		{
			$this->db
				->group_start()
				->like("{$this->table}.title", $search)
				->or_like("{$this->table}.code", $search)
				->group_end();
		}
		
		return $this;
	}
	
	public function setFilter()
	{
		
		
		# BRANDS
		
		$brands = $this->input->get('brand');
		if(!empty($brands))
		{
			$this->db->where_in("{$this->table}.id_brand", $brands);
		}
		
		
		# COLORS
		
		$colors = $this->input->get('color');
		if(!empty($colors))
		{
			$this->db->where_in("{$this->table}.color", $colors);
		}
		
		
		# MATERIAL
		
		$materials = $this->input->get('material');
		if(!empty($materials))
		{
			$this->db->where_in("{$this->table}.material", $materials);
		}
		
		
		# PRICE
		
		$price_from = $this->input->get('price_from');
		$price_to = $this->input->get('price_to');
		
		if($price_from != '' || $price_to != '')
		{
			$this->db->group_start();
			
			if($price_from != '')
			{
				$this->db->where("{$this->table}.price >=", $price_from);
			}
			
			if($price_to != '')
			{
				$this->db->where("{$this->table}.price <=", $price_to);
			}
			
			$this->db->group_end();
		}
		
		
		# STICKERS
		
		foreach (['hit', 'new', 'discount'] as $sticker)
		{
			$get_sticker = $this->input->get($sticker);
			if($get_sticker == 1)
			{
				$this->db->where("{$this->table}.sticker_".$sticker, 1);
			}
		}
		
		
		#-------------
		
		return $this;
	}
	
	
	# BY CART
	
	public function getByCart()
	{
		$cart = $this->cart->contents();
		if(empty($cart)) return [];
		
		$products = $this->db
			->select("{$this->table}.id")
			->select("{$this->table}.img")
			->select("{$this->table}.color")
			->select("{$this->table}.material")
			->select("{$this->table}.country")
			->select("{$this->table}.size")
			->select("CONCAT('catalog/', {$this->table_catalog}.alias, '/', {$this->table}.alias) as path")
			->join($this->table_catalog, "{$this->table_catalog}.id = {$this->table}.id_parent")
			->group_by("{$this->table}.id")
			->where_in("{$this->table}.id", array_column($cart, 'id'))
			->get($this->table)
			->result_array();
		
		$products = array_column($products, null, 'id');
		$cart = array_column($cart, null, 'id');
		
		foreach ($cart as $product)
		{
			$cart[$product['id']] = array_merge($product, $products[$product['id']]);
		}
		
		
		return $cart;
		var_dump($cart); die;
	}
	
	
	# FILTERS
	
	public function getPrices()
	{
		$item = $this->db
			->select('MIN(price) as min, MAX(price) as max')
			->where('display', 1)
			->where('visibility', 1)
			->get($this->table)
			->row_array();
		
		$item['get_min'] = intval($_GET['price_from'] ?? floor($item['min']));
		$item['get_max'] = intval($_GET['price_to'] ?? ceil($item['max']));
		
		
		return $item;
		var_dump($item); die;
	}
	
	public function getMaterials()
	{
		$items = $this->db
			->select('material')
			->distinct('material')
			->where('visibility', 1)
			->where('material !=', '')
			->get($this->table)
			->result_array();
		
		return array_column($items, 'material');
		var_dump($items); die;
	}
	
	public function getColors()
	{
		$items = $this->db
			->select('color')
			->distinct('color')
			->where('visibility', 1)
			->where('color !=', '')
			->get($this->table)
			->result_array();
		
		return array_column($items, 'color');
		var_dump($items); die;
	}
	
	
	
	# ARRIVALS
	
	private $arrivals_parents = [];
	
	public function getArrivalsByTree($tree)
	{
		$data = [];
		
		foreach ($tree as $parent)
		{
			$id = $parent['id'];
			$this->arrivals_parents[$id][] = $id;
			
			if(!empty($parent['items']))
			{
				$this->getArrivalsParents($id, $parent['items']);
			}
			
			$this->db->where_in("{$this->table}.id_parent", $this->arrivals_parents[$id]);
			$products = $this->getItemsFront(['sticker_new' => 1], 'num DESC', 8);
			
			if(!empty($products))
			{
				$data[$parent['id']] = [
					'id' => $parent['id'],
					'name' => $parent['name'],
					'alias' => $parent['alias'],
					'products' => $products,
				];
			}
		}
		
		
		return $data;
		var_dump($data);
		die;
	}
	
	private function getArrivalsParents($id, $categories)
	{
		foreach ($categories as $category)
		{
			$this->arrivals_parents[$id][] = $category['id'];
			
			if(!empty($category['items']))
			{
				$this->getArrivalsParents($id, $category['items']);
			}
		}
	}
	
}
