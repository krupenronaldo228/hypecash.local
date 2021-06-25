<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Pages
 * @property Pages_model pages
 */

class Pages extends SITE_Controller {
	
	public function index()
	{
		$alias = uri(1);
		
		$this->init('about');
		
		$this->load->model('pages_model', 'pages');
		
		$item = $this->pages->getItem(['alias' => $alias, 'visibility' => 1]);
		if(empty($item)) show_404();
		
		$this->data['item'] = $item;
		
		$this->breadcrumbs->add($this->data['item']['title'], $alias);
		
		$this->add_script('assets/plugins/share42/share.js');
		
		$this->output('pages/page');
	}
}