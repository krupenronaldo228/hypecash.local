<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Sitemap_model
 * @property CI_DB_query_builder db
 */

class Sitemap_model extends CI_Model {
	
	protected $pages = [];
	
	public function generate()
	{
		$this->sitemap_pages();
		
		$file_name = 'sitemap.xml';
		
		$dom = new domDocument("1.0", "utf-8");
		$tagRoot = $dom->createElement('urlset');
		$tagRoot->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
		
		foreach($this->pages as $page)
		{
			$tagUrl = $dom->createElement('url');
			foreach($page as $value => $label)
			{
				$tagUrlItem = $dom->createElement($value, $label);
				$tagUrl->appendChild($tagUrlItem);
			}
			$tagRoot->appendChild($tagUrl);
		}
		
		$dom->appendChild($tagRoot);
		
		$dom->save($file_name);
		
		redirect('/sitemap.xml');
		
		var_dump($this->pages); die;
	}
	
	protected function sitemap_pages() 
	{
		$pages = [
			[
				'alias' => '',
				'home'	=> true,
				'table' => null,
				'condition' => [],
			],
			[
				'alias' => 'news',
				'home'	=> true,
				'table' => 'news',
				'condition' => ['visibility' => 1],
			],
			[
				'alias' => 'articles',
				'home'	=> true,
				'table' => 'articles',
				'condition' => ['visibility' => 1],
			],
			[
				'alias' => 'about',
				'home'	=> true,
				'table' => 'pages',
				'condition' => ['visibility' => 1],
			],
			[
				'alias' => 'reviews',
				'home'	=> true,
				'table' => null,
				'condition' => [],
			],
			[
				'alias' => 'contacts',
				'home'	=> true,
				'table' => null,
				'condition' => [],
			],
		];

		foreach($pages as $page)
		{
			if($page['home'])
			{
				$this->pages[] = [
					'loc' => base_url($page['alias']),
					'lastmod' => date('Y-m-d\TH:i:sP'),
					'priority' => 1,
				];
			}
			if($page['table'])
			{
				$items = $this->db->get_where($page['table'], $page['condition'])->result_array();
				foreach($items as $item)
				{
					$this->pages[] = [
						'loc' => base_url($page['alias'].'/'.$item['alias']),
						'lastmod' => !empty($item['mod_date'])
							? date('Y-m-d\TH:i:sP', strtotime($item['mod_date']))
							: date('Y-m-d\TH:i:sP'),
						'priority' => 0.8,
					];
				}
			}
		}
	}
}