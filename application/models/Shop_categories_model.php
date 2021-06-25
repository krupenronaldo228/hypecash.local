<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_categories_model extends Base_Model {

    public function __construct()
    {
        parent::__construct();

        $this->table 		= 'shop_categories';
        $this->folder		= 'shop_categories';
    }

    protected $table_products = 'shop_products';

    # CREATE TREE

    protected 	$current_child = [];

    public function getItemsTree($params = [], $order = false, $current = false)
    {
        $return = [
            'tree'				=> [],
            'current'			=> $current,
            'upline' 			=> [],
            'breadcrumbs' 		=> [],
            'current_child'	=> [],
        ];

        $tree = [];
        $categories = [];
        $relations = [];
        $upline = [];
        $breadcrumbs = [];

        $items = array_column($this->getItems($params, $order), null, 'id');

        // Делаем индексированный список и отношения
        foreach ($items as $item)
        {
            $categories[$item['id']] = $item;
            $categories[$item['id']]['toggle'] = 'static';
            $categories[$item['id']]['level'] = 1;
            $categories[$item['id']]['items'] = [];

            $relations[$item['id']] = $item['id_parent'];
        }

        if ($current)
        {
            // Составляем хлебные крошки

            $upline[] = $current;
            $_b_parent = $current;
            while ($_b_parent != 0) {
                $_new_parent = $relations[$_b_parent];
                if ($_new_parent != 0) $upline[] = intval($_new_parent);
                $_b_parent = $_new_parent;
            }

            asort($upline);

            foreach ($categories as $key => $item)
            {
                if ($item['id'] == $current) $categories[$key]['toggle'] = 'current';
                elseif (in_array($item['id'], $upline)) $categories[$key]['toggle'] = 'open';
            }
        }

        foreach ($categories as $id => &$node)
        {
            $idParent = $categories[$id]['id_parent'];


            //Если нет вложений
            if (!$node['id_parent']) {
                $tree[$id] = &$node;
            }
            else {
                //Если есть потомки то перебираем массив
                $categories[$node['id_parent']]['items'][$id] = &$node;
            }
        }

        foreach ($tree as $key => $_tree)
        {
            $tree[$key] = $this->_add_level($_tree, 1);
        }


        foreach ($upline as $_upline)
        {
            $breadcrumbs[$_upline]['title'] = $items[$_upline]['name'];
            $breadcrumbs[$_upline]['alias'] = $items[$_upline]['alias'];
        }

        $return['breadcrumbs'] = $breadcrumbs;

        $return['tree'] = $tree;
        $return['current_child'] = $this->current_child;

        return $return;

        var_dump($return);
        die;
    }

    protected function _add_level($item, $level, $current = false)
    {
        $item['level'] = $level++;

        if ($item['toggle'] == 'current') {
            $this->current_child[$item['id']] = $item['id'];
            $current = true;
        }

        if (isset($item['items'])) {
            foreach ($item['items'] as $key => $child) {

                if($current)
                {
                    $this->current_child[$child['id']] = $child['id'];
                }

                $item['items'][$key] = $this->_add_level($child, $level, $current);
            }
        }

        return $item;
    }

    # GET ADMIN TREE

    public function getTreeAdmin()
    {
        $tree = [];

        $query = $this->getItems([], 'num DESC');
        if (empty($query)) return $tree;

        $items = array_column($query, null, 'id');

        foreach ($items as $id => &$node)
        {
            if (!$node['id_parent']) {
                $tree[$id] = &$node;

            }
            else {
                //Если есть потомки то перебираем массив
                $items[$node['id_parent']]['items'][$id] = &$node;
            }
        }

        return $tree;

        var_dump($tree);
        die;
    }


    # HELPER

    public function post()
    {
        $return = $this->input->post();

        $return['visibility'] = !empty($return['visibility'])
            ? $return['visibility'] ? 1 : 0
            : 0;

        $return['home'] = !empty($return['home'])
            ? $return['home'] ? 1 : 0
            : 0;

        $return['mod_date'] = date('Y-m-d H:i:s');

        return $return;
    }


    # UPDATE DISPLAY

    protected $hidden_categories = [];

    public function updateDisplay()
    {
        $tree = $this->getTreeAdmin();

        foreach($tree as $item)
        {
            $this->check_display($item, 1);
        }

        $this->db->update($this->table, ['display' => 1]);
        $this->db->update($this->table_products, ['display' => 1]);

        if(!empty($this->hidden_categories))
        {
            $this->db->where_in('id', $this->hidden_categories);
            $this->db->update($this->table, ['display' => 0]);

            $this->db->where_in('id_parent', $this->hidden_categories);
            $this->db->update($this->table_products, ['display' => 0]);
        }
    }

    protected function check_display($item, $display)
    {
        if($display == 1 and $item['visibility'] == 0)
        {
            $display = 0;
        }

        if($display == 0)
        {
            $this->hidden_categories[] = $item['id'];
        }

        if(!empty($item['items']))
        {
            foreach($item['items'] as $child)
            {
                $this->check_display($child, $display);
            }
        }
    }


    # IMAGES

    public function thumb_size()
    {
        return [
            'x' => 350,
            'y' => 300,
            'type' => 'thumb'
        ];
    }
}
