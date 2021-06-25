<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends Base_Model {


	# SETTINGS

	public function getSettings()
	{
		$items = $this->db
			->get('settings')
			->result_array();

		return array_column($items, 'value', 'key');
	}


	# PAGE INFO

	public function getPage($page = null)
	{
		if(is_null($page)) return [];

		return $this->db
			->where('alias', $page)
			->get('pageinfo_site')
			->row_array();
	}


	# NAVIGATION

	public function getNavigation($position = 'top')
	{
		$this->table = 'navigation';
		$return = [];

		$parents = $this->db
			->where('id_parent', 0)
			->where('position', $position)
			->where('visibility', 1)
			->order_by('num DESC')
			->get('navigation')
			->result_array();


		if(empty($parents))
			return $return;

		foreach($parents as $parent)
		{
			$current = false;

			$check = trim($parent['link'], '/');
			$check_arr = explode('/', $check);
			if($check_arr[0] != 'about' and $check_arr[0] == uri(1)) $current = true;
			if($check_arr[0] == 'about' and uri(1) == 'about') {
				if(isset($check_arr[1]) and $check_arr[1] == uri(2)) $current = true;
				elseif(!isset($check_arr[1]) and !uri(2)) $current = true;
			}

			$parent['current'] = $current;
			$parent['items'] = [];

			$return[$parent['id']] = $parent;
		}

		$items =

		$parents = $this->db
			->where('id_parent !=', 0)
			->where('position', $position)
			->where('visibility', 1)
			->order_by('num DESC')
			->get('navigation')
			->result_array();

		foreach($items as $item)
		{
			if(!empty($return[$item['id_parent']]))
			{
				$return[$item['id_parent']]['items'][] = $item;
			}
		}

		return $return;
	}


	# NAVIGATION

	public function getNavigationCabinet()
	{
		return [
			[
				'title' => 'Персональная информация',
				'link' => 'cabinet/profile',
				'alias' => 'profile',
				'icon' => fa5s('user-edit fa-fw'),
			],
			[
				'title' => 'Выход',
				'link' => 'login/logout',
				'alias' => 'logout',
				'icon' => fa5s('sign-out-alt fa-fw'),
			],
		];
	}


	# REDIRECTS

	public function getRedirect($params)
	{
		return $this->db
			->get_where('redirects', $params)
			->row_array();
	}



}
