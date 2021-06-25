<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends Base_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'settings';
		$this->folder		= 'settings';
		$this->siteparam 	= ['id' => 1];
	}
	
	public function siteinfo()
	{
		$items = $this->getItems();

		return array_column($items, 'value', 'key');
	}
	
	public function siteinfo_update($data)
	{
		$insert = [];

		foreach ($data as $key => $value)
		{
			$insert[] = [
				'key' => $key,
				'value' => $value,
			];
		}

		return $this->db->update_batch($this->table, $insert, 'key');
	}
	
	
	# HELPER
	
	public function post_main()
	{
		$return = $this->input->post();
		
		$return['enable'] = !empty($return['enable'])
			? $return['enable'] ? 1 : 0
			: 0;
		
		return $return;
	}

	public function post_template()
	{
		$return = $this->input->post();

		return $return;
	}
	
	
	# CACHE
	
	public function cache()
	{
		$key = 'template_version';

		$item = $this->getItem('key', $key);
		$version = floatval($item['value']) + 0.1;

		$this->update(['value' => $version], ['key' => $key]);

		return;
	}


	# FAVICON

	public function favicon($site_name)
	{
		$name = 'favicon.png';
		$path_images = './'.PATH_SITE.'/img/';
		$path_favicon = $path_images.'favicon';
		$key = 'favicon';

		if(empty($_FILES[$key]['name'])) return;

		$this->load->helper('file');

		if($this->upload->do_upload($key))
		{
			# create folder
			if(!is_dir($path_favicon))
				mkdir($path_favicon, 0755, true);


			# rename to favicon
			$file = $this->upload->data();
			$filename = $file['file_name'];

			rename($path_images.$filename, $path_favicon.'/'.$name);


			# create ico
			require( APPPATH.'/libraries/PHP_ICO.php' );

			$source = $path_favicon.'/'.$name;
			$destination = './favicon.ico';

			$ico_lib = new PHP_ICO( $source, [[16, 16]] );
			$ico_lib->save_ico( $destination );


			# create variables of favicon
			$this->load->library('SimpleImage');
			$sizes = $this->favicon_sizes();
			foreach ($sizes as $size => $size_name)
			{
				$this->simpleimage
					->fromFile($path_favicon.'/'.$name)
					->bestFit($size, $size)
					->toFile($path_favicon.'/'.$size_name);
			}

			$this->favicon_manifest($site_name);

			$this->cache();

		}
		else {

			throw new Exception(fa5s('exclamation-triangle fa-fw mr5').' Ошибка загрузки изображения <strong>'.$_FILES[$key]['name'].'</strong>' .
				'<ul class="note-list">'.$this->upload->display_errors('<li>', '</li>').'</ul>');

		}
	}

	private function favicon_sizes()
	{
		return [
			'57' => 'apple-touch-icon-57x57.png',
			'60' => 'apple-touch-icon-60x60.png',
			'72' => 'apple-touch-icon-72x72.png',
			'76' => 'apple-touch-icon-76x76.png',
			'114' => 'apple-touch-icon-114x114.png',
			'120' => 'apple-touch-icon-120x120.png',
			'144' => 'apple-touch-icon-144x144.png',
			'152' => 'apple-touch-icon-152x152.png',
			'180' => 'apple-touch-icon-180x180.png',
			'32' => 'favicon-32x32.png',
			'192' => 'android-chrome-192x192.png',
			'96' => 'favicon-96x96.png',
			'16' => 'favicon-16x16.png',
		];
	}

	private function favicon_manifest($site_name)
	{
		$manifest = '{
	"name": "' . $site_name. '",
	"icons": [
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-36x36.png",
			"sizes": "36x36",
			"type": "image\/png",
			"density": 0.75
		},
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-48x48.png",
			"sizes": "48x48",
			"type": "image\/png",
			"density": 1
		},
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-72x72.png",
			"sizes": "72x72",
			"type": "image\/png",
			"density": 1.5
		},
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-96x96.png",
			"sizes": "96x96",
			"type": "image\/png",
			"density": 2
		},
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-144x144.png",
			"sizes": "144x144",
			"type": "image\/png",
			"density": 3
		},
		{
			"src": "\/assets\/site\/img\/favicon\/android-chrome-192x192.png",
			"sizes": "192x192",
			"type": "image\/png",
			"density": 4
		}
	]
}';

		file_put_contents('./'.PATH_SITE.'/img/favicon/manifest.json', $manifest);
	}


	# OPEN GRAPH IMAGE

	public function og_image()
	{
		$key = 'og_image';
		$name = 'og_image.jpg';
		$path_images = './'.PATH_SITE.'/img/';

		if(!empty($_FILES[$key]['name']))
		{
			$this->load->helper('file');

			if($this->upload->do_upload($key))
			{
				$file = $this->upload->data();
				$filename = $file['file_name'];

				rename($path_images.$filename, $path_images.'/'.$name);

				$this->load->library('SimpleImage');
				$this->simpleimage
					->fromFile($path_images.'/'.$name)
					->bestFit(1200, 630)
					->toFile($path_images.'/'.$name);

			}
			else {

				throw new Exception(fa5s('exclamation-triangle fa-fw mr5').' Ошибка загрузки изображения <strong>'.$_FILES[$key]['name'].'</strong>' .
					'<ul class="note-list">'.$this->upload->display_errors('<li>', '</li>').'</ul>');

			}
		}
	}

}
