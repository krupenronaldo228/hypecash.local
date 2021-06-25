<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_products_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'shop_products';
		$this->folder		= 'shop_products';
		$this->page			= 'shop-products';
	}

    private $table_catalog = 'shop_categories';

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

        $return['home'] = !empty($return['home'])
            ? $return['home'] ? 1 : 0
            : 0;

        $return['mod_date'] = date('Y-m-d H:i:s');

        unset($return['date'], $return['time']);


        return $return;
    }



	/*public function post()
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
	}*/
}
