<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'social';
	}

	# HELPER

	public function post()
	{
		$return = $this->input->post();

		$return['visibility'] = !empty($return['visibility'])
			? $return['visibility'] ? 1 : 0
			: 0;

		return $return;
	}


	# FRONT

	public function getFront($params = [], $order = 'num DESC')
	{
		$return = [];

		$items = parent::getItems($params, $order);
		if(empty($items)) return $return;

		$data = self::getKeys();

		foreach ($items as $item)
		{
			$social = $data[$item['key']];
			$item['title'] = $social['title'];
			$item['icon'] = $social['icon'];

			$return[] = $item;
		}

		return $return;
	}



	# LIST

	public function getKeys($key = null)
	{
		$data = [
			[
				'key' => 'vk',
				'title' => 'Вконтакте',
				'icon' => 'fab fa-vk'
			],
			[
				'key' => 'facebook',
				'title' => 'Facebook',
				'icon' => 'fab fa-facebook-f'
			],
			[
				'key' => 'twitter',
				'title' => 'Twitter',
				'icon' => 'fab fa-twitter'
			],
			[
				'key' => 'instagram',
				'title' => 'Instagram',
				'icon' => 'fab fa-instagram'
			],
			[
				'key' => 'ok',
				'title' => 'Одноклассники',
				'icon' => 'fab fa-odnoklassniki'
			],
			[
				'key' => 'mailru',
				'title' => 'Mail.ru',
				'icon' => 'fas fa-at'
			],
			[
				'key' => 'linkedin',
				'title' => 'LinkedIn',
				'icon' => 'fab fa-linkedin-in'
			],
			[
				'key' => 'whatsapp',
				'title' => 'Whatsapp',
				'icon' => 'fab fa-whatsapp'
			],
			[
				'key' => 'viber',
				'title' => 'Viber',
				'icon' => 'fab fa-viber'
			],
			[
				'key' => 'telegram',
				'title' => 'Telegram',
				'icon' => 'fab fa-telegram-plane'
			],
			[
				'key' => 'youtube',
				'title' => 'Youtube',
				'icon' => 'fab fa-youtube'
			],
		];

		$data = array_column($data, null, 'key');

		if(is_null($key))
			return $data;

		return $data[$key];
	}
}
