<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pageinfo_model extends Base_Model {

	public function __construct()
	{
		parent::__construct();
		
		$this->table 		= 'pageinfo_site';
	}
	
	
	# HELPER
	
	public function post()
	{
		return $this->input->post();
	}
	
	
	# THUMB RESIZE
	
	public function thumbResize($folder, $size_x, $size_y, $type)
	{
		$folderPath = 'assets/uploads/'.$folder;
		$thumbPath = $folderPath.'/thumb';
		$thumbExt = array('gif', 'jpg', 'png', 'jpeg', 'bmp');
		
		set_time_limit(0);
		ini_set("memory_limit", "256M");
		
		if(is_dir('./'.$folderPath))
		{
			$filesList = glob('./'.$folderPath.'/*.*');
			$files = array();
			
			foreach($filesList as $file)
			{
				$fileDotArr = explode('.', $file);
				$fileExt = $fileDotArr[count($fileDotArr) - 1];
				if(in_array($fileExt, $thumbExt)) $files[] = str_replace('./'.$folderPath.'/', '', $file);
			}
			
			if(!empty($files) and is_dir('./'.$thumbPath))
			{
				$this->load->library('SimpleImage');
				foreach($files as $file)
				{
					if($type == 'thumb') {
						$this->simpleimage->load($folderPath . '/' . $file)
							->thumbnail($size_x, $size_y)
							->save($thumbPath . '/' . $file, 90);
					}elseif($type='best_fit'){
						$this->simpleimage->load($folderPath . '/' . $file)
							->best_fit($size_x, $size_y)
							->save($thumbPath . '/' . $file, 90);
					}
				}
			}
			return true;
		}
		return false;
	}
}
