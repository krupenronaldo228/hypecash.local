<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends SITE_Controller {

	public $page = 'errors';

	public function index()
	{
		$this->init($this->page);
		
		$this->breadcrumbs->add($this->data['pageinfo']['name'], $this->page);

        $this->output->set_status_header('404');
		
		$this->output('common/404');
	}
}