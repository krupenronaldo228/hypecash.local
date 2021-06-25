<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class About
 */

class About extends SITE_Controller {
	
	public function index()
	{
		$this->init('about');
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], 'about');
		
		$this->add_script('assets/plugins/share42/share.js');
		
		$this->output('pages/about');
	}
}