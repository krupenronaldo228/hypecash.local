<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Breadcrumbs {

	protected $segments = [];
	protected $breadcrumbs = '';
	
	public function create_links($wrapper = false)
	{
		$uri = $this->segments;
		
		$sep = '<span class="breadcrumbs-sep">'.fa5s('angle-right').'</span>';		
		$breadcrumbs = '<div class="breadcrumbs">';
		if($wrapper) $breadcrumbs .= '<div class="wrapper">';		
		$breadcrumbs .= '<div class="breadcrumbs-in">';
		$breadcrumbs .= '<a href="'.base_url().'">Главная</a> ';
		
		$count = count($uri);
		$i = 1;
		foreach($uri as $k => $v)
		{
			$breadcrumbs .= $sep;
			if($i != $count) $breadcrumbs .= ' <a href="'.base_url($k).'">'.$v.'</a> ';
			else $breadcrumbs .= ' <span>'.$v.'</span> ';
				
			$i++;
		}
		
		$breadcrumbs .= '</div>';
		if($wrapper) $breadcrumbs .= '</div>';
		$breadcrumbs .= '</div>';
		
		return $breadcrumbs;
	}
	
	public function create_admin_links()
	{
		$uri = array_merge(['home' => fa5s('home')], $this->segments);
		
		$sep = '<span class="breadcrumbs-sep">/</span>';
		$breadcrumbs = '<div class="breadcrumbs">';
		
		
		$count = count($uri);
		$i = 1;
		foreach($uri as $k => $v)
		{
			if($i != $count)
			{
				$breadcrumbs .= ' <a href="/admin/'.ltrim($k, '/').'">'.$v.'</a> ';
				$breadcrumbs .= $sep;
				
			} else {
				$breadcrumbs .= ' <span>'.$v.'</span> ';
			}
			
			$i++;
		}
		
		$breadcrumbs .= '</div>';
		
		return $breadcrumbs;
	}
	
	public function add($title, $link = '')
	{
		$this->segments[$link] = $title;

		return $this;
	}
}
