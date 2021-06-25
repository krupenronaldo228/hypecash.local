<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends Base_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'slider';
		$this->folder		= 'slider';
	}
	
	
	# LOAD
	
	public function file_multiload($keys = [])
	{
		$return = [];
		$error = false;
		
		foreach($keys as $key)
		{
			$filename = null;
			
			if(!empty($_FILES[$key]['name']))
			{
				$this->load->helper('file');
				
				if($this->upload->do_upload($key))
				{
					$file = $this->upload->data();
					$filename = $file['file_name'];
					
					$this->thumb_create($key, $filename);
					
				} else {
					
					$error .= '<div class="mt10">' . fa5s('exclamation-triangle fa-fw mr5').' Ошибка загрузки изображения <strong>'.$_FILES[$key]['name'].'</strong></div>';
				
				}
			}
			
			if(!empty($filename))
				$return[$key] = $filename;
		}
		
		if($error)
			$error .=  '<ul class="note-list">'.$this->upload->display_errors('<li>', '</li>').'</ul>';
		
		$return['error'] = $error;
		
		return $return;
	}
	
	
	# HELPER
	
	public function post()
	{
		$return = $this->input->post();
		
		$return['visibility'] = !empty($return['visibility'])
			? $return['visibility'] ? 1 : 0
			: 0;
		
		$return['show_text'] = !empty($return['show_text'])
			? $return['show_text'] ? 1 : 0
			: 0;
			
		return $return;
	}
	
	public function aligns()
	{
		return [
			'left'		=> 'По левому краю',
			'center'	=> 'По центру',
			'right'		=> 'По правому краю',
		];
	}
	
	
	# IMAGE
	
	const IMG_MAIN = 'img';
	const IMG_MOBILE = 'mobile';
	
	public function thumb_size($name = null)
	{
		$return = [
			self::IMG_MAIN => [
				'name'	=> self::IMG_MAIN,
				'title'	=> 'Основное изображение',
				'x'		=> 1920,
				'y'		=> 450,
				'type'	=> 'thumb',
			],
			self::IMG_MOBILE => [
				'name'	=> self::IMG_MOBILE,
				'title'	=> 'Мобильное изображение',
				'x'		=> 500,
				'y'		=> 400,
				'type'	=> 'thumb',
			],
		];
		
		if($name) return $return[$name];
		return $return;
	}
}