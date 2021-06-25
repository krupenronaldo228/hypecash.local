<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| SESSION HELPERS
|--------------------------------------------------------------------------
*/

if ( ! function_exists('set_flash'))
{
	function set_flash($key, $value = '')
	{
		$CI =& get_instance();		
		return $CI->session->set_flashdata($key, $value);
	}
}


/*
|--------------------------------------------------------------------------
| COOKIE HELPERS
|--------------------------------------------------------------------------
*/
if ( ! function_exists('init_cookie'))
{
    function init_cookie($name, $value = null)
    {
        $cookie = array(
            'expire'	=> 2592000,
			'path'		=> '/',
        );
		
		if(!is_array($name))
		{
			$cookie['name'] = $name;
			$cookie['value'] = $value;
		} else {
			foreach($name as $k => $v)
				$cookie[$k] = $v;
		}
		
		return $cookie;
    }
}


/*
|--------------------------------------------------------------------------
| URL HELPERS
|--------------------------------------------------------------------------
*/
if ( ! function_exists('uri'))
{
	function uri($num)
	{
		$CI =& get_instance();		
		return $CI->uri->segment($num);
	}
}


/*
|--------------------------------------------------------------------------
| FILES HELPERS
|--------------------------------------------------------------------------
*/
if ( ! function_exists('check_img'))
{
	function check_img($src, $attr = array(), $nophoto = 'default.png', $only_url = false)
	{
		if(file_exists('./'.$src) and $src != "" and !is_dir('./'.$src)) {
			if(!empty($attr))
			{
				$attr['src'] = $src;
				return !$only_url ? img($attr) : base_url($src);
			}
			
			return !$only_url ? img($src) : base_url($src);
		}
		
		if($nophoto)
		{
			$np = $nophoto != '' ? $nophoto : '300x200.png';
			$attr['src'] = 'assets/uploads/nophoto/'.$np;
			
			return !$only_url ? img($attr) : base_url('assets/site/img/no-photo/'.$np);
		}
		
		return '';
	}
}

if ( ! function_exists('deletefile'))
{
	function deletefile($src)
	{
		if(!is_array($src)) $src[] = $src;
		
		foreach($src as $path)
		{
			if(file_exists('.'.$path) and !is_dir('.'.$path)) unlink('.'.$path);
		}
		return true;
	}
}


/*
|--------------------------------------------------------------------------
| PAGINATION HELPERS
|--------------------------------------------------------------------------
*/
if ( ! function_exists('admin_pagination'))
{
	function admin_pagination($base_url, $total, $per_page = 10, $uri_segment = 4)
	{
		$return = array(
			'base_url'		=> '/admin/'.trim($base_url, '/').'/',
			'total_rows'	=> $total,
			'uri_segment'	=> $uri_segment,
			'per_page'		=> $per_page,
			'use_page_numbers' => true,
			
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'num_tag_open'	=> '<li class="pagination-num">',
			'num_tag_close'	=> '</li>',
			'cur_tag_open'	=> '<li class="pagination-num"><a href="javascript:void(0)" class="pagination-current">',
			'cur_tag_close'	=> '</a></li>',
			
			'first_tag_open'	=> '<li class="pagination-nav pagination-left pagination-first">',
			'first_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li class="pagination-nav pagination-right pagination-last">',
			'last_tag_close'	=> '</li>',
			'next_tag_open'		=> '<li class="pagination-nav pagination-right pagination-next">',
			'next_tag_close'	=> '</li>',
			'prev_tag_open'		=> '<li class="pagination-nav pagination-left pagination-prev">',
			'prev_tag_close'	=> '</li>',
			
			'first_link'	=> fa5s('angle-double-left'),
			'last_link'		=> fa5s('angle-double-right'),
			'prev_link'		=> fa5s('angle-left'),
			'next_link'		=> fa5s('angle-right'),
		);
		
		$return['offset'] = (uri($uri_segment) * $return['per_page']) - $return['per_page'];
		if($return['offset'] < 0) $return['offset'] = 0;
		
		if (count($_GET) > 0)
		{
			$return['suffix'] = '?' . http_build_query($_GET, '', "&");
			$return['first_url'] = $return['base_url'] . $return['suffix'];
		}
		
		return $return;
	}
}

if ( ! function_exists('site_pagination'))
{
	function site_pagination($base_url, $total, $per_page = 10, $uri_segment = 2)
	{
		$return = array(
			'base_url'		=> '/'.trim($base_url, '/').'/',
			'total_rows'	=> $total,
			'uri_segment'	=> $uri_segment,
			'per_page'		=> $per_page,
			'use_page_numbers' => true,
			
			'full_tag_open' => ' <ul class="pagination">',
			'full_tag_close' => '</ul>',
			'num_tag_open'	=> '<li class="pagination-num">',
			'num_tag_close'	=> '</li>',
			'cur_tag_open'	=> '<li class="pagination-num pagination-active"><a href="javascript:void(0)">',
			'cur_tag_close'	=> '</a></li>',
			
			'first_tag_open'	=> '<li class="pagination-nav pagination-left pagination-first">',
			'first_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li class="pagination-nav pagination-right pagination-last">',
			'last_tag_close'	=> '</li>',
			'next_tag_open'		=> '<li class="pagination-nav pagination-right pagination-next">',
			'next_tag_close'	=> '</li>',
			'prev_tag_open'		=> '<li class="pagination-nav pagination-left pagination-prev">',
			'prev_tag_close'	=> '</li>',
			
			'first_link'	=> fa5s('arrow-left') . ' <span>В начало</span>',
			'last_link'		=> '<span>В конец</span> ' . fa5s('arrow-right'),
			'prev_link'		=> fa5s('arrow-left') . ' <span>Предыдущая</span>',
			'next_link'		=> '<span>Следующая</span> ' . fa5s('arrow-right'),
		);
		
		$return['offset'] = (uri($uri_segment) * $return['per_page']) - $return['per_page'];
		if($return['offset'] < 0) $return['offset'] = 0;
		
		if (count($_GET) > 0)
		{
			$return['suffix'] = '?' . http_build_query($_GET, '', "&");
			$return['first_url'] = $return['base_url'] . $return['suffix'];
		}
		
		return $return;
	}
}